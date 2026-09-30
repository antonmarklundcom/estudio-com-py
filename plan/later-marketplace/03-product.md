# 03 — Product

What v1 does, for whom, and the exact rules. Builders implement this file literally. The wedge
behind these choices is in `02-market.md` §4; the legal limits are in `05-legal.md`.

## 1. Roles

| Role | Account? | What they do |
|---|---|---|
| Visitor / client | **No account.** They get a private tokenized link (`/mi-consulta/<token>`) on screen after submitting, and by email if they gave one | Browse, read guides, run the intake, pick lawyers, rate the lawyer later |
| Lawyer (`lawyer`) | Yes: email + password, phone confirmed | Profile, verification, lead inbox, plan, invoices |
| Admin (`admin`) | Yes, 2FA (TOTP) | Verification queue, leads, disputes, reviews, payments, settings |
| Editor (`editor`) | Yes | Guides/taxonomy copy only; no PII access (added in P1, used later) |

`users.role` is a DB enum from day one. Every mutation checks the role **and** ownership on the server.

## 2. Taxonomy (seeded in P0; editable by admin)

**Specialties (11)**, slug → public name: `familia` Familia y divorcio · `sucesiones` Herencias y
sucesiones · `laboral` Laboral · `penal` Penal · `civil` Deudas, cobros y contratos ·
`inmobiliario` Inmuebles y alquileres · `accidentes` Accidentes y daños · `empresas` Empresas y
sociedades · `tributario` Impuestos (DNIT) · `marcas` Marcas y propiedad intelectual ·
`migraciones` Residencia y migraciones.
The 8 existing área slugs of the PHP site map 1:1 onto the first 8 (no rename), so old URLs redirect cleanly.

**Situations (14 client-facing cards).** The client picks a situation, never a specialty. Each maps
to one specialty and to a question set. Our own wording, written for this site:

| slug | Card text | → specialty | Urgency hint asked |
|---|---|---|---|
| `me-despidieron` | Me despidieron o tengo un problema en el trabajo | laboral | date of dismissal |
| `divorcio` | Quiero separarme o divorciarme | familia | — |
| `hijos` | Pensión, tenencia o visitas de mis hijos | familia | court date? |
| `herencia` | Murió un familiar y hay bienes | sucesiones | — |
| `me-demandan` | Me llegó una demanda, intimación o notificación | civil | date received |
| `cobrar` | Me deben dinero y quiero cobrar | civil | — |
| `deudas` | Tengo deudas que no puedo pagar | civil | embargo? |
| `alquiler` | Problema con un alquiler o desalojo | inmobiliario | date of notice |
| `inmueble` | Comprar, vender o regularizar un inmueble | inmobiliario | signing date |
| `accidente` | Tuve un accidente o sufrí un daño | accidentes | date of accident |
| `penal` | Me denunciaron, quiero denunciar o hay un detenido | penal | **detained now?** |
| `empresa` | Crear una empresa, socios o contratos | empresas | — |
| `impuestos` | Tengo un problema con la DNIT | tributario | notice deadline |
| `extranjero` | Soy extranjero: residencia, empresa o bienes | migraciones | visa/permit expiry |
| `otro` | Otra cosa | admin triage (`otros`) | — |

`penal` + "detained now" shows an immediate notice before the form: contact a lawyer now, and the
public defender service exists (wording and phone number are an owner-verified fact, `05-legal.md` §7).

**Cities.** Seed the 17 departments' capitals plus Gran Asunción: Asunción, Luque, San Lorenzo,
Lambaré, Fernando de la Mora, Capiatá, Mariano Roque Alonso, Ñemby, Limpio, Villa Elisa, San
Antonio, Itauguá, Ciudad del Este, Hernandarias, Presidente Franco, Encarnación, Pedro Juan
Caballero, Coronel Oviedo, Caaguazú, Villarrica, Concepción, Pilar, San Juan Bautista, Caacupé,
Paraguarí, Salto del Guairá, Villa Hayes, Filadelfia. Each city belongs to a department
(`departments` table). Lawyers pick cities; they can also tick **"Atención virtual en todo el país"**.

