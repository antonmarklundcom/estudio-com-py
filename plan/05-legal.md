# 05 — Legal and ethics (hard constraints)

**I am not a lawyer.** Primary legal texts could not be opened from this environment; the findings
come from search extracts of official URLs (bacn.gov.py, csj.gov.py, colegiodeabogados.org.py)
and commentary. Each item says how sure it is and what **a Paraguayan lawyer must confirm (⚖)**
before launch. The rules in the "Build rule" lines are binding on builders regardless.

## 1. Lawyer advertising, solicitation, paid lead generation

**Findings.**
- There is no statutory lawyer ethics code. The *Código de Ética Profesional* of the Colegio de
  Abogados del Paraguay binds its members (membership is voluntary, Constitution art. 42).
  - **Art. 8, "Formación de clientela":** avoid direct or indirect solicitation of clients. Avoid
    "suspicious or excessive" advertising and **"la mediación de agentes o corredores"**. Ads
    should be limited to title, specialties, office and hours, in sober text.
  - **Art. 28:** fees may be shared only among lawyers (and procuradores) who did common work.
- The CSJ (Consejo de Superintendencia) disciplines lawyers and controls the matrícula.
- No Código de Organización Judicial (COJ, Ley 879/81) article on advertising was found.
- Confidence: medium on the article wording, low on how it applies to platforms. No case law was
  found.

**What that means for us.**
- A flat subscription for a listing and a software tool is the lowest-risk model. It is
  comparable to paid advertising.
- Per-lead or commission pricing is the main risk, because it can be read as a paid "corredor"
  or as fee-sharing.
- Ranking by payment could be read as "publicidad excesiva".
- The risk falls mostly on the lawyers, and is reputational. It is still our risk too: lawyers
  won't join a platform that exposes them.

**Build rules.**
- No per-lead price, commission, success fee or any share of a lawyer's fee (`04` §1).
- The organic ranking never uses the plan tier (`03` §5.2).
- Sponsored cards are labelled "Patrocinado" and sit outside the ranked list.
- Profile copy is sober. The profile form blocks superlatives ("el mejor", "100 % casos ganados",
  "garantizado") with a wordlist check. Specialties are "áreas de práctica declaradas", not
  certified specialisations.
- The platform never contacts a client on a lawyer's behalf. The client chooses whom to send
  the case to (`03` §5.3).

⚖ Confirm:
- whether the included-cases subscription is compatible with arts. 8 and 28;
- whether a sponsored slot is acceptable;
- whether an updated Colegio code or a CSJ acordada on publicity exists;
- what the lawyer-facing terms should say.

## 2. Fees: Ley 1376/88 (arancel)

**Findings (high confidence on the core rule).**
- The arancel applies when there is no written fee contract.
- A **fee agreement below the arancel, or a prior waiver, is void**.
- Cuota litis is allowed up to 45 % of the net result, but not in alimentos or labour cases
  (medium confidence).
- Consultations are priced in jornales: a verbal consultation is at least 5 jornales/hour
  (about Gs 585k at Gs 117,077 per jornal).

**Build rules.**
- No "consulta gratis" option anywhere: not on profiles, not in ads, not in our copy.
- A lawyer's "desde Gs X" for a consultation is validated to be ≥ the arancel minimum, computed
  from the `settings.jornal_minimo` value.
- The platform publishes arancel minimums only as tables reviewed by a lawyer, and labels them
  "mínimo legal según Ley 1376/88; el honorario final lo acuerda con su abogado".
- Our copy never says or implies that a lawyer on the site charges less than the law allows.

⚖ Confirm:
- the exact articles and the jornal count per act for the tables in `07-seo.md` §5;
- whether "consulta inicial sin cargo" breaches art. 1 (we assume it does);
- whether we may publish lawyers' declared ranges at all.

## 3. Unauthorized practice and the AI intake

**Findings (low confidence).**
- Representation in court is reserved to matriculated abogados and procuradores (COJ arts. 87–91).
- No statute was found that reserves out-of-court "orientación" to lawyers.
- Risk rises if the AI advises, predicts, drafts filings, or if the site looks like a law firm.
- **The brand "estudio" reads like "estudio jurídico".** That is a misleading-advertising risk
  under Ley 1334/98 and a trust risk.

**Build rules.**
- The AI only summarises facts (`03` §3.3, `06` §6).
- The disclaimer appears on the intake, on the result page and in the footer: *"estudio.com.py
  es un directorio de abogados independientes. No es un estudio jurídico y no presta
  asesoramiento legal. La relación profesional es entre usted y el abogado que elija."*
- The header tagline always carries "Directorio de abogados verificados".
- JSON-LD for the platform is `Organization`, never `LegalService`.

⚖ Confirm whether the name "estudio.com.py" needs more than the tagline + disclaimer (question 2
in `10-risks-and-open-questions.md`).

## 4. Personal data

**Findings.**
- **Ley 6534/2020** covers credit data only. It repealed 1682/01 and 1969/02.
- **Ley 7593/2025** (general data protection) was promulgated on 2025-11-27 with a 2-year
  *vacatio legis*, so it applies fully around **late November 2027**. The data agency (ANPDP) is
  being set up in 2026. The main points, all medium confidence:
  - legal bases: consent, contract, legitimate interest and others;
  - consent must be prior, free, informed and unequivocal, and revocable;
  - sensitive data includes health, sexual life and biometrics; criminal data is left to special
    regulation;
  - rights: access, rectification, deletion, objection, portability, restriction; about 30 days
    to answer;
  - safeguards on automated decisions;
  - international transfer only with adequacy or safeguards;
  - breach notice within 72 h;
  - fines up to 10,000 jornales.
