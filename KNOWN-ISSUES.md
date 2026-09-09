# Known issues

Promoted from the per-phase build logs (`docs/log/*.md`) and this phase's own findings. One
line each, with the phase that found it. Fixes belong in a later phase or in Anton's own
hands — see `plan.md` §7 (human inputs) and §10 (backlog).

- **Live site returns HTTP 500 on every URL** (O1, 2026-09-09 17:16 UTC, PHP 8.3.33 on
  Hostinger). Not stale content — the site is down. Fixed by uploading the zip this phase
  builds (see `docs/log/S5.md` for the exact filename); nothing in the repo can fix it.
- **No `.gitattributes`** (O1). A clone made with `core.autocrlf=true` gets CRLF shell
  scripts again, which broke `verify.sh`'s heredocs once already. Add one pinning `*.sh` and
  the GitHub workflow files to LF.
- **`README.md`'s "Content model" section omits `content/abogados.php`** (O1). The signed-lawyer
  collection exists and is used by `partials/abogados.php`; the README's content-file table
  was never updated to list it.
- **`templates/segment.php` never reads `$record['guides']`** (S5). `content/areas-ciudades.php`
  already forwards `'guides' => $svc['guides']` into every área × ciudad record (pre-existing
  code, not part of this phase's diff), and this phase populated that data on all 8 áreas, but
  `templates/service.php` is the only template that renders a "Guía relacionada" band from it.
  The 56 combo pages therefore carry the guide slug in their content record without ever
  showing the band — confirmed on `/ciudades/luque/familia/` (guide data present, no band in
  the rendered HTML). Fixing this needs one `<?php if ($record['guides'] ?? []) ... ?>` block
  in `templates/segment.php`, mirroring the block already in `templates/service.php` — out of
  this phase's owned paths (`templates/**` is hard-limited). The 8 área pages themselves show
  the band correctly.
- **Local `verify.sh` flakiness on this Windows/Git Bash machine** (S2, S3). A stray `php -S`
  process left bound to the fixed port from a prior run collides with the next run's own
  server, producing phantom `enviar.php` / metadata / lead-routing failures on pages the
  current diff never touched. `taskkill //F //IM php.exe` plus clearing `logs/rate` and
  `logs/leads.log` before each run has fixed it every time across three phases now. Not a code
  defect; CI (Linux, no shared-process contention) has been green on every run. Worth a
  `--port` default that varies per invocation if this keeps costing session time.
