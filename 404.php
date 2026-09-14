<?php
http_response_code(404);

$page = [
    'slug'        => '404',
    'title'       => 'Página no encontrada',
    'description' => 'La página que buscas no existe o cambió de dirección.',
    'robots'      => 'noindex, follow',
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

        <!-- not found section start -->
        <section class="not-found-section">
            <div class="container">
                <div class="not-found-content">
                    <p class="not-found-code" aria-hidden="true">404</p>
                    <h1>No encontramos esta página</h1>
                    <p>Es posible que la dirección esté mal escrita o que la página haya cambiado de lugar. Estas secciones pueden ayudarte:</p>
                    <ul class="not-found-links">
                        <?php foreach (MAIN_NAV as $slug => $label): ?>
                            <li><a href="<?= url($slug) ?>"><?= e($label) ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="<?= url('contact') ?>">Contacto</a></li>
                    </ul>
                    <div class="not-found-actions">
                        <a href="<?= url() ?>" class="btn-main"><span><i data-lucide="house"></i>Ir al inicio</span></a>
                        <a href="<?= url('contact') ?>" class="btn-outline"><span>Solicitar información</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- not found section end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
