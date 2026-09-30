# 10 — Risks and open questions

## A. Self-review: the 10 weakest assumptions

I re-read the plan to find what is most likely wrong. Each item is either **fixed** in the plan
(and where) or **flagged**: kept, with how we'll find out early.

| # | Assumption | Why it's weak | Status |
|---|---|---|---|
| 1 | Solo lawyers will pay for *shared* cases | Unvalidated; the competitor gives 100 profiles free | **Mitigated by your prices** (Gs 150k/month, founders Gs 600k/year). The first year of founders produces real data. North-star metric and review at month 3 (`04` §5). Profesional isn't sold in cells that can't deliver ≥ 2 cases/month |
| 2 | Subscription with included cases is ethically safe where per-lead is not | Only the Colegio code wording supports it; no case law | **Flagged → question 3 and 4.** Legal opinion before P4 goes live. The product already has no per-case price, so no redesign is needed if the opinion is cautious. If it's strict, drop routing from paid tiers and sell listing/software only |
| 3 | The CSJ matrícula-digital QR gives a third party a checkable status page | Known from news only; not tested | **Fixed + flagged.** Verification accepts a CSJ constancia ≤ 90 days old as an alternative (`03` §4.3). You scan one real QR before P2 (`01` manual check 3). If neither is practical, there is no badge, and verification is blocked, not faked |
| 4 | Organic search will deliver cases within a few months | New domain, YMYL topic, no volume data | **Flagged.** Ads seed the first cells (`04` §3). Guides get a paid lawyer review. Keyword data is pulled in window S5 and re-ranks the local cells |
| 5 | Busy solo lawyers can accept within the SLA | They spend mornings in court, and alerts are push + email (no WhatsApp) | **Fixed + flagged → question 9.** Default raised to 6 business hours (3 urgent). Web Push alerts plus a reminder at 50 % of the SLA. Measure the median accept time for the first 60 days, then tune |
| 6 | Clients give a phone number before seeing whom they'll get | Conversion drop at step 4 | **Fixed.** The intake shows live supply ("3 abogados verificados atienden laboral en Luque") from step 1 (`03` §3.2). The shortlist preview comes before contact details are revealed to lawyers, and contact goes only to lawyers the client chose |
| 7 | Lawyers notice new cases fast enough without WhatsApp | Email is easy to miss; Web Push on iPhone needs the panel added to the home screen | **Flagged.** Onboarding makes "instalar el panel y activar avisos" a checklist step, and the response-time stat shows who misses cases. WhatsApp can be added later without a migration (`06` §7) |
| 8 | Cloudflare Email Sending covers our email | 200/day quota **per account, shared with all your sites**, and with no WhatsApp email carries more | **Flagged.** Push carries the instant alerts; about 4 emails per case. Ask Cloudflare for an increase before S8–S10 go live; past 150/day, alerts batch into a digest (`06` §7) |
| 9 | Next.js + sharp run fine on the Hostinger Node slot | sharp is a native binary, and Hostinger builds are opaque | **Fixed.** The W1 M2 deploy includes a `/api/health/sharp` smoke test, with a WASM fallback (`09` §1) |
| 10 | The brand "estudio.com.py" is fine for a directory | "Estudio" reads as a law firm, a misleading-advertising and trust risk | **Flagged → question 2.** The tagline "Directorio de abogados verificados" and a disclaimer are everywhere, and the schema is never `LegalService` (`05` §3) |

Also watched, lower weight:
- The client fake-lead rate without OTP (question 17, decided: no OTP in v1).
- Ley 7593 obligations and international transfers (`05` §4, lawyer to confirm).
- The rankings of the legacy PHP site lost in migration: small site, all URLs 301'd, accepted.
- The exchange rate in the USD equivalents (display only, prices are in Gs).
- The competitor copying fee transparency. That takes lawyer-reviewed content upkeep; our lead
  is time plus the reviewed tables.

## B. Research that could not be done here

- The network policy blocked buscaabogados.com.py, datos.gov.py, datos.csj.gov.py and every
  primary legal source. Competitor and legal findings come from search snippets and are marked
  UNVERIFIED where it matters.
  - To let a future session read them, add those hosts to the environment's allowed domains
    (cloud environment menu → Edit → Network access).
  - Or run the 15-minute manual check in `01-competitors.md`.
- **The keyword-library MCP was not available** in this session. Keywords to pull are in
  `07-seo.md` §2 (window S5, question 20).