**Languages:** `es` (implicit), `gn` Guaraní, `pt` Portugués, `en` Inglés, `de` Alemán.

## 3. Client side

### 3.1 Entry points
Every public page ends in one CTA: **"Contar mi caso"** → `/consulta/` (situation preselected when
the page knows it). Profiles also offer **"Escribir por WhatsApp"** (directory contact, §3.5).

### 3.2 Intake flow (`/consulta/`), mobile-first, 5 steps, no account

1. **Situación** — the 14 cards. As soon as a card and (on step 4) a city are known, a live line
   shows supply honestly: *"3 abogados verificados atienden laboral en Luque"* or *"Aún no hay
   abogados verificados en Luque; le mostraremos abogados con atención virtual"* — so the client
   knows what they get before giving a phone number.
2. **Preguntas** — 3–6 closed questions from the situation's question set (JSON in the repo,
   `content/intake/<situation>.json`): e.g. `me-despidieron`: fecha del despido, ¿le pagaron la
   liquidación?, ¿estaba en IPS?, antigüedad (rangos), ¿firmó algo? Each question has a
   `plazo` flag if the answer can start a legal clock.
3. **En sus palabras** — free text, 30–1500 chars, with a visible hint: *"No incluya números de
   cédula, cuentas ni datos de terceros. El abogado se los pedirá si hacen falta."* Optional
   (not v1: file upload).
4. **Dónde y cómo** — city (autocomplete), "¿acepta atención virtual?" (default yes), preferred
   language, contact preference: **WhatsApp** (default) / llamada / email; name; phone (required);
   email (optional).
5. **Revisar y enviar** — shows the AI summary (§3.3) *as the lawyer will read it*, editable by the
   client; two consent checkboxes (§3.6); Turnstile; submit.

After submit → matching result page (§5). **No phone OTP in v1**: estudio has no WhatsApp number
and no SMS (decided). Fake leads are handled by Turnstile, rate limits, dedupe and lawyer reports
(§5.6). Email is optional but encouraged: *"Déjenos su email y le avisamos cuando un abogado acepte."*

Save progress in `localStorage` per step; abandoned intakes are not stored server-side before
step 5 (data minimisation), only anonymous funnel events.

### 3.3 AI summary (what the lawyer receives)
Generated server-side at step 5 from the answers + free text. Output is **structured JSON** (schema
in `06-architecture.md` §6), rendered as:

- *Resumen* — 3–5 neutral bullets of facts as stated by the client ("El cliente indica que…").
- *Especialidad sugerida* + confidence; if low, the case goes to admin triage instead of auto-match.
- *Posibles plazos* — only restating dates the client gave and marking them "a confirmar por el abogado".
- *Preguntas que el abogado podría hacer* — 3 items.
- *Documentos que suelen pedirse* — pulled from the situation's static checklist, not invented.

Hard rules (enforced in the prompt **and** by a post-filter + tests): no advice, no prediction of
outcome, no amounts owed, no legal citations, no "usted tiene derecho a". The client sees the same
text and the disclaimer: *"Este resumen lo arma un sistema automático con lo que usted escribió. No
es asesoramiento legal. Solo un abogado puede evaluar su caso."*
If the model call fails or times out (8 s), a deterministic template summary is used; the intake never blocks.

