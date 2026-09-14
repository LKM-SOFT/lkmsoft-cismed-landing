<?php
/**
 * Site navigation items shared by the header and the footer.
 * Keys are page slugs; values are the labels shown to the user.
 */

const MAIN_NAV = [
    'features'    => 'Funciones',
    'specialties' => 'Especialidades',
    'faq'         => 'Preguntas frecuentes',
];

const LEGAL_NAV = [
    'privacy-notice' => 'Aviso de privacidad',
];

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
