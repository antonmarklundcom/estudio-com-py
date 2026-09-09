<?php
/**
 * Every UI string on the site, in one file. Formal "usted", neutral Paraguay
 * Spanish, matching the 'py' market.
 *
 * estudio.com.py is a referral service: copy never says "nuestro estudio",
 * "nuestros abogados" or implies estudio.com.py itself practices law. It
 * connects — "lo conectamos con", "el abogado o los abogados correctos".
 */

declare(strict_types=1);

return [

    'clusters' => [
        'areas' => 'Áreas del derecho',
    ],

    'cluster_leads' => [
        'areas' => 'Elija el área más cercana a su situación. Si no sabe cuál es, elija Otra.',
    ],

    'nav' => [
        'home'         => 'Inicio',
        'services'     => 'Áreas',
        'pricing'      => 'Precios',
        'tools'        => 'Herramientas',
        'guides'       => 'Guías',
        'about'        => 'Cómo funciona',
        'blog'         => 'Guías',
        'contact'      => 'Contacto',
        'privacy'      => 'Privacidad',
        'terms'        => 'Términos',
        'menu'         => 'Menú',
        'close'        => 'Cerrar',
        'open_menu'    => 'Abrir el menú',
        'close_menu'   => 'Cerrar el menú',
        'skip'         => 'Ir al contenido principal',
        'firm'         => 'estudio.com.py',
        'all_services' => 'Ver todas las áreas',
        'cities'       => 'Ciudades',
        'free_pill'    => 'Sin costo',
    ],

    'cta' => [
        'quote'         => 'Contar mi situación',
        'whatsapp'      => 'WhatsApp',
        'whatsapp_long' => 'Escribir por WhatsApp',
        'consult'       => 'Contar mi situación',
        'contact'       => 'Contactar',
        'see_included'  => 'Ver cómo funciona',
        'talk'          => 'Contar mi situación',
    ],

    'whatsapp' => [
        'menu_title' => '¿Sobre qué quiere escribirnos?',
        'menu_note'  => 'Abrimos WhatsApp con el mensaje ya escrito. Puede cambiarlo antes de enviarlo.',
        'other'      => 'Otra consulta',
        'this_page'  => 'Lo que está viendo',
        'open_menu'  => 'Abrir opciones de WhatsApp',
        'close_menu' => 'Cerrar',
    ],

    'home' => [
        'eyebrow'   => 'Sin costo para usted',
        'h1_lead'   => '¿Qué le pasó? ',
        'h1_accent' => 'Lo conectamos con el abogado correcto.',
        'lead'      => 'Cuéntenos en un minuto. Su consulta llega al abogado o los abogados '
                     . 'independientes indicados según su área y ciudad, y le responden '
                     . 'directamente por su cuenta.',

        'services_eyebrow' => 'Áreas',
        'services_title'   => 'Elija el área',
        'services_lead'    => 'Si no sabe cuál es, elija Otra y lo resolvemos en su consulta.',

        'unsure_title' => '¿No sabe qué necesita?',
        'unsure_text'  => 'Cuéntenos su situación en sus propias palabras y lo orientamos hacia el área correcta, sin costo.',
    ],

    'panel' => [
        'title' => 'Cómo funciona',
        'badge' => 'Sin costo',
        'tiles' => [
            ['label' => 'Cuenta qué pasó',      'value' => '1 min'],
            ['label' => 'Lo derivamos',         'value' => 'Su área y ciudad'],
            ['label' => 'El abogado responde',  'value' => 'Directo'],
        ],
        'foot'  => 'Usted no paga nada por la derivación',
        'note'  => 'De la consulta a la respuesta',
    ],

    'about' => [
        'eyebrow' => 'Qué es estudio.com.py',
        'title'   => 'Contamos su caso una vez y lo llevamos al abogado correcto.',
        'text'    => 'estudio.com.py no es un estudio jurídico: es un servicio de derivación. '
                   . 'Cuenta su situación, y su ficha llega al abogado o los abogados '
                   . 'independientes de su área y su ciudad. Ellos son responsables de su propio '
                   . 'ejercicio profesional; nosotros no intervenimos en la consulta ni cobramos '
                   . 'nada al usuario. Si todavía no hay un abogado incorporado en su área y '
                   . 'ciudad, su ficha queda registrada y le avisamos apenas se sume uno.',
        'credentials' => [
            'Su ficha se comparte solo con quien recibe su consulta',
            'Abogados independientes, responsables de su propio ejercicio',
            'El servicio es gratuito para usted: paga el abogado que recibe la derivación',
            'Si nadie la toma todavía, su ficha queda registrada y le avisamos apenas se sume un abogado',
        ],
        'badge_note'     => 'de experiencia',
        'badge_fallback' => 'Servicio de derivación',
    ],

    'process' => [
        'eyebrow' => 'Cómo funciona',
        'title'   => 'De contar qué pasó a hablar con el abogado correcto.',
        'steps'   => [
            [
                'title' => 'Cuenta qué pasó',
                'text'  => 'Toca opciones, no escribe un ensayo. Un minuto.',
            ],
            [
                'title' => 'Lo derivamos',
                'text'  => 'Su ficha llega al abogado o los abogados independientes de su área y su ciudad.',
            ],
            [
                'title' => 'Le responden directamente',
                'text'  => 'El abogado se pone en contacto con usted. No intervenimos en la consulta.',
            ],
        ],
    ],

    'industries' => [
        'eyebrow' => 'Ciudades',
        'title'   => 'Ciudades donde derivamos consultas',
        'lead'    => 'Asunción y Gran Asunción, por ahora.',
        'items'   => [
            ['label' => 'Asunción',              'path' => '/ciudades/asuncion/'],
            ['label' => 'Luque',                 'path' => '/ciudades/luque/'],
            ['label' => 'San Lorenzo',            'path' => '/ciudades/san-lorenzo/'],
            ['label' => 'Lambaré',                'path' => '/ciudades/lambare/'],
            ['label' => 'Fernando de la Mora',    'path' => '/ciudades/fernando-de-la-mora/'],
            ['label' => 'Capiatá',                'path' => '/ciudades/capiata/'],
            ['label' => 'Mariano Roque Alonso',   'path' => '/ciudades/mariano-roque-alonso/'],
        ],
    ],

    'testimonials' => [
        'eyebrow' => 'Casos',
        'title'   => 'Lo que dicen quienes usaron el servicio',
    ],

    'services_hub' => [
        'eyebrow'      => 'Áreas',
        'title'        => 'Elija el área de su consulta.',
        'lead'         => 'Cada área conecta con abogados independientes especializados en ese tipo de caso.',
        'unsure_title' => '¿No sabe qué necesita?',
        'unsure_text'  => 'Cuéntenos su caso y lo orientamos hacia el área correcta.',
        'unsure_cta'   => 'Contar mi situación',
    ],

    'cta_band' => [
        'eyebrow' => 'Consulta sin costo',
        'title'   => 'Cuéntenos qué le pasó.',
        'lead'    => 'Un minuto, sin costo. Su consulta llega al abogado correcto para su caso.',
    ],

    'form' => [
        'legend'          => 'Contar mi situación',
        'name'            => 'Nombre',
        'company'         => 'Ciudad',
        'company_hint'    => 'Ej.: Luque',
        'phone'           => 'WhatsApp o teléfono',
        'phone_hint'      => 'Ej.: 0981 123 456',
        'email'           => 'Correo (opcional)',
        'need'            => '¿Qué le pasó?',
        'message'         => 'Cuéntenos brevemente',
        'message_hint'    => 'Su situación, en dos líneas…',
        'submit'          => 'Enviar mi consulta',
        'sending'         => 'Enviando…',
        'privacy_note'    => 'Su ficha se comparte solo con el abogado que recibe la consulta. No la vendemos. Ver la política de privacidad.',
        'success_title'   => 'Recibimos su consulta.',
        'success_text'    => 'Su ficha queda registrada y le avisamos cuando un abogado de su área y ciudad la toma.',
        'error_title'     => 'No pudimos enviar el formulario.',
        'error_text'      => 'Vuelva a intentarlo en un momento o escríbanos directamente.',
        'error_phone'     => 'Necesitamos un teléfono o WhatsApp válido para responderle.',
        'required'        => 'obligatorio',
        'thanks_next'     => 'Qué sigue',
        'thanks_whatsapp' => 'Si prefiere no esperar, escríbanos ahora por WhatsApp.',
        'remind_title'    => 'Que le avisemos antes de cada vencimiento',
        'remind_text'     => 'Le anotamos su caso y le escribimos unos días antes.',
        'remind_phone'    => 'Su WhatsApp',
        'remind_submit'   => 'Quiero que me recuerden',
        'remind_ok'       => 'Anotado.',
    ],

    // One chip per key in the homepage Ficha — matches the 8 legal areas plus
    // "otra cosa". Each maps to an área slug in content/lead-values.php's 'needs'.
    'needs' => [
        'despido'    => 'Me despidieron',
        'divorcio'   => 'Divorcio o hijos',
        'herencia'   => 'Herencia',
        'empresa'    => 'Problema en mi empresa',
        'marca'      => 'Marca o registro',
        'alquiler'   => 'Alquiler o inmueble',
        'impuestos'  => 'Impuestos / DNIT',
        'penal'      => 'Denuncia o causa penal',
        'otro'       => 'Otra cosa',
    ],

    'contact' => [
        'eyebrow' => 'Contacto',
        'title'   => 'Cuéntenos su caso.',
        'lead'    => 'Déjenos sus datos y su ficha llega al abogado independiente de su área y '
                   . 'su ciudad. Le avisamos cuando la tome.',
        'address' => 'Dirección',
        'hours'   => 'Horario',
        'phone'   => 'Teléfono',
        'email'   => 'Correo',
        'expect'  => 'Qué pasa después',
        'steps'   => [
            'Su ficha queda registrada.',
            'La derivamos al abogado independiente de su área y su ciudad.',
            'El abogado le responde directamente. Nosotros no intervenimos en la consulta.',
            'Si todavía no hay un abogado incorporado en su área y ciudad, la ficha queda '
                . 'registrada y le avisamos apenas se sume uno.',
        ],
    ],

    'service' => [
        'includes'     => 'Qué resolvemos en esta área',
        'excludes'     => 'Qué no incluye',
        'we_need'      => 'Qué tener a mano',
        'benefits'     => 'Qué esperar',
        'faq'          => 'Preguntas frecuentes',
        'related'      => 'Otras áreas',
        'cities'       => 'En su ciudad',
        'cities_lead'  => 'Derivamos esta área en Asunción y Gran Asunción. Elija su ciudad.',
        'guides'       => 'Guía relacionada',
        'articles'     => 'Guía relacionada',
        'form_eyebrow' => 'Consulta',
        'form_lead'    => 'Cuéntenos qué le pasó y lo conectamos con el abogado correcto, sin costo.',
        /* The "quién recibe su consulta" copy lives in the `trust` group below:
           one partial renders it on all three page kinds. */
        'breadcrumb'   => 'Ruta de navegación',
    ],

    'segment' => [
        'traps_title'  => 'En esta ciudad',
        'bundle_title' => 'Otras áreas en esta ciudad',
        'form_eyebrow' => 'Consulta',
        'form_lead'    => 'Cuéntenos su situación; lo conectamos con el abogado correcto en esta ciudad.',
        /* {ciudad} and {area} are filled in by templates/segment.php. */
        'areas_in_city'       => 'Áreas en {ciudad}',
        'other_areas_in_city' => 'Otras áreas en {ciudad}',
        'area_other_cities'   => '{area} en otras ciudades',
        'area_national'       => 'Ver {area} en todo Asunción y Gran Asunción →',
    ],

    /* "Quién recibe su consulta", rendered by partials/abogados.php on the home
       trust band, on área pages and on área × ciudad pages. `label` heads the
       block either way; `empty` is what it says while content/abogados.php is
       still empty — three wordings because the home band speaks for the whole
       site, the área page for that área and the city page for that city.
       {firm} and {ciudad} are filled in by the partial. */
    'trust' => [
        'label' => [
            'home'    => '{firm} — quién recibe su consulta',
            'service' => 'Quién recibe su consulta',
            'segment' => 'Quién recibe su consulta',
        ],
        'empty' => [
            'home'    => 'Estamos incorporando abogados independientes en Asunción y Gran Asunción. Su ficha queda registrada y le avisamos cuando un abogado de su área la tome.',
            'service' => 'Estamos incorporando abogados independientes de esta área en Asunción y Gran Asunción. Su ficha queda registrada y le avisamos cuando uno la tome.',
            'segment' => 'Estamos incorporando abogados independientes que atienden en {ciudad}. Su ficha queda registrada y le avisamos cuando un abogado de su área la tome.',
        ],
    ],

    /* Labels on a signed lawyer's card. The card itself carries nothing else:
       no photo, no rating, no years of experience (plan §1.2). */
    'abogados' => [
        'areas'  => 'Áreas',
        'cities' => 'Ciudades',
    ],

    'tools' => [
        'reviewed_prefix' => 'Datos revisados el',
        'orientativo'     => 'Los resultados son orientativos y no reemplazan un cálculo oficial.',
        'calculate'       => 'Calcular',
        'result_title'    => 'Resultado',
        'use_result'      => 'Usar este resultado en el formulario',
        'need_js'         => 'Esta herramienta necesita JavaScript activado en su navegador.',
        'restart'         => 'Volver a empezar',
    ],

    'guide' => [
        'reviewed_prefix'       => 'Revisado el',
        'orientativo'           => 'Es una guía general: para su caso puntual, cuéntenos su situación.',
        'delegate_eyebrow'      => 'Su caso',
        'delegate_title'        => '¿Prefiere contarnos su situación?',
        'delegate_lead'         => 'Lo conectamos con el abogado correcto para su caso, sin costo.',
        'delegate_form_heading' => 'Contar mi situación',
        'related'               => 'Otras guías',
    ],

    'article' => [
        'reading_time' => 'min de lectura',
        'updated'      => 'Actualizado el',
        'read_more'    => 'Leer la guía',
    ],

    'hub' => [
        'empty' => 'Todavía no hay nada publicado en esta sección.',
    ],

    'pricing' => [
        'quote'    => 'Sin costo',
        'per_month' => 'por mes',
        'cta'      => 'Contar mi situación',
        'note'     => 'El servicio es gratuito para usted.',
    ],

    'placeholder' => [
        'notice' => 'Estamos preparando esta página.',
        'action' => 'Mientras tanto, cuéntenos su situación y lo orientamos.',
    ],

    'error404' => [
        'title' => 'No encontramos esta página',
        'lead'  => 'Puede que el enlace haya cambiado. Estas son las secciones más buscadas.',
    ],

    'footer' => [
        'blurb'   => 'Un servicio de derivación entre personas con una consulta legal y abogados '
                   . 'independientes en Asunción y Gran Asunción.',
        'rights'  => 'Todos los derechos reservados.',
        'contact' => 'Contacto',
        'legal'   => 'estudio.com.py es un servicio de derivación. No es un estudio jurídico, no '
                   . 'ejerce la abogacía ni brinda asesoramiento legal. Los abogados a los que '
                   . 'derivamos son profesionales independientes, responsables de su propio '
                   . 'ejercicio. El uso de este sitio no crea una relación abogado-cliente con '
                   . 'estudio.com.py. El servicio es gratuito para el usuario; los abogados '
                   . 'receptores abonan por la derivación.',
    ],
];
