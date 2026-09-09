<?php
/**
 * A city page is three lines: the record in content/segmentos.php holds
 * everything, templates/segment.php renders it.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'fernando-de-la-mora';
require ROOT_DIR . '/templates/segment.php';
