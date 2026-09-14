<?php
/**
 * Inner page header with breadcrumb. Expects $page['title'] and optional $page['heading'], $page['lead'].
 */
?>
        <!-- page header start -->
        <section class="breadcrumb-section">
            <div class="container">
                <nav aria-label="Ruta de navegación" data-aos="fade-up" data-aos-duration="1000">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url() ?>"><i data-lucide="house"></i> Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= e($page['title']) ?></li>
                    </ol>
                </nav>
                <div class="breadcrumb-titles">
                    <h1 data-aos="fade-up" data-aos-duration="1000"><?= e($page['heading'] ?? $page['title']) ?></h1>
                    <?php if (!empty($page['lead'])): ?>
                        <p data-aos="fade-up" data-aos-duration="1000"><?= e($page['lead']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- page header end -->
