# 09 — Build plan: one Opus window, then Sonnet windows

**Shape (your decision, 2026-09-30):**
- **Window W1 (Opus 5.5, effort high)** builds everything that is hard for Sonnet, in one go:
  - the schema, security and auth;
  - the SEO engine and redirects;
  - money and legal math, the verification engine;
  - the intake, AI, matching and SLA engines;
  - manual billing periods, cron;
  - the contracts every UI will call.
- **Windows S1–S12 (Sonnet 5.5)** then build every page, every piece of content, and every
  panel and admin screen on top of those engines. Several run in parallel.

The product phases P0–P5 (foundations → public site → lawyer onboarding → intake → payments →
launch) still describe *what* ships and in what order it goes live. This file maps them onto
windows.

**Never Codex, never Fable** for any window, subagent, workflow or Routine (`fable-cost-guardrail`).
Subagents spawned inside W1 for mechanical parts must set `model: "sonnet"` explicitly.

## 0. Rules every window follows

1. **Read only:**
   - its prompt file;
   - `plan/00-README.md`;
   - the plan files named in its section;
   - `docs/contracts.md` (after W1);
   - the `docs/log/<id>.md` of the windows it depends on.
2. Questions marked *Decided* in `plan/10-risks-and-open-questions.md` are locked. For an open
   question, use the recommended answer and note it in the log.
3. **Stop and ask only** for a missing credential with no fallback, or a foundation decision where
   a wrong guess forces a rewrite. To ask, append the question to `docs/decisions-needed.md`,
   commit, push, and end the window. Missing env values never block: document them in
   `.env.example` and degrade gracefully.
4. **One PR per milestone** (W1) or per window (S*): branch `phase/<id>`, merged when the local
   gate is green.
   - The gate is `npm run check` (typecheck + lint + vitest) and `npm run build`, plus the
     acceptance commands listed for that milestone.
   - There is no GitHub Actions workflow (question 12). A husky pre-push hook runs the gate.
   - Screenshots and Lighthouse reports are never committed.
5. **Owns:** a Sonnet window writes only inside its Owns list plus its own `docs/log/<id>.md`.
   Engines (`src/lib/**` except the UI helpers named in its Owns, and `src/db/**`) belong to W1.
   A Sonnet window that needs an engine change doesn't make it; it writes the need to
   `docs/decisions-needed.md` and works around it.
6. **Schema:** only W1 touches `src/db/schema.ts`. PR titles start with `MIGRATION REQUIRED —`,
   and you run `db:migrate` on production.
7. **Log:** `docs/log/<id>.md` has at most 12 lines of Built, 8 of Decisions and 8 of Known
   issues, plus one Verification line. Add an index line to `plan/00-README.md` §6.
8. **Fan-out:** for N ≥ 4 same-shaped units (hubs, guides, local blocks, question sets), write one
   exemplar, then spawn Sonnet subagents; one verify and one PR (`fable-directs-sonnet-builds`).
9. **Skills to load at the matching step:**
   - `nodejs-mysql-hostinger-stack`, `nextjs-deploy-hostinger` (W1 M1–M2, S6);
   - `vendercrm-lead-capture` (W1 M2, and any form);
   - `cloudflare-email` (W1 M2);
   - `claude-api` (W1 M6);
   - `higgsfield-image-pipeline` → `webimg-pipeline` (S5);
   - `budgeted-runner-deploy` (anything under `.github/` or hooks);
   - `security-review` (S12).
10. **Secrets:** API keys (VenderCRM, Anthropic, Cloudflare) go in hPanel env vars only.
    Never write a real key into the repo, a prompt file, a log or a PR body.

## 1. W1 — the Opus window

**Start:** open a **new** Claude Code window on **Opus 5.5 at effort high**, in auto-accept mode,
and paste:
`Read plan/09-phases.md §0 and §1, then execute window W1 from the first unmerged milestone.`

- **Why a new window:** this planning window's context is full of research W1 doesn't need.
- **Why high, not medium:** W1 is schema, auth, money and routing, where a wrong guess costs a
  rewrite. The Sonnet windows are where the cheaper effort goes.

**Resuming:** if the window ends (limits, crash), paste the same line into a fresh Opus window.
Every milestone is its own merged PR plus a log, so W1 continues from the first milestone without
a log.

