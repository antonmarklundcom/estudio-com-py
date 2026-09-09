# Phase S2 — Guías. Sonnet session. Lane 2, runs in parallel with S3 and S4.

Read ONLY: this file, `plan.md` §1, §4, §6 (intro + 6.1), the phase table and §9 index, and
`docs/log/O1.md`. Also read `content/guias.php` and `docs/facts-to-verify.md` (they are your
material). Do not read the rest. Execute under the autonomy protocol §4. Build nothing outside
the plan.

Owns (the only paths you may create or modify, plus the §4.9 append-only exceptions):
- `content/guias.php`
- `guias/<slug>/index.php` (new route dirs, three lines each, copy an existing one)
- `docs/log/S2.md`

Hard limits (lane 2): no changes to `lib/**`, `partials/**`, `templates/**`, `enviar.php`,
`router.php`, `.htaccess`, `verify.sh`, `deploy/**`, the CSS tokens block, `content/services.php`
(S5 links guides from áreas), or any content file another phase owns. Workaround + Backlog note
in `docs/log/S2.md`; truly blocked → append to `docs/decisions-needed.md`, push, end (§4.4).

Budget: one session, ≤ 90 min. Polish cap §4.13. When the exit criteria pass, open the PR that turn.

Phase rules:
- Branch `phase/S2` off latest main. WIP commit every 30 min.
- Load `paraguay-business-apps` for institution names and voice; `php-site-template` for the
  guide record shape and the three-line route file.
- The five new guides and their áreas are named in plan §6.1. Same voice as the three existing
  ones: usted, plain PY Spanish, 5 steps, 2–3 FAQs, `relatedService` set, `toolLink` null.
- **No invented facts** (§1.2): no fees, no day counts unless a public rule fixes them (then say
  "la ley fija un plazo; el abogado se lo confirma"), no institutions beyond MTESS, IPS, DINAPI,
  DNIT, DGRP, Ministerio Público, Registro Civil, escribano, juzgados.
- `seoTitle` ≤ 43 chars (the suffix adds 17), `metaDescription` 120–155, both unique site-wide.
- Same-shaped units: write ONE exemplar (penal) yourself, then fan out the other four as parallel
  Sonnet subagents per `fable-directs-sonnet-builds` §Fan-out; one verify, one PR. Never Fable.
- Fix `related[]` so every guide points at two others that exist.
- Re-runnable; minor issues → `docs/log/S2.md`; stop only per §4.4.

Exit (all must hold before the PR opens):
- 8 guide URLs return 200 with full copy; each emits HowTo + FAQPage JSON-LD that parses.
- `./verify.sh` green (route contract picks the new guides up from `content/guias.php`).
- PR merged green. Screenshots: CI artifact (≤ 5 pages × 2 widths).

## After this phase
Follow `prompts/_handoff.md`. Lane 2 spawns nothing — end with your phase report.
