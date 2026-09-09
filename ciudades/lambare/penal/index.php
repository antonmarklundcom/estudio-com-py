<?php
/**
 * An área × ciudad page is four lines: the record in
 * content/areas-ciudades.php holds everything, templates/segment.php renders it.
 */

require __DIR__ . '/../../../lib/bootstrap.php';

$collection = 'areas-ciudades';
$slug       = 'penal-lambare';
require ROOT_DIR . '/templates/segment.php';
