> **PARKED (2026-09-30).** You chose the lean model in `plan/00-README.md` (SEO first, 1–3 partner
> lawyers). This folder is the full marketplace plan, kept for later. Decisions recorded here
> (Gs 150k/month, founders Gs 600k/year, manual billing, no WhatsApp) still apply if it is revived.
> File references like `05-legal.md` inside this folder mean the files in this folder.

# estudio.com.py: marketplace plan

This folder replaces the PHP referral-site plan (`/plan.md`, phases O1–S5, all merged
2026-09-09/29) as the plan of record. That PHP site stays live until the P1 cutover. Its content
(8 áreas, 8 guides, 7 cities) is ported, not thrown away.

Written 2026-09-30. Research limits: competitor and legal sources could only be read through
search snippets; see `10` §B.

## 1. One-page summary

**What:** a directory of verified lawyers in Paraguay, plus a situation-first intake that routes
each client's case to up to 3 lawyers the client chooses. Lawyers pay a flat monthly
subscription.

**Where we win:**
- **Primary wedge, "Lo que cuesta y lo que viene":** every page answers *what happens now, what
  it costs, and who can take my case here*. That means:
  - the legal minimum fees from the arancel (Ley 1376/88), computed live;
  - fee ranges the lawyers declare themselves;
  - step-by-step situation guides;
  - two calculators.
  Trust rests on a dated, four-step "Matrícula verificada" badge that names its official source.
- **Secondary wedge, "Empresas y extranjeros":** company formation, DNIT and residency, with
  EN/PT pages, pt/en-speaking lawyers, and a cross-sell with contador.com.py. Residency
  applications rose 63 % and EAS formations 28 % in 2025.

**Mechanics** (these must be done well, but they are not the wedge):
- a 5-step mobile-first intake with an AI case summary that never gives advice (the lawyer then
  contacts the client on the lawyer's own WhatsApp; estudio has no WhatsApp number in v1);
- a transparent ranking in which the plan tier never adds points;
- a 6-business-hour accept SLA with automatic reassignment, alerts by Web Push + email;
- reviews only from clients whose case a lawyer actually accepted.

**Money:**
- Perfil verificado: free.
- **Profesional: Gs 150.000/month** (or Gs 1.500.000/year), routed cases included, **no
  per-lead price, no commission** (decided).
- **Fundador:** the first 50 lawyers pay Gs 600.000/year, locked.
- Labelled sponsored slot: Gs 150.000/month per page.
- **Billing is manual (decided):** the lawyer pays by bank transfer (or a payment link you make by
  hand), you mark it paid in the admin, and the plan runs until its paid-until date. No gateway
  integration, no auto-debit. You issue the SIFEN invoices yourself (FacturaPY / e-Kuatia'i).
- Scenario at month 12: 50 founders + 30 standard + 10 sponsored slots ≈ Gs 8.5 M/month revenue,
  ≈ Gs 3.8 M contribution. At these prices paid ads lose money per lawyer served, so organic
  content is the business.
- Every form posts to VenderCRM server-side. There is no RUC on the site (decided).

**Stack:** Next.js + Tailwind v4 + MySQL/Drizzle on a Hostinger Node slot. Cloudflare provides
R2, Turnstile, email and the cron Worker. Lawyer alerts use Web Push (PWA) + email. The AI is `claude-opus-5-5` at low effort. Leads are
mirrored to VenderCRM without case text.

**Phases** (what ships, in order):

| Phase | What |
|---|---|
| P0 | Foundations: schema, security, deploy skeleton |
| P1 | Public site + SEO, then **cutover** replacing the PHP site |
| P2 | Lawyer onboarding + verification |
| P3 | Intake + matching + SLA |
| P4 | Payments |
| P5 | Hardening + launch + cold start |

**How it's built (`09`):** **one Opus 5.5 window (W1, effort high)** builds everything hard in
8 milestones: schema, auth, SEO engine, fee math, verification, intake/AI/matching/SLA, billing,
and the contracts. Then **12 Sonnet 5.5 windows (S1–S12)** build all pages, content, panels and
admin screens, up to 4 in parallel. Optionally, one short Opus review at the end. Never Fable,
never Codex.

**Decided on 2026-09-30:**
- no pay-per-lead;
- prices (150k/month, founders 600k/year, sponsored 150k);
- no WhatsApp number;
- no RUC on the site;
- VenderCRM on every form.

**Still open** (`10` §C):
- 4: hire a Paraguayan lawyer now.
- 6: which entity sells the plans (needed before S11 goes live).
- 7: decided: invoices issued by hand, no integration.
- 20: connect the keyword-library MCP before S5.

## 2. Files

| File | What it decides |
|---|---|
| `01-competitors.md` | What buscaabogados and the others do, their gaps, CSJ data, a 15-minute manual check for you |
| `02-market.md` | Supply, demand, fees, foreigners; the wedge evaluation (a–f) and recommendation |
| `03-product.md` | Roles, taxonomy, intake, AI summary, verification definition, lawyer panel, **routing rules**, admin, out of scope |
| `04-business-model.md` | Model comparison, prices, founder offer, cold start, unit economics, payments |
| `05-legal.md` | Hard constraints: advertising, arancel, AI and unauthorised practice, Ley 7593, e-commerce, reviews, items needing a lawyer (⚖) |
| `06-architecture.md` | Stack, repo layout, **full data model**, auth, AI module, notifications, cron, security, deploy |
| `07-seo.md` | URL scheme, keyword seeds, redirects, **indexability rules**, content wedge, EN/PT, technical SEO |
| `08-data.md` | Lawful seed data: taxonomy, CSJ roll (verification only), Leads DB dependency, opt-in, content port |
| `09-phases.md` | Sessions, tasks, Opus/Sonnet split, acceptance commands, your blockers, parallelism, funnel events |
| `10-risks-and-open-questions.md` | 10 weakest assumptions (fixed or flagged), research gaps, **18 numbered questions** with recommendations, blocker list |

`plan/data/` (created in P1) holds `keywords.csv` and `facts-to-verify.md`.

## 3. How to start

1. Reply to the open questions in `10` §C if you disagree with a recommendation.
2. Set up the Hostinger Node slot + MySQL + env vars (`09` §1, "You during W1").
3. Open a **new window on Opus 5.5, effort high**, in auto-accept mode, and paste:
   `Read plan/09-phases.md §0 and §1, then execute window W1 from the first unmerged milestone.`
4. After W1 ends, open the Sonnet 5.5 windows in the waves of `09` §3 with
   `Read prompts/<file>.md in this repo and execute it.`

## 4. Rules that override everything else

- A lawyer appears publicly only after verification. We never create profiles from lists.
- No per-lead price, commission, fee share, or "consulta gratis". Sponsored placement is
  always labelled.
- The AI summarises; it never advises. Case text never leaves the app except to the chosen
  lawyers and the AI processor.
- No scraping of any site whose terms or robots.txt forbid it, and no getting around bot
  protection. Outreach data comes only through the Leads DB, checked against No Molestar.
- No invented facts: no fake reviews, counts, stats or bylines.

## 5. Out of scope for v1

See `03-product.md` §7.

## 6. Build log index

(one line per session, appended by the session: id, PR, `docs/log/<id>.md`)
