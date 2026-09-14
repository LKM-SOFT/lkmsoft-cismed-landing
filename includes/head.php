<?php
/**
 * Document head. Expects a $page array with: slug, title, description.
 * Optional: robots (e.g. "noindex"), schema (list of JSON-LD objects).
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/navigation.php';
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/whatsapp.php';

$pageTitle = !empty($page['title']) ? $page['title'] . ' | ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE;
$pageDescription = $page['description'] ?? '';
$canonical = rtrim(SITE_URL, '/') . '/' . ($page['slug'] ?? '');
$isIndexable = empty($page['robots']) || !str_contains($page['robots'], 'noindex');
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (analytics_enabled()): ?>
        <!-- Google tag (gtag.js) with Consent Mode v2: nothing is stored until the visitor accepts cookies. -->
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }

            gtag('consent', 'default', {
                analytics_storage: 'denied',
                ad_storage: 'denied',
                ad_user_data: 'denied',
                ad_personalization: 'denied',
                wait_for_update: 500
            });

            try {
                if (localStorage.getItem('<?= COOKIE_CONSENT_KEY ?>') === 'granted') {
                    gtag('consent', 'update', { analytics_storage: 'granted' });
                }
            } catch (error) {}

            gtag('js', new Date());
            gtag('config', '<?= e(GA_MEASUREMENT_ID) ?>');
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(GA_MEASUREMENT_ID) ?>"></script>
    <?php endif; ?>
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="author" content="<?= e(COMPANY_NAME) ?>">
    <?php if ($isIndexable): ?>
        <link rel="canonical" href="<?= e($canonical) ?>">
    <?php endif; ?>
    <?php if (!empty($page['robots'])): ?>
        <meta name="robots" content="<?= e($page['robots']) ?>">
    <?php endif; ?>

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= SITE_LOCALE ?>">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="<?= asset('images/brand/favicon.webp') ?>">
    <link rel="apple-touch-icon" href="<?= asset('images/brand/cismed-logo.webp') ?>">
    <meta name="theme-color" content="#0072e8">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('fonts/aspekta/font-face.css') ?>">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?= asset('css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/vendor/aos.css') ?>">

    <!-- Template and site styles -->
    <link rel="stylesheet" href="<?= asset('css/template/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/cismed.css') ?>">

    <?php foreach ($page['schema'] ?? [] as $schema): ?>
        <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
    <?php endforeach; ?>
</head>

<body class="page-<?= e($page['slug'] ?: 'home') ?>">
    <a class="visually-hidden-focusable skip-link" href="#main-content">Saltar al contenido</a>
