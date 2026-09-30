# 09 — Build plan: one Opus window, then Sonnet windows

Everything happens in the existing PHP site: one branch `phase/<id>` and one PR per milestone,
merged when `./verify.sh` is green (CI already runs it). Before merging, run
`deploy/make-zip.sh` and `./verify.sh --root dist/<zip>`; the zip you upload is the last merged
one.

**Never Codex, never Fable.** Subagents inside a window set `model: "sonnet"` explicitly.

## 0. Rules every window follows

1. **Read only:** the prompt/section for the window, `plan/00-README.md`, `plan/05-legal.md`,
   the plan files named in the window, and `/plan.md` §1–§2 (the site's locked decisions:
   referral service, content-as-data, design system, URL scheme).
2. **`05-legal.md` wins every conflict.** When copy is in doubt, use the more modest wording.
3. **Stop and ask only** for a missing credential with no fallback. To ask, write it in
   `docs/decisions-needed.md`, commit, push, and end the window.
4. **Log:** `docs/log/<id>.md` has at most 12 lines of Built, 8 of Decisions and 8 of Known
   issues. Add an index line to `plan/00-README.md` §5.
5. **Never write a real API key** into the repo, a prompt, a log or a PR body. The VenderCRM key
   goes only into `config.php` on the server.
6. **Skills to load:** `php-site-template` (any site change), `vendercrm-lead-capture` (form
   and `enviar.php`), `phased-autonomous-build` (prompt files).

## 1. Step 0 — you, about 20 minutes, before any window

1. Upload the current zip (`deploy/make-zip.ps1` on your PC, or ask any window to build it) to
   Hostinger `public_html`. The site returned 500 on 2026-09-09 until this is done.
2. Create `config.php` on the server from `config.example.php`:
   - `VENDERCRM_URL` = `https://crm.clientes.com.py`
   - `VENDERCRM_API_KEY` = the estudio row of your VenderCRM list
3. Submit one test lead and confirm it appears in VenderCRM. Then run
   `deploy/verify-live.sh https://estudio.com.py`.

## 2. Window L1: Opus 5.5, effort high, one window, about 3–4 h

**Why Opus:** the legal copy, the consent flow, the lead handler and the fee math decide your
legal exposure. That's the work where Sonnet's cheaper guess is the expensive one. **Why high:**
this window is short, and it's the part where "protect me legally" lives.

Start it in a **new window** in auto-accept mode and paste:
`Read plan/09-phases.md §0 and §2, then execute window L1 from the first unmerged milestone.`

### M1: legal copy and consent (`06` C1, C3, C5, C7)

- Consent checkbox + `consent_version`; `enviar.php` rejects a submission without consent and
  sends `fields.consent_version`/`consent_at`, área, ciudad and page; the message field is capped
  at 500 characters with the hint.
- The tagline, footer disclaimer, thank-you, "qué pasa después" and empty states are rewritten
  to `05` §1–§2.
- The forbidden-phrase check goes into `verify.sh`, and every existing page is fixed until it
  passes.

**Acceptance:**
- `./verify.sh` is green, including the new check.
- A POST without consent is rejected with a friendly error, and the no-JS path works too.
- A POST with consent shows `consent_version` in the degraded-mode log line.
- `grep -ri "nuestros abogados\|asesoramiento legal\|gratis"` over the rendered pages finds
  nothing.

### M2: legal pages and your documents (`06` C6, C10, C11)

- `/terminos/`, `/privacidad/`, `/como-trabajamos/` per `05` §3, §4 and §6, with a visible
  "Borrador pendiente de revisión legal" note behind a `LEGAL_REVIEWED` flag in `content/site.php`.
- `docs/partner-agreement-outline.md` and `docs/ops/lead-handling.md` (reply templates in
  Spanish for "cubierto", "no cubierto" and "consentimiento para compartir"; the +7-day
  follow-up; the monthly deletion routine).
- The `leads-to-csv.php --older-than` report.

**Acceptance:** the three pages render, are in the sitemap, and pass the forbidden-phrase check.
The docs exist and contain no real names or keys.

### M3: partner card, indexability, FAQ schema (`06` C4, C8)

- The extended `content/abogados.php` shape and card (empty array committed; one commented
  example).
- `noindex` on área × ciudad records without a local block; `content/local-blocks.php` with
  **one exemplar** (Asunción × familia, every fact with a source URL in a comment).
- `FAQPage` JSON-LD on área pages and guides.

**Acceptance:**
- The sitemap drops from 86 to 31 URLs: 7 pages + 8 áreas + 7 cities + 8 guides + 1 local cell.
  The new pages from M2 add to that count.
- `curl` on a combo without a block shows `noindex`.
- Uncommenting the example partner renders the card on familia pages, then it is recommitted
  commented out.

### M4: fee and severance tools (`06` C9)

- The arancel table (acts in jornales) and the severance rules in `lib/market/py.php` with source
  comments, plus the two tool pages and JS.
- ≥ 10 hand-computed cases each, runnable with a PHP test script under `tests/` and added to
  `verify.sh`.
- Both tools are `stub` (noindex) while `TOOLS_LIVE` is off.

**Acceptance:** the test cases match, and the tool pages render in both flag states.

### M5: handoff

- Write `prompts/s1-guias.md`, `prompts/s2-areas-fees.md`, `prompts/s3-local.md` and
  `prompts/s4-linkpass.md` (≤ 35 lines each, from §3).
- Build the zip, verify it, and name it in `docs/log/L1.md`.
- End by telling you to upload it.

## 3. Sonnet 5.5 windows (effort medium; S1–S3 in parallel, S4 last)

Paste line: `Read prompts/<file>.md in this repo and execute it.`

| Window | Owns | Builds | Acceptance |
|---|---|---|---|
| **S1 Guides** | `content/guias.php`, `guias/**` | 9 new guides (`07` §4.3) in the existing record shape; every one passes `05` §5; `related[]` links 2 guides + its área + tool | 17 guide URLs 200; ≥ 900 words each; verify green |
| **S2 Área depth + fees** | `content/services.php` | A "¿Cuánto cuesta?" section on the 8 áreas using the M4 table keys (legal minimum only), FAQ to 5 each, content ≥ 800 words | verify green; no fee below arancel; no forbidden phrases |
| **S3 Local blocks** | `content/local-blocks.php`, `plan/data/facts-to-verify.md` | 9 more cells (`07` §3), facts sourced or left out and listed | 10 cells indexable; 0 unsourced facts |
| **S4 Keywords + link pass** | `plan/data/**`, link fields in `content/*.php`, `index.php`, `KNOWN-ISSUES.md` | Import keyword data (MCP or KWP CSV); re-rank the next local cells into `plan/data/next-cells.md`; cross-links; zip + verify; Lighthouse after your upload | verify green on the zip; Lighthouse ≥ 95 ×4 on 4 pages (after upload) |

## 4. What only you do

| When | You |
|---|---|
| Now | Step 0 (upload + `config.php` + test lead) |
| During L1 | Book the one-off lawyer consultation (`05` §10); start looking for partner lawyers (`04` §3) |
| After L1 | Upload the zip; Search Console + sitemap; GA4 ID in `config.php` (optional) |
| After the lawyer review | Set `LEGAL_REVIEWED` and `TOOLS_LIVE` (or ask a window to) |
| First partner | Check them (`05` §3), sign the agreement, fill `content/abogados.php` (a Sonnet window can do it from your notes) |
| Ongoing | Reply to leads within 1 business day; monthly deletion; +7-day follow-ups |
