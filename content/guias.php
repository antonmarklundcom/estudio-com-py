<?php
/**
 * The how-to guides under /guias/, keyed by slug. Same shape discipline as
 * content/services.php. Every guide names a relatedService — the delegate box
 * that hands the situation to the lead form resolves from that one slug.
 */

declare(strict_types=1);

return [

    'me-despidieron-primeros-10-dias' => [
        'path'            => '/guias/me-despidieron-primeros-10-dias/',
        'title'           => 'Me despidieron: qué hacer los primeros 10 días',
        'navLabel'        => 'Me despidieron: primeros 10 días',
        'seoTitle'        => 'Me despidieron: primeros 10 días',
        'metaDescription' => 'Qué guardar, qué no firmar y cuándo ir al MTESS si lo despidieron en '
                           . 'Paraguay. Guía práctica, paso a paso, y cómo llegar a un abogado laboral.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Laboral',
            'h1'      => 'Me despidieron: qué hacer los primeros 10 días',
            'lead'    => 'Los primeros diez días después de un despido son los que más pesan '
                       . 'para un reclamo. Esto es lo que conviene hacer, en orden.',
        ],
        'intro' => [
            'Si lo despidieron, con o sin causa, hay pasos concretos que conviene dar antes de '
                . 'firmar nada o de dejar pasar el tiempo. Ninguno reemplaza el consejo de un '
                . 'abogado sobre su caso puntual, pero le ordenan la situación mientras lo consigue.',
        ],
        'steps' => [
            ['title' => 'Guarde todo', 'body' => ['Contrato, recibos de sueldo, mensajes de trabajo y la nota de despido si se la dieron por escrito.']],
            ['title' => 'No firme nada que no entienda', 'body' => ['Una renuncia o un finiquito firmado apurado es difícil de revertir después. Léalo con calma o no lo firme todavía.']],
            ['title' => 'Anote las fechas', 'body' => ['Fecha exacta del despido, último día trabajado y si hubo aviso previo. Estos datos definen los plazos del reclamo.']],
            ['title' => 'Revise si le pagaron la liquidación', 'body' => ['La liquidación se paga al terminar la relación laboral. Si no llega, hay una vía administrativa en el MTESS antes de un juicio.']],
            ['title' => 'Consulte antes de que pase mucho tiempo', 'body' => ['Los reclamos laborales tienen plazos. Cuéntenos su situación y lo conectamos con un abogado laboral independiente que le confirma los pasos exactos para su caso.']],
        ],
        'faq' => [
            ['q' => '¿Tengo derecho a liquidación si me despidieron sin causa?', 'a' => 'En general sí. El monto exacto depende de su antigüedad y su sueldo; el abogado que reciba su consulta hace el cálculo para su caso.'],
            ['q' => '¿Qué pasa si no me aportaban a IPS?', 'a' => 'Es un reclamo aparte de la liquidación. Cuéntenoslo al derivar su consulta.'],
        ],
        'relatedService' => 'laboral',
        'toolLink'       => null,
        'related'        => ['divorcio-mutuo-acuerdo-o-contencioso'],
    ],

    'divorcio-mutuo-acuerdo-o-contencioso' => [
        'path'            => '/guias/divorcio-mutuo-acuerdo-o-contencioso/',
        'title'           => 'Divorcio en Paraguay: mutuo acuerdo o contencioso',
        'navLabel'        => 'Divorcio: mutuo acuerdo o contencioso',
        'seoTitle'        => 'Divorcio: mutuo acuerdo o contencioso',
        'metaDescription' => 'Diferencias entre el divorcio de mutuo acuerdo y el contencioso en '
                           . 'Paraguay, los tiempos aproximados y qué pasa con los hijos.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Familia',
            'h1'      => 'Divorcio en Paraguay: mutuo acuerdo o contencioso',
            'lead'    => 'La primera decisión antes de empezar un divorcio es si hay acuerdo con '
                       . 'la otra parte. De eso depende casi todo lo que sigue.',
        ],
        'intro' => [
            'En Paraguay, un divorcio puede tramitarse por mutuo acuerdo, cuando ambas partes '
                . 'están de acuerdo en divorciarse y en los términos, o de forma contenciosa, '
                . 'cuando no hay acuerdo. El camino que corresponde cambia el tiempo, el costo y '
                . 'los pasos a seguir.',
        ],
        'steps' => [
            ['title' => 'Confirme si hay acuerdo', 'body' => ['Con acuerdo entre ambas partes, incluyendo qué pasa con los hijos y los bienes, el trámite es más simple y rápido.']],
            ['title' => 'Reúna los papeles base', 'body' => ['Certificado de matrimonio y, si hay hijos, sus partidas de nacimiento. Se piden en el Registro Civil.']],
            ['title' => 'Si hay hijos, prevea tenencia, visitas y pensión', 'body' => ['Estos tres puntos se resuelven en el mismo proceso que el divorcio, con o sin acuerdo.']],
            ['title' => 'Si no hay acuerdo, prepárese para un juicio', 'body' => ['El divorcio contencioso lleva más tiempo y requiere probar la causal correspondiente ante el juzgado.']],
            ['title' => 'Consulte con un abogado de familia', 'body' => ['Cuéntenos su situación y lo conectamos con un abogado de familia independiente que le confirma los pasos y el tiempo estimado para su caso.']],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda un divorcio de mutuo acuerdo?', 'a' => 'Suele ser más rápido que uno contencioso, pero el tiempo exacto depende del juzgado y de la documentación. El abogado que reciba su consulta le da un plazo concreto.'],
            ['q' => '¿Quién se queda con los hijos?', 'a' => 'La tenencia se resuelve según el interés superior del niño. Si hay acuerdo entre las partes, eso se toma en cuenta; si no, lo define el juzgado.'],
        ],
        'relatedService' => 'familia',
        'toolLink'       => null,
        'related'        => ['herencia-sin-testamento-como-empieza'],
    ],

    'herencia-sin-testamento-como-empieza' => [
        'path'            => '/guias/herencia-sin-testamento-como-empieza/',
        'title'           => 'Herencia sin testamento: cómo empieza una sucesión',
        'navLabel'        => 'Herencia sin testamento',
        'seoTitle'        => 'Herencia sin testamento: guía',
        'metaDescription' => 'Quién hereda cuando no hay testamento en Paraguay, qué papeles pide '
                           . 'el juzgado y cómo se inicia la sucesión, paso a paso.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Sucesiones',
            'h1'      => 'Herencia sin testamento: cómo empieza una sucesión',
            'lead'    => 'Cuando alguien fallece sin testamento, la ley establece quién hereda. '
                       . 'Esto es lo que hace falta para iniciar la sucesión.',
        ],
        'intro' => [
            'La sucesión "ab intestato" (sin testamento) sigue un orden legal de herederos: '
                . 'primero los hijos y el cónyuge, y a falta de estos, otros parientes según el '
                . 'grado. El trámite se inicia ante el juzgado que corresponde al domicilio del fallecido.',
        ],
        'steps' => [
            ['title' => 'Consiga el certificado de defunción', 'body' => ['Es el primer documento que va a pedir el juzgado y el abogado que tome el caso.']],
            ['title' => 'Reúna las partidas que acreditan el parentesco', 'body' => ['Partidas de nacimiento o matrimonio de los herederos, según el caso.']],
            ['title' => 'Verifique si existe testamento', 'body' => ['Si hay testamento, el proceso cambia: se tramita como sucesión testamentaria en lugar de ab intestato.']],
            ['title' => 'Identifique los bienes a heredar', 'body' => ['Inmuebles, cuentas, vehículos: una lista general ayuda a que el abogado arme el expediente más rápido.']],
            ['title' => 'Inicie el trámite con un abogado', 'body' => ['Cuéntenos su situación y lo conectamos con un abogado de sucesiones independiente que le confirma los pasos y los papeles exactos para su caso.']],
        ],
        'faq' => [
            ['q' => '¿Quién hereda si no hay testamento?', 'a' => 'La ley establece un orden de herederos, empezando por los hijos y el cónyuge. El abogado que reciba su consulta se lo confirma según su caso.'],
            ['q' => '¿Hace falta abogado para una sucesión?', 'a' => 'Sí, es un trámite judicial. El abogado presenta la sucesión ante el juzgado correspondiente.'],
        ],
        'relatedService' => 'sucesiones',
        'toolLink'       => null,
        'related'        => ['me-despidieron-primeros-10-dias'],
    ],
];
