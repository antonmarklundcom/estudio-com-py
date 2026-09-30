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
- **Local `verify.sh` flakiness on this Windows/Git Bash machine** (S2, S3). A stray `php -S`
  process left bound to the fixed port from a prior run collides with the next run's own
  server, producing phantom `enviar.php` / metadata / lead-routing failures on pages the
  current diff never touched. `taskkill //F //IM php.exe` plus clearing `logs/rate` and
  `logs/leads.log` before each run has fixed it every time across three phases now. Not a code
  defect; CI (Linux, no shared-process contention) has been green on every run. Worth a
  `--port` default that varies per invocation if this keeps costing session time.
