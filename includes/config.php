<?php
/**
 * Global site configuration.
 */

const SITE_NAME = 'CISMed';
const SITE_TAGLINE = 'Expediente clínico electrónico en la nube';
const COMPANY_NAME = 'LKM Soft';
const SITE_LOCALE = 'es_MX';
const CONTACT_EMAIL = 'info@cismed.mx';

// WhatsApp contact: number in international format (digits only), how it is shown, and the prefilled message.
const WHATSAPP_NUMBER = '5215540624411';
const WHATSAPP_DISPLAY = '55 4062 4411';
const WHATSAPP_MESSAGE = 'Hola CISMED 👋 ¡Me gustaría recibir informes!';

// Canonical production URL (without www), used for canonical, Open Graph and structured data.
const SITE_URL = 'https://cismed.mx';

/**
 * Base path of the site, so links work both at the domain root and inside a local subfolder.
 * It is derived from the project folder, so scripts in subfolders (e.g. actions/) get the same value.
 */
function base_path(): string
{
    static $basePath = null;
    if ($basePath !== null) {
        return $basePath;
    }

    $projectRoot = str_replace('\\', '/', (string) realpath(__DIR__ . '/..'));
    $documentRoot = str_replace('\\', '/', (string) realpath($_SERVER['DOCUMENT_ROOT'] ?? ''));

    if ($documentRoot !== '' && stripos($projectRoot, $documentRoot) === 0) {
        $relative = substr($projectRoot, strlen($documentRoot));
    } else {
        $relative = dirname($_SERVER['SCRIPT_NAME'] ?? '/');
    }

    return $basePath = rtrim(str_replace('\\', '/', $relative), '/') . '/';
}

/**
 * Builds a site-relative URL for a page slug or an asset path.
 */
function url(string $path = ''): string
{
    return base_path() . ltrim($path, '/');
}

/**
 * Builds an asset URL with a cache-busting version based on the file modification time.
 */
function asset(string $path): string
{
    $file = __DIR__ . '/../assets/' . ltrim($path, '/');
    $version = is_file($file) ? '?v=' . filemtime($file) : '';
    return url('assets/' . ltrim($path, '/')) . $version;
}

/**
 * Escapes a value for safe HTML output.
 */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
