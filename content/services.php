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
            'Unión de hecho: reconocimiento y disolución',
            'Reconocimiento de filiación',
        ],
        'excludes' => [
            'La división de una herencia entre herederos: eso lo ve sucesiones.',
            'Un conflicto societario entre cónyuges dueños de una empresa: eso lo ve empresas.',
            'Una denuncia penal ya presentada por hechos de violencia: eso lo ve penal.',
        ],
        'weNeed' => [
            'Certificado de matrimonio',
            'Partidas de nacimiento de los hijos, si los hay',
            'Cédulas de identidad de ambas partes',
            'Comprobante de ingresos, si va a pedir o discutir la pensión alimentaria',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Con acuerdo entre las partes, el trámite es más rápido y económico. Sin '
                        . 'acuerdo, corresponde un juicio. Si hay hijos, la tenencia, las visitas y '
                        . 'la pensión se resuelven en el mismo proceso.',
                    'Reúna los documentos del matrimonio y de los hijos antes de la primera '
                        . 'consulta: acorta la primera reunión con el abogado y le permite darle '
                        . 'una devolución concreta sobre su caso desde el principio.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'Depende de si hay acuerdo entre las partes y de la carga del juzgado. El abogado que reciba su consulta le da un cálculo para su caso.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
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
            ['q' => '¿Necesito el acuerdo de mi pareja para divorciarme?', 'a' => 'No siempre: si no hay acuerdo, el divorcio sigue por la vía contenciosa. El abogado que reciba su consulta le explica qué implica en su caso.'],
            ['q' => '¿Puedo pedir la pensión alimentaria mientras dura el proceso?', 'a' => 'Sí, se puede solicitar como medida mientras el divorcio está en trámite. El abogado que reciba su consulta le confirma cómo hacerlo.'],
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
            'Acompañamiento en la etapa de investigación fiscal',
        ],
        'excludes' => [
            'Reclamos por despido o liquidación laboral: eso lo ve laboral.',
            'El trámite civil de un divorcio o una tenencia, aunque haya una denuncia penal '
                . 'de por medio: eso lo ve familia.',
        ],
        'weNeed' => [
            'Cualquier notificación o cédula que haya recibido',
            'Fecha de los hechos y de la denuncia, si la hay',
            'Nombre de la unidad fiscal o el juzgado, si ya lo tiene',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'No firme ni declare nada sin asesoramiento. Guarde toda notificación, '
                        . 'cédula o mensaje relacionado con el caso: el abogado que reciba su '
                        . 'consulta lo va a necesitar.',
                    'Anote fechas y nombres mientras los recuerda con claridad. Si lo citaron a '
                        . 'declarar, confirme la fecha con el abogado antes de presentarse.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'Cada etapa del proceso penal tiene sus propios plazos legales. El abogado que reciba su consulta le confirma en qué etapa está su caso.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Qué hago si me notificaron una imputación?', 'a' => 'Guarde la notificación y no declare sin abogado. Cuéntenos su caso y lo conectamos con un penalista independiente.'],
            ['q' => '¿Puedo hacer una denuncia yo mismo?', 'a' => 'Sí, ante el Ministerio Público o en una comisaría. El abogado que reciba su consulta lo puede acompañar desde ese primer paso.'],
            ['q' => '¿Qué es una medida cautelar?', 'a' => 'Una restricción que puede pedir el fiscal mientras dura la investigación, como una prohibición de salida del país. El abogado que reciba su consulta le explica qué medidas aplican a su caso.'],
            ['q' => '¿Tengo que declarar si me citan?', 'a' => 'Puede declarar o abstenerse; conviene decidirlo con el abogado antes de presentarse. Cuéntenos su caso para derivarlo.'],
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
            'Renuncia forzada o presionada',
        ],
        'excludes' => [
            'Un contrato entre empresas o entre socios: eso lo ve empresas.',
            'Una fiscalización de la DNIT sobre la empresa empleadora: eso lo ve tributario.',
        ],
        'weNeed' => [
            'Contrato y recibos de sueldo',
            'La nota de despido, si la hay',
            'Mensajes o correos relacionados con la salida',
            'Constancia de aportes a IPS, si la tiene',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Guarde todo: contrato, recibos, mensajes y la nota de despido si la hay. '
                        . 'No firme una renuncia que no entienda ni bajo presión: es difícil de '
                        . 'revertir después.',
                    'Si sigue trabajando mientras evalúa el reclamo, siga cumpliendo sus '
                        . 'funciones con normalidad; el abogado que reciba su consulta le explica '
                        . 'cómo eso puede afectar el caso.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'La liquidación se paga al terminar la relación laboral. Si no llega, hay una vía administrativa de conciliación ante el MTESS antes del juicio.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
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
            ['q' => '¿Me pueden despedir sin motivo?', 'a' => 'Sí, pero corresponde una indemnización cuando el despido es sin causa. El abogado que reciba su consulta le calcula qué le corresponde según su caso.'],
            ['q' => '¿Qué hago si me están presionando para que renuncie?', 'a' => 'No firme nada bajo presión. Cuéntenos su situación y lo conectamos con un abogado laboral independiente antes de que tome una decisión.'],
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
            'Inscripción de bienes heredados a nombre de los herederos',
        ],
        'excludes' => [
            'El divorcio o la tenencia de los hijos: eso lo ve familia.',
            'La venta de un inmueble ya inscripto a nombre de los herederos: eso lo ve inmobiliario.',
        ],
        'weNeed' => [
            'Certificado de defunción',
            'Partidas que acrediten el parentesco',
            'Testamento, si lo hay',
            'Títulos o datos de los bienes del fallecido, si los tiene',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'La sucesión se inicia ante el juzgado que corresponda al domicilio del '
                        . 'fallecido. El abogado que reciba su consulta le dice qué papeles pedir '
                        . 'primero y en qué juzgado cae su caso.',
                    'Reúna el certificado de defunción y las partidas de los herederos antes de '
                        . 'la primera consulta; con eso el abogado ya puede orientarlo sobre los '
                        . 'siguientes pasos.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'Depende de si los herederos están de acuerdo y de la cantidad de bienes a repartir. El abogado que reciba su consulta le da un cálculo para su caso.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Quién hereda si no hay testamento?', 'a' => 'La ley establece un orden de herederos. El abogado que reciba su consulta se lo confirma según su caso.'],
            ['q' => '¿Puedo vender un bien mientras dura la sucesión?', 'a' => 'En general no, hasta que se inscriba la declaratoria de herederos. El abogado que reciba su consulta le explica las excepciones.'],
            ['q' => '¿Qué pasa si un heredero no está de acuerdo?', 'a' => 'La división puede complicarse y, en algunos casos, requerir juicio. Cuéntenos su situación para derivarla al abogado correcto.'],
            ['q' => '¿Necesito abrir la sucesión aunque no haya bienes grandes?', 'a' => 'Depende de qué bienes dejó el fallecido y si están a su nombre. El abogado que reciba su consulta le confirma si corresponde en su caso.'],
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
            'Acuerdos con proveedores o clientes',
        ],
        'excludes' => [
            'El registro de una marca o un logo: eso lo ve marcas.',
            'Una fiscalización o un reclamo de la DNIT: eso lo ve tributario.',
            'Un reclamo de un empleado por despido o liquidación: eso lo ve laboral.',
        ],
        'weNeed' => [
            'Datos de los socios y el objeto social, si está constituyendo',
            'El contrato o acuerdo en cuestión, si ya existe',
            'RUC de la sociedad, si ya está constituida',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Si está por constituir una sociedad, defina primero con quién y con qué '
                        . 'objeto social; eso determina si conviene una SA o una SRL. Si tiene un '
                        . 'conflicto entre socios, reúna el contrato social y las actas que tenga.',
                    'No firme un contrato comercial sin que lo revise un abogado, aunque la otra '
                        . 'parte tenga apuro. Una cláusula mal redactada es más cara de corregir '
                        . 'después que de revisar antes.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'Depende del tipo de sociedad y de la documentación reunida. El abogado que reciba su consulta le da un plazo concreto.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda constituir una sociedad?', 'a' => 'Depende del tipo de sociedad y de la documentación. El abogado que reciba su consulta le da un plazo concreto.'],
            ['q' => '¿Qué diferencia hay entre SA y SRL?', 'a' => 'Varían en el número de socios, el capital y las formalidades. El abogado que reciba su consulta le recomienda cuál conviene a su caso.'],
            ['q' => '¿Qué pasa si tengo un conflicto con un socio?', 'a' => 'Depende de lo que diga el contrato social y de qué se discute. Cuéntenos su situación y lo conectamos con un abogado societario independiente.'],
            ['q' => '¿Necesito un abogado para un contrato con un proveedor?', 'a' => 'No es obligatorio, pero un contrato mal redactado puede costarle más caro después. El abogado que reciba su consulta lo revisa antes de que lo firme.'],
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
            'Uso indebido de una marca por un tercero',
            'Registro de nombre comercial',
        ],
        'excludes' => [
            'La constitución de la sociedad que va a usar la marca: eso lo ve empresas.',
            'Un contrato comercial que no trate sobre la marca en sí: eso lo ve empresas.',
        ],
        'weNeed' => [
            'El nombre o logo a registrar',
            'El rubro o clase de productos/servicios',
            'Si ya usa la marca en el mercado, desde cuándo',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Antes de usar un nombre o logo en su negocio, conviene hacer una búsqueda '
                        . 'de antecedentes ante la DINAPI para saber si ya está registrado o es '
                        . 'similar a uno existente.',
                    'Si le llegó una oposición a su solicitud, guarde la notificación y respete '
                        . 'el plazo que fija la DINAPI para responder; el abogado que reciba su '
                        . 'consulta se lo confirma.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'El trámite ante la DINAPI tiene plazos propios. El abogado que reciba su consulta le confirma el tiempo estimado para su caso.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda el registro de una marca?', 'a' => 'El trámite ante la DINAPI tiene plazos propios. El abogado que reciba su consulta le confirma el tiempo estimado para su caso.'],
            ['q' => '¿Qué pasa si alguien ya usa una marca parecida a la mía?', 'a' => 'Puede complicar o impedir el registro. El abogado que reciba su consulta le confirma tras revisar los antecedentes.'],
            ['q' => '¿Tengo que renovar la marca cada cierto tiempo?', 'a' => 'Sí, el registro tiene una vigencia y hay que renovarlo antes de que venza. El abogado que reciba su consulta le confirma cuándo corresponde en su caso.'],
            ['q' => '¿Puedo registrar solo el nombre o también el logo?', 'a' => 'Se puede registrar cada uno por separado o juntos. El abogado que reciba su consulta le recomienda qué conviene según su marca.'],
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
            'Conflictos entre propietarios vecinos, medianeras y límites',
        ],
        'excludes' => [
            'La división de un inmueble heredado entre herederos: eso lo ve sucesiones.',
            'La constitución de una sociedad dueña del inmueble: eso lo ve empresas.',
        ],
        'weNeed' => [
            'Título o escritura del inmueble, si lo tiene',
            'Contrato de alquiler, si el conflicto es por locación',
            'Comprobantes de pago o notificaciones relacionadas, si las hay',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Antes de comprar o alquilar, pida ver el título y verifique que la '
                        . 'propiedad esté libre de gravámenes ante la DGRP. Si está del lado del '
                        . 'inquilino o el propietario en un conflicto, reúna el contrato de alquiler.',
                    'Guarde los comprobantes de pago del alquiler y cualquier notificación que '
                        . 'haya recibido o enviado: el abogado que reciba su consulta los va a '
                        . 'necesitar para confirmarle los pasos.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'Depende del tipo de contrato y del motivo del desalojo o del trámite. El abogado que reciba su consulta le confirma los pasos para su caso.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Cómo empiezo un desalojo?', 'a' => 'Depende del tipo de contrato y del motivo del desalojo. El abogado que reciba su consulta le confirma los pasos para su caso.'],
            ['q' => '¿Qué debo revisar antes de comprar un inmueble?', 'a' => 'El título, que esté libre de gravámenes y que coincida con lo inscripto en la DGRP. El abogado que reciba su consulta hace esa revisión por usted.'],
            ['q' => '¿Puedo alquilar sin contrato escrito?', 'a' => 'Se puede, pero un contrato escrito protege a ambas partes ante un conflicto. El abogado que reciba su consulta le recomienda qué incluir.'],
            ['q' => '¿Qué pasa si el inquilino no paga?', 'a' => 'Depende de lo que diga el contrato y de cuánto tiempo lleva sin pagar. Cuéntenos su situación y lo conectamos con un abogado inmobiliario independiente.'],
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
            'Sumarios administrativos por presuntas infracciones tributarias',
            'Consultas sobre IVA, renta y otros tributos nacionales',
        ],
        'excludes' => [
            'La constitución de la sociedad fiscalizada: eso lo ve empresas.',
            'Un reclamo laboral de un empleado, aunque surja de la misma fiscalización: eso lo ve laboral.',
        ],
        'weNeed' => [
            'Cualquier notificación de la DNIT que haya recibido',
            'RUC y el tipo de actividad',
            'Declaraciones juradas o comprobantes relacionados con el reclamo',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacer ahora',
                'body' => [
                    'Guarde la notificación completa y anote la fecha en que la recibió: los '
                        . 'plazos para responder corren desde ese momento. No responda a la DNIT '
                        . 'sin que un abogado revise la notificación primero.',
                    'Reúna sus declaraciones juradas y comprobantes de los períodos que menciona '
                        . 'la fiscalización; ayuda al abogado a evaluar el caso desde la primera '
                        . 'consulta.',
                ],
            ],
            [
                'h2'   => 'Qué esperar',
                'body' => [],
                'items' => [
                    ['title' => 'Plazos', 'text' => 'La DNIT fija plazos propios para cada etapa del proceso. El abogado que reciba su consulta le confirma en qué etapa está su caso.'],
                    ['title' => 'Costo',  'text' => 'El abogado le cotiza antes de empezar; estudio.com.py no cobra al usuario.'],
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Abogado de su zona', 'text' => 'Lo derivamos a un abogado independiente que atiende en su ciudad.'],
            ['title' => 'Respuesta directa',  'text' => 'El abogado le responde directamente; no intervenimos en la consulta.'],
        ],
        'faq' => [
            ['q' => '¿Qué hago si me llegó una fiscalización de la DNIT?', 'a' => 'Guarde la notificación y no responda sin asesoramiento. Cuéntenos su caso y lo conectamos con un tributarista independiente.'],
            ['q' => '¿Qué pasa si no respondo a tiempo?', 'a' => 'Puede perder el derecho a presentar descargos en esa etapa. El abogado que reciba su consulta le confirma el plazo que le queda.'],
            ['q' => '¿Puedo regularizar una deuda impositiva antes de que me fiscalicen?', 'a' => 'Sí, existen vías de regularización voluntaria. El abogado que reciba su consulta le explica cuál aplica a su caso.'],
            ['q' => '¿Un contador puede reemplazar al abogado en este trámite?', 'a' => 'El contador lleva la parte contable; el abogado lo representa en los recursos y en la parte legal del reclamo. Cuéntenos su situación y lo conectamos con quien corresponda.'],
        ],
        'cta'       => ['label' => 'Contar mi situación', 'whatsappText' => ''],
        'related'   => ['empresas', 'laboral'],
        'guides'    => [],
        'articles'  => [],
        'toolLinks' => [],
    ],
];
