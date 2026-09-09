#!/usr/bin/env bash
#
# Post-cutover verification: curls every URL in the route
# contract (deploy/routes.php — every page the content arrays declare, plus the
# redirects and 410s the site froze) against a LIVE base URL and asserts the
# status each one must answer with. Run this after uploading to the Hostinger staging subdomain, and
# again after the DNS cutover to the production domain.
#
#     ./deploy/verify-live.sh https://staging.example.com
#     ./deploy/verify-live.sh https://example.com
#
# Unlike verify.sh (which boots its own php -S), this script only reads
# locally to build the expected route list — every request goes to the live
# URL you pass in. It never boots a server and never touches config.php.
#
set -uo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

BASE="${1:-}"
if [ -z "$BASE" ]; then
  echo "usage: $0 <base-url>   e.g. $0 https://staging.example.com" >&2
  exit 2
fi
BASE="${BASE%/}"

red()   { printf '\033[31m%s\033[0m\n' "$*"; }
green() { printf '\033[32m%s\033[0m\n' "$*"; }
step()  { printf '\n\033[1m== %s\033[0m\n' "$*"; }
fail()  { red "  FAIL  $*"; FAILURES=$((FAILURES + 1)); }
ok()    { printf '  ok    %s\n' "$*"; }

FAILURES=0

# Hostinger answers the first request from a new client with a JS anti-bot
# challenge — 403, an HTML body, and a cookie. A browser user agent gets past it
# most of the time; when it does not, one retry six seconds later does. Every
# request in this script goes through these two helpers so a challenge is never
# reported as a broken page.
UA='Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36'
JAR="$(mktemp)"
trap 'rm -f "$JAR"' EXIT

live_code() {   # live_code <path> — HTTP status, following no redirects
  local code
  code=$(curl -s -o /dev/null -w '%{http_code}' --max-time 15     -A "$UA" -b "$JAR" -c "$JAR" "${BASE}${1}")
  if [ "$code" = "403" ] || [ "$code" = "000" ]; then
    sleep 6
    code=$(curl -s -o /dev/null -w '%{http_code}' --max-time 15       -A "$UA" -b "$JAR" -c "$JAR" "${BASE}${1}")
  fi
  printf '%s' "$code"
}

live_body() {   # live_body <path> — response body
  local body
  body=$(curl -s --max-time 15 -A "$UA" -b "$JAR" -c "$JAR" "${BASE}${1}")
  if [ -z "$body" ]; then
    sleep 6
    body=$(curl -s --max-time 15 -A "$UA" -b "$JAR" -c "$JAR" "${BASE}${1}")
  fi
  printf '%s' "$body"
}

live_header() { # live_header <path> <header-name> — one response header, lower-cased
  curl -sI --max-time 15 -A "$UA" -b "$JAR" -c "$JAR" "${BASE}${1}"     | tr -d '' | grep -i "^${2}:" | head -1 | cut -d' ' -f2- | tr 'A-Z' 'a-z'
}

step "reachability"
code=$(live_code /)
if [ "$code" = "000" ]; then
  red "could not reach $BASE (connection failed) — check DNS/hosting before continuing"; exit 2
fi
ok "$BASE responds ($code)"

step "https"
case "$BASE" in
  https://*) ok "base URL is https" ;;
  *) fail "base URL is not https — Hostinger free SSL should be active before cutover" ;;
esac

step "routes"
ROUTE_LIST=$(php "$ROOT/deploy/routes.php" "$ROOT")
ROUTE_COUNT=0

while IFS=$'\t' read -r path expected; do
  [ -z "$path" ] && continue
  ROUTE_COUNT=$((ROUTE_COUNT + 1))
  actual=$(live_code "$path")
  if [ "$actual" != "$expected" ]; then
    fail "$path — expected $expected, got $actual"
    ROUTE_FAILED=1
  fi
done <<< "$ROUTE_LIST"
[ "${ROUTE_FAILED:-0}" -eq 0 ] && ok "$ROUTE_COUNT URLs answered as specified"

