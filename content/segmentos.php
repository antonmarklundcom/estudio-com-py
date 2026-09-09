<?php
/**
 * City pages — one per city estudio.com.py derives consultations into,
 * rendered by templates/segment.php. Repurposes the template's "segment"
 * content type (normally a rubro/sector landing page) as a city landing page:
 * 'bundle' lists all eight áreas instead of a sector's service bundle, and
 * 'traps' (relabelled "En esta ciudad" in content/ui.php) carries real,
 * general jurisdictional facts rather than invented specifics.
 *
 * leadSlug anchors the page's own lead form to a real área, but the form's
 * "¿Qué le pasó?" chips (content/ui.php 'needs') are shown regardless, so a
 * visitor always tells us their actual área — the anchor only sets the
 * fallback tier when nobody picks a chip.
 *
 * Área × ciudad combination pages (e.g. "Abogado de divorcio en Luque") are
 * the natural next content phase once these seven city pages prove the
 * pattern — see docs/facts-to-verify.md.
 */

declare(strict_types=1);

$allAreas = ['familia', 'penal', 'laboral', 'sucesiones', 'empresas', 'marcas', 'inmobiliario', 'tributario'];

$centralNote = 'Los juicios de esta ciudad se tramitan en la Circunscripción Judicial de Central. '
             . 'El abogado que reciba su consulta le confirma en qué juzgado cae su caso.';

return [

    'asuncion' => [
        'path'            => '/ciudades/asuncion/',
        'navLabel'        => 'Asunción',
        'seoTitle'        => 'Abogados en Asunción',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en Asunción, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en Asunción',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en Asunción, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            [
                'title' => 'Juzgados',
                'text'  => 'Asunción es su propia circunscripción judicial. El abogado que reciba '
                         . 'su consulta le confirma en qué juzgado cae su caso.',
            ],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en todo Asunción?', 'a' => 'Sí, derivamos consultas de todos los barrios de Asunción.'],
        ],
    ],

    'luque' => [
        'path'            => '/ciudades/luque/',
        'navLabel'        => 'Luque',
        'seoTitle'        => 'Abogados en Luque',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en Luque, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en Luque',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en Luque, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            ['title' => 'Juzgados', 'text' => $centralNote],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en todo Luque?', 'a' => 'Sí, derivamos consultas de toda la ciudad de Luque.'],
        ],
    ],

    'san-lorenzo' => [
        'path'            => '/ciudades/san-lorenzo/',
        'navLabel'        => 'San Lorenzo',
        'seoTitle'        => 'Abogados en San Lorenzo',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en San Lorenzo, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en San Lorenzo',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en San Lorenzo, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            ['title' => 'Juzgados', 'text' => $centralNote],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en todo San Lorenzo?', 'a' => 'Sí, derivamos consultas de toda la ciudad de San Lorenzo.'],
        ],
    ],

    'lambare' => [
        'path'            => '/ciudades/lambare/',
        'navLabel'        => 'Lambaré',
        'seoTitle'        => 'Abogados en Lambaré',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en Lambaré, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en Lambaré',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en Lambaré, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            ['title' => 'Juzgados', 'text' => $centralNote],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en todo Lambaré?', 'a' => 'Sí, derivamos consultas de toda la ciudad de Lambaré.'],
        ],
    ],

    'fernando-de-la-mora' => [
        'path'            => '/ciudades/fernando-de-la-mora/',
        'navLabel'        => 'Fernando de la Mora',
        'seoTitle'        => 'Abogados en Fernando de la Mora',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en Fernando de la Mora, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en Fernando de la Mora',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en Fernando de la Mora, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            ['title' => 'Juzgados', 'text' => $centralNote],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en toda la ciudad?', 'a' => 'Sí, derivamos consultas de toda Fernando de la Mora.'],
        ],
    ],

    'capiata' => [
        'path'            => '/ciudades/capiata/',
        'navLabel'        => 'Capiatá',
        'seoTitle'        => 'Abogados en Capiatá',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en Capiatá, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en Capiatá',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en Capiatá, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            ['title' => 'Juzgados', 'text' => $centralNote],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en toda la ciudad?', 'a' => 'Sí, derivamos consultas de toda Capiatá.'],
        ],
    ],

    'mariano-roque-alonso' => [
        'path'            => '/ciudades/mariano-roque-alonso/',
        'navLabel'        => 'Mariano Roque Alonso',
        'seoTitle'        => 'Abogados en Mariano Roque Alonso',
        'metaDescription' => 'Cuéntenos su situación y lo conectamos con un abogado independiente '
                           . 'que atiende en Mariano Roque Alonso, en el área que corresponda a su caso.',
        'hero' => [
            'eyebrow' => 'Ciudades',
            'h1'      => 'Abogados en Mariano Roque Alonso',
            'lead'    => 'Cuéntenos qué le pasó y lo conectamos con un abogado independiente que '
                       . 'atiende en Mariano Roque Alonso, en el área que corresponda a su caso.',
        ],
        'leadSlug' => 'familia',
        'bundle'   => $allAreas,
        'traps'    => [
            ['title' => 'Juzgados', 'text' => $centralNote],
        ],
        'sections' => [],
        'weNeed'   => [],
        'faq' => [
            ['q' => '¿Atienden en toda la ciudad?', 'a' => 'Sí, derivamos consultas de toda Mariano Roque Alonso.'],
        ],
    ],
];
