<?php

/**
 * content/abogados.php — "quién recibe su consulta".
 *
 * The lawyers who have actually signed up to receive leads from this site. It
 * is empty because none has yet: estudio.com.py is a referral service, and
 * until a real firm signs, every page renders the honest empty state instead of
 * a card (see partials/abogados.php).
 *
 * Contract — one record per lawyer or firm, keyed by slug:
 *
 *   'name'   string        how they want to be named on the site
 *   'areas'  string[]      área slugs from content/services.php
 *   'cities' string[]      city slugs from content/segmentos.php
 *   'since'  'YYYY-MM'     when they started receiving consultas; sorts the cards
 *   'note'   string|null   one honest sentence, or null
 *
 * Nothing else. No photos, no ratings, no review counts, no years of
 * experience, no "especialista en" — this site does not invent facts about
 * people (plan §1.2), and the design system is text-only (plan §1.3).
 *
 * A record renders a card on the home trust band, on every área page in its
 * 'areas', and on every área × ciudad page whose área and city it both matches.
 *
 * Example of the shape — uncomment and edit when the first lawyer signs:
 *
 * 'estudio-gimenez' => [
 *     'name'   => 'Estudio Giménez',
 *     'areas'  => ['familia', 'sucesiones'],
 *     'cities' => ['asuncion', 'luque'],
 *     'since'  => '2026-10',
 *     'note'   => 'Atiende consultas de familia y sucesiones en Asunción y Luque.',
 * ],
 */

declare(strict_types=1);

return [
];
