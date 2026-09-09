# Phase S3 — Áreas depth. Sonnet session. Lane 2, runs in parallel with S2 and S4.

Read ONLY: this file, `plan.md` §1, §2, §4, §6 (intro + 6.2), the phase table and §9 index, and
`docs/log/O1.md`. Also read `content/services.php`, `content/areas-ciudades.php` and
`docs/facts-to-verify.md` (your material). Do not read the rest. Execute under the autonomy
protocol §4. Build nothing outside the plan.

Owns (the only paths you may create or modify, plus the §4.9 append-only exceptions):
- `content/services.php` — every key EXCEPT `guides`, `related`, `path`, `cluster`, `parent`
  (S5 owns `guides`/`related`; the rest are frozen)
- `content/areas-ciudades.php` — the `$areas` table only (`kw`, `topic`, `adj`, `local`)
- `docs/log/S3.md`

Hard limits (lane 2): no changes to `lib/**`, `partials/**`, `templates/**`, `enviar.php`,
`router.php`, `.htaccess`, `verify.sh`, `deploy/**`, the CSS tokens block, `content/segmentos.php`,
`content/lead-values.php`, or any content file another phase owns. Workaround + Backlog note in
`docs/log/S3.md`; truly blocked → append to `docs/decisions-needed.md`, push, end (§4.4).

Budget: one session, ≤ 90 min. Polish cap §4.13. When the exit criteria pass, open the PR that turn.

Phase rules:
- Branch `phase/S3` off latest main. WIP commit every 30 min.
- Load `paraguay-business-apps` (voice, institutions) and `php-site-template` (record contract).
- Per área targets are in plan §6.2: includes 5–6, excludes 2–3 (name the área that DOES cover
  it), weNeed 3–4, sections "Qué hacer ahora" (2 paragraphs) + "Qué esperar" with items Plazos /
  Costo, faq 4–5. Costs and times are described structurally, never as numbers (§1.2).
- `hero.lead` ≤ 2 sentences and must keep the phrase "su ciudad" where it has it today — the
  área × ciudad generator swaps it for the city name.
- After any edit run the length check: `php -r` (or a temp script) asserting every
  `areas-ciudades` record has `seo_title` ≤ 60 and description 120–155; the generator's header
  comment explains the budget. Titles/descriptions must stay unique site-wide (verify checks).
- Same-shaped units: write ONE exemplar (laboral) yourself, then fan out the other seven as
  parallel Sonnet subagents per `fable-directs-sonnet-builds` §Fan-out; one verify, one PR.
- Copy never says "nuestros abogados" / "nuestro estudio"; it's "lo conectamos con un abogado
  <adj> independiente". No new institution names beyond `docs/facts-to-verify.md`.
- Re-runnable; minor issues → `docs/log/S3.md`; stop only per §4.4.

Exit (all must hold before the PR opens):
- 8 área URLs and 56 área × ciudad URLs return 200 with the deeper copy; FAQPage JSON-LD parses
  on a sample of 5; `excludes` renders on all 8 áreas.
- `./verify.sh` green; the length check prints nothing.
- PR merged green. Screenshots: CI artifact (≤ 5 pages × 2 widths).

## After this phase
Follow `prompts/_handoff.md`. Lane 2 spawns nothing — end with your phase report.
