<?php
/**
 * A guide page is three lines: the record in content/guias.php holds
 * everything, templates/guide.php renders it.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'como-registrar-una-marca-ante-dinapi';
require ROOT_DIR . '/templates/guide.php';
