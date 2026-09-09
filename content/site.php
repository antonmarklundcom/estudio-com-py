<?php
/**
 * Business facts. Everything the site says about itself comes from here.
 *
 * estudio.com.py is a referral service, not a law firm: it never claims to
 * practice law, never names a firm that has not actually signed on, and never
 * invents a credential, a team size or a stat. See docs/facts-to-verify.md.
 */

declare(strict_types=1);

return [
    // --- identity -----------------------------------------------------------
    'name'   => 'estudio.com.py',
    'domain' => 'estudio.com.py',
    'slug'   => 'estudio',

    'market' => 'py',

    // Not 'LegalService' — that schema type implies estudio.com.py itself
    // practices law. The organisation is an Organization; what it offers is
    // described separately as a Service (lib/seo.php jsonld_service()) with
    // the serviceType and areaServed below, so the two never get conflated.
    'schemaType'  => ['Organization'],
    'serviceType' => 'Derivación de consultas legales a abogados independientes',
    'serviceAreas' => [
        'Asunción', 'Luque', 'San Lorenzo', 'Lambaré', 'Fernando de la Mora',
        'Capiatá', 'Mariano Roque Alonso',
    ],

    'legalName'   => null,
    'description' => 'Contamos su situación en un minuto y lo conectamos con el abogado o los '
                   . 'abogados independientes correctos para su caso, en Asunción y Gran Asunción.',

    // --- contact ------------------------------------------------------------
    // Both stay null until WhatsApp reception is set up (post-launch, once
    // lawyers are signed and leads start flowing). Until then every CTA points
    // at the lead form, which posts to VenderCRM — see content/lead-values.php.
    'phone'    => null,
    'whatsapp' => null,
    'email'    => null,

    // --- address ------------------------------------------------------------
    // No single office: this is a multi-city referral network, not a physical
    // practice. Leave null rather than pick one city as if it were HQ.
    'street'  => null,
    'city'    => null,
    'country' => null,
    'hours'   => null,
    'openingHours' => [],

    // --- credentials and scale ----------------------------------------------
    // No firms are signed yet. Nothing here until that changes — see the
    // "Quién recibe su consulta" empty state on the homepage and area pages.
    'registration' => null,
    'foundedYear'  => null,
    'teamSize'     => null,

    // --- imagery ------------------------------------------------------------
    'photos' => [
        'portrait' => null,
        'team'     => null,
    ],

    // --- collections ----------------------------------------------------------
    'socials'      => [],
    'stats'        => [],
    'testimonials' => [],
    'team'         => [],
    'credentials'  => [],
];
