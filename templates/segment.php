<?php
/**
 * Renders one segment page: a city page from content/segmentos.php, or an
 * área × ciudad page from content/areas-ciudades.php ("Abogado de divorcio en
 * Luque"). Every route file is three lines: require bootstrap, set $slug (and
 * $collection for the área × ciudad pages), require this file — the same
 * pattern templates/service.php and templates/tool.php use.
 *
 * A segment page has no tier or WhatsApp message of its own: it presets the
 * visitor into $record['leadSlug'], an existing service slug in
 * content/lead-values.php['services'], so the whole lead value model
 * resolves the tier, the CRM tag and the WhatsApp prefill with no new
 * entries needed there. An área × ciudad page uses its área as leadSlug, so
 * its leads arrive as that área (tier B) with the chip pre-selected and the
 * city pre-filled.
 *
 * Optional record keys beyond the segment contract:
 *   breadcrumbs  array   full crumb list (without the home crumb); defaults
 *                        to Servicios › title
 *   includes     array   "Qué resolvemos en esta área" checklist
 *   area, city   string  set on área × ciudad records; drive the cross-links
 *
 * New file, additive — not one of the hard-limited templates.
 */

declare(strict_types=1);

/** @var string $slug */
/** @var string $collection */
$collection = $collection ?? 'segmentos';
$record     = content($collection)[$slug ?? ''] ?? null;

if ($record === null) {
    http_response_code(404);
    require ROOT_DIR . '/404.php';
    return;
}

$page = [
    'title'       => $record['seoTitle'],
    'description' => $record['metaDescription'],
    'path'        => $record['path'],
    /* A city page sits under Ciudades; an área × ciudad record brings its
       own three-level crumb. */
    'breadcrumbs' => $record['breadcrumbs'] ?? [
        ['label' => ui('nav.cities'), 'path' => '/ciudades/'],
        ['label' => $record['navLabel'] ?? $record['seoTitle'], 'path' => $record['path']],
    ],
    'faq'      => $record['faq'],
    /* Every WhatsApp link and the CTA band on this page resolve through the
       bundle's tier-A service, not a segmento entry of its own. */
    'leadSlug' => $record['leadSlug'],
];

$hero        = $record['hero'];
$ctaWhatsapp = whatsapp_text_for_page($page);

/* Cross-links across the área × ciudad matrix. A city page lists its áreas
   (cards); an área × ciudad page lists the same city's other áreas and the
   same área's other cities (pills). All derived from the records, so a new
   city or área shows up everywhere with no edit here. */
