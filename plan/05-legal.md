# 05 — Legal protection (highest priority)

**I am not a lawyer, and this is not legal advice.** The primary legal texts couldn't be opened
from this environment, so the findings come from search extracts of official sources. Items
marked ⚖ go to the one-off lawyer consultation in §10 before paid ads or partner fees start.

## 1. What you are, and what you never say

**You are a marketing and contact service:** *"estudio.com.py le pone en contacto con abogados
independientes matriculados."* You are not a law firm and you don't give legal advice. You are
never a party to the relationship between the client and the lawyer.

| Allowed (use these) | Never (a check in `verify.sh` fails the build) |
|---|---|
| "Le ponemos en contacto con un abogado independiente" | "nuestros abogados", "nuestro estudio", "somos abogados", "nuestro equipo legal" |
| "Abogado asociado: Abg. <nombre>, matrícula N° <n>" (only when true) | "asesoramiento legal", "asesoría jurídica", "le asesoramos", "consulta legal gratis" |
| "Información general, no es asesoramiento legal" | "gratis", "sin costo" about a lawyer's service |
| "El abogado le informa sus honorarios antes de empezar" | "garantizado", "ganamos", "100 %", "el mejor", "especialistas certificados" |
| "Usted no paga nada a estudio.com.py" | any number of lawyers, cases, years or reviews that isn't literally true |

**Site-wide:**
- The header tagline is **"Contacto con abogados independientes"**.
- The footer disclaimer, on every page: *"estudio.com.py es un servicio de contacto con abogados
  independientes. No es un estudio jurídico ni presta asesoramiento legal. La relación
  profesional y los honorarios se acuerdan directamente entre usted y el abogado."*
- JSON-LD is `Organization`, never `LegalService` or `Attorney`.

The PHP site already follows most of this (`/plan.md` §1.1). The build adds the enforced check.

**Why it protects you:** representation in court is reserved to matriculated lawyers (COJ Ley
879/81 arts. 87–91). Out-of-court "advice" isn't clearly reserved, but claiming to be a firm or
to advise is where the risk sits:
- misleading advertising (Ley 1334/98 covers the *advertising* of professional services);
- possible complaints from lawyers or the CSJ.

The brand word "estudio" reads like "estudio jurídico". The tagline and disclaimer are the
counterweight. ⚖ Ask whether they are enough.

## 2. Promoting before you have a lawyer

**It's allowed if every promise is one you can keep today.** So the rules below apply until the
first partner signs (they are also the safe default after).

- **The form promise is only what *you* do:** *"Le respondemos en 1 día hábil. Si tenemos un
  abogado independiente para su caso, se lo presentamos (nombre y matrícula) y usted decide si
  quiere que le pasemos sus datos. Si no, se lo decimos y borramos su consulta."*
- **Don't** say "un abogado le llamará", show a "respuesta en X horas" by a lawyer, or show
  fake or placeholder lawyer cards. The honest empty state stays until a real partner exists.
- **The client's data goes to a lawyer only after the client says yes to that named lawyer**
  (two-step consent, §4). This is the single most protective rule: you never hand someone's
  case to a person they didn't choose.
- **No paid ads for an área you can't serve.** SEO traffic is fine; the form's promise is honest
  either way. Ads create volume you would have to turn away.
- A case you can't place gets a reply within 1 business day. The general reply names the public
  defender (Ministerio de la Defensa Pública) for people without means; that wording is
  owner-verified before it goes live. The lead is then deleted from VenderCRM within 30 days.

## 3. Working with 1–3 partner lawyers

**How you get paid (lowest risk first):**

1. **Flat monthly marketing fee** per partner, fixed in advance and unrelated to any client or
   case. It works like paid advertising. **Recommended.**
2. Area exclusivity as part of that flat fee ("the only lawyer shown for familia"). Fine, if the
   site says who the lawyer is.
