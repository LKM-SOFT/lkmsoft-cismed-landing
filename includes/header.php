<?php
/**
 * Site header with main navigation. Expects $page['slug'].
 */
$currentSlug = $page['slug'] ?? '';
?>
    <!-- header start -->
    <header id="header">
        <button type="button" class="menu-btn" aria-label="Abrir menú" aria-controls="main-menu" aria-expanded="false">
            <i data-lucide="menu"></i>
        </button>
        <a href="<?= url() ?>" class="brand-logo" aria-label="<?= e(SITE_NAME) ?> - Inicio">
            <?= brand_logo() ?>
        </a>
        <nav class="navbar-menu" aria-label="Principal">
            <div class="menu-overlay"></div>
            <ul class="menu-items" id="main-menu" data-segmented-nav>
                <li class="d-xl-none d-inline-block mobile-close">
                    <h3>Menú<button type="button" class="close-menu" aria-label="Cerrar menú"><i data-lucide="x"></i></button></h3>
                </li>
                <!-- Sliding highlight behind the active link (desktop segmented control). -->
                <li class="menu-pill" aria-hidden="true" data-nav-pill></li>
                <?php foreach (MAIN_NAV as $slug => $label): ?>
                    <li class="menu-link-item">
                        <a href="<?= url($slug) ?>" class="menu-item first-item<?= $slug === $currentSlug ? ' active' : '' ?>"<?= $slug === $currentSlug ? ' aria-current="page"' : '' ?>><?= e($label) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="right-btns">
            <a href="<?= url('contact') ?>" class="btn-main"><span><span class="d-none d-sm-inline">Solicitar información</span><span class="d-sm-none">Contacto</span></span></a>
        </div>
    </header>
    <!-- header end -->

    <main id="main-content">