$segArea     = $record['area'] ?? null;
$segCity     = $record['city'] ?? ($segArea === null ? $slug : null);
$segCityName = $record['cityName'] ?? ($record['navLabel'] ?? '');
$segAreaCards  = [];   // city page: every área in this city
$segOtherAreas = [];   // área × ciudad: other áreas in this city
$segOtherCities = [];  // área × ciudad: this área in other cities
foreach (content('areas-ciudades') as $segCombo) {
    if ($segArea === null && $segCombo['city'] === $segCity) {
        $segAreaCards[] = [
            'title' => services($segCombo['area'])['navLabel'],
            'text'  => services($segCombo['area'])['metaDescription'],
            'path'  => $segCombo['path'],
            'links' => [],
        ];
    } elseif ($segArea !== null && $segCombo['city'] === $segCity && $segCombo['area'] !== $segArea) {
        $segOtherAreas[] = ['label' => services($segCombo['area'])['navLabel'], 'path' => $segCombo['path']];
    } elseif ($segArea !== null && $segCombo['area'] === $segArea && $segCombo['city'] !== $segCity) {
        $segOtherCities[] = ['label' => $segCombo['cityName'], 'path' => $segCombo['path']];
    }
}

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="page-hero">
    <div class="container">
      <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <div class="page-hero__inner">
        <p class="eyebrow"><?= e($hero['eyebrow']) ?></p>
        <h1><?= e($hero['h1']) ?></h1>
        <p class="lead"><?= e($hero['lead']) ?></p>
        <div class="btn-row">
          <a class="btn btn--primary" href="#solicitar"><?= e(ui('cta.consult')) ?></a>
          <?php if (($wa = whatsapp_link($ctaWhatsapp)) !== null): ?>
            <a class="btn btn--secondary" href="<?= e($wa) ?>" rel="noopener"><?= e(ui('cta.whatsapp')) ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php $segBand = 0; /* alternates white/surface across whichever of the
                          optional bands below actually render */ ?>

  <?php if ($record['traps'] !== []): ?>
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <h2><?= e(ui('segment.traps_title')) ?></h2>
        <div class="grid grid--<?= count($record['traps']) === 2 ? '2' : '3' ?> mt-4">
          <?php foreach ($record['traps'] as $trap): ?>
            <div class="card">
              <h3 class="card-title"><?= e($trap['title'] ?? '') ?></h3>
              <p class="card__text"><?= e($trap['text'] ?? '') ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php $segIncludes = $record['includes'] ?? []; ?>
  <?php if ($segIncludes !== [] || $record['weNeed'] !== []): ?>
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <div class="checklist-grid">
          <?php if ($segIncludes !== []): ?>
            <div>
              <h2><?= e(ui('service.includes')) ?></h2>
              <ul class="checklist mt-4">
                <?php foreach ($segIncludes as $item): ?>
                  <li><span><?= e($item) ?></span></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          <?php if ($record['weNeed'] !== []): ?>
            <div>
              <h2><?= e(ui('service.we_need')) ?></h2>
              <ul class="checklist checklist--need mt-4">
                <?php foreach ($record['weNeed'] as $item): ?>
                  <li><span><?= e($item) ?></span></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($record['sections'] !== []): ?>
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container stack">
        <?php foreach ($record['sections'] as $block): ?>
          <div class="prose">
            <h2><?= e($block['h2'] ?? '') ?></h2>
            <?php foreach ($block['body'] ?? [] as $paragraph): ?>
              <p><?= e($paragraph) ?></p>
            <?php endforeach; ?>
            <?php if (!empty($block['items'])): ?>
              <div class="grid grid--2 mt-4">
                <?php foreach ($block['items'] as $item): ?>
                  <div class="card">
                    <h3 class="card-title"><?= e($item['title'] ?? '') ?></h3>
                    <p class="card__text"><?= e($item['text'] ?? '') ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($segAreaCards !== []): ?>
    <!-- City page: every área in this city, each linking to its own
         "Abogado de X en <ciudad>" page. -->
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <h2><?= e(str_replace('{ciudad}', $segCityName, ui('segment.areas_in_city'))) ?></h2>
        <div class="mt-4">
          <?php $gridCards = $segAreaCards; ?>
          <?php require ROOT_DIR . '/partials/service-card-grid.php'; ?>
        </div>
      </div>
    </section>
  <?php elseif ($record['bundle'] !== []): ?>
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <h2><?= e(ui('segment.bundle_title')) ?></h2>
        <div class="mt-4">
          <?php $gridSlugs = $record['bundle']; ?>
          <?php require ROOT_DIR . '/partials/service-card-grid.php'; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Guía relacionada: the generator already forwards the área's guides into
       every área × ciudad record, so a combo page links the same how-to its
       área page does. Bands alternate through $segBand, not a fixed modifier. -->
  <?php $segGuides = $record['guides'] ?? []; ?>
  <?php if ($segGuides !== []): ?>
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <h2><?= e(ui('service.guides')) ?></h2>
        <div class="grid grid--3 mt-4">
          <?php foreach ($segGuides as $segGuideSlug): ?>
            <?php $segGuide = content('guias')[$segGuideSlug] ?? null; ?>
            <?php if ($segGuide === null): ?>
              <?php continue; ?>
            <?php endif; ?>
            <a class="card card--link" href="<?= e($segGuide['path']) ?>">
              <h3 class="card-title"><?= e($segGuide['navLabel']) ?></h3>
              <p class="card__text"><?= e($segGuide['metaDescription']) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($record['faq'] !== []): ?>
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <?php $faqItems = $record['faq']; ?>
        <?php require ROOT_DIR . '/partials/faq.php'; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- Solicitar: preset to the record's lead service, with the matching chip
       pre-selected and the city pre-filled. -->
  <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>" id="solicitar">
    <div class="container split split--top">
      <div class="stack">
        <p class="eyebrow"><?= e(ui('segment.form_eyebrow')) ?></p>
        <h2><?= e(ui('form.legend')) ?></h2>
        <p class="lead"><?= e(ui('segment.form_lead')) ?></p>
        <ul class="checklist">
          <?php foreach (lead_value($record['leadSlug'])['nextStep'] as $segStep): ?>
            <li><span><?= e($segStep) ?></span></li>
          <?php endforeach; ?>
        </ul>
        <!-- Quién recibe su consulta: the honest empty state until a lawyer
             signs for this área in this city, that lawyer's card afterwards. -->
        <?php
        $abogadosScope    = 'segment';
        $abogadosArea     = $segArea;
        $abogadosCity     = $segCity;
        $abogadosCityName = $segCityName;
        require ROOT_DIR . '/partials/abogados.php';
        ?>
      </div>

      <div>
        <?php
        $formId      = ($segArea !== null ? 'area-ciudad-' : 'segmento-') . $slug;
        $formService = $record['leadSlug'];
        $formNeed    = $segArea !== null ? lead_value($segArea)['need'] : '';
        $formCity    = $segCityName;
        $formHeading = '';
        require ROOT_DIR . '/partials/lead-form.php';
        ?>
      </div>
    </div>
  </section>

  <?php if ($segOtherAreas !== [] || $segOtherCities !== []): ?>
    <!-- Área × ciudad cross-links: the matrix's row and column, as pills. -->
    <section class="section<?= $segBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container stack">
        <?php if ($segOtherAreas !== []): ?>
          <div class="link-group">
            <h2 class="d4"><?= e(str_replace('{ciudad}', $segCityName, ui('segment.other_areas_in_city'))) ?></h2>
            <ul class="link-pills">
              <?php foreach ($segOtherAreas as $segLink): ?>
                <li><a class="link-pill" href="<?= e($segLink['path']) ?>"><?= e($segLink['label']) ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if ($segOtherCities !== []): ?>
          <div class="link-group">
            <h2 class="d4"><?= e(str_replace('{area}', services($segArea)['navLabel'], ui('segment.area_other_cities'))) ?></h2>
            <ul class="link-pills">
              <?php foreach ($segOtherCities as $segLink): ?>
                <li><a class="link-pill" href="<?= e($segLink['path']) ?>"><?= e($segLink['label']) ?></a></li>
              <?php endforeach; ?>
            </ul>
            <p class="note"><a href="<?= e(services($segArea)['path']) ?>"><?= e(str_replace('{area}', services($segArea)['navLabel'], ui('segment.area_national'))) ?></a></p>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php $ctaContactPath = '#solicitar'; /* the form is on this page; don't send people to /contacto/ */ ?>
  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
