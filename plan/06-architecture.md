# 06 — Architecture: keep the PHP site

## 1. Decision

Keep the existing **static HTML + PHP site** (built from `php-site-template`) on Hostinger shared
hosting. There's no database, no Node slot and no framework migration.

Why:
- It's built, verified and already shaped as a referral service: 8 áreas, 7 cities, 56
  área × ciudad pages, 8 guides, a lead handler posting to VenderCRM, self-hosted fonts, a
  `verify.sh` gate and CI.
- Everything the lean model needs is content plus a few small changes.
- A Next.js marketplace (`later-marketplace/06-architecture.md`) is justified only when lawyers
  self-serve.

## 2. Changes to make

| # | Change | Where | Why |
|---|---|---|---|
| C1 | **Consent checkbox** (required, not pre-ticked) + `consent_version` hidden field; the message field capped at 500 characters with the sensitive-data hint | `partials/lead-form.php`, `content/ui.php` (`form.*`), `enviar.php` (reject without consent; send `fields.consent_version`, `fields.consent_at`) | `05` §4 step 1 |
| C2 | **VenderCRM on every form, verified live:** `config.php` on the server with `VENDERCRM_URL = https://crm.clientes.com.py` and `VENDERCRM_API_KEY` = the estudio row of your VenderCRM list. Nothing changes in code: `enviar.php` already posts to `/api/v1/leads` server-side with an idempotency key, honeypot and rate limit. Add `fields.area`, `fields.ciudad`, `fields.pagina` if missing | your step on the server, plus a check in `deploy/verify-live.sh` | Leads must reach your CRM |
| C3 | **Forbidden-phrase check** in `verify.sh`: grep the rendered HTML of every route for the "Never" list in `05` §1; fail on any hit | `verify.sh` | Enforces legal copy on every future edit |
| C4 | **Partner card:** extend the `content/abogados.php` shape with `matricula`, `checked_on` (date of your check, not shown), `modalidad` ("Asunción y virtual"), `approved_text_on` (date the lawyer approved the card). Render "Abg. <nombre> · Matrícula N° <n> · Abogado independiente asociado" | `content/abogados.php`, `partials/abogados.php` | `03` §4, `05` §3 |
| C5 | **Honest promise copy:** thank-you, "Qué pasa después", form lead copy and the empty state all state the 1-business-day reply and the two-step consent; no "un abogado le llamará" | `content/ui.php`, `content/lead-values.php` (`nextStep`) | `05` §2 |
| C6 | **Legal pages rewritten:** `/terminos/`, `/privacidad/` (`05` §4, §6), and a new `/como-trabajamos/`. Marked "borrador" in a visible note until the lawyer's review; the texts are conservative enough to be live meanwhile | `content/pages.php`, new route dir | `05` §3, §6, §10 |
| C7 | **Footer disclaimer + tagline** ("Contacto con abogados independientes") | `content/ui.php`, `partials/footer.php`, `partials/header.php` | `05` §1 |
| C8 | **Indexability of the 56 área × ciudad pages:** add `noindex` to generated records unless the cell has a hand-written local block (`content/local-blocks.php`, ≥ 150 words, sourced facts); `sitemap.php` already skips `noindex`. The URLs stay live for users | `content/areas-ciudades.php`, new `content/local-blocks.php` | Thin near-duplicates hurt the whole domain (`07` §3) |
| C9 | **Two tools:** `/herramientas/honorarios-minimos-abogado/` (arancel table × jornal mínimo from `lib/market/py.php`) and `/herramientas/liquidacion-por-despido/` (extend the market module's `laboral` table). Behind `TOOLS_LIVE` in `config.php` until reviewed; with the flag off they render as `stub` (noindex) | `content/tools.php`, `assets/js/tools/*.js`, `lib/market/py.php` tables, `templates/tool.php` (existing) | Primary content wedge (`02` §4) |
| C10 | **Docs for you:** `docs/partner-agreement-outline.md`, `docs/ops/lead-handling.md` (reply templates, consent step 2 wording, deletion routine) | `docs/` | `05` §3, §4 |
| C11 | **Retention helper:** extend `deploy/leads-to-csv.php` with a `--older-than 30d` report of the local log. Deletion in VenderCRM itself is your manual monthly step | `deploy/` | `05` §4 |
| C12 | **Analytics without case data:** confirm `assets/js/analytics.js` sends only `lead_submit` with área/tier, never form text. GA4 only after `GA4_ID` is set | `assets/js/analytics.js` | `05` §4 |

**Not changed:**
- the design system (text-only; question 9);
- the URL scheme (frozen: `/servicios/<área>/`, `/ciudades/<c>/`, `/ciudades/<c>/<a>/`,
  `/guias/<slug>/`);
- the deploy method (zip → `public_html`, `deploy/make-zip.*`).

## 3. Deploy and verify (as today)

`./verify.sh` → `deploy/make-zip.sh` (or `.ps1`) → `./verify.sh --root dist/<zip>` → you upload to
Hostinger `public_html` → `deploy/verify-live.sh https://estudio.com.py`.

**Known issue:** the live site returned HTTP 500 on 2026-09-09 until the zip is uploaded
(`KNOWN-ISSUES.md`). Uploading the current zip plus `config.php` is step 0 of the build.

## 4. CI

The existing `.github/workflows/verify.yml` stays as it is: the PHP gate, already running on PRs.
There is no new workflow (`budgeted-runner-deploy`).
