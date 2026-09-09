<?php
/**
 * A área page is three lines: the record in content/services.php holds
 * everything, templates/service.php renders it.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'empresas';
require ROOT_DIR . '/templates/service.php';
