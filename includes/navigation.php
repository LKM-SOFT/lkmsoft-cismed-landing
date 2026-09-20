<?php
/**
 * Site navigation items shared by the header and the footer.
 * Keys are page slugs; values are the labels shown to the user.
 */

const MAIN_NAV = [
    'features'    => 'Funciones',
    'specialties' => 'Especialidades',
    'plans'       => 'Planes',
    'faq'         => 'Preguntas frecuentes',
];

const LEGAL_NAV = [
    'privacy-notice' => 'Aviso de privacidad',
];

/**
 * Link attributes for the "create account" button: sign-up lives in the CIS application,
 * so it opens in a new tab. analytics.js reports the click with the given location.
 */
function account_link_attributes(string $location): string
{
    return 'href="' . e(registration_url()) . '" target="_blank" rel="noopener"'
        . ' data-account-link data-track-location="' . e($location) . '"';
}

/**
 * Renders the CISMed logo (symbol + wordmark).
 * Use "dark" on light backgrounds (gray symbol) and "light" on dark backgrounds (white symbol).
 */
function brand_logo(string $variant = 'dark'): string
{
    $isLight = $variant === 'light';
    $symbol = asset($isLight ? 'images/brand/cismed-logo-white.webp' : 'images/brand/cismed-logo.webp');
    $class = 'brand-mark' . ($isLight ? ' brand-mark-light' : '');

    return '<span class="' . $class . '">'
        . '<img src="' . $symbol . '" width="182" height="173" alt="">'
        . '<span class="brand-name">CIS<span>Med</span></span>'
        . '</span>';
}
