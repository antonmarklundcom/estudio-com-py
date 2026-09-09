<?php
/**
 * The lead value model. One record per área (content/services.php) plus one
 * per homepage "¿qué le pasó?" chip (content/ui.php 'needs') plus the neutral
 * default. See README.md for the full contract.
 *
 * Every lead here goes to VenderCRM only, in degraded (log) mode until
 * config.php's VENDERCRM_URL/VENDERCRM_API_KEY are set — see enviar.php.
 * No WhatsApp reception yet: content/site.php 'whatsapp' stays null, so
 * whatsapp_link() returns null everywhere and every CTA points at the lead
 * form instead.
 */

declare(strict_types=1);

/* Conversion-value proxies for Google Ads smart bidding, in guaraníes. A named
   área (the visitor picked a specific chip or area page) is worth more than a
   generic "otra cosa" lead. */
$tierValues = [
    'A' => 300000,
    'B' => 150000,
    'C' => 50000,
];

$needLabels = [];

return [

    'tierValues' => $tierValues,
    'needLabels' => $needLabels,

    'whatsappMenu' => ['familia'],

    'default' => [
        'menuLabel'    => 'Consulta general',
        'need'         => 'otro',
        'tier'         => 'C',
        'whatsappText' => 'Hola, quisiera hacer una consulta legal.',
        'nextStep'     => [
            'Su ficha queda registrada.',
            'La derivamos al abogado independiente de su área y su ciudad.',
        ],
        'crmTag'       => 'consulta-general',
        'nextLink'     => null,
    ],

    'services' => [
        'familia' => [
            'menuLabel'    => 'Familia / Divorcio',
            'need'         => 'divorcio',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quisiera consultar por un caso de familia / divorcio.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado de familia independiente de su ciudad.',
            ],
            'crmTag'       => 'familia',
            'nextLink'     => null,
        ],
        'penal' => [
            'menuLabel'    => 'Penal',
            'need'         => 'penal',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quisiera consultar por un caso penal.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado penalista independiente de su ciudad.',
            ],
            'crmTag'       => 'penal',
            'nextLink'     => null,
        ],
        'laboral' => [
            'menuLabel'    => 'Laboral',
            'need'         => 'despido',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quisiera consultar por un caso laboral.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado laboral independiente de su ciudad.',
            ],
            'crmTag'       => 'laboral',
            'nextLink'     => null,
        ],
        'sucesiones' => [
            'menuLabel'    => 'Sucesiones',
            'need'         => 'herencia',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quisiera consultar por una sucesión / herencia.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado de sucesiones independiente de su ciudad.',
            ],
            'crmTag'       => 'sucesiones',
            'nextLink'     => null,
        ],
        'empresas' => [
            'menuLabel'    => 'Empresas',
            'need'         => 'empresa',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quisiera consultar por un caso societario / de empresas.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado de empresas independiente de su ciudad.',
            ],
            'crmTag'       => 'empresas',
            'nextLink'     => null,
        ],
        'marcas' => [
            'menuLabel'    => 'Marcas',
            'need'         => 'marca',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quisiera consultar por el registro de una marca.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado de propiedad industrial independiente.',
            ],
            'crmTag'       => 'marcas',
            'nextLink'     => null,
        ],
        'inmobiliario' => [
            'menuLabel'    => 'Inmobiliario',
            'need'         => 'alquiler',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quisiera consultar por un caso inmobiliario.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado inmobiliario independiente de su ciudad.',
            ],
            'crmTag'       => 'inmobiliario',
            'nextLink'     => null,
        ],
        'tributario' => [
            'menuLabel'    => 'Tributario',
            'need'         => 'impuestos',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quisiera consultar por un caso tributario / DNIT.',
            'nextStep'     => [
                'Su ficha queda registrada.',
                'La derivamos a un abogado tributario independiente.',
            ],
            'crmTag'       => 'tributario',
            'nextLink'     => null,
        ],
    ],

    'tools' => [],

    /* One record per key in content/ui.php 'needs' — the homepage Ficha chips.
       Each borrows its área's service copy for the WhatsApp/CRM text. */
    'needs' => [
        'despido'   => ['tier' => 'B', 'crmTag' => 'laboral',      'service' => 'laboral'],
        'divorcio'  => ['tier' => 'B', 'crmTag' => 'familia',      'service' => 'familia'],
        'herencia'  => ['tier' => 'B', 'crmTag' => 'sucesiones',   'service' => 'sucesiones'],
        'empresa'   => ['tier' => 'A', 'crmTag' => 'empresas',     'service' => 'empresas'],
        'marca'     => ['tier' => 'B', 'crmTag' => 'marcas',       'service' => 'marcas'],
        'alquiler'  => ['tier' => 'B', 'crmTag' => 'inmobiliario', 'service' => 'inmobiliario'],
        'impuestos' => ['tier' => 'A', 'crmTag' => 'tributario',   'service' => 'tributario'],
        'penal'     => ['tier' => 'B', 'crmTag' => 'penal',        'service' => 'penal'],
        'otro'      => ['tier' => 'C', 'crmTag' => 'consulta-general', 'service' => null],
    ],
];