Redaction before storage and before the model call: regex-mask cédula-like numbers, card/account
numbers and emails inside the free text (the client's own contact fields are separate).

### 3.4 Urgency
`urgency = alta` when any `plazo` answer is ≤ 10 days old / ≤ 10 days ahead, or detained-now, or the
client ticks "tengo un plazo que vence pronto". Urgent cases: shorter SLA (§5.4), badge in the
lawyer inbox, admin alert. We never compute the legal deadline itself.

### 3.5 Directory contact (no intake)
The profile's WhatsApp button opens `wa.me/<lawyer>` with a neutral prefill ("Hola, le escribo desde
estudio.com.py…"). We log a `contact_click` event (lawyer, page, time) — no client data. This is
free for every verified lawyer, paid or not, and is shown to them as "contactos directos".

### 3.6 Consent (two checkboxes, not pre-ticked)
1. *Acepto los Términos y la Política de Privacidad.*
2. *Autorizo a enviar mi consulta y mis datos de contacto a los abogados que elija (máx. 3) y, si
   alguno no responde, al siguiente que me proponga el sistema.* (If unticked: only the chosen
   lawyers, no automatic reassignment.)
Stored as `consents` rows (text version hash, timestamp, IP hash). Marketing opt-in is a separate,
optional third box and defaults off.

### 3.7 Client status page `/mi-consulta/<token>`
Shows: case summary, which lawyers received it, accepted/declined/expired, the lawyers' contact
buttons once accepted, "¿Le contactaron?" answer buttons, "Pedir otro abogado", "Eliminar mis
datos". Token = 32 random bytes, stored hashed, expires 180 days.

## 4. Lawyer side

### 4.1 Signup & onboarding (`/para-abogados/registro`)
Email + password + phone + name + matrícula number + specialties + cities. Email confirmation link.
Then a checklist dashboard: completar perfil → subir documentos → verificación → elegir plan.
**A profile is never public before `verification.status = verified`.**

### 4.2 Profile fields
Public: display name (as on the matrícula), photo (own, uploaded, face visible, no stock), title
line (≤ 80 chars), bio (300–1500 chars), specialties (≤ 3 principales + ≤ 3 secundarias),
cities + virtual flag, languages, years practising (derived from matrícula year when known; else
self-declared and labelled "declarado"), office address (optional, shown only if they want),
**honorarios orientativos** per specialty, one of three modes: *"Según arancel legal (Ley
1376/88)"* · *"Consulta inicial desde Gs X"* (X validated ≥ the arancel minimum for a verbal
consultation, computed from the current jornal mínimo) · *"A convenir en la primera consulta"*;
plus an optional "cómo cobro" note ≤ 300 chars. Self-declared and labelled as such. **No "consulta
gratis" option** — a fee below the arancel is void and a waiver risk (`05-legal.md` §2),
working hours, WhatsApp number (hidden unless the lawyer ticks "mostrar mi WhatsApp" — that tick
is stored as consent), website, verification badge + date, reviews.
Private: cédula, documents, billing data (RUC/razón social for the invoice), notification settings,
vacation mode.
Slug: `/abogado/<nombre-apellido>` (+ `-2` on collision). Name changes are admin-approved.

### 4.3 Verification — what "Verificado" means (exact)
The badge **"Matrícula verificada"** is shown only when all four checks passed and are < 12 months old:

1. **Identity** — cédula (front/back) reviewed by an admin; name matches the account.
2. **Matrícula** — the lawyer's CSJ credential (physical carnet or the CSJ *matrícula digital* with QR)
   uploaded; number and name match.
3. **Official status** — an admin confirms the matrícula is *active* on an official CSJ source: the
   QR of the digital matrícula (shows habilitado/suspendido/cancelado), or a CSJ constancia de
   matrícula issued ≤ 90 days ago (checked for authenticity by its verification code/QR if it has
   one), or the
   CSJ open dataset as a *secondary* cross-check only (it is from 2019 and cannot prove current
   status). The source used, the date and the admin are stored in `verifications`.
4. **Liveness/contact** — a 2-minute video call (Google Meet link sent by email) or a selfie
   holding the credential, and the admin phones the lawyer's number once to confirm it.

