<?php
/**
 * Site footer and closing scripts. Accepts optional $page['scripts'] (array of paths under assets/).
 */
?>
    </main>

    <!-- footer start -->
    <footer>
        <img src="<?= asset('images/template/background/8.svg') ?>" class="img-fluid footer-top-effect" alt="">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-5">
                    <div class="footer-info">
                        <a href="<?= url() ?>" class="d-inline-block mb-4" aria-label="<?= e(SITE_NAME) ?> - Inicio">
                            <?= brand_logo('light') ?>
                        </a>
                        <p>Expediente clínico electrónico y gestión integral del consultorio, en la nube y pensado para México.</p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="footer-col">
                        <div class="footer-links">
                            <h3 class="footer-title"><?= e(SITE_NAME) ?></h3>
                            <ul class="footer-content">
                                <?php foreach (MAIN_NAV as $slug => $label): ?>
                                    <li><a href="<?= url($slug) ?>"><?= e($label) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <h3 class="footer-title"><?= e(COMPANY_NAME) ?></h3>
                            <ul class="footer-content">
                                <li><a href="<?= url('contact') ?>">Contacto</a></li>
                                <li><a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a></li>
                                <li><a <?= whatsapp_link_attributes('footer') ?>>WhatsApp <?= e(WHATSAPP_DISPLAY) ?></a></li>
                            </ul>
                        </div>
                        <div class="footer-links">
                            <h3 class="footer-title">Legal</h3>
                            <ul class="footer-content">
                                <?php foreach (LEGAL_NAV as $slug => $label): ?>
                                    <li><a href="<?= url($slug) ?>"><?= e($label) ?></a></li>
                                <?php endforeach; ?>
                                <?php if (analytics_enabled()): ?>
                                    <li><button type="button" class="footer-link-button" data-cookie-preferences>Preferencias de cookies</button></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-sec">
                <p>© <?= date('Y') ?> <?= e(COMPANY_NAME) ?>. Todos los derechos reservados.</p>
                <p><?= e(SITE_NAME) ?> es un producto de <?= e(COMPANY_NAME) ?>.</p>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <a <?= whatsapp_link_attributes('floating_button') ?> class="whatsapp-float" aria-label="Escríbenos por WhatsApp">
        <?= whatsapp_icon() ?>
        <span class="whatsapp-float-label">¿Hablamos por WhatsApp?</span>
    </a>

    <?php if (analytics_enabled()): ?>
        <!-- Cookie consent banner: shown by analytics.js until the visitor makes a choice. -->
        <div class="cookie-banner" role="region" aria-label="Aviso de cookies" data-cookie-banner hidden>
            <div class="cookie-banner-content">
                <span class="cookie-banner-icon"><i data-lucide="cookie"></i></span>
                <p>
                    Usamos cookies de análisis de Google Analytics para conocer cómo se usa el sitio y mejorarlo.
                    Solo se activan si las aceptas. Consulta nuestro <a href="<?= url('privacy-notice') ?>#cookies">aviso de privacidad</a>.
                </p>
            </div>
            <div class="cookie-banner-actions">
                <button type="button" class="btn-outline" data-cookie-choice="denied"><span>Rechazar</span></button>
                <button type="button" class="btn-main" data-cookie-choice="granted"><span>Aceptar</span></button>
            </div>
        </div>
    <?php endif; ?>

    <button type="button" id="backToTop" class="back-to-top" aria-label="Volver arriba">
        <i data-lucide="move-up"></i>
    </button>

    <!-- Vendor scripts (defer keeps execution order and avoids blocking rendering) -->
    <script src="<?= asset('js/vendor/bootstrap.min.js') ?>" defer></script>
    <script src="<?= asset('js/vendor/gsap.min.js') ?>" defer></script>
    <script src="<?= asset('js/vendor/ScrollTrigger.min.js') ?>" defer></script>
    <script src="<?= asset('js/vendor/split-type.js') ?>" defer></script>
    <script src="<?= asset('js/vendor/aos.js') ?>" defer></script>
    <script src="<?= asset('js/vendor/lenis.min.js') ?>" defer></script>

    <!-- Site scripts. icons.js is generated by tools/build-icons.js. -->
    <script src="<?= asset('js/icons.js') ?>" defer></script>
    <script src="<?= asset('js/main.js') ?>" defer></script>
    <?php if (analytics_enabled()): ?>
        <script src="<?= asset('js/analytics.js') ?>" data-consent-key="<?= COOKIE_CONSENT_KEY ?>" defer></script>
    <?php endif; ?>
    <?php foreach ($page['scripts'] ?? [] as $script): ?>
        <script src="<?= asset($script) ?>" defer></script>
    <?php endforeach; ?>
</body>

</html>