**Rough size:** 8 milestones, about 10–14 h of model time in one long window (context
compacts; that's expected). No UI polish in W1: minimal screens only where an acceptance test
needs one. The real UI is Sonnet's job.

### M1 — repo, scaffold, schema (P0)

- Move the whole PHP site into `legacy-php/` with `git mv`.
  - Fix any root-relative paths in its `verify.sh`, `deploy/make-zip.*` and workflow (the
    workflow gets `working-directory: legacy-php` and a `paths: legacy-php/**` filter).
  - The PHP site must stay deployable until cutover.
  - The CRLF-only working-tree changes are not ours: leave them uncommitted.
- Scaffold Next.js (App Router, TS strict, `src/`, Tailwind v4, `trailingSlash: true`,
  ESLint/Prettier, Vitest, Playwright).
  - husky: pre-push runs the gate; pre-commit blocks `.github/workflows/*`.
  - Delete any generated workflow. *(A Sonnet subagent may do this.)*
- **`src/db/schema.ts`: all tables and enums in `06` §4**, relations, the pool
  (`connectionLimit: 8`, `timezone: 'Z'`), and the first migration.
- Tokens (`06` §12) + `next/font/local` with the moved woff2 files + a bare layout. UI primitives
  (Button, Card, Badge, Chip, Field) are tokens only. *(Sonnet subagent.)*
- Seeds:
  - `seed-taxonomy.ts`, `seed-plans.ts` (Perfil verificado 0, Profesional 150k/1.5M, Fundador
    600k/year, sponsored 150k);
  - settings (SLA 6 h, urgent 3 h, fair use 40, founder cap 50, jornal mínimo), holidays;
  - `create-admin.ts`, and `seed-dev.ts` with its production guard.
  *(Sonnet subagent, after the schema.)*

**Acceptance:**
- The gate passes.
- `db:migrate` on an empty `estudio_dev` creates every table.
- Running the seeds twice gives identical counts.
- `legacy-php/verify.sh` passes.
- `/` renders with the tokens, and Playwright asserts zero requests to `fonts.googleapis.com`.

### M2 — core libraries + deploy skeleton (P0)

- `env.ts` (zod; optional groups degrade), `crypto.ts` (AES-256-GCM + HMAC), `ratelimit.ts`
  (MySQL window), `turnstile.ts`, `audit.ts`.
- `auth/`: iron-session, bcryptjs, TOTP, `requireRole`, `requireOwner`.
- Outbox + `email.ts` (Cloudflare REST, never throws, 5 s) + `webpush.ts` (VAPID).
- `vendercrm.ts` (`06` §9: base URL `https://crm.clientes.com.py`, UUID idempotency key per form
  render, never blocks the visitor), with mocked-fetch tests.
- `/api/health` (DB ping), `/api/health/sharp` (AVIF resize smoke test; fall back to WASM if
  sharp fails on Hostinger), and `robots.ts` returning `Disallow: /` while `SITE_INDEXABLE=false`.
- Deploy to the Hostinger slot (`nextjs-deploy-hostinger` §1, §6a).

**Acceptance:**
- Crypto round-trip and tamper tests pass.
- A guard test proves the lawyer role is refused on admin actions.
- The rate limiter blocks request N+1.
- A VenderCRM test posts the exact payload shape, with no free text.
- `curl https://<slot>.hostingersite.com/api/health` → `{"db":"ok"}`, and `/api/health/sharp`
  → 200.

### M3 — SEO engine + route contract (P1)

- `meta.ts`, `jsonld.ts`, `indexability.ts` (`07` §4), `sitemap.ts` (index + parts),
  `robots.ts`.
- Redirects (`07` §3), plus a test that walks all 86 legacy URLs.
- The route list as a typed contract (`src/lib/seo/routes.ts`), so the Sonnet page windows fill
  pages, not routing.
- **One reference page, end to end:** the specialty × city combo page, including the honest
  empty state, the indexability switch, JSON-LD and breadcrumbs. S1 copies its pattern.
- An identity-footer component reading `settings`: brand, email, contact form, **no RUC**
  (`05` §5).
- Drafts of `/terminos/`, `/privacidad/`, `/para-abogados/terminos/`, `/como-verificamos/` and
  `/como-funciona/` per `05` §8, `draft: true` until the lawyer reviews them. Legal drafting
  stays in Opus.

**Acceptance:**
- Unit tests pass: title/description uniqueness across generated routes, the indexability
  matrix, and the redirect walk.
- The build succeeds with zero lawyers in the DB.
- Every JSON-LD block parses, and the platform is never `LegalService`.

### M4 — fee and labour math (P1)

`src/lib/tools/honorarios.ts` (arancel table in `content/arancel.json`, jornal mínimo from
settings) and `src/lib/tools/liquidacion.ts` (port and re-check the legacy `py.php` tables). Each
has ≥ 10 hand-computed test cases. They ship behind the `TOOLS_LIVE` flag until the lawyer review
(question 4). S1 builds their UI.

### M5 — lawyer auth, storage, verification engine (P2)

- Server actions for:
  - signup (Turnstile, 3/day/IP), email verification, login (lockout + Turnstile after 3
    failures), password reset;
  - admin TOTP enrolment and challenge.
- R2 client, signed PUT/GET (5 min), MIME sniff, 8 MB cap, photo pipeline (AVIF/WebP
  160/320/640, EXIF stripped).
- The verification state machine (`03` §4.3): the 4-step checklist, `official_source`, the CSJ
  roll cross-check hook, audited decisions, 12-month expiry, 90-day document purge.
- The profile validation lib:
  - specialty/city limits;
  - the "desde" fee ≥ the arancel consultation minimum;
  - a superlatives wordlist;
  - a completeness score.

**Acceptance (integration tests):**
- The signup → verify → approve path sets `status=verified` with a dated badge.
- Lawyer A cannot read B's documents or edit B's profile.
- With a fake clock, documents are purged at +90 d and the badge expires at +12 m.
- A bio containing "el mejor abogado" is rejected.

### M6 — intake, AI, matching, SLA, cron (P3)

- The intake server action:
  - Turnstile, honeypot, 4 s minimum, rate limits, blocklist, dedupe;
  - consents stored with the document hash, encryption;
  - lead + assignment creation;
  - the VenderCRM push via the outbox.
- `ai/` (load `claude-api` first): the prompt, JSON schema, filter, fallback and redaction, plus
  20 fixtures (Guaraní/jopara, an advice-seeking attempt, deadlines).
- `matching/` (`03` §5.1–5.3), as pure functions with ≥ 25 cases. **One test proves the plan tier
  never changes the score.**
- `sla/` (America/Asuncion, holidays, 6 h / 3 h defaults, reminder at 50 %, reassignment,
  routing pause), with fake-clock tests.
- `/api/cron/tick` + jobs (SLA, outbox, check-ins, review invitations, purges, digest) with
  `job_locks`, plus the Cloudflare Worker `workers/cron-tick/` and its README.
- The exemplar question set `content/intake/me-despidieron.json` (S8 writes the other 13).

**Acceptance (integration, fake clock, 3 seeded lawyers):**
- The intake creates a lead with 3 `offered` assignments, and the outbox has push + email rows.
- Accept reveals the contact.
- A non-responder expires at SLA + 1 min and the next-ranked lawyer is offered.
- The 4th submission from the same phone in a day is refused.
- The AI filter suite finds 0 forbidden patterns.

### M7 — manual billing engine (P4)

Billing is manual (decided: no gateway, no auto-debit; `04` §6). The engine is small:
- `billing/periods.ts`: statuses `founder_free → active → grace → lapsed` driven by `paid_until`;
  a 7-day grace period, then routing off; the Fundador price (600k/year, cap 50) locked per
  lawyer; founders verified before billing starts stay `founder_free` until you set a first date.
- `billing/confirm.ts`: the admin-confirm action (payment row `reported → confirmed`, extends
  `paid_until` by the plan period, audit row). Also reject, with a reason.
- Reminder emails at −7 d and −1 d (cron job), and sponsored-slot periods on the same mechanism
  (1 per page, indexable pages only).

**Acceptance (fake clock):**
- Confirming a yearly payment sets `paid_until` +1 year, and the lawyer is eligible in `matching`.
- At `paid_until` + 8 days routing is off; the profile is still public.
- A founder's next confirmation is priced 600k, not the list price.
- Confirming the same payment twice changes nothing the second time.

### M8 — handoff to Sonnet

- **`docs/contracts.md`** lists every server action, route handler and lib function the UI
  windows may call, with signatures, errors and example calls, and states which files are
  engine-owned.
- Write `prompts/s01-…md` to `prompts/s12-…md` (≤ 35 lines each, skeleton from
  `phased-autonomous-build` Stage 3): Owns, reads, rules, acceptance from §2 below.
- Log `docs/log/W1.md` and end with the start order for the S windows (§3).

**You during W1:**
- create the Hostinger Node slot and the MySQL DB, add your IP to Remote MySQL, and connect
  GitHub → Hostinger;
- set the env vars (`DATABASE_URL`, `SESSION_SECRET`, `ENCRYPTION_KEY`, `HASH_KEY`,
  `SITE_INDEXABLE=false`, `VENDERCRM_URL`, `VENDERCRM_API_KEY` = the estudio row of your
  VenderCRM list);
- run `db:migrate` and the seeds on production.

Nothing else blocks W1: R2, Turnstile and Anthropic all have mocked or degraded modes.

**Database in a cloud window:** if W1 runs as a Claude Code cloud session, it installs MySQL 8 (or
MariaDB) inside its own container for `estudio_dev` and the tests; production is only touched by
you.

## 2. The Sonnet 5.5 windows

Effort: **medium** for the content windows (S2–S5), and the default (**high**) for windows that
write application code (S1, S6–S12).

| Window | Owns | Builds | Acceptance (run for real) |
|---|---|---|---|
| **S1 Public UI** | `src/app/(public)/**` pages except `consulta`, `mi-consulta`, `para-abogados`; `src/components/public/**` | Home, `/abogados/`, specialty hub, city hub, profile, guide (MDX), tool UIs on the M4 libs, trust and legal page rendering, 404, all copying M3's reference combo | Build with 0 lawyers passes; Playwright visits every route in `routes.ts` → 200/301 as the contract says; no Google Fonts request |
| **S2 Hubs** | `content/especialidades/**` | Port 8 hubs + write civil, accidentes, migraciones (≥ 800 words, fee section, 5 FAQs) | 11 render; word counts printed; grep finds no "gratis" or superlatives |
| **S3 Guides** | `content/guias/**` | Port 8 guides to the new shape + 9 new (`07` §5.3) | 17 guides ≥ 900 words, `lastReviewed`, each links hub + tool + 2 guides; the link checker passes |
| **S4 Local** | `content/local/**`, `plan/data/facts-to-verify.md` | 25 local blocks, every fact sourced in front-matter; unsourced facts left out and listed | 25 cells indexable; 0 facts without a source |
| **S5 Extra** | `content/en/**`, `content/pt/**`, `src/app/(public)/para-abogados/**`, `public/img/**`, `plan/data/keywords.csv` | 6 EN/PT pages + hreflang · `/para-abogados/` + interest form → VenderCRM (`source: para-abogados`) · ~30 images (Rule 0 first) · keyword pull (§4 of `10`) | The form reaches VenderCRM (or a failed outbox row without a key); every image has AVIF+WebP, an SEO name and alt text; hreflang validates |
| **S6 Cutover** | link fields in `content/**`, `src/components/public/**` perf fixes, `docs/cutover.md` | Generated internal links; Lighthouse; cutover with you (DNS → Cloudflare per `cloudflare-email` onboarding, A/CNAME → Hostinger, `SITE_INDEXABLE=true`, Search Console, PHP hosting untouched 30 days) | Broken links 0; Lighthouse mobile ≥ 95 ×4 on 5 pages (median of 3); public JS ≤ 90 KB; legacy-URL walk passes on production; the sitemap has no `noindex` URL |
| **S7 Lawyer onboarding UI** | `src/app/(lawyer)/panel/(auth)/**`, `panel/perfil/**`, `src/app/admin/verificaciones/**`, `src/app/admin/abogados/**`, `scripts/import-csj-dataset.ts` | Signup/login/reset/TOTP screens, profile editor, document upload, admin verification queue + lawyer admin, CSJ import + "found in the 2019 roll" widget | E2E: signup → email link → profile → upload → admin approves (`qr_matricula_digital`) → public profile shows "Matrícula verificada · fecha"; an unverified profile → 404 |
| **S8 Client intake UI** | `content/intake/**` (13 sets), `src/app/(public)/consulta/**`, `src/app/(public)/mi-consulta/**` | 13 question sets (fan-out); 5-step stepper (localStorage, live-supply line, 44 px targets, penal "detenido ahora" notice); result page + send; `/mi-consulta/` (status, "pedir otro", "eliminar mis datos") | E2E Laboral/Luque: summary shown → 3 lawyers → send → "aceptada" after a lawyer accepts; delete-my-data nulls PII |
| **S9 Lawyer inbox** | `src/app/(lawyer)/panel/casos/**`, PWA manifest + service worker, `src/app/(public)/resena/**`, `src/app/admin/resenas/**`, `src/lib/notify/templates/**` | Inbox, accept/decline, contact reveal, "contactado", report; push opt-in screen; review form + moderation + lawyer reply; all email template texts | E2E: push subscription saved; accept → contact shown; review submitted → moderated → published |
| **S10 Admin ops** | `src/app/admin/casos/**`, `src/app/admin/reportes/**`, `src/app/admin/embudo/**` | Cases (PII view audited), triage, SLA monitor, bad-lead reports, demand report, funnel table (§5) | Admin views work on seeded data; every PII view writes an audit row |
| **S11 Billing UI** | `src/app/(lawyer)/panel/plan/**`, `src/app/admin/pagos/**`, `src/app/(public)/para-abogados/planes/**`, sponsored card component | Plans page (150k / 1.5M / Fundador 600k per year / sponsored 150k); panel "Cómo pagar" (bank details from settings, reference code, optional hand-made payment link, "Ya pagué" + receipt upload); admin Pagos (confirm/reject, invoice number, paid-until list, revenue); sponsored card labelled "Patrocinado" outside the ranked list | E2E: lawyer reports a payment → admin confirms → plan active and paid-until shown; the sponsored card is absent from the shortlist JSON |
| **S12 Launch** | security fixes anywhere (listed in the log), `scripts/backup-db.ts`, `docs/ops/**`, `docs/launch/**` | `security-review` skill + fixes; headers checked with `curl -I`; weekly encrypted dump → R2 + a **restore test**; breach runbook, verification-call script, admin routine; project skill `estudio-dev`; Ads structure and outreach templates; delete `legacy-php/` 30 days after cutover | Restore into `estudio_dev` succeeds; security findings fixed or logged with reasons; launch checklist below is green |

**Launch checklist (S12, on production):**
- a real verified test lawyer completes intake → accept → review;
- Lighthouse passes;
- the legal pages are reviewed (or the interim pages you approved, question 5);
- one real bank transfer is reported, confirmed and reflected in `paid_until`;
- the demand report works.

## 3. Order and parallelism

```
W1 (Opus: M1 → M8)
  └─► S1 ─┬─► S2 ┐
          ├─► S3 ├─► S6 cutover (needs you: DNS)
          ├─► S4 │
          ├─► S5 ┘
          ├─► S7 ─┐
          ├─► S8  ├─► S12 launch
          ├─► S9  │
          ├─► S10 │
          └─► S11 ┘
```

- Run at most **4 Sonnet windows at a time**. Suggested waves:
  1. S1 alone (everything else builds on its components);
  2. S2, S3, S4, S5;
  3. S6 (cutover) together with S7, S8, S9;
  4. S10, S11;
  5. S12.
- Paste line for each: `Read prompts/<file>.md in this repo and execute it.`
- **Optional:** one short Opus 5.5 window after S12 to review the money and auth code paths the
  Sonnet windows touched (question 19). Recommended, but not required.

## 4. What only you can do, by window

| Window | You |
|---|---|
| W1 | Hostinger slot + DB + env vars; `db:migrate`; answer the remaining questions in `10` §C |
| S1–S5 | Higgsfield credits (~30 images); keyword data (question 20); Turnstile keys |
| S6 | Cloudflare DNS move; GA4 + Search Console; interim or reviewed legal pages (questions 4, 5) |
| S7 | R2 buckets + token; Cloudflare Email Sending for the domain; the verification operator; scan one matrícula-digital QR; CSJ dataset download |
| S8–S10 | Anthropic API key; deploy the cron Worker (`wrangler`, README); VAPID keys (the script prints them); ask Cloudflare for a higher email quota |
| S11 | Entity + bank account for payments (question 6); bank details in admin settings; your invoicing tool; accountant |
| S12 | Legal sign-off; outreach via the Leads DB (No Molestar checked); Ads budget; paid guide review |

## 5. Funnel events (`funnel_events`; GA4 mirrors the starred ones as conversions)

- **Client:**
  - `intake_view`, `intake_step` (n), `intake_ai_shown`, `intake_submit*`
  - `shortlist_shown` (count), `case_sent*` (n lawyers), `no_coverage`
  - `contact_click*` (the lawyer's WhatsApp button)
  - `client_checkin_answer` (yes/no), `review_submitted`, `data_deleted`
- **Lawyer:**
  - `lawyer_interest*`, `signup_start`, `signup_done`, `email_verified`, `docs_uploaded`
  - `verified*`, `profile_complete`, `push_enabled`
  - `case_offered`, `case_viewed`, `case_accepted*`, `case_declined`, `case_expired`
  - `lead_reported`
  - `plan_checkout_start`, `payment_paid*`, `subscription_canceled`
- **SEO:** `tool_used` (tool, result bucket), `guide_cta_click`.

No free text and no PII in events. Session IDs are random per visit. GA4 loads only after cookie
consent.
