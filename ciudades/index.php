<?php
/**
 * The cities hub: every record in content/segmentos.php, in file order.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/ciudades/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/ciudades/',
    'breadcrumbs' => [['label' => ui('nav.cities'), 'path' => '/ciudades/']],
];

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="page-hero">
    <div class="container">
      <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <div class="page-hero__inner">
        <p class="eyebrow"><?= e(ui('nav.cities')) ?></p>
        <h1><?= e($meta['h1']) ?></h1>
        <p class="lead"><?= e($meta['lead']) ?></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <?php if (content('segmentos') === []): ?>
        <p class="lead"><?= e(ui('hub.empty')) ?></p>
      <?php else: ?>
        <div class="grid grid--3">
          <?php foreach (content('segmentos') as $listCity): ?>
            <a class="card card--link" href="<?= e($listCity['path']) ?>">
              <h2 class="card-title"><?= e($listCity['navLabel']) ?></h2>
              <p class="card__text"><?= e($listCity['metaDescription']) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
