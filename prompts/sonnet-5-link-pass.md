# Phase S5 — Link pass. Sonnet session. Runs alone, after S2, S3 and S4 are merged.

Read ONLY: this file, `plan.md` §1, §4, §6.4, §7, the phase table and §9 index, and
`docs/log/O1.md`, `docs/log/S2.md`, `docs/log/S3.md`, `docs/log/S4.md`. Do not read the rest.
Execute under the autonomy protocol §4. Build nothing outside the plan.

Owns (the only paths you may create or modify, plus the §4.9 append-only exceptions):
- `content/services.php` — ONLY the `guides` and `related` keys of each record
- `content/nav.php`, `index.php` (the Guías section only), `KNOWN-ISSUES.md`
- `docs/log/S5.md`

Hard limits: no changes to `lib/**`, `partials/**`, `templates/**`, `enviar.php`, `router.php`,
`.htaccess`, `verify.sh`, `deploy/**`, the CSS tokens block, or any other content file. If a
cross-link needs a template change, write it to `KNOWN-ISSUES.md` and the Backlog, don't do it.

Budget: one session, ≤ 60 min. Polish cap §4.13. When the exit criteria pass, open the PR that turn.

Phase rules:
- Branch `phase/S5` off latest main (all three lane 2 PRs merged — check `git log` first).
- `services[<área>]['guides']` = the guide slug(s) for that área from `content/guias.php`
  (`relatedService` tells you which). All 8 áreas get ≥ 1. This also lights the "Guía
  relacionada" band on the 56 área × ciudad pages through the generator — verify one.
- Home Guías list: 8 rows. Check it at 390 px; if it runs long, show the 6 most recent by
  `lastReviewed` and keep the existing "Ver todas →" link. Do not restyle.
- Footer: add nothing unless it fits the existing column pattern in `content/nav.php` without
  a CSS change.
- Sitemap sanity: `curl /sitemap.xml | grep -c '<loc>'` equals pages + 8 áreas + 7 cities +
  56 combos + 8 guides; every `<loc>` returns 200 locally.
- `KNOWN-ISSUES.md`: promote only still-open, cross-phase items from the four phase logs;
  one line each, with the phase that found it.
- Build the zip (`deploy/make-zip.ps1` on Windows, `.sh` elsewhere) from merged main and run
  `./verify.sh --root dist/<name>`.
- Re-runnable; minor issues → `docs/log/S5.md`; stop only per §4.4.

Exit (all must hold before the PR opens):
- 8 área pages and a sampled combo page show the "Guía relacionada" band; every guide link 200s.
- Sitemap count matches; `./verify.sh` green on main after merge; zip verified.
- PR merged green; `docs/log/S5.md` + §9 line written.

## After this phase
Follow `prompts/_handoff.md` gates 1–4. Manual-run mode: no watcher to delete. STOP with the
closing report: what is live vs. what waits on Anton (§7: upload the named zip, `config.php`
CRM keys, WhatsApp number, first signed lawyer), the KNOWN-ISSUES list, and the Backlog.