step "internals stay unreachable"
INTERNAL_FAILED=0
for path in /config.php /lib/helpers.php /content/site.php /logs/leads.log /.htaccess /deploy/make-zip.sh; do
  actual=$(live_code "$path")
  if [ "$actual" = "200" ]; then
    fail "$path is publicly readable (got 200) — check .htaccess made it to the server"
    INTERNAL_FAILED=1
  fi
done
[ "$INTERNAL_FAILED" -eq 0 ] && ok "internal paths are not served"

step "sitemap and robots"
sitemap=$(live_body /sitemap.xml)
if echo "$sitemap" | grep -q "<urlset"; then
  ok "sitemap.xml renders"
else
  fail "sitemap.xml did not return a <urlset> — is sitemap.php reachable and is SITE_URL set in config.php?"
fi

# 8 áreas + 7 cities + 56 combos + the static pages and guides is comfortably
# over 80; a sitemap that suddenly lists fewer means a content array did not ship.
SITEMAP_URLS=$(echo "$sitemap" | grep -c "<loc>")
if [ "$SITEMAP_URLS" -ge 80 ]; then
  ok "sitemap.xml lists $SITEMAP_URLS URLs"
else
  fail "sitemap.xml lists only $SITEMAP_URLS URLs, expected at least 80"
fi

robots=$(live_body /robots.txt)
if echo "$robots" | grep -qi "sitemap"; then
  ok "robots.txt references the sitemap"
else
  fail "robots.txt does not mention the sitemap"
fi

# Only for a site that actually replaced a WordPress install: the redirect is
# commented out in .htaccess and absent from the route contract otherwise, and
# asserting on it there would fail every run for no reason.
if printf '%s' "$ROUTE_LIST" | grep -q '^/wp-sitemap\.xml'; then
  step "wp-sitemap.xml redirect (WordPress cutover)"
  wpcode=$(live_code /wp-sitemap.xml)
  if [ "$wpcode" = "301" ]; then
    ok "/wp-sitemap.xml still redirects (301)"
  else
    fail "/wp-sitemap.xml returned $wpcode, expected 301 — Search Console will flag this"
  fi
fi

# The fonts were moved off the Google CDN on 2026-09-09 (self-hosted, subset,
# preloaded). A CDN link creeping back costs a third-party connection on first
# paint and leaks the visitor's IP to Google; a woff2 served as the wrong type is
# a build that shipped the files but not the .htaccess.
step "self-hosted fonts"
home=$(live_body /)
if printf '%s' "$home" | grep -q 'fonts\.googleapis\.com\|fonts\.gstatic\.com'; then
  fail "the homepage still links the Google Fonts CDN"
else
  ok "no Google Fonts CDN reference in the HTML"
fi

FONT_FAILED=0
FONT_COUNT=0
while IFS= read -r font; do
  [ -z "$font" ] && continue
  FONT_COUNT=$((FONT_COUNT + 1))
  ctype=$(live_header "/assets/fonts/${font}" content-type)
  case "$ctype" in
    font/woff2*) ;;
    *) fail "/assets/fonts/${font} is served as \"${ctype:-nothing}\", expected font/woff2"; FONT_FAILED=1 ;;
  esac
done < <(cd "$ROOT/assets/fonts" 2>/dev/null && ls *.woff2 2>/dev/null)
if [ "$FONT_COUNT" -eq 0 ]; then
  fail "assets/fonts/ has no .woff2 files locally — nothing to check"
elif [ "$FONT_FAILED" -eq 0 ]; then
  ok "$FONT_COUNT woff2 files served as font/woff2"
fi

echo
if [ "$FAILURES" -eq 0 ]; then
  green "verify-live.sh: PASS ($ROUTE_COUNT routes checked against $BASE)"
  exit 0
else
  red "verify-live.sh: FAIL ($FAILURES problem(s) against $BASE)"
  exit 1
fi