3. ~~Pay per lead / per case~~: **no.** The Colegio ethics code art. 8 tells lawyers to avoid
   "la mediación de agentes o corredores". A per-lead price makes you look like that broker.
4. ~~A percentage of the lawyer's fees, success fees~~: **never.** Art. 28 allows fee-sharing only
   between lawyers. Doing it exposes the lawyer, and your agreement could be void.

The ethics code binds lawyers who are Colegio members, not you. But a partner who gets in trouble
is your problem too, and a clean model is what makes a good lawyer say yes.

**A written agreement with each partner.** The outline for their lawyer to finalise is in
`docs/partner-agreement-outline.md`, drafted in the build. It covers:
- the services: website marketing and forwarding contact requests the client authorised;
- the flat fee and the term;
- the lawyer's independence: they alone advise, set fees (within Ley 1376/88) and answer for
  their professional work;
- no fee-sharing, commission or per-case payment;
- the lawyer keeps their matrícula active and tells you at once about any suspension;
- the lawyer approves how they're presented (name, photo, text);
- data: each side is responsible for the data it holds, confidentiality, deletion when a client
  asks, and no reuse of clients for other purposes;
- the lawyer indemnifies you for their professional acts;
- 30-day termination, and the lawyer's name comes off the site immediately at the end.

**Check each partner yourself before publishing them:**
- identity (cédula);
- matrícula, with current status from the CSJ *matrícula digital* QR or a CSJ constancia less
  than 90 days old;
- a video call.

Keep a dated note of the check; with 1–3 lawyers this takes minutes. Re-check yearly. Show "Abg.
<nombre>, matrícula N° <n>" on the site, and never a "verificado" badge implying a process
beyond what you did.

**Disclose it:** a page `/como-trabajamos/` says in plain words:
- the partner lawyers pay estudio.com.py a fixed monthly fee for publicity;
- estudio.com.py doesn't charge the client or take any part of the lawyer's fees;
- the client chooses whether to contact the lawyer.

Transparency is your best defence against a "misleading advertising" or "captación" complaint.

## 4. Client data (Ley 7593/2025 applies fully from about November 2027; build to it now)

- **Collect the minimum:** name, phone, city, área (chips), and an optional short note (≤ 500
  characters) with the hint *"No incluya datos sensibles, números de documento ni datos de otras
  personas; el abogado se los pedirá si hacen falta."* No uploads.
- **Consent, step 1** (form checkbox, required, not pre-ticked): *"Acepto la Política de
  Privacidad y autorizo a estudio.com.py a contactarme por teléfono, WhatsApp o email sobre esta
  consulta."* The text version is sent with the lead as a field.
- **Consent, step 2** (per lawyer, before sharing): you message the client *"Le presentamos al
  Abg. X, matrícula N° Y, que atiende casos de Z. ¿Autoriza que le pasemos su nombre, teléfono y
  consulta?"* You forward only after a "sí" and note the date in VenderCRM. That note is your
  proof of consent.
- **Where the data lives:** VenderCRM (your CRM) and the lawyer. Nowhere else: no case text in
  analytics or logs. `enviar.php` already logs only a degraded-mode line; the build checks that
  it doesn't log the message text.
- **Retention:**
  - not placed: deleted within 30 days;
  - placed: deleted 12 months after forwarding;
  - on request: deleted within 15 days.
  A reminder routine in VenderCRM or your calendar does the monthly clean-up.
- **The privacy policy** says:
  - who you are (see §6);
  - what you collect, why, and the two-step sharing;
  - the processors: Hostinger, Cloudflare, VenderCRM, Google Analytics if used;
  - the retention periods above;
  - how to ask for access, correction or deletion (contact form or email);
  - that consent can be withdrawn at any time.
- **Sensitive by nature:** a legal problem often implies health, family, sexual or criminal
  facts. That is why the note is short, optional and warned against, and why sharing needs the
  second consent.

## 5. Content (guides, fee pages, calculators)

- Every guide is general information, dated, with "No es asesoramiento legal; consulte con un
  abogado", and it ends with the contact form.
