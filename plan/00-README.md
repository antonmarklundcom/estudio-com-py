# estudio.com.py: lean plan (SEO first, 1–3 partner lawyers)

Updated 2026-09-30 after your decision. You want to rank and get traffic first, work with only
1–3 partner lawyers who cover the áreas, never present yourself as a lawyer, and be legally
protected. The full marketplace plan (directory, verification, matching, billing, Next.js) is
**parked** in `later-marketplace/`; revive it only if contacts outgrow what 3 lawyers can take.

## 1. One-page summary

**What:** the existing PHP site becomes an honest legal-information site with one contact form.
You reply to each request within 1 business day. You introduce the client to a partner lawyer by
name and matrícula, and forward the details **only after the client says yes**. The lawyer and
the client agree fees directly. You are a contact service, not a law firm, and the site says so
everywhere.

**Why it ranks:** situation guides, fee pages based on the legal minimum (arancel, Ley 1376/88),
and two calculators (fee minimums, severance). Competitors don't offer these (`01`, `02` §4).
Thin generated pages go `noindex` until they have real local content.

**How you earn:** a **flat monthly publicity fee** per partner (recommended Gs 600.000 after
2 free months). Never per lead, never a share of fees. It is disclosed on `/como-trabajamos/`.
Billing is manual from your company.

**How you're protected** (`05-legal.md`):
1. A copy rulebook, enforced by the build: no "nuestros abogados", no "asesoramiento", no
   "gratis".
2. A tagline and disclaimer on every page.
3. Two-step consent before any data reaches a lawyer.
4. A minimal form with deletion deadlines.
5. A flat-fee partner agreement with lawyer independence and indemnity.
6. Operating through a company.
7. One 1–2 hour consultation with an independent lawyer before ads or partner fees.

**Build:**
- **Step 0 (you, 20 min):** upload the zip and `config.php` with VenderCRM, then send a test lead.
- **One Opus 5.5 window (effort high, about 3–4 h):** legal copy, consent, legal pages, partner
  card, indexability, fee math.
- **Four Sonnet 5.5 windows (medium):** guides, área fee sections, local blocks, keywords + link
  pass.
- No database, no new hosting, no Fable, no Codex.

## 2. Files

| File | What it decides |
|---|---|
| `01-competitors.md` | What buscaabogados and others do, their gaps, a manual check for you |
| `02-market.md` | Market figures and the content wedge |
| `03-product.md` | The client flow, partner coverage, what the site shows |
| `04-business-model.md` | Flat partner fee, economics, finding partners |
| `05-legal.md` | **The legal protection rules**, plus the questions for the one-off lawyer consultation |
| `06-architecture.md` | The 12 concrete changes to the PHP site |
| `07-seo.md` | URLs (unchanged), indexability, content to add |
| `08-data.md` | What data is used (little, none scraped) |
| `09-phases.md` | Step 0, the Opus window L1 (5 milestones), the Sonnet windows S1–S4, your tasks |
| `10-risks-and-open-questions.md` | Weakest assumptions, and 10 questions with recommendations |
| `later-marketplace/` | The parked marketplace plan (00–10) |

## 3. How to start

1. Do Step 0 (`09` §1).
2. Open a **new window on Opus 5.5, effort high**, in auto-accept mode, and paste:
   `Read plan/09-phases.md §0 and §2, then execute window L1 from the first unmerged milestone.`
3. After L1, upload its zip, then run the Sonnet windows:
   `Read prompts/<file>.md in this repo and execute it.`

## 4. Rules that override everything else

- Never claim to be a lawyer, a firm, or to give advice. `verify.sh` enforces the phrase list.
- Never promise something only a lawyer can do, and never show a lawyer who hasn't signed.
- Never forward a client's data without their yes to a named lawyer.
- Never charge per lead or take a share of a lawyer's fees.
- No scraping, no invented facts, reviews or numbers.

## 5. Build log index

(one line per window/milestone: id, PR, `docs/log/<id>.md`)
