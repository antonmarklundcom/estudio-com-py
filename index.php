<?php
/**
 * Homepage: hero with the Ficha (lead form) beside the pitch, the "elegí el
 * área" grid, cómo funciona, the trust band (facts + the honest empty state
 * for "quién recibe su consulta" while no firm is signed — see
 * content/site.php), ciudades, guías and the closing consulta.
 *
 * estudio.com.py is a referral service: nothing here claims a team, a stat or
 * a client. Every collection in content/site.php starts null/empty on
 * purpose, and the sections below read that honestly instead of padding it out.
 */

require __DIR__ . '/lib/bootstrap.php';

$meta = page_meta('/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/',
];

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <!-- Hero ------------------------------------------------------------- -->
  <section class="hero hero--home">
    <div class="container hero__grid">

      <div class="hero__copy">
        <span class="pill">
          <span class="pill__dot" aria-hidden="true"></span>
          <?= e(ui('home.eyebrow')) ?>
        </span>

        <h1><?= e(ui('home.h1_lead')) ?><span class="accent"><?= e(ui('home.h1_accent')) ?></span></h1>

        <p class="lead hero__lead"><?= e(ui('home.lead')) ?></p>
      </div>

      <div class="hero__panel hero__panel--form" id="home-form">
        <?php
        $formId      = 'home';
        $formHeading = ui('form.legend');
        require ROOT_DIR . '/partials/lead-form.php';
        ?>
      </div>

    </div>
  </section>

  <!-- Elegí el área ------------------------------------------------------ -->
  <section class="section section--surface" id="servicios">
    <div class="container">
      <div class="section-head section-head--split">
        <div class="section-head__text">
          <p class="eyebrow"><?= e(ui('home.services_eyebrow')) ?></p>
          <h2><?= e(ui('home.services_title')) ?></h2>
        </div>
        <p class="section-head__aside"><?= e(ui('home.services_lead')) ?></p>
      </div>

      <div class="area-grid">
        <?php foreach (services() as $areaTile): ?>
          <a class="area-tile" href="<?= e($areaTile['path']) ?>">
            <span class="area-tile__title"><?= e($areaTile['navLabel']) ?></span>
            <span class="area-tile__text"><?= e($areaTile['metaDescription']) ?></span>
          </a>
        <?php endforeach; ?>
        <a class="area-tile area-tile--other" href="#home-form">
          <span class="area-tile__title"><?= e(ui('needs.otro') ?: 'Otra') ?></span>
          <span class="area-tile__text">Cuéntenos qué le pasó y lo orientamos al área correcta.</span>
        </a>
      </div>

      <div class="unsure">
        <div class="unsure__copy">
          <h3 class="card-title"><?= e(ui('home.unsure_title')) ?></h3>
          <p><?= e(ui('home.unsure_text')) ?></p>
        </div>
        <a class="btn btn--primary" href="#home-form"><?= e(ui('cta.talk')) ?></a>
      </div>
    </div>
  </section>

  <!-- Cómo funciona ------------------------------------------------------ -->
  <?php require ROOT_DIR . '/partials/process.php'; ?>

  <!-- Confianza: hechos + estado de "quién recibe su consulta" ----------- -->
  <section class="section section--surface">
    <div class="container stack">
      <p class="eyebrow"><?= e(ui('about.eyebrow')) ?></p>
      <h2><?= e(ui('about.title')) ?></h2>
      <div class="prose"><p><?= e(ui('about.text')) ?></p></div>

      <div class="grid grid--2 mt-4">
        <?php foreach (content('ui')['about']['credentials'] as $trustFact): ?>
          <div class="card">
            <p class="card__text"><?= e($trustFact) ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="trust-empty mt-4">
        <p class="trust-empty__label"><?= e(ui('nav.firm')) ?> — quién recibe su consulta</p>
        <p class="trust-empty__text">
          Estamos incorporando abogados independientes en Asunción y Gran Asunción. Su ficha
          queda registrada y le avisamos cuando un abogado de su área la tome.
        </p>
      </div>
    </div>
  </section>

  <!-- Ciudades ------------------------------------------------------------ -->
  <?php $homeCities = content('ui')['industries']['items']; ?>
  <section class="section section--ink">
    <div class="container city-band">
      <div class="city-band__head">
        <h2><?= e(ui('industries.title')) ?></h2>
        <span class="city-band__note"><?= e(ui('industries.lead')) ?></span>
      </div>
      <div class="city-band__list">
        <?php foreach ($homeCities as $i => $homeCity): ?>
          <a class="city-pill<?= $i === 0 ? ' city-pill--active' : '' ?>" href="<?= e($homeCity['path']) ?>"><?= e($homeCity['label']) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Guías ---------------------------------------------------------------- -->
  <?php $homeGuias = content('guias'); ?>
  <?php if ($homeGuias !== []): ?>
    <section class="section">
      <div class="container">
        <div class="section-head section-head--split">
          <div class="section-head__text">
            <p class="eyebrow"><?= e(ui('nav.guides')) ?></p>
            <h2><?= e(ui('nav.guides')) ?></h2>
          </div>
          <a class="section-head__aside" href="/guias/">Ver todas &rarr;</a>
        </div>
        <div class="guide-list mt-4">
          <?php foreach ($homeGuias as $homeGuia): ?>
            <?php $homeGuiaService = services($homeGuia['relatedService'] ?? ''); ?>
            <a class="guide-row" href="<?= e($homeGuia['path']) ?>">
              <span class="guide-row__meta">
                <span class="guide-row__tag"><?= e($homeGuiaService['navLabel'] ?? '') ?></span>
                <span class="guide-row__title"><?= e($homeGuia['title']) ?></span>
              </span>
              <span class="guide-row__arrow" aria-hidden="true">&rarr;</span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