Badge tooltip and `/como-verificamos/` state exactly these four steps and the date of the last
check. If step 3 cannot be done for a lawyer, there is **no badge and no public profile**. Re-check
every 12 months (cron flags `expires_at`); suspension found → profile hidden immediately. We never
claim to verify specialisation, experience, quality or disciplinary history.

Document handling: stored in a private bucket, visible only to admins through 5-minute signed
URLs, deleted 90 days after the decision (the `verifications` row keeps method, source, result,
date, admin — not the images).

### 4.4 Lead inbox
List of cases with state chips: *Nuevo (vence en 3 h 20 min)*, *Aceptado*, *Rechazado*, *Vencido*,
*En disputa*. Case view before accepting: situation, AI summary, city, urgency, language, contact
preference — **no name/phone/email**. Buttons: **Aceptar** / **No puedo tomarlo** (reason: fuera de
mi área, sin agenda, conflicto de interés, otro). After accept: full contact data + "Abrir WhatsApp"
button (the lawyer's own WhatsApp, via `wa.me`) + "Marcar como contactado" + "Reportar problema"
(§5.6). Notifications on each new case: **Web Push** to the installed lawyer panel (PWA, works on
Android and on iPhone once added to the home screen) + email; one reminder at 50 % of the SLA;
daily digest email. No estudio WhatsApp number in v1 (decided).

### 4.5 Reply tracking
Events per assignment: `offered_at`, `viewed_at`, `accepted_at|declined_at|expired_at`,
`contacted_at` (lawyer marks), `client_confirmed_contact` (client answers at +24 h). Public profile
shows **"Responde habitualmente en X h"** only after ≥ 5 offers in 90 days (median offered→accepted).

### 4.6 Reviews
Only the client of an **accepted** assignment can review, via a one-time link sent 14 days after
acceptance (reminder at 30 days). 1–5 stars on two axes (atención, claridad) + text ≤ 1000 chars;
no review of the case outcome is asked. Lawyer can reply once. Admin moderates before publishing
(rules: no insults, no personal data, no case details that identify third parties). Reviews are
never edited by us, never deleted for being negative, never bought, never imported. Profile shows
the count and average only from ≥ 3 published reviews.

### 4.7 Plans & billing (details in `04-business-model.md`)
Plan page, this month's cases (offered / accepted / fair-use cap), **paid until** date, how to pay
(bank transfer details and a reference code `EST-<id>-<periodo>`, or a payment link you created by
hand), a "Ya pagué" button (optional receipt upload), invoices you issued. **Billing is manual**:
no card on file, no auto-debit. Email reminders 7 days and 1 day before the paid-until date; after
a 7-day grace period routing turns off until you confirm the next payment. **No
per-case price anywhere**: cases are included in the subscription, never sold one by one
(`05-legal.md` §1).

## 5. Matching and lead routing

### 5.1 Eligibility (all must hold)
Verified & badge current · plan includes routing (Profesional, founder, or trial) · specialty match
(principal or secondary) · serves the client's city, **or** virtual + client accepts virtual ·
speaks the requested language (Spanish always ok unless client asked another) · not in vacation
mode · under the monthly fair-use cap (settings, default 40 accepted) · not paused from routing (§5.5) ·
never offered this same case before.

### 5.2 Ranking (deterministic, documented publicly on `/como-funciona/`)
`score = specialty (principal 40 / secondary 20) + location (same city 30 / same department 15 /
virtual 10) + responsiveness (0–20: median accept time and accept rate, 90 days, neutral 10 for
new lawyers) + fairness (0–10: fewer cases accepted in the last 7 days than the cell median) + profile
completeness (0–5)`. Ties → random. **Plan tier never adds points** (only eligibility, §5.1).
Sponsored slots are separate and labelled (`04` §2).

### 5.3 Shortlist and client choice
Result page shows up to **3** eligible lawyers (photo, name, badge, specialties, city/virtual,
response time, honorarios orientativos, rating if ≥ 3). All pre-selected; the client can deselect.
**"Enviar mi consulta"** creates one `lead_assignment` per selected lawyer. Max **3 simultaneous**
lawyers per case (shared, not exclusive). The client may also just open a profile and use WhatsApp.

No eligible lawyer → honest message ("Todavía no tenemos un abogado verificado de X en Y"), offer
virtual lawyers of that specialty, and a waitlist opt-in; the case is kept as *sin cobertura* and
counted in the admin demand report (a cold-start tool, `04` §5).

### 5.4 SLA and reassignment
- Business hours: Mon–Fri 08:00–19:00, Sat 08:00–12:00, America/Asuncion, holidays table. Timer
  pauses outside them.
- Lawyer must **accept or decline within 6 business hours** (urgent: 3). Default is 6 rather
  than 4 because alerts are Web Push + email, not WhatsApp; it's a setting, tune it after 60 days of data.
- Timeout → assignment `expired`, responsiveness penalty, and — if
  the client consented to reassignment — the next-ranked eligible lawyer gets the case
  automatically (up to 3 total accepted, up to 6 total offers per case).
- Client check-in at accept + 24 h by email if given (otherwise the question waits on the status
  page): "¿Le contactó el abogado?" No → assignment
  flagged, offer "pedir otro abogado", penalty after admin sees 2 such flags in 30 days.
- The promise to clients (the conversion message) is shown only in specialty×city cells with
  ≥ 2 eligible lawyers: *"Un abogado verificado acepta su consulta en pocas horas hábiles, o se la
  enviamos a otro."* Never a guarantee of result.

### 5.5 Routing suspension
Accept rate < 40 % over the last 10 offers, or ≥ 3 expiries in 14 days → paused from routing for 7
days (still listed), lawyer notified with the reason. Admin can override.

### 5.6 Bad-lead reports (no money involved)
Because cases are not priced one by one, a bad lead costs the lawyer time, not money — so there is
nothing to refund. Within 72 h of accepting, the lawyer can report: *contacto falso/inalcanzable*
(3 attempts over 48 h, logged), *duplicado*, *fuera de área* (misclassified), *ya tiene abogado*,
*spam/abuso*. Admin decides in ≤ 2 business days. Upheld → the case doesn't count toward the fair-use
cap or the lawyer's accept-rate/response stats, the phone/IP goes on the blocklist when it is spam
or fake, and misclassification feeds the triage review. If per-case pricing is ever introduced
(only after the legal opinion in `05-legal.md` §1), a credit rule is added then.

## 6. Admin (`/admin`)
Verification queue (documents, checklist, CSJ source field, approve/reject with reason) · Lawyers
(status, plan, pause, notes) · Cases (all, with triage queue for `otro`/low confidence; PII visible
only here, every view audited) · Assignments & SLA monitor · Bad-lead reports · Reviews moderation
· Payments (confirm a transfer → set paid-until +1 month / +1 year; record the invoice number you issued) · Revenue (MRR, paid
lawyers, churn) · Demand report (cases by specialty × city, covered/uncovered) · Abuse reports
(from lawyers and clients; block phone/IP) · Taxonomy & settings (SLA hours, fair-use cap, max lawyers
per case, holidays) · Audit log viewer.

## 7. Out of scope for v1 (do not build; send to backlog)
In-app chat or calls · video consultations · client accounts/logins · clients paying lawyers through
us (escrow, fees, success fees) · booking calendars · file uploads from clients · a public legal
Q&A chatbot or any AI answer to legal questions · public Q&A forum · document generation ·
multi-lawyer firm accounts (v1.5) · lawyer-to-lawyer referrals · **pay-per-lead, per-case prices,
commissions or any share of the lawyer's fee** · auctions/bidding for leads · exclusive leads · reviews imported from Google or elsewhere · Guaraní/Portuguese/English UI
(except the fixed set of secondary-wedge pages in `07-seo.md` §6) · native apps · scraping or
bulk-importing lawyers into public profiles · SMS channel · notary (escribano) listings.
