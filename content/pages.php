<?php
/**
 * The static (non-área) pages, keyed by path. Áreas live in
 * content/services.php, guides in content/guias.php, city pages in
 * content/segmentos.php; this is everything else with a URL.
 *
 *   title        string  <title> without the ' | <site name>' suffix
 *   description  string  120–155 chars, unique across the whole site
 *   h1           string  visible heading
 *   lead         string  one-line intro under the H1
 *   sections     array   optional prose blocks for templates/page.php
 *   stub         bool    placeholder page — templates/page-stub.php, noindex
 *   noindex      bool    excluded from sitemap.php and the route contract
 *   changefreq   string  sitemap hint
 *   priority     string  sitemap hint
 *
 * Every entry here needs a route file (<path>/index.php) except '/404'.
 */

declare(strict_types=1);

return [
    '/' => [
        /* The homepage title is the site's one shot at "abogado + ciudad":
           'Inicio' says nothing to a search result. Kept under the 43-char
           page budget (60 with the ' | estudio.com.py' suffix). */
        'title'       => 'Abogados en Asunción y Gran Asunción',
        'description' => '¿Qué le pasó? Cuéntenos en un minuto y lo conectamos con el abogado '
                       . 'independiente correcto para su caso en Asunción y Gran Asunción. Sin '
                       . 'costo para usted.',
        'h1'          => '',
        'lead'        => '',
        'stub'        => false,
        'changefreq'  => 'weekly',
        'priority'    => '1.0',
    ],

    '/servicios/' => [
        'title'       => 'Áreas',
        'description' => 'Familia, penal, laboral, sucesiones, empresas, marcas, inmobiliario y '
                       . 'tributario. Elija el área de su consulta y lo conectamos con el abogado correcto.',
        'h1'          => 'Áreas',
        'lead'        => 'Elija el área de su consulta. Si no sabe cuál es, cuéntenos su situación y lo orientamos.',
        'stub'        => false,
        'changefreq'  => 'monthly',
        'priority'    => '0.9',
    ],

    '/ciudades/' => [
        'title'       => 'Ciudades',
        'description' => 'Derivamos consultas legales en Asunción, Luque, San Lorenzo, Lambaré, '
                       . 'Fernando de la Mora, Capiatá y Mariano Roque Alonso.',
        'h1'          => 'Abogados por ciudad',
        'lead'        => 'Asunción y Gran Asunción, por ahora.',
        'stub'        => false,
        'changefreq'  => 'monthly',
        'priority'    => '0.7',
    ],

    '/guias/' => [
        'title'       => 'Guías',
        'description' => 'Guías prácticas sobre despidos, divorcio, herencias y otros trámites '
                       . 'legales frecuentes en Paraguay, escritas en lenguaje claro.',
        'h1'          => 'Guías',
        'lead'        => 'Qué hacer, paso a paso, en las situaciones que más nos consultan.',
        'stub'        => false,
        'changefreq'  => 'monthly',
        'priority'    => '0.7',
    ],


    '/contacto/' => [
        'title'       => 'Contacto',
        'description' => 'Cuéntenos su caso: su ficha llega al abogado independiente de su área y '
                       . 'su ciudad, y le responde directamente. Sin costo para usted.',
        'h1'          => '',
        'lead'        => '',
        'stub'        => false,
        'changefreq'  => 'yearly',
        'priority'    => '0.8',
    ],

    '/privacidad/' => [
        'title'       => 'Política de privacidad',
        'description' => 'Cómo tratamos los datos personales que nos deja en el formulario y '
                       . 'cómo puede pedir su acceso, corrección o eliminación.',
        'h1'          => 'Política de privacidad',
        'lead'        => 'Cómo tratamos los datos personales que nos confía.',
        'sections'    => [
            [
                'h2'   => 'Qué datos recogemos',
                'body' => [
                    'Recogemos los datos que usted escribe en el formulario de consulta —nombre, '
                        . 'ciudad, teléfono o WhatsApp, correo si lo deja, el área elegida y el '
                        . 'mensaje— más los parámetros de campaña del enlace por el que llegó.',
                ],
            ],
            [
                'h2'   => 'Para qué los usamos',
                'body' => [
                    'Usamos sus datos únicamente para derivar su consulta al abogado o los '
                        . 'abogados independientes que correspondan a su área y su ciudad, y para '
                        . 'darle seguimiento. No los vendemos ni los cedemos a terceros ajenos a la '
                        . 'derivación.',
                ],
            ],
            [
                'h2'   => 'Con quién los compartimos',
                'body' => [
                    'Su ficha se comparte solo con el abogado o los abogados independientes que '
                        . 'reciben su consulta. estudio.com.py no ejerce la abogacía ni interviene '
                        . 'en la relación entre usted y el abogado.',
                ],
            ],
            [
                'h2'   => 'Cuánto tiempo conservamos sus datos',
                'body' => [
                    'Conservamos su ficha mientras exista la posibilidad de derivarla a un '
                        . 'abogado de su área y su ciudad, y mientras haga falta para responder '
                        . 'a consultas o reclamos sobre esa derivación. Puede pedir su '
                        . 'eliminación en cualquier momento, aunque la consulta ya haya sido '
                        . 'derivada.',
                ],
            ],
            [
                'h2'   => 'Sus derechos',
                'body' => [
                    'Puede pedir el acceso, la corrección o la eliminación de sus datos '
                        . 'escribiéndonos desde la página de contacto.',
                ],
            ],
        ],
        'stub'        => false,
        'changefreq'  => 'yearly',
        'priority'    => '0.3',
    ],

    '/terminos/' => [
        'title'       => 'Términos de servicio',
        'description' => 'Las condiciones bajo las que funciona el servicio de derivación: qué es '
                       . 'estudio.com.py, qué no es, y la relación con los abogados independientes.',
        'h1'          => 'Términos de servicio',
        'lead'        => 'Condiciones bajo las que funciona el servicio de derivación.',
        'sections'    => [
            [
                'h2'   => 'Qué es estudio.com.py',
                'body' => [
                    'estudio.com.py es un servicio de derivación. No es un estudio jurídico, no '
                        . 'ejerce la abogacía ni brinda asesoramiento legal. Conecta a personas con '
                        . 'una consulta legal con abogados independientes, según el área y la ciudad.',
                ],
            ],
            [
                'h2'   => 'Los abogados a los que derivamos',
                'body' => [
                    'Son profesionales independientes, responsables de su propio ejercicio '
                        . 'profesional, de su matrícula y de la relación abogado-cliente que '
                        . 'establezcan con usted. El uso de este sitio no crea una relación '
                        . 'abogado-cliente con estudio.com.py.',
                ],
            ],
            [
                'h2'   => 'Costo del servicio',
                'body' => [
                    'El servicio es gratuito para el usuario. Los abogados receptores abonan por '
                        . 'la derivación; sus honorarios profesionales se acuerdan directamente con '
                        . 'cada uno.',
                ],
            ],
            [
                'h2'   => 'Qué hacemos con su consulta si ningún abogado la toma',
                'body' => [
                    'Si todavía no hay un abogado independiente incorporado en su área y su '
                        . 'ciudad, su ficha queda registrada en lugar de descartarse. Le '
                        . 'avisamos apenas un abogado de su área y su ciudad se incorpore y la '
                        . 'tome. No le cobramos nada por ese tiempo de espera ni le garantizamos '
                        . 'un plazo.',
                ],
            ],
            [
                'h2'   => 'Sin garantía de resultado',
                'body' => [
                    'Conectar su consulta con un abogado no garantiza que ese abogado la acepte, '
                        . 'ni el resultado, el plazo o el costo de su caso. Cada abogado decide '
                        . 'de forma independiente si toma o no una consulta, y esos términos se '
                        . 'acuerdan directamente entre usted y el abogado.',
                ],
            ],
        ],
        'stub'        => false,
        'changefreq'  => 'yearly',
        'priority'    => '0.3',
    ],

    '/404' => [
        'title'       => 'Página no encontrada',
        'description' => 'No encontramos la página que buscaba. Vea las áreas o cuéntenos su '
                       . 'situación y lo orientamos.',
        'h1'          => 'No encontramos esta página',
        'lead'        => '',
        'stub'        => false,
        'noindex'     => true,
        'changefreq'  => 'yearly',
        'priority'    => '0.1',
    ],
];
