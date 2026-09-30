# 01 — Competitors

Observed 2026-09-30.

## How this was researched, and its limit

- **No competitor page was actually opened.** This environment's network policy denied the
  connection to buscaabogados.com.py, datos.gov.py and the other sites. Everything here comes
  from web-search result snippets.
- **Nothing was scraped or copied.** Their terms forbid scraping, and a blocked connection was
  never worked around.
- Anything marked **UNVERIFIED** needs your eyes. The checklist at the end takes about 15
  minutes in a normal browser.

## buscaabogados.com.py (main competitor)

| Aspect | What we know | Status |
|---|---|---|
| What it lists | Lawyer directory + an AI "first step" tool. You browse by practice area and city. A snippet shows a "Derecho laboral en Asunción" listing, so specialty × city pages exist | snippets |
| Size | Unknown | UNVERIFIED |
| Contact flow | About 3 short questions → the AI names the type of problem → matching verified lawyers by case and city are shown. Free for the visitor. Your brief says contact is by WhatsApp or form | final contact step UNVERIFIED |
| How lawyers pay | A "Miembro fundador" badge appears on profiles. Your brief says first 100 profiles free, then a paid plan. Prices not seen | UNVERIFIED |
| Trust signals | Claims profiles are verified, not self-declared: identity and matrícula checked before publishing, matrícula matched against the Corte Suprema's public list, and the cédula confirmed as belonging to that professional | wording from snippets |
| What "verificado" does *not* say | How often it is re-checked. Whether suspensions or sanctions are covered. Which CSJ source is used (the only public bulk list, the 2019 open dataset, can't prove *current* status) | gap |
| SEO structure | Only the home URL confirmed | UNVERIFIED |
| Observable weaknesses | Nothing public about fees. The verification claim leans on a CSJ list that may be dated. No evidence of guides, costs or response times | inferred, verify |

**Takeaway.** It already has the three table-stakes features: verification, AI intake and
WhatsApp. We cannot beat it by copying those. We beat it on:
- **precision of trust**: exactly what we checked, and when;
- **depth of answers**: costs, steps, plazos;
- **routing discipline**: response times and reassignment;
- **the business/foreigner niche**.

## abogados.com.py

- **No indexed evidence the site exists or ranks.** Two searches returned nothing for the domain.
- The only related hit is a Ciudad del Este Facebook page, "Abogados." (about 3.3K likes). It
  calls itself the most complete digital guide of lawyers in Paraguay and uses a Hotmail contact.
- Your figure of about 45 profiles is UNVERIFIED.
- Treat it as a **small, weak competitor**. It is worth a manual look: a weak site on an exact-match
  domain could be a future acquisition target (question 14 in `10-risks-and-open-questions.md`).

## Others found

| Player | Model | Weakness vs us |
|---|---|---|
| SoloAbogados.org | Regional directory with city pages (`/abogados/paraguay/asuncion`); a snippet shows about 13 entries in Asunción | Tiny, not local, no verification |
| Lawzana | Global "top 10 per specialty/city" pages, in EN and ES | Generic rankings, thin, basis unknown |
| Lawyertys, NotariaLatina | International directories. NotariaLatina uses numeric-ID profile URLs and has reviews | Templated, low trust, weak URLs |
| Lexgoapp | "Most recommended" list + app | Unknown depth |
| Lawyers.com, The Lawyers Global | English firm listings for foreigners | Firms only, a handful |
| Yagua / yellow-pages | Business listings | Old, generic |
| German Embassy list | PDF of recommended lawyers for German citizens (Oct 2025) | Not a product; confirms foreigner demand |
| Widú Legal | Self-serve legal documents + allied lawyers | Document-first, not search |
| honorarios.com.py | Fee information site (arancel) | Fee content only. It competes with our fee pages, not our directory |
| LEXIUS, Dikaia | AI legal research for professionals | Different audience |
| Colegio de Abogados del Paraguay | Professional body. About 1,123 members, listed only in a PDF | No searchable directory. Membership is voluntary and small |
| Law-firm sites (Vouga, etc.) | Single firms | Not directories. Potential lawyer-side customers |

**No Doctoralia-style Paraguayan lawyer marketplace was found** (reviews + response times + fee
ranges + a routed intake).

## CSJ data relevant to verification (details in `08-data.md`)

- **Open dataset "Abogados"** (datos.gov.py / datos.csj.gov.py):
  - published by the CSJ under the government public-information licence;
  - fields reportedly matrícula + name;
  - **last modified 2019-10-15**;
  - the download could not be tested from here.
- **Matrícula digital (Acordada 1.764/2024, Dec 2024):** lawyers can carry a digital carnet with
  a QR code. Scanning it shows whether the lawyer is authorised, suspended or cancelled, plus
  sanctions. This is the best per-lawyer current-status check that exists, and it is the one our
  badge relies on.
- A **constancia de matrícula** can be requested from the CSJ through its correspondence form.

## Opportunities (feed into `02-market.md` §4)

1. Publish exactly what "verificado" means, with a date, and use the QR matrícula digital for
   *current* status.
2. Fees: nobody combines the legal minimums (arancel) with lawyer-declared ranges on a directory.
3. Interior cities in depth (Encarnación, CDE, PJC, Coronel Oviedo). The incumbents cluster on
   Asunción.
4. Foreigners: EN/PT pages for residency and company formation face only generic international
   directories.
5. Response-time data and automatic reassignment. No competitor shows either.
6. Clean slug URLs + honest schema, against numeric-ID and templated competitors.

## Manual check for you (browser, ≤ 6 pages per site, read only, don't copy text)

Write findings under "Owner check" below; P1 reads them.

1. buscaabogados.com.py:
   - home;
   - one specialty × city listing (note the URL pattern and how many lawyers it shows);
   - one lawyer profile (fields shown, the badge wording, the contact button: WhatsApp or form?);
   - the lawyer plans page (prices in Gs, the founder offer's terms);
   - `/robots.txt`;
   - the terms page (the scraping clause, what they promise about verification).
2. abogados.com.py: does it load? How many profiles? How do you contact a lawyer? Is there a
   paid plan?
3. Scan a real lawyer's *matrícula digital* QR and note the landing URL and what it shows. This
   decides the verification step 3 procedure.

### Owner check

_(empty — fill in)_