- Constitution art. 33 (privacy) and art. 135 (habeas data) apply now.

**Build rules. We build to Ley 7593 from day one; it is cheaper than retrofitting.**
- **Treat every case description as sensitive.** It routinely contains health, family, sexual
  or criminal facts. That means:
  - explicit consent to share it with the chosen lawyers (`03` §3.6);
  - encryption at rest (`06` §4);
  - redaction of identifiers before AI processing;
  - no case text in VenderCRM, analytics, logs or error trackers.
- **What we store about clients:** name, phone, optional email, city, situation, answers, free
  text, the AI summary, consents, assignment events and hashed IP. Nothing else. No cédula, no
  documents in v1.
- **Retention:**
  - unaccepted cases: 180 days;
  - accepted cases: 24 months;
  - verification images: 90 days after the decision;
  - lawyer accounts: while active + 5 years for invoices (tax law);
  - after that, PII is purged by cron and anonymised stats are kept.
- **Rights:**
  - "Eliminar mis datos" on `/mi-consulta/`;
  - a rights request form on `/privacidad/` with a 15-day internal target (under the reported
    30-day legal limit);
  - human review available for any automated routing outcome ("Pedir revisión" → admin).
- **International transfers:** list the processors and countries in the privacy policy
  (Hostinger, Cloudflare, Anthropic, uPay, VenderCRM, Google Analytics) and get
  DPAs where offered. Under 7593 a transfer mechanism is needed. ⚖ Confirm what suffices.
- **Breach runbook** (in P5): contain → assess → notify affected users and, from when the ANPDP
  exists, the agency within 72 h.
- **Lawyers are data subjects too:** CSJ roll data is used only to verify a lawyer who signed up.
  We never publish unclaimed profiles built from the dataset (`08-data.md`).

⚖ Confirm:
- 7593 obligations that apply before November 2027 (if any);
- how criminal-matter intakes must be handled;
- the retention periods;
- the transfer mechanism;
- whether the controller must register with the ANPDP.

## 5. Consumer and e-commerce law

**Findings (medium-high confidence).**
- **Ley 4868/13 art. 7:** the site must permanently show:
  - legal name, address, owners, email and phone;
  - the privacy policy;
  - an electronic copy of the contract.
- **Art. 23:** commercial electronic messages must be labelled as such, with an opt-out, and use
  lawfully obtained data.
- **Ley 1334/98:** liberal professions are excluded, but the **advertising** that offers them is
  covered. Our service to clients is covered by it.

**Build rules.**
- **Your decision: no RUC on the site for now.** Art. 7 (as reported) lists legal name, address,
  owners, email and phone; RUC is not in the list. Until payments go live the footer and
  `/contacto/` show the brand, an email address and the contact form. ⚖ Before P4 (when we start
  charging lawyers) the lawyer confirms the minimum identity a site that *sells* must show. The
  RUC then appears on the invoices sent to lawyers, not on public pages.
- The terms (clients) and the lawyer terms (B2B) are versioned MDX files, and the version hash
  is stored with each acceptance.
- Every promotional message has an opt-out line.

## 6. Reviews, badges, claims (our own rules; no Paraguayan rule found beyond misleading advertising)

- Reviews come only from verified, accepted assignments (`03` §4.6). None are fake, bought,
  seeded, incentivised with money, or imported. Negative reviews are never removed for being
  negative.
- "Verificado" means exactly the four checks in `03` §4.3. The badge carries its date and links
  to `/como-verificamos/`. A check we don't perform is never claimed: no "especialista
  certificado", no "sin antecedentes".
- No guarantee of outcome, response, or price anywhere. The SLA copy promises a *process*
  (reassignment), not a result.
- Sponsored placement is always labelled.
- No scraped private data. No contacting people from scraped lists without a lawful basis
  (`08-data.md` §3). The *No Molestar* registry (Ley 5839/2017, SEDECO) is checked before any
  WhatsApp or call outreach.

## 7. Facts to verify before they go live (owner + lawyer)

- The public-defender (Ministerio de la Defensa Pública) contact shown to "detenido ahora"
  intakes.
- The jornal mínimo value and the arancel tables.
- Jurisdiction facts in the 25 local blocks (carried over from `legacy-php/docs/facts-to-verify.md`
  and extended).
- The QR matrícula-digital verification procedure (`01-competitors.md`, manual check 3).

## 8. Pages to write (P1, reviewed by a lawyer before cutover)

`/terminos/` (clients), `/para-abogados/terminos/` (lawyers: verification, routing rules, SLA,
pause, plans, cancellation, no commission, conduct), `/privacidad/` (per §4), `/como-verificamos/`,
`/como-funciona/` (the ranking formula in plain words, sponsored labelling), cookie notice (GA4
consent, off until accepted).

## 9. Taxes (for the accountant)

The selling entity charges IVA 10 % on subscriptions and sponsored slots, owes IRE, and must issue
SIFEN e-invoices. Whether a new RUC must e-invoice from day one is a DNIT/accountant question. Foreign
SaaS costs (Anthropic, Meta, Cloudflare) carry IVA through card perception.
