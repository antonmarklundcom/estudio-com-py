<?php
/**
 * Article index. Empty on this site: articles live under content/guias.php
 * instead ("Guías"), which fits a referral service's how-to content better
 * than a dated blog. Kept as an array — lib/helpers.php and blog/index.php
 * read content('blog') unconditionally, and /blog/ stays a noindex redirect
 * target rather than being deleted, in case an old link points at it.
 */

declare(strict_types=1);

return [];
