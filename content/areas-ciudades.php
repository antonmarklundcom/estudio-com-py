<?php
/**
 * Área × ciudad pages — "Abogado de divorcio en Luque" — one record per
 * (área, ciudad) pair, rendered by templates/segment.php exactly like the
 * plain city pages in content/segmentos.php. Route: /ciudades/<ciudad>/<área>/.
 *
 * The records are BUILT here from two small tables rather than typed out 56
 * times, because the law is national: what changes from city to city is the
 * jurisdiction (which circunscripción hears the case, where the trámite is
 * filed) and nothing else. Every area-specific paragraph, checklist and FAQ
 * comes from the área's own record in content/services.php, so the copy has
 * one source and can never drift between /servicios/familia/ and its seven
 * city variants.
 *
 * Honesty rules (see docs/facts-to-verify.md): the "En esta ciudad" cards
 * state general, public jurisdiction facts only — which circunscripción, which
 * national institution — and every one of them ends by deferring to the
 * lawyer. No court addresses, no processing times, no judge names.
 *
 * Every record carries 'area' and 'city' keys so templates/service.php can
 * list an área's cities and templates/segment.php a city's áreas.
 */

declare(strict_types=1);

$services = content('services');

/* --- áreas ------------------------------------------------------------------
   kw      the search phrase people actually type, used for <title> and H1
   topic   what the área covers, in the visitor's words (metaDescription;
           kept short so "<topic> en <ciudad>" + the promise stays <= 155)
   adj     "abogado <adj>" — the lawyer we derive to
   local   the área's own jurisdiction fact, with {ciudad} and {fuero} slots:
           {fuero} is the city's circunscripción sentence below            */
