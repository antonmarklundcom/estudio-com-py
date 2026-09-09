# Phase S4 — Pages & trust copy. Sonnet session. Lane 2, runs in parallel with S2 and S3.

Read ONLY: this file, `plan.md` §1, §4, §6 (intro + 6.3), §7, the phase table and §9 index, and
`docs/log/O1.md` (O1 moved the "quién recibe su consulta" empty-state text into `ui('trust.empty')`
— you edit it there, not in `index.php`). Also read `content/pages.php`, `content/ui.php` and
`contacto/index.php` (your material). Do not read the rest. Execute under the autonomy protocol
§4. Build nothing outside the plan.

Owns (the only paths you may create or modify, plus the §4.9 append-only exceptions):
- `content/pages.php`
- `content/ui.php` — ONLY the groups `about`, `process`, `contact`, `cta_band`, `form`, `footer`,
  `error404`, `trust` (other groups belong to other phases or are frozen)
- `contacto/index.php`, `privacidad/index.php`, `terminos/index.php`, `404.php`
- `docs/log/S4.md`

Hard limits (lane 2): no changes to `lib/**`, `partials/**`, `templates/**`, `enviar.php`,
`router.php`, `.htaccess`, `verify.sh`, `deploy/**`, `index.php`, the CSS tokens block, or any
content file another phase owns. Workaround + Backlog note in `docs/log/S4.md`; truly blocked →
append to `docs/decisions-needed.md`, push, end (§4.4).

Budget: one session, ≤ 90 min. Polish cap §4.13. When the exit criteria pass, open the PR that turn.

Phase rules:
- Branch `phase/S4` off latest main. WIP commit every 30 min.
- Load `paraguay-business-apps` (voice) and `vendercrm-lead-capture` §privacy wording if present.
- The job is trust *without* lawyers signed (plan §6.3): who pays, what is shared and with whom,
  what happens if nobody takes the ficha. Facts only — everything must already be true in
  `terminos`. No stats, no "cientos de consultas", no promises of response time.
- Form strings (`form.*`) are shared by every form on the site: keep labels short, keep the field
  order and names, one-line notes only. `form.company` stays "Ciudad".
- `/privacidad/` and `/terminos/` sections are prose blocks in `content/pages.php`; add the new
  sections there, no new templates.
- `404.php` already lists áreas; add the seven cities from `content('segmentos')` as links —
  read the file's existing loop and mirror it.
- Descriptions 120–155 and unique; titles ≤ 43 chars page part. Usted everywhere.
- Re-runnable; minor issues → `docs/log/S4.md`; stop only per §4.4.

Exit (all must hold before the PR opens):
- `/`, `/contacto/`, `/privacidad/`, `/terminos/`, `/esta-pagina-no-existe/` render the new copy;
  a grep of the rendered HTML for "nuestros abogados", "nuestro estudio", "años de experiencia",
  "clientes satisfechos" finds nothing.
- `./verify.sh` green.
- PR merged green. Screenshots: CI artifact (≤ 5 pages × 2 widths).

## After this phase
Follow `prompts/_handoff.md`. Lane 2 spawns nothing — end with your phase report.
