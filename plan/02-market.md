# 02 — Market and positioning

Sources are web-search extracts from 2026-09-30; primary pages could not be opened from this
environment. Figures marked (!) need a check before they appear in public copy.

## 1. Supply: lawyers

- **About 74,500 matriculated lawyers** in total (Última Hora, "Un país de abogados") (!). The
  count grows fast: about 45,200 of them matriculated between 2011 and 2024.
- **About 38,000** were on the 2023 roll to vote for the Consejo de la Magistratura (ABC), a rough
  proxy for *active* lawyers.
- The Colegio de Abogados has only about 1,100 members. There is no mandatory bar, so no body
  holds a complete, current list we can use.
- **What this means:** supply is abundant and fragmented, and most lawyers are solo
  practitioners with no web presence. A flat-fee partnership that brings clients is an easy offer
  to explain. The hard part is reaching lawyers and getting them verified, not persuading them.

## 2. Demand: clients

- Paraguay: 6.11 M people (Census 2022). 85 % of people aged 10+ use the internet, **97 % of them
  via mobile, and 98 % of internet users use WhatsApp** (INE EPHC 2025). WhatsApp-first contact
  is therefore the default, not an option.
- Guaraní is spoken at home by about 67 % (alone or with Spanish; INE 2025). A "habla guaraní"
  filter is cheap and meaningful. A Guaraní UI is not needed in v1.
- Largest cities (Census 2022): Asunción 462k, Ciudad del Este 326k, Luque 260k, Capiatá 237k,
  San Lorenzo 225k, Limpio 140k, Pedro Juan Caballero 127k, Lambaré 127k, Ñemby 116k, Fernando de
  la Mora 110k, Encarnación 107k (!).
- **Foreigners:** 156,800 immigrants (Census 2022). **47,687 residency applications in 2025
  (+63 %)**, 58 % of grants to Brazilians, and early 2026 up about 79 % year on year (Migraciones) (!).
- **Companies:** 7,618 EAS formed in 2025 (+28 %), 21,891 since 2021 (IP Paraguay) (!). EAS can
  be formed online in about 72 h, so the lawyer's role is advisory (statutes, partners,
  foreigners), not the paperwork.
- **Fees clients face:** the arancel (Ley 1376/88) sets minimums in jornales. With the jornal
  mínimo at Gs 117,077 since 2026-07-01 (!), a verbal consultation costs at least 5
  jornales/hour, about **Gs 585,000**, and a mutual-consent divorce at least 60 jornales, about
  **Gs 7.0 M**. Market reports put divorces at Gs 8–10 M. Clients don't know any of this, and
  that fear is our content opening.

## 3. Search demand

- The keyword-library MCP is not connected here, and Google Trends/Keyword Planner were
  unreachable. **No volume numbers exist in this plan.**
- The seed list and page mapping are in `07-seo.md` §2. Pulling the data is part of window S5 in
  `09-phases.md`, and nothing about positioning waits on it.
- Google Ads CPC for PY legal terms is also unknown. One aggregator suggests USD 0.40–1.00 across
  Paraguay (!). The business model uses a range and is re-computed after the first 2 weeks of ads.

## 4. Positioning: where a newcomer can win

Each candidate scored 1–5 on **E** (edge vs buscaabogados), **C** (cost/risk to build),
**D** (does it drive demand?), **S** (does it help lawyer sales?).

| | Candidate | E | C | D | S | Verdict |
|---|---|---|---|---|---|---|
| a | Depth per specialty/city: guides with costs, steps, plazos | 4 | 4 | **5** | 3 | Organic traffic engine. Paid ads can only break even (`04` §4), so SEO is where the margin is |
| b | Much better intake + matching | 2 | 3 | 2 | 3 | Competitor already has an AI intake. We must match it well; it is not a wedge on its own |
| c | Response guarantee + reassignment | 4 | 3 | 2 | **4** | Real differentiator, but only credible where ≥ 2 lawyers cover a cell. It is an operating rule (`03` §5.4), promoted cell by cell |
| d | Transparent honorarios | **5** | 4 | 4 | 2 | Nobody combines arancel minimums with declared ranges. Must stay within Ley 1376/88: no "gratis", nothing below the minimum |
| e | Guaraní / English / Portuguese | 3 | 4 | 3 | 3 | Guaraní as a filter. EN/PT pay off only for foreigners, so it fits under f |
| f | Business, company formation, tax + foreigners, cross-sold with contador.com.py | 4 | 4 | 3 | **5** | Higher-value clients, lawyers who pay more, and your own RUC/IVA/e-Kuatia cross-sell |

### Recommendation (updated 2026-09-30 for the lean model)

**Primary wedge (unchanged): "Lo que cuesta y lo que viene" (a + d).** Every page answers what
happens now, what it costs by law (arancel minimums), and how to get a lawyer. Guides and two
calculators do the work. This is content, so it fits the lean model perfectly: it needs no lawyer
supply to rank.

**Secondary (deferred): "Empresas y extranjeros" (f + e).** Build it only when a partner covers
empresas/tributario (and speaks EN/PT for foreigners). The contador.com.py cross-link on the
empresas/tributario pages can go in now.

**Dropped for now:**
- b (intake/matching) and c (response SLA) need a lawyer pool; they live in `later-marketplace/`;
- a Guaraní filter needs lawyer profiles.

### What we do not do

- Present estudio.com.py as a firm or as giving advice.
- Show lawyers who haven't signed.
- Charge per lead.
- Promise results.
- Build pages on competitor brand names.
