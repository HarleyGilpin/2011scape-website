#!/usr/bin/env bash
# Fetch a 2011 capture of the RuneScape login form from the Wayback Machine.
# Output is written to _scratch/loginform-2011.html for later sanitisation.
# This is a one-off helper; the live login form lives at
#   resources/views/secure/weblogin/form.blade.php
# and uses the same field names (username, password, rem, mod, ssl, dest)
# posting to /secure/m=weblogin/login.html.

set -euo pipefail

cd "$(dirname "$0")/.."
mkdir -p _scratch

CAPTURE="https://web.archive.org/web/2011id_/https://secure.runescape.com/m=weblogin/loginform.ws"

curl --fail --silent --show-error -L \
    -A 'Mozilla/5.0 (X11; Linux x86_64) 2011scape-archive-fetch/1.0' \
    "$CAPTURE" \
    -o _scratch/loginform-raw.html

# Strip Wayback toolbar/scripts.
sed -E '
    /<!-- BEGIN WAYBACK TOOLBAR INSERT -->/,/<!-- END WAYBACK TOOLBAR INSERT -->/d
    s|https?://web\.archive\.org/web/[0-9]+(im_|js_|cs_|fw_|/)?||g
    /WB_wombat_Init/d
    /ait-client-rewrite\.js/d
' _scratch/loginform-raw.html > _scratch/loginform-2011.html

echo "Wrote _scratch/loginform-2011.html"
