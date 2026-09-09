# Phase O1 — Foundation & deploy. Opus session. Lane 1 (the only lane 1 phase).

Read ONLY: this file, `plan.md` §1 (incl. §1.9), §2, §4, §5, §7, the phase table and §9 index, and
`docs/facts-to-verify.md`. Do not read the Sonnet sections (§6) beyond the Owns lists in the
phase table. Execute under the autonomy protocol §4. Build nothing outside the plan.

Owns (the only paths you may create or modify, plus the §4.9 append-only exceptions):
- `verify.sh`, `enviar.php`, `lib/**`, `partials/**`, `templates/**`, `deploy/**`, `.github/**`
- `content/abogados.php` (new), `content/site.php`, `content/ui.php` (only: add `trust.empty`,
  and keys a new partial needs under a new `abogados` group)
- `index.php` (only the trust band, to call the new partial), `.gitignore`, `docs/log/O1.md`

Budget: one session, ≤ 2 h. When the exit criteria pass, open the PR that turn (§4.13).

Phase rules:
- First thing: §5.1 — `git init`, first commit of the tree as-is (check `.gitignore` covers
  `config.php`, `logs/`, `dist/`, `docs/screenshots/`, `tests/node_modules/`), `gh repo create
  antonmarklundcom/estudio-com-py --private --source . --push`. Then branch `phase/O1`.
- §5.2 verify.sh: the four `php -r` blocks break on Git Bash paths. Temp-file + `cygpath -w`
  fix, identical behaviour on Linux CI. Green means zero FAIL lines on both.
- §5.3 lead handler: load `vendercrm-lead-capture` before touching `enviar.php`. The form's
  `company` input is the visitor's *city* on this site; send it to the CRM as a city and log it
  as `ciudad`. Do not rename form inputs (shared partial), do not change tiers or the thank-you.
- §5.4 `content/abogados.php` contract is in plan §2 — write it once, exactly. NOTE plan §1.9:
  `templates/service.php` and `templates/segment.php` ALREADY have a `.trust-empty` block beside
  the form; the partial replaces those blocks in that same position (never two empty states on
  one page) and folds their `ui()` keys into `trust.empty`. The partial must
  render the existing empty-state copy unchanged when the array is empty (diff the HTML of `/`,
  `/servicios/familia/`, `/ciudades/luque/familia/` before/after).
- §5.5 live check script must cope with Hostinger's JS anti-bot 403 on the first request
  (retry after 6 s / browser UA). If Anton has not uploaded a zip yet, commit the script and
  say so in the log — never wait.
- Design system §1.3 is locked: no new colours, icons or images for the abogados card; text only,
  `.card` + `.card-title` + `.card__text` from the existing CSS; a new `/* == O1 == */` block at
  the END of `assets/css/site.css` only if a rule is genuinely missing.
- Windows: no `zip` binary — use `deploy/make-zip.ps1`. Never Compress-Archive.
- Re-runnable; minor issues → `docs/log/O1.md`; stop only per §4.4.

Exit (all must hold before the PR opens):
- GitHub repo exists, CI green on the PR; `./verify.sh` zero FAIL lines on Windows and in CI.
- `logs/leads.log` line for a POST with `company=Luque` carries `ciudad: Luque`; JSON response
  still `ok:true, degraded:true, service, value_tier, value, currency, thanks`.
- `content/abogados.php` + `partials/abogados.php` in place, empty state byte-identical on the
  three sampled pages, example record renders on all three when uncommented (then re-commented).
- `deploy/verify-live.sh` committed; run against https://estudio.com.py if a zip has been
  uploaded, result in the log either way.
- Zip built from merged main, `./verify.sh --root dist/<name>` green, name in `docs/log/O1.md`.
- PR merged green. Screenshots: CI artifact.

## After this phase
Follow `prompts/_handoff.md` gates 1–4. Manual-run mode (plan §4): create no watcher and spawn no
sessions. End with the phase report naming the zip to upload and the three Sonnet prompts that can
now run: `prompts/sonnet-2-guias.md`, `prompts/sonnet-3-areas-depth.md`,
`prompts/sonnet-4-pages-trust.md` (parallel or sequential), then `prompts/sonnet-5-link-pass.md`.
