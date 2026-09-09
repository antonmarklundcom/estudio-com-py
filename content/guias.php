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
        'related'        => ['divorcio-mutuo-acuerdo-o-contencioso', 'me-llego-una-fiscalizacion-de-dnit'],
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
        'related'        => ['herencia-sin-testamento-como-empieza', 'que-revisar-antes-de-comprar-un-inmueble'],
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
        'related'        => ['divorcio-mutuo-acuerdo-o-contencioso', 'que-revisar-antes-de-comprar-un-inmueble'],
    ],

    'me-notificaron-una-imputacion-que-hacer' => [
        'path'            => '/guias/me-notificaron-una-imputacion-que-hacer/',
        'title'           => 'Me notificaron una imputación: qué hacer',
        'navLabel'        => 'Me notificaron una imputación',
        'seoTitle'        => 'Me notificaron una imputación',
        'metaDescription' => 'Qué hacer si le notificaron una imputación en Paraguay: qué guardar, '
                           . 'qué no declarar sin abogado y cómo llegar a un abogado penalista independiente.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Penal',
            'h1'      => 'Me notificaron una imputación: qué hacer',
            'lead'    => 'Una imputación no es una condena, pero lo que haga en los primeros días '
                       . 'puede pesar en el proceso. Esto es lo que conviene hacer, en orden.',
        ],
        'intro' => [
            'Si el Ministerio Público le notificó una imputación, tiene derechos y plazos que '
                . 'conviene conocer antes de declarar o de firmar cualquier documento. Ninguno de '
                . 'estos pasos reemplaza el consejo de un abogado sobre su caso puntual, pero le '
                . 'ordenan la situación mientras lo consigue.',
        ],
        'steps' => [
            ['title' => 'Guarde la notificación completa', 'body' => ['Cédula, notificación o cualquier documento que haya recibido del Ministerio Público o del juzgado. Va a necesitarlo el abogado que tome el caso.']],
            ['title' => 'No declare sin abogado', 'body' => ['Tiene derecho a no declarar hasta contar con asesoramiento. Una declaración apurada es difícil de revertir después.']],
            ['title' => 'Anote los hechos y las fechas', 'body' => ['Fecha de los hechos que se le imputan, fecha de la notificación y de cualquier audiencia fijada. Estos datos definen los plazos del proceso.']],
            ['title' => 'Revise si hay una medida cautelar', 'body' => ['Una imputación puede venir acompañada de una medida cautelar. Si es su caso, es un punto que el abogado necesita conocer de entrada.']],
            ['title' => 'Consulte antes de la próxima audiencia', 'body' => ['Los procesos penales tienen plazos y audiencias fijas. Cuéntenos su situación y lo conectamos con un abogado penalista independiente que le confirma los pasos exactos para su caso.']],
        ],
        'faq' => [
            ['q' => '¿Una imputación significa que ya tengo antecedentes?', 'a' => 'No. La imputación es el inicio de un proceso, no una condena. El abogado que reciba su consulta le explica en qué etapa está su caso.'],
            ['q' => '¿Tengo que declarar si me citan?', 'a' => 'Tiene derecho a no declarar sin abogado presente. Cuéntenos su situación antes de la audiencia.'],
        ],
        'relatedService' => 'penal',
        'toolLink'       => null,
        'related'        => ['me-llego-una-fiscalizacion-de-dnit', 'sa-o-srl-como-elegir'],
    ],

    'sa-o-srl-como-elegir' => [
        'path'            => '/guias/sa-o-srl-como-elegir/',
        'title'           => 'SA o SRL: cómo elegir y qué papeles pide el registro',
        'navLabel'        => 'SA o SRL: cómo elegir',
        'seoTitle'        => 'SA o SRL: cómo elegir',
        'metaDescription' => 'Diferencias entre SA y SRL en Paraguay, qué papeles pide el registro '
                           . 'para constituir la empresa y cómo llegar a un abogado societario independiente.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Empresas',
            'h1'      => 'SA o SRL: cómo elegir y qué papeles pide el registro',
            'lead'    => 'Antes de constituir una empresa en Paraguay conviene entender la '
                       . 'diferencia entre una SA y una SRL. Esto es lo que hace falta para empezar.',
        ],
        'intro' => [
            'Sociedad Anónima (SA) y Sociedad de Responsabilidad Limitada (SRL) son las dos '
                . 'formas más usadas para constituir una empresa en Paraguay. La que corresponde '
                . 'depende de la cantidad de socios, el capital y cómo quiere organizar la administración.',
        ],
        'steps' => [
            ['title' => 'Defina cuántos socios va a tener', 'body' => ['La SRL tiene un límite de socios que la SA no tiene. La ley fija ese número; el abogado se lo confirma según cuántos socios va a tener la empresa.']],
            ['title' => 'Piense en el capital y su división', 'body' => ['En la SA el capital se divide en acciones; en la SRL, en cuotas sociales. La forma de transferir la participación cambia según cuál elija.']],
            ['title' => 'Reúna los datos de los socios', 'body' => ['Nombre, documento y domicilio de cada socio, y el objeto social que va a tener la empresa: a qué actividad se va a dedicar.']],
            ['title' => 'Prevea el paso por el registro', 'body' => ['La constitución se inscribe en el registro correspondiente. El abogado que arme el expediente le confirma la documentación exacta según el tipo de sociedad.']],
            ['title' => 'Consulte antes de constituir la sociedad', 'body' => ['Cuéntenos su situación y lo conectamos con un abogado societario independiente que le confirma la forma que más le conviene y los papeles que hacen falta.']],
        ],
        'faq' => [
            ['q' => '¿Qué diferencia hay entre una SA y una SRL?', 'a' => 'La principal es cómo se divide el capital y cuántos socios admite cada una. El abogado que reciba su consulta le confirma cuál conviene para su caso.'],
            ['q' => '¿Puedo cambiar de SRL a SA más adelante?', 'a' => 'Es posible, pero implica un trámite propio. Cuéntenos su situación si es algo que está evaluando.'],
        ],
        'relatedService' => 'empresas',
        'toolLink'       => null,
        'related'        => ['como-registrar-una-marca-ante-dinapi', 'me-llego-una-fiscalizacion-de-dnit'],
    ],

    'como-registrar-una-marca-ante-dinapi' => [
        'path'            => '/guias/como-registrar-una-marca-ante-dinapi/',
        'title'           => 'Cómo registrar una marca en Paraguay ante la DINAPI',
        'navLabel'        => 'Cómo registrar una marca (DINAPI)',
        'seoTitle'        => 'Registrar una marca ante la DINAPI',
        'metaDescription' => 'Cómo registrar una marca en Paraguay ante la DINAPI: pasos, qué '
                           . 'revisar antes y cómo llegar a un abogado especializado en marcas y patentes.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Marcas',
            'h1'      => 'Cómo registrar una marca en Paraguay ante la DINAPI',
            'lead'    => 'Registrar una marca ante la DINAPI protege el nombre o el logo de su '
                       . 'negocio frente a terceros. Esto es lo que conviene revisar antes de empezar.',
        ],
        'intro' => [
            'La Dirección Nacional de Propiedad Intelectual (DINAPI) es el organismo que registra '
                . 'marcas en Paraguay. Antes de presentar la solicitud conviene revisar que la '
                . 'marca no esté ya registrada y tener claro qué productos o servicios va a cubrir.',
        ],
        'steps' => [
            ['title' => 'Revise que la marca esté disponible', 'body' => ['Antes de presentar la solicitud, conviene verificar que nadie haya registrado ya un nombre o logo igual o similar para el mismo rubro.']],
            ['title' => 'Defina qué va a cubrir la marca', 'body' => ['El registro se hace por clase de productos o servicios. Tenga claro a qué actividad se va a dedicar la marca antes de presentar la solicitud.']],
            ['title' => 'Prepare el logo o el nombre tal como lo va a usar', 'body' => ['La marca se registra tal como se presenta: el nombre, el logo o ambos, según lo que quiera proteger.']],
            ['title' => 'Presente la solicitud ante la DINAPI', 'body' => ['La solicitud pasa por un examen y queda expuesta a oposiciones de terceros antes de concederse el registro.']],
            ['title' => 'Consulte con un abogado especializado en marcas', 'body' => ['Cuéntenos su situación y lo conectamos con un abogado especializado en marcas y patentes independiente que le confirma los pasos y los plazos para su caso.']],
        ],
        'faq' => [
            ['q' => '¿Cuánto dura el registro de una marca?', 'a' => 'La ley fija un plazo de vigencia; el abogado que reciba su consulta se lo confirma junto con los pasos de renovación.'],
            ['q' => '¿Qué pasa si alguien ya usa un nombre parecido?', 'a' => 'Puede haber una oposición durante el trámite. Cuéntenos su situación para evaluar el caso.'],
        ],
        'relatedService' => 'marcas',
        'toolLink'       => null,
        'related'        => ['sa-o-srl-como-elegir', 'que-revisar-antes-de-comprar-un-inmueble'],
    ],

    'que-revisar-antes-de-comprar-un-inmueble' => [
        'path'            => '/guias/que-revisar-antes-de-comprar-un-inmueble/',
        'title'           => 'Antes de comprar un inmueble: qué revisar en el título y la DGRP',
        'navLabel'        => 'Antes de comprar un inmueble',
        'seoTitle'        => 'Antes de comprar un inmueble',
        'metaDescription' => 'Qué revisar en el título de un inmueble y ante la DGRP antes de '
                           . 'comprar en Paraguay, y cómo llegar a un abogado inmobiliario independiente.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Inmobiliario',
            'h1'      => 'Antes de comprar un inmueble: qué revisar en el título y la DGRP',
            'lead'    => 'Antes de firmar la compra de un inmueble en Paraguay conviene revisar el '
                       . 'título y el estado del inmueble ante la Dirección General de los Registros Públicos (DGRP).',
        ],
        'intro' => [
            'Comprar un inmueble sin revisar antes su situación legal es uno de los errores más '
                . 'caros. Esto es lo que conviene verificar antes de firmar cualquier documento o '
                . 'entregar una seña.',
        ],
        'steps' => [
            ['title' => 'Pida el título y verifique al vendedor', 'body' => ['Confirme que quien vende figura como titular en el título y que no hay otro dueño no declarado.']],
            ['title' => 'Consulte el estado del inmueble en la DGRP', 'body' => ['La Dirección General de los Registros Públicos permite verificar si el inmueble tiene gravámenes, embargos o alguna limitación registrada.']],
            ['title' => 'Revise si hay deudas asociadas', 'body' => ['Impuestos u otras obligaciones vinculadas al inmueble pueden trasladarse al nuevo propietario si no se aclaran antes de la compra.']],
            ['title' => 'No entregue una seña sin respaldo', 'body' => ['Cualquier pago antes de la escritura conviene documentarlo por escrito, con los datos de ambas partes y del inmueble.']],
            ['title' => 'Consulte con un abogado antes de escriturar', 'body' => ['La escritura la formaliza un escribano, pero revisar el título antes es un paso aparte. Cuéntenos su situación y lo conectamos con un abogado inmobiliario independiente que le confirma qué falta revisar en su caso.']],
        ],
        'faq' => [
            ['q' => '¿Alcanza con revisar el título en la DGRP?', 'a' => 'Es un paso central, pero no el único. El abogado que reciba su consulta le confirma qué más conviene revisar según el inmueble.'],
            ['q' => '¿Quién hace la escritura de la compra?', 'a' => 'La escritura la formaliza un escribano. El abogado puede orientarlo sobre qué revisar antes de llegar a esa instancia.'],
        ],
        'relatedService' => 'inmobiliario',
        'toolLink'       => null,
        'related'        => ['herencia-sin-testamento-como-empieza', 'sa-o-srl-como-elegir'],
    ],

    'me-llego-una-fiscalizacion-de-dnit' => [
        'path'            => '/guias/me-llego-una-fiscalizacion-de-dnit/',
        'title'           => 'Me llegó una fiscalización de la DNIT: primeros pasos',
        'navLabel'        => 'Fiscalización de la DNIT: primeros pasos',
        'seoTitle'        => 'Fiscalización de la DNIT',
        'metaDescription' => 'Qué hacer si le llegó una fiscalización de la DNIT en Paraguay: '
                           . 'primeros pasos, qué documentación reunir y cómo llegar a un abogado tributario.',
        'lastReviewed'    => '2026-09-09',
        'hero' => [
            'eyebrow' => 'Tributario',
            'h1'      => 'Me llegó una fiscalización de la DNIT: primeros pasos',
            'lead'    => 'Una notificación de fiscalización de la DNIT tiene plazos para responder. '
                       . 'Esto es lo que conviene hacer apenas la recibe.',
        ],
        'intro' => [
            'Si la Dirección Nacional de Ingresos Tributarios (DNIT) le notificó una fiscalización, '
                . 'hay pasos concretos que conviene dar antes de responder o de presentar '
                . 'documentación. Ninguno reemplaza el consejo de un abogado tributario sobre su '
                . 'caso puntual, pero le ordenan la situación mientras lo consigue.',
        ],
        'steps' => [
            ['title' => 'Lea la notificación completa', 'body' => ['Identifique qué período y qué tributo está fiscalizando la DNIT, y qué documentación le está pidiendo exactamente.']],
            ['title' => 'Reúna la documentación pedida', 'body' => ['Comprobantes, declaraciones y registros contables del período fiscalizado. El abogado que tome el caso va a necesitarlos.']],
            ['title' => 'Anote los plazos de la notificación', 'body' => ['La notificación fija un plazo para responder. La ley fija ese plazo; el abogado se lo confirma según el tipo de fiscalización.']],
            ['title' => 'No responda sin revisar antes con un abogado', 'body' => ['Una respuesta apurada o incompleta puede complicar el proceso. Conviene ordenar la documentación antes de contestar.']],
            ['title' => 'Consulte antes de que venza el plazo', 'body' => ['Cuéntenos su situación y lo conectamos con un abogado tributario independiente que le confirma los pasos exactos para su caso.']],
        ],
        'faq' => [
            ['q' => '¿Qué pasa si no respondo a tiempo?', 'a' => 'La ley fija un plazo para responder; no hacerlo puede complicar el proceso. El abogado que reciba su consulta le confirma los próximos pasos.'],
            ['q' => '¿Una fiscalización significa que hice algo mal?', 'a' => 'No necesariamente. Es un procedimiento de revisión. El abogado que reciba su consulta le explica en qué consiste su caso puntual.'],
        ],
        'relatedService' => 'tributario',
        'toolLink'       => null,
        'related'        => ['sa-o-srl-como-elegir', 'me-notificaron-una-imputacion-que-hacer'],
    ],
];
