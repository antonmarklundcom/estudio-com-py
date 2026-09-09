<?php
/**
 * /blog/ was a stub twin of /guias/ (same title, same description, no
 * articles). .htaccess and router.php 301 it to /guias/; this file is the
 * same redirect for a host that ignores the rewrite, so the URL never renders
 * a duplicate page again. Blog articles, if any are ever written into
 * content/blog.php, still live at /blog/<slug>/ under this directory.
 */

http_response_code(301);
header('Location: /guias/');
exit;