- There are no case predictions, no amounts "que le corresponden", and no deadlines unless a
  public rule states them (named generically: "la ley fija un plazo; el abogado se lo confirma").
- Fee pages publish **only the arancel minimums (Ley 1376/88)**, labelled "mínimo legal según Ley
  1376/88; el honorario final lo acuerda con el abogado". A fee below the arancel is void, so
  never "gratis". The tables are reviewed by a lawyer before publishing (a partner can do it; the
  byline says so only if true).
- The calculators (fee minimums, severance) say "orientativo" and ship behind a flag until
  reviewed.
- There is no invented social proof: no testimonials, counts or ratings unless real and
  documented.

## 6. Your own exposure (the structural protections)

1. **Operate through a company, not personally:** an EAS (online, about 72 h) or your existing
   company, before you invoice a partner or run ads. The company, not you, signs the partner
   agreements and appears in the privacy policy as the data controller.
2. **Site identity:** your decision is no RUC on the site. The footer shows the brand, an email
   and the contact form. ⚖ Ask what minimum identity Ley 4868 art. 7 requires for a free
   contact service. The same rule covers the company name as data controller.
3. **The terms** (`/terminos/`) say:
   - it is an information and contact service;
   - no lawyer-client relationship with estudio.com.py;
   - no guarantee of result, availability or response by any lawyer;
   - no liability for the lawyer's professional acts;
   - the guides are general information;
   - Paraguayan law, Asunción courts.
4. **Keep records:**
   - the partner check notes;
   - signed partner agreements;
   - consent notes in VenderCRM;
   - deletion log;
   - the versions of terms and privacy (git history is enough).
5. **Taxes:** the flat fee is a service with IVA 10 %. Invoice it through your company (SIFEN) and
   ask your accountant.

## 7. Outreach, when you look for partner lawyers

With 1–3 partners you don't need lists or scraping: use your network, referrals from
contador.com.py contacts, and 1:1 messages to firms that publish their business contact.

For any WhatsApp or call to a number:
- check it against SEDECO's *No Molestar* registry (Ley 5839/2017);
- say who you are;
- stop if they say no.
Commercial emails are labelled as such and include an opt-out (Ley 4868 art. 23).

## 8. Your other directory sites (asked 2026-09-30)

These are the same principles, stated generally. ⚖ Include them in the §10 consultation.
- Publish only business contact data the business published itself.
- A personal mobile goes public only with that person's recorded approval.
- Offer a "reclamar / eliminar esta ficha" route, and act on removals fast.
- Have a privacy page naming the data source.
- Never scrape a site whose terms or robots.txt forbid it, and never get around bot protection.
- These obligations tighten when Ley 7593 applies in full (around late 2027).

## 9. Research findings behind this file

The article-level findings and sources (Colegio code arts. 8/28, Ley 1376 art. 1, COJ, Ley 7593,
Ley 4868, Ley 1334, Ley 5839) are in `later-marketplace/05-legal.md` §1–§7. They apply here
unchanged.

## 10. One-off lawyer consultation: about 1–2 hours, before ads or partner fees

Take this list to an independent Paraguayan lawyer (not your partner, to avoid the conflict of
interest):
1. Is a flat monthly marketing fee from partner lawyers compatible with the Colegio code arts. 8
   and 28? Is area exclusivity OK?
2. Are the brand "estudio.com.py", the tagline and the disclaimer enough to avoid misleading
   advertising?
3. Is the two-step consent (§4) sufficient under Ley 7593 and the Constitution (art. 135)? Are
   the retention periods reasonable?
4. What minimum site identity is required (Ley 4868 art. 7) if no RUC is shown?
5. Review `/terminos/`, `/privacidad/`, `/como-trabajamos/` and the partner agreement outline.
6. Are the arancel fee tables correct, and do they need a disclaimer beyond §5?
7. Your other directory sites (§8): what to change before 2027.