$areas = [
    'familia' => [
        'kw'    => 'Abogado de divorcio',
        'topic' => 'Divorcio, tenencia, visitas o pensión',
        'adj'   => 'de familia',
        'local' => [
            'title' => 'Dónde se tramita',
            'text'  => 'Los asuntos de tenencia, régimen de visitas y pensión alimentaria se '
                     . 'tramitan ante los Juzgados de la Niñez y la Adolescencia; el divorcio, '
                     . 'ante el fuero civil. {fuero} El abogado que reciba su consulta le '
                     . 'confirma el juzgado exacto para su caso.',
        ],
    ],
    'penal' => [
        'kw'    => 'Abogado penalista',
        'topic' => 'Denuncias, imputaciones o querellas',
        'adj'   => 'penalista',
        'local' => [
            'title' => 'Fiscalía y juzgados',
            'text'  => 'Las denuncias se presentan ante el Ministerio Público (Fiscalía) o en '
                     . 'una comisaría, y la causa sigue ante el fuero penal. {fuero} El '
                     . 'abogado que reciba su consulta le indica la unidad fiscal y el juzgado '
                     . 'que corresponden a su caso.',
        ],
    ],
    'laboral' => [
        'kw'    => 'Abogado laboral',
        'topic' => 'Despido, liquidación o aportes a IPS',
        'adj'   => 'laboral',
        'local' => [
            'title' => 'MTESS y fuero laboral',
            'text'  => 'Antes de un juicio existe una vía administrativa de conciliación ante '
                     . 'el Ministerio de Trabajo (MTESS), que es nacional. Si se llega a juicio, '
                     . 'lo entiende el fuero laboral. {fuero} El abogado que reciba su consulta '
                     . 'le dice si conviene conciliar primero o demandar directamente.',
        ],
    ],
    'sucesiones' => [
        'kw'    => 'Abogado de sucesiones',
        'topic' => 'Herencias y declaratoria de herederos',
        'adj'   => 'de sucesiones',
        'local' => [
            'title' => 'Dónde se abre la sucesión',
            'text'  => 'La sucesión se inicia ante el juzgado civil que corresponde al último '
                     . 'domicilio del fallecido, no al de los herederos. Si vivía en {ciudad}, '
                     . '{fuero_min} El abogado que reciba su consulta le confirma el juzgado '
                     . 'exacto.',
        ],
    ],
    'empresas' => [
        'kw'    => 'Abogado de empresas',
        'topic' => 'Sociedades, contratos y socios',
        'adj'   => 'de empresas',
        'local' => [
            'title' => 'Trámite nacional, abogado local',
            'text'  => 'La constitución y la inscripción de una sociedad son trámites '
                     . 'nacionales ante los registros públicos; la ciudad importa para '
                     . 'reunirse con el abogado y para un eventual juicio entre socios o con un '
                     . 'proveedor. {fuero} El abogado que reciba su consulta le confirma dónde '
                     . 'cae su caso.',
        ],
    ],
    'marcas' => [
        'kw'    => 'Abogado de marcas',
        'topic' => 'Registro y oposición de marcas',
        'adj'   => 'de marcas',
        'local' => [
            'title' => 'DINAPI es nacional',
            'text'  => 'El registro y la oposición de marcas se tramitan ante la DINAPI '
                     . '(Dirección Nacional de Propiedad Intelectual), que es una sola para '
                     . 'todo el país. Que el abogado atienda en {ciudad} importa para reunirse '
                     . 'y firmar, no para el trámite en sí. Un conflicto por uso de marca, en '
                     . 'cambio, sí puede llegar a juicio: {fuero_min}',
        ],
    ],
    'inmobiliario' => [
        'kw'    => 'Abogado inmobiliario',
        'topic' => 'Compraventa, alquiler o desalojo',
        'adj'   => 'inmobiliario',
        'local' => [
            'title' => 'Registros y fuero civil',
            'text'  => 'Una compraventa se formaliza ante escribano y se inscribe en la '
                     . 'Dirección General de los Registros Públicos (DGRP), que es nacional. '
                     . 'Un desalojo o un conflicto de alquiler por un inmueble en {ciudad} va '
                     . 'al fuero civil: {fuero_min} El abogado que reciba su consulta le '
                     . 'confirma qué camino corresponde.',
        ],
    ],
    'tributario' => [
        'kw'    => 'Abogado tributario',
        'topic' => 'Fiscalizaciones y sumarios de la DNIT',
        'adj'   => 'tributario',
        'local' => [
            'title' => 'DNIT es nacional',
            'text'  => 'Las fiscalizaciones, los sumarios y los recursos administrativos se '
                     . 'tramitan ante la DNIT (Dirección Nacional de Ingresos Tributarios), que '
                     . 'es una sola para todo el país. Que el abogado atienda en {ciudad} '
                     . 'importa para reunirse y revisar papeles; la vía judicial posterior se '
                     . 'tramita en Asunción. El abogado que reciba su consulta le confirma en '
                     . 'qué etapa está su caso.',
        ],
    ],
];

/* --- ciudades ---------------------------------------------------------------
   fuero      full sentence: which circunscripción hears the city's cases
   fuero_min  the same fact as a clause that can follow "Si vivía en X, ..."   */
$central = [
    'fuero'     => 'Los juicios de esta ciudad se tramitan en la Circunscripción Judicial de Central.',
    'fuero_min' => 'el caso cae en la Circunscripción Judicial de Central.',
];
$cities = [
    'asuncion' => [
        'name'      => 'Asunción',
        'fuero'     => 'Asunción es su propia circunscripción judicial.',
        'fuero_min' => 'el caso cae en la Circunscripción Judicial de la Capital.',
    ],
    'luque'               => ['name' => 'Luque'] + $central,
    'san-lorenzo'         => ['name' => 'San Lorenzo'] + $central,
    'lambare'             => ['name' => 'Lambaré'] + $central,
    'fernando-de-la-mora' => ['name' => 'Fernando de la Mora'] + $central,
    'capiata'             => ['name' => 'Capiatá'] + $central,
    'mariano-roque-alonso' => ['name' => 'Mariano Roque Alonso'] + $central,
];

