# 04 — Business model

Assumptions (all are editable `settings` or `plans` rows):
- Prices include IVA 10 %.
- 1 USD ≈ Gs 7,300 (check the rate before publishing prices).
- Salario mínimo is Gs 3,044,000 and the jornal mínimo Gs 117,077 (Decreto 6225/2026, from
  2026-07-01).
- The arancel minimum for a verbal consultation is about Gs 585,000.

## 1. Options compared

| Model | Revenue fit | Legal risk (`05-legal.md` §1) | Payment friction in PY | Lawyer appeal | Verdict |
|---|---|---|---|---|---|
| Pay-per-lead | Scales with value delivered | **Highest.** The Colegio code bars "mediación de agentes o corredores" (art. 8) and fee-sharing with non-lawyers (art. 28). Per-lead pricing looks like a paid corredor | Many small charges at 2–3 % card fees, and QR/transfers have no auto-debit | Liked when leads are good, hated when they're fake (disputes) | **Not in v1.** Revisit only after a written legal opinion |
| Subscription with lead quotas | Predictable | Medium: a quota is per-lead pricing by another name | Monthly auto-debit exists (uPay) | Good | Rejected in favour of the next row |
| **Subscription, cases included (fair use), no per-case price** | Predictable MRR | **Lowest.** It is a flat fee for advertising and a software tool, unrelated to any client or fee | One monthly charge | "Sin comisión, sin pago por consulta" is a strong sales line | **Recommended core** |
| Featured listing (sponsored slot) | Add-on, capped by pages | Low if clearly labelled "Patrocinado" and never mixed into the ranked shortlist | Monthly | Appeals to established firms | **Recommended add-on** |
| Hybrid (all of the above) | Max revenue | Inherits pay-per-lead risk | Complex | Confusing | No |

## 2. Recommended model and prices (your decisions, 2026-09-30)

| Plan | Price | What it includes |
|---|---|---|
| **Perfil verificado** | Gs 0 | Verified public profile. Listed in the directory and on specialty/city pages. The lawyer's own WhatsApp contact button. "Contactos directos" stats. **No routed cases, no reviews.** This is the supply-growth and SEO layer |
| **Profesional** | **Gs 150.000 / mes** (≈ USD 20), or Gs 1.500.000 / año (2 months free) | Everything in Perfil verificado, plus **routed cases from the intake with no per-case charge** (fair use 40 accepted/month), up to 3 principal + 3 secondary specialties, up to 6 cities + virtual, response-time badge, review invitations, fee section on the profile, monthly report |
| **Fundador** (first 50 verified lawyers) | **Gs 600.000 / año**, locked for as long as they renew each year | Profesional in full. Annual payment only (one charge a year: uPay link or bank transfer, no card auto-debit needed). A factual "Fundador" label on the profile. Lawyers verified before payments go live (P4) use it free until their first invoice |
| **Espacio patrocinado** (add-on, Profesional or Fundador only) | **Gs 150.000 / mes** per specialty × city page | One labelled "Patrocinado" card above the organic list on that combo page and its city hub. Max 1 per page, on indexable pages only. Never affects the shortlist ranking |

No pay-per-lead, per-case price, commission or share of fees, ever in v1 (decided).

Why Gs 150k: about a quarter of the legal minimum for *one* consultation and about 5 % of a
minimum salary, so one client every few months pays for it. It's an easy yes for a solo lawyer,
and still filters out profiles nobody maintains. The founder price (Gs 600k/year ≈ Gs 50k/month)
buys the first 50 lawyers' loyalty and a year of paid commitment up front, which is what makes the
directory credible in its first year.

## 3. Cold start

**First 50 verified lawyers (weeks 0–8, no ad budget):**
1. **Demand-first pitch.** The site goes live at P1 with guides and tools before any lawyer is
   routed. The admin demand report (cases by specialty × city, "sin cobertura") becomes the sales
   script: "En Luque tuvimos 9 consultas laborales este mes y nadie para atenderlas."
2. **Concierge onboarding.** You or an assistant fill in the profile during a 15-minute
   video call, which is also verification step 4. Target: 5 per working day.
3. **Warm channels:** your own network; contador.com.py clients' lawyers; lawyers in
   alquilar.com.py and propia.com.py deals (desalojos, títulos); university alumni groups (UNA,
   UCA, UNINORTE, UAA law faculties); and the Colegio de Abogados' events (as a sponsor, not by
   scraping its list).
4. **Outreach list** comes only through your Leads DB (`C:\Claude 1\leads-db`) and its scraper
   process, from sources whose terms allow it (`08-data.md` §3). Every number is checked against
   SEDECO's *No Molestar* registry, every message says who we are and how to opt out, and there
   is one follow-up at most.
5. **Target cells,** not a national spread: Asunción + Gran Asunción + CDE + Encarnación × laboral,
   familia, sucesiones, inmobiliario, penal, plus a nationwide virtual pool for empresas and
   migraciones.

**First 100 client requests (weeks 4–12):**
1. **Organic:** 17 guides + 2 tools live at P1, but expect little organic traffic in the first
   3 months.
