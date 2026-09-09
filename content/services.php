<?php
/**
 * The eight legal areas estudio.com.py derives consultations into, keyed by
 * slug. Same shape the template documents in README.md ("Content model").
 *
 * estudio.com.py does not practice law: 'includes' below lists the situations
 * this area covers (what gets derived), not services estudio.com.py performs.
 * Every slug also needs a record in content/lead-values.php.
 */

declare(strict_types=1);

return [

    'familia' => [
        'path'            => '/servicios/familia/',
        'title'           => 'Familia / Divorcio',
        'navLabel'        => 'Familia / Divorcio',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado de familia y divorcio en Paraguay',
        'metaDescription' => 'Divorcio, tenencia, régimen de visitas o pensión alimentaria. '
                           . 'Cuéntenos su situación y lo conectamos con un abogado de familia '
                           . 'independiente en su ciudad.',
        'hero' => [
            'eyebrow' => 'Familia / Divorcio',
            'h1'      => 'Abogado de familia y divorcio',
            'h2'      => 'Divorcio, tenencia, visitas o pensión alimentaria.',
            'lead'    => 'Quiere divorciarse, o ya se lo pidieron, y no sabe por dónde empezar. '
                       . 'Cuéntenos su situación y lo conectamos con un abogado de familia '
                       . 'independiente que atiende en su ciudad.',
        ],
        'includes' => [
            'Divorcio de mutuo acuerdo o contencioso',
            'Tenencia y régimen de visitas de los hijos',
            'Pensión alimentaria, fijación o reclamo',
            'División de bienes del matrimonio',
        ],
        'weNeed' => [
            'Certificado de matrimonio',
            'Partidas de nacimiento de los hijos, si los hay',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Con acuerdo entre las partes, el trámite es más rápido y económico. Sin '
                        . 'acuerdo, corresponde un juicio. Si hay hijos, la tenencia, las visitas y '
                        . 'la pensión se resuelven en el mismo proceso.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda un divorcio en Paraguay?', 'a' => 'Depende de si hay acuerdo entre las partes y de la carga del juzgado. El abogado que lo reciba le da un plazo concreto para su caso.'],
            ['q' => '¿Qué pasa con los hijos?', 'a' => 'La tenencia, el régimen de visitas y la pensión alimentaria se resuelven junto con el divorcio cuando hay hijos en común.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['sucesiones', 'penal'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'penal' => [
        'path'            => '/servicios/penal/',
        'title'           => 'Penal',
        'navLabel'        => 'Penal',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado penalista en Paraguay',
        'metaDescription' => 'Denuncias, imputaciones, querellas o medidas cautelares. Cuéntenos '
                           . 'su situación y lo conectamos con un abogado penalista independiente '
                           . 'en su ciudad.',
        'hero' => [
            'eyebrow' => 'Penal',
            'h1'      => 'Abogado penalista',
            'h2'      => 'Denuncias, imputaciones, querellas y medidas cautelares.',
            'lead'    => 'Lo denunciaron, lo imputaron o necesita hacer una denuncia. Cuéntenos '
                       . 'qué pasó y lo conectamos con un abogado penalista independiente que '
                       . 'atiende en su ciudad.',
        ],
        'includes' => [
            'Denuncias y querellas',
            'Imputaciones y audiencias preliminares',
            'Medidas cautelares',
            'Defensa en causas penales',
        ],
        'weNeed' => [
            'Cualquier notificación o cédula que haya recibido',
            'Fecha de los hechos y de la denuncia, si la hay',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'No firme ni declare nada sin asesoramiento. Guarde toda notificación, '
                        . 'cédula o mensaje relacionado con el caso: el abogado que reciba su '
                        . 'consulta lo va a necesitar.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Qué hago si me notificaron una imputación?', 'a' => 'Guarde la notificación y no declare sin abogado. Cuéntenos su caso y lo conectamos con un penalista independiente.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['laboral', 'familia'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'laboral' => [
        'path'            => '/servicios/laboral/',
        'title'           => 'Laboral',
        'navLabel'        => 'Laboral',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado laboral en Paraguay',
        'metaDescription' => 'Despidos, liquidación, aportes a IPS o acoso laboral. Cuéntenos su '
                           . 'situación y lo conectamos con un abogado laboral independiente en su ciudad.',
        'hero' => [
            'eyebrow' => 'Laboral',
            'h1'      => 'Abogado laboral',
            'h2'      => 'Despidos, liquidación, aportes a IPS y acoso laboral.',
            'lead'    => 'Lo despidieron, no le pagaron la liquidación o lo están presionando '
                       . 'para renunciar. Cuéntenos qué pasó y lo conectamos con un abogado '
                       . 'laboral independiente que atiende en su ciudad.',
        ],
        'includes' => [
            'Despido sin causa o con causa injustificada',
            'Liquidación no pagada',
            'Aportes a IPS no realizados',
            'Acoso laboral y accidentes de trabajo',
        ],
        'weNeed' => [
            'Contrato y recibos de sueldo',
            'La nota de despido, si la hay',
            'Mensajes o correos relacionados con la salida',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Guarde todo: contrato, recibos, mensajes y la nota de despido si la hay. '
                        . 'No firme una renuncia que no entienda ni bajo presión: es difícil de '
                        . 'revertir después.',
                ],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'La liquidación se paga al terminar la relación laboral. Si no llega, hay una vía administrativa ante el MTESS antes del juicio.'],
                    ['title' => 'Qué esperar', 'text' => 'El abogado revisa su caso, le dice si hay reclamo y cuánto puede tardar.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿No me pagaron la liquidación, qué hago?', 'a' => 'Puede pedir una audiencia de conciliación en el MTESS antes de ir a juicio. El abogado que reciba su consulta le confirma los pasos para su caso.'],
            ['q' => '¿Puedo reclamar si no me aportaban a IPS?', 'a' => 'Sí, es un reclamo aparte de la liquidación. Cuéntenos su caso para derivarlo al abogado correcto.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['empresas', 'tributario'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'sucesiones' => [
        'path'            => '/servicios/sucesiones/',
        'title'           => 'Sucesiones',
        'navLabel'        => 'Sucesiones',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado de sucesiones en Paraguay',
        'metaDescription' => 'Herencias con o sin testamento, declaratoria de herederos. Cuéntenos '
                           . 'su situación y lo conectamos con un abogado de sucesiones independiente en su ciudad.',
        'hero' => [
            'eyebrow' => 'Sucesiones',
            'h1'      => 'Abogado de sucesiones',
            'h2'      => 'Herencias con o sin testamento, declaratoria de herederos.',
            'lead'    => 'Falleció un familiar y no sabe cómo empezar la sucesión. Cuéntenos su '
                       . 'situación y lo conectamos con un abogado de sucesiones independiente '
                       . 'que atiende en su ciudad.',
        ],
        'includes' => [
            'Sucesión con testamento',
            'Sucesión sin testamento (ab intestato)',
            'Declaratoria de herederos',
            'División de bienes entre herederos',
        ],
        'weNeed' => [
            'Certificado de defunción',
            'Partidas que acrediten el parentesco',
            'Testamento, si lo hay',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'La sucesión se inicia ante el juzgado que corresponda al domicilio del '
                        . 'fallecido. El abogado que reciba su consulta le dice qué papeles pedir '
                        . 'primero y en qué juzgado cae su caso.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Quién hereda si no hay testamento?', 'a' => 'La ley establece un orden de herederos. El abogado que reciba su consulta se lo confirma según su caso.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['familia', 'inmobiliario'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'empresas' => [
        'path'            => '/servicios/empresas/',
        'title'           => 'Empresas',
        'navLabel'        => 'Empresas',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado de empresas en Paraguay',
        'metaDescription' => 'Constitución de sociedades, contratos, conflictos entre socios. '
                           . 'Cuéntenos su situación y lo conectamos con un abogado de empresas independiente.',
        'hero' => [
            'eyebrow' => 'Empresas',
            'h1'      => 'Abogado de empresas',
            'h2'      => 'Constitución de sociedades, contratos, conflictos entre socios.',
            'lead'    => 'Está por armar una sociedad, necesita un contrato o tiene un conflicto '
                       . 'entre socios. Cuéntenos su situación y lo conectamos con un abogado '
                       . 'societario independiente.',
        ],
        'includes' => [
            'Constitución de sociedades (SA, SRL)',
            'Redacción y revisión de contratos comerciales',
            'Conflictos entre socios',
            'Cierre o transformación de sociedades',
        ],
        'weNeed' => [
            'Datos de los socios y el objeto social, si está constituyendo',
            'El contrato o acuerdo en cuestión, si ya existe',
        ],
        'sections' => [],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda constituir una sociedad?', 'a' => 'Depende del tipo de sociedad y de la documentación. El abogado que reciba su consulta le da un plazo concreto.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['tributario', 'marcas'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'marcas' => [
        'path'            => '/servicios/marcas/',
        'title'           => 'Marcas',
        'navLabel'        => 'Marcas',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado de marcas en Paraguay',
        'metaDescription' => 'Registro y oposición de marcas ante la DINAPI. Cuéntenos su '
                           . 'situación y lo conectamos con un abogado de propiedad industrial independiente.',
        'hero' => [
            'eyebrow' => 'Marcas',
            'h1'      => 'Abogado de marcas',
            'h2'      => 'Registro y oposición de marcas ante la DINAPI.',
            'lead'    => 'Quiere registrar su marca o le llegó una oposición. Cuéntenos su '
                       . 'situación y lo conectamos con un abogado de propiedad industrial '
                       . 'independiente.',
        ],
        'includes' => [
            'Búsqueda de antecedentes y registro de marca',
            'Oposiciones, propias o de terceros',
            'Renovación de marcas registradas',
        ],
        'weNeed' => [
            'El nombre o logo a registrar',
            'El rubro o clase de productos/servicios',
        ],
        'sections' => [],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda el registro de una marca?', 'a' => 'El trámite ante la DINAPI tiene plazos propios. El abogado que reciba su consulta le confirma el tiempo estimado para su caso.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['empresas', 'tributario'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'inmobiliario' => [
        'path'            => '/servicios/inmobiliario/',
        'title'           => 'Inmobiliario',
        'navLabel'        => 'Inmobiliario',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado inmobiliario en Paraguay',
        'metaDescription' => 'Compraventa, alquileres, desalojos, títulos y DGRP. Cuéntenos su '
                           . 'situación y lo conectamos con un abogado inmobiliario independiente en su ciudad.',
        'hero' => [
            'eyebrow' => 'Inmobiliario',
            'h1'      => 'Abogado inmobiliario',
            'h2'      => 'Compraventa, alquileres, desalojos, títulos y DGRP.',
            'lead'    => 'Está por comprar, vender o alquilar un inmueble, o tiene un conflicto '
                       . 'con un inquilino o propietario. Cuéntenos su situación y lo conectamos '
                       . 'con un abogado inmobiliario independiente que atiende en su ciudad.',
        ],
        'includes' => [
            'Compraventa de inmuebles y revisión de títulos',
            'Contratos de alquiler',
            'Desalojos',
            'Trámites ante la Dirección General de los Registros Públicos (DGRP)',
        ],
        'weNeed' => [
            'Título o escritura del inmueble, si lo tiene',
            'Contrato de alquiler, si el conflicto es por locación',
        ],
        'sections' => [],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cómo empiezo un desalojo?', 'a' => 'Depende del tipo de contrato y del motivo del desalojo. El abogado que reciba su consulta le confirma los pasos para su caso.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['sucesiones', 'familia'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],

    'tributario' => [
        'path'            => '/servicios/tributario/',
        'title'           => 'Tributario',
        'navLabel'        => 'Tributario',
        'cluster'         => 'areas',
        'parent'          => null,
        'seoTitle'        => 'Abogado tributario en Paraguay',
        'metaDescription' => 'Reclamos y fiscalizaciones de la DNIT, regularización. Cuéntenos su '
                           . 'situación y lo conectamos con un abogado tributario independiente.',
        'hero' => [
            'eyebrow' => 'Tributario',
            'h1'      => 'Abogado tributario',
            'h2'      => 'Reclamos y fiscalizaciones de la DNIT, regularización.',
            'lead'    => 'Le llegó una fiscalización o un reclamo de la DNIT, o necesita '
                       . 'regularizar su situación impositiva. Cuéntenos su caso y lo conectamos '
                       . 'con un abogado tributario independiente.',
        ],
        'includes' => [
            'Fiscalizaciones y reclamos de la DNIT',
            'Regularización de deudas impositivas',
            'Recursos administrativos',
        ],
        'weNeed' => [
            'Cualquier notificación de la DNIT que haya recibido',
            'RUC y el tipo de actividad',
        ],
        'sections' => [],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Qué hago si me llegó una fiscalización de la DNIT?', 'a' => 'Guarde la notificación y no responda sin asesoramiento. Cuéntenos su caso y lo conectamos con un tributarista independiente.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['empresas', 'laboral'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],
];