- The memory notes on Tailwind v4 `var()` pitfalls and Hostinger deploys weren't readable from
  this cloud session. `06` §12 lists the known pitfalls; reconcile them in W1 M1.

## C. Questions for you

Your answers of 2026-09-30 are marked **Decided**. Open questions use the recommendation unless
you reply with a correction. The numbers are stable because other files refer to them.

1. **Decided (by default): rebuild in this repo**, PHP site moved to `legacy-php/` and kept live
   until cutover.
2. **Keep the name estudio.com.py?**
   → *Yes, with the tagline "Directorio de abogados verificados" and the "no somos un estudio
   jurídico" disclaimer on every page.* Ask the question 4 lawyer whether that is enough.
3. **Decided: no pay-per-lead.** Subscription with cases included, no commission, plus labelled
   sponsored slots.
4. **Hire one Paraguayan lawyer (not one listed as a founder) for a written opinion and
   reviews?** The scope:
   - Colegio code arts. 8/28 applied to our model;
   - Ley 1376 and "consulta gratis";
   - Ley 7593 duties, international transfers, and the minimum site identity for selling;
   - reviewing the terms, privacy policy and arancel tables;
   - reviewing the 17 guides;
   - **plus one question on your other directory sites** (listings built from public business
     data under Ley 7593).
   → *Yes, start now.* It gates the non-interim legal pages, the fee tools and going live with
   payments. It doesn't gate the build.
5. **If the review isn't back by cutover, go live with conservative interim legal pages and the
   fee tools off?**
   → *Yes.*
6. **Decided: no RUC on the site for now.** Which entity sells the plans is still needed before
   S11 goes live.
   → *The existing company behind contador.com.py if its objeto social covers
   advertising/software services, otherwise a new EAS.* The RUC appears on invoices only.
7. **Invoicing: your FacturaPY app or an invoicing API (Sifende, FactPy, BillPy, Kuentalo)?**
   → *FacturaPY if it issues SIFEN documents through an API; otherwise FactPy or Sifende.*
8. **Decided: prices.**
   - Profesional Gs 150.000/month, or Gs 1.500.000/year.
   - Fundador: the first 50 lawyers, Gs 600.000/year, locked.
   - Sponsored slot Gs 150.000/month per page.
   - Review at month 3.
9. **SLA: accept/decline within 6 business hours (3 if urgent).** Business hours Mon–Fri 08–19
   and Sat 08–12, America/Asuncion. At most 3 lawyers per case, at most 6 offers per case.
   → *Yes. All are settings, tuned after 60 days.*
10. **AI model for the case summary:**
    → *`claude-opus-5-5` at effort `low`* (about USD 0.015 per intake).
11. **Decided: no WhatsApp for estudio for now.** Alerts are Web Push + email. Clients and lawyers
    talk on the lawyer's own WhatsApp.
12. **Add a GitHub Actions workflow for the Next.js app?**
    → *No.* Use a husky pre-push gate (`budgeted-runner-deploy`).
13. **Shared cases (up to 3 lawyers), not exclusive?**
    → *Yes for v1.*
14. **abogados.com.py: pursue the domain?**
    → *Not now.*
15. **Who runs the verification calls and the admin queue for the first 50?**
    → *You. They double as sales calls.* Hire an assistant after about 30 lawyers.
16. **Free "Perfil verificado" lawyers get their own WhatsApp button?**
    → *Yes.* It is the lawyer's number, not estudio's.
17. **Decided (follows from 11): no client phone OTP in v1.** Use Turnstile, rate limits, dedupe
    and lawyer reports.
18. **Data location** (Hostinger, Cloudflare R2, Anthropic US):
    → *Accept, and list the processors and countries in the privacy policy.* The lawyer in
    question 4 confirms the transfer basis.
19. **Optional short Opus window after S12** to review the money and auth paths the Sonnet
    windows touched?
    → *Yes.* About 1 hour; cheap insurance before real payments.
20. **Keyword data for S5:**
    → *Connect your keyword-library MCP before S5* (claude.ai → Customize → Connectors, then
    start a new window). Otherwise export a CSV from Google Keyword Planner and drop it at
    `plan/data/kwp-export.csv`; S5 imports it.

## D. Human-owned blockers

Per window: `09-phases.md` §4. Before W1 you only need the Hostinger slot, the DB and the env
vars; everything else has a mocked or degraded mode.