2. **Google Ads:** Gs 2–3 M/month (≈ USD 275–410), exact and phrase match on "abogado <esp>
   <ciudad>", despido/divorcio/sucesión cost queries and desalojo. Only for cells with ≥ 2 lawyers.
   Conversion is tracked on `lead_submitted` (value from tier) and `assignment_accepted`.
3. **Your sites:**
   - contextual links on alquilar.com.py and propia.com.py ("¿Problema con un inquilino?" →
     `/consulta/alquiler/`);
   - contador.com.py pages (empresas, DNIT) → `/abogados/empresas/`.
4. **Community:** helpful answers in Paraguayan Facebook groups (expats, Brasileiros no Paraguai,
   barrio groups) that link to guides, not to a form. Owner-run, no automation.
5. **Brazilian/expat channel:** the PT/EN pages plus 1–2 relocation-consultant partners
   (referral link, no payment per lead).

## 4. Unit economics (scenario, month 12)

| Line | Assumption | Gs / month |
|---|---|---|
| Founders | 50 × Gs 600k / 12 | **2.5 M** |
| Standard Profesional | 30 lawyers × 150k (monthly and annual averaged) | **4.5 M** |
| Sponsored slots | 10 × 150k | **1.5 M** |
| **Revenue** | | **≈ 8.5 M (≈ USD 1,160)** |
| Google Ads | steady state | 3.0 M |
| Card/QR fees | ~2.5 % | 0.2 M |
| Claude API | ~800 intakes × ~USD 0.015 | 0.1 M |
| SIFEN invoicing provider | from ~Gs 85k | 0.1 M |
| R2, Cloudflare, Hostinger slot | mostly already paid | 0.1 M |
| Part-time verifier/admin (10 h/week) | | 1.5 M |
| **Costs** | | **≈ 5.0 M** |
| **Contribution** | | **≈ 3.5 M/month (≈ USD 480)** before your time |

**Lead economics:**
- At a CPC of Gs 3–7k and a 5–8 % intake conversion, one paid-ads lead costs **Gs 40–140k**.
- Each case goes to up to 3 lawyers, so the cost per *accepted assignment* is about Gs 20–70k.
- A lawyer who needs 3–5 cases a month to feel value costs **Gs 60–350k/month of ads to
  satisfy**, against Gs 150k (or Gs 50k for a founder) of revenue.

**Conclusions:**
- At these prices, paid ads **lose money** per lawyer served. Ads only seed cells in the first
  months; organic content is the business. That makes the primary wedge (`02` §4) non-optional.
- Founders are close to free supply; the money comes from standard Profesional after the founder
  cap, plus sponsored slots (which now cost the same as a month of Profesional and are the
  highest-margin line).
- Founders alone (Gs 2.5 M) cover the non-ad costs (Gs 2.0 M). With the full Ads budget,
  cash break-even is about 17 standard payers on top of the founders, fewer with sponsored
  slots. It becomes a meaningful business at 150+ standard payers (≈ Gs 25 M/month).
- Churn is the key risk: track "accepted cases per paying lawyer per month" as the north-star
  metric and don't sell Profesional in cells that can't deliver ≥ 2 cases/month.

## 5. Metrics that decide pricing changes (review at month 3 and month 6)

- Cases per paying lawyer per month (target ≥ 4)
- Accept rate (≥ 60 %) and median accept time (≤ 2 business h)
- Founder renewal at year 1 (target ≥ 70 %)
- Monthly churn (target ≤ 5 %)
- Cost per accepted assignment (target ≤ Gs 50k)
- Share of cases "sin cobertura" per cell

## 6. Payments: what exists and what you set up

| Option | Use | Notes |
|---|---|---|
| **uPay (ex-Pagopar, ueno)** | **Primary.** Monthly/annual subscription with card-on-file auto-debit + retries, plus one-off links | Needs RUC certificate + cédula, merchant verification. Reported fees about 2 % debit / 3 % credit (BCP cap since 2026-07-01), T+1/T+2 settlement. API + webhooks. **Get the current price list in writing.** Invoicing not included |
| Bancard QR / vPOS | Optional second rail | QR is about 65–70 % of electronic payments. vPOS supports tokens; recurring use is to be confirmed with Bancard. Needs a Bancard merchant account |
| Bank transfer (SIP, instant, 24/7) | Annual plans, larger firms | No fee. Manual confirmation in admin with a reference code `EST-<lawyerId>-<period>` |
| AdamsPay | Fallback gateway if uPay onboarding stalls | Gs 49–199k/month plans. Recurring cards not confirmed |
| Stripe, PayPal, Mercado Pago | — | Not available to a Paraguayan merchant |

**Invoicing:** every paid payment triggers a SIFEN electronic invoice through an invoicing API
(Sifende, FactPy, BillPy or Kuentalo, from about Gs 85k/month), or through your own FacturaPY app
if it issues SIFEN documents. That choice is question 7. No gateway was found that issues the
invoice itself.

**What only you can do** (blockers, see `09-phases.md` P4):
1. Choose the legal entity that sells the plans: a new EAS, or the company behind
   contador.com.py. You need a RUC, a bank account, and the site-identity details the e-commerce
   law requires.
2. Open the uPay merchant account (documents above) and get API keys.
3. Enable SIFEN e-invoicing for that RUC and choose the invoicing provider.
4. Have an accountant confirm the IVA/IRE treatment of subscriptions and sponsored slots.