$records = [];

foreach ($cities as $citySlug => $city) {
    foreach ($areas as $areaSlug => $area) {
        $svc  = $services[$areaSlug];
        $name = $city['name'];

        /* <title> budget is 60 chars including " | estudio.com.py" (17), so
           the page's own title has 43. "Abogado de sucesiones en Mariano
           Roque Alonso" is 45; the comma form keeps the same words. */
        $seoTitle = $area['kw'] . ' en ' . $name;
        if (mb_strlen($seoTitle) > 43) {
            $seoTitle = $area['kw'] . ', ' . $name;
        }

        $fill = static fn (string $s): string => strtr($s, [
            '{ciudad}'    => $name,
            '{fuero}'     => $city['fuero'],
            '{fuero_min}' => $city['fuero_min'],
        ]);

        /* Meta description, 120–155 chars: topic + city + the promise. */
        $description = $area['topic'] . ' en ' . $name . ': lo conectamos con un abogado '
                     . $area['adj'] . ' independiente de su zona, sin costo para usted.';

        /* The área's own lead says "que atiende en su ciudad"; here the city
           is known. Leads without that phrase get the city appended. */
        $lead = $svc['hero']['lead'];
        $lead = str_contains($lead, 'su ciudad')
            ? str_replace('su ciudad', $name, $lead)
            : rtrim($lead, '.') . '. Atiende en ' . $name . '.';

        $path = '/ciudades/' . $citySlug . '/' . $areaSlug . '/';

        $records[$areaSlug . '-' . $citySlug] = [
            'kind'            => 'area-ciudad',
            'area'            => $areaSlug,
            'city'            => $citySlug,
            'cityName'        => $name,
            'path'            => $path,
            'navLabel'        => $svc['navLabel'] . ' en ' . $name,
            'seoTitle'        => $seoTitle,
            'metaDescription' => $description,
            'breadcrumbs'     => [
                ['label' => ui('nav.cities'), 'path' => '/ciudades/'],
                ['label' => $name, 'path' => '/ciudades/' . $citySlug . '/'],
                ['label' => $svc['navLabel'], 'path' => $path],
            ],
            'hero' => [
                'eyebrow' => $svc['navLabel'] . ' · ' . $name,
                'h1'      => $svc['hero']['h1'] . ' en ' . $name,
                'lead'    => $lead,
            ],
            /* Routes the lead as this área (tier B), not as a generic city
               lead — and pre-selects the matching "¿Qué le pasó?" chip. */
            'leadSlug' => $areaSlug,
            'includes' => $svc['includes'],
            'traps'    => [
                ['title' => $area['local']['title'], 'text' => $fill($area['local']['text'])],
                [
                    'title' => 'Cómo lo derivamos',
                    'text'  => 'Su ficha llega a un abogado ' . $area['adj'] . ' independiente '
                             . 'que atiende en ' . $name . '. Dónde se reúnen y cómo trabajan '
                             . 'lo acuerdan entre ustedes; nosotros no intervenimos en la consulta.',
                ],
            ],
            'sections' => $svc['sections'],
            'bundle'   => [],
            'weNeed'   => $svc['weNeed'],
            'faq'      => array_merge($svc['faq'], [
                [
                    'q' => '¿El abogado atiende en ' . $name . '?',
                    'a' => 'Derivamos su consulta a un abogado ' . $area['adj']
                         . ' independiente que atiende en ' . $name . '. La primera respuesta '
                         . 'suele ser por teléfono o WhatsApp; la reunión, donde acuerden.',
                ],
                [
                    'q' => '¿En qué juzgado cae un caso de ' . $name . '?',
                    'a' => $city['fuero'] . ' El abogado que reciba su consulta le confirma el '
                         . 'fuero y el juzgado exactos para su situación.',
                ],
            ]),
            'guides' => $svc['guides'],
        ];
    }
}

return $records;
