<?php

/**
 * partials/abogados.php — the "quién recibe su consulta" block.
 *
 * One block per page, in the place the empty state already occupied: the home
 * trust band, the área page beside its form, the área × ciudad page beside its
 * form. With content/abogados.php empty — the state the site launches in — it
 * renders exactly the honest empty copy it rendered before this partial
 * existed. With records in the file it renders text-only cards instead.
 *
 * Callers set, before the require:
 *   $abogadosScope    'home' | 'service' | 'segment'   which wording to use
 *   $abogadosArea     ?string   área slug to filter by, or null for no filter
 *   $abogadosCity     ?string   city slug to filter by, or null for no filter
 *   $abogadosCityName ?string   the city's display name, for {ciudad}
 *
 * @var string  $abogadosScope
 * @var ?string $abogadosArea
 * @var ?string $abogadosCity
 * @var ?string $abogadosCityName
 */

$abScope    = $abogadosScope ?? 'home';
$abArea     = $abogadosArea ?? null;
$abCity     = $abogadosCity ?? null;
$abCityName = $abogadosCityName ?? '';

/* A record shows on a page when it covers what that page is about: an área page
   asks for its área, an área × ciudad page for both, the home band for neither
   and so lists everyone. */
$abMatches = [];
foreach (content('abogados') as $abSlug => $abRecord) {
    if ($abArea !== null && !in_array($abArea, (array) ($abRecord['areas'] ?? []), true)) {
        continue;
    }
    if ($abCity !== null && !in_array($abCity, (array) ($abRecord['cities'] ?? []), true)) {
        continue;
    }
    $abMatches[$abSlug] = $abRecord;
}

/* Oldest first, so the order does not shuffle when a new lawyer signs. */
uasort($abMatches, static fn (array $a, array $b): int
    => strcmp((string) ($a['since'] ?? ''), (string) ($b['since'] ?? '')));

$abLabel = str_replace('{firm}', ui('nav.firm'), ui('trust.label.' . $abScope));
?>
<?php if ($abMatches === []): ?>
  <div class="trust-empty">
    <p class="trust-empty__label"><?= e($abLabel) ?></p>
    <p class="trust-empty__text"><?= e(str_replace('{ciudad}', $abCityName, ui('trust.empty.' . $abScope))) ?></p>
  </div>
<?php else: ?>
  <div class="stack">
    <p class="trust-empty__label"><?= e($abLabel) ?></p>
    <?php foreach ($abMatches as $abRecord): ?>
      <div class="card">
        <p class="card-title"><?= e((string) $abRecord['name']) ?></p>
        <?php
        $abAreaNames = [];
        foreach ((array) ($abRecord['areas'] ?? []) as $abAreaSlug) {
            $abService = services($abAreaSlug);
            if ($abService !== null) {
                $abAreaNames[] = $abService['navLabel'] ?? $abService['title'];
            }
        }
        $abCityNames = [];
        foreach ((array) ($abRecord['cities'] ?? []) as $abCitySlug) {
            $abSegment = content('segmentos')[$abCitySlug] ?? null;
            if ($abSegment !== null) {
                $abCityNames[] = $abSegment['navLabel'];
            }
        }
        ?>
        <?php if ($abAreaNames !== []): ?>
          <p class="card__text"><?= e(ui('abogados.areas')) ?>: <?= e(implode(', ', $abAreaNames)) ?></p>
        <?php endif; ?>
        <?php if ($abCityNames !== []): ?>
          <p class="card__text"><?= e(ui('abogados.cities')) ?>: <?= e(implode(', ', $abCityNames)) ?></p>
        <?php endif; ?>
        <?php if (!empty($abRecord['note'])): ?>
          <p class="card__text"><?= e((string) $abRecord['note']) ?></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
