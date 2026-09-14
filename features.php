<?php
$page = [
    'slug'        => 'features',
    'title'       => 'Funciones',
    'heading'     => 'Todo lo que tu consultorio necesita, en un solo sistema',
    'lead'        => 'Conoce los módulos de CISMed: agenda médica, notificaciones, pacientes, historia clínica, consultas, recetas, facturación CFDI y seguridad.',
    'description' => 'Funciones de CISMed: agenda médica con calendario, recordatorios por correo, SMS y WhatsApp, historia clínica, consultas por especialidad, recetas, facturación CFDI y seguridad de datos.',
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';
?>

        <!-- module navigation start -->
        <nav class="module-nav" aria-label="Módulos de CISMed">
            <div class="container">
                <ul class="module-nav-list">
                    <?php foreach (MODULES as $module): ?>
                        <li>
                            <a href="#<?= e($module['anchor']) ?>"><i data-lucide="<?= e($module['icon']) ?>"></i><?= e($module['title']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <!-- module navigation end -->

        <!-- modules detail start -->
        <div class="feature-blocks section-b-space">
            <?php foreach (MODULES as $index => $module): ?>
                <?php $isReversed = $index % 2 === 1; ?>
                <section class="feature-block" id="<?= e($module['anchor']) ?>" aria-labelledby="<?= e($module['anchor']) ?>-title">
                    <div class="container">
                        <div class="row g-4 g-lg-5 align-items-center">
                            <div class="col-lg-6<?= $isReversed ? ' order-lg-1' : '' ?>">
                                <div class="theme-title text-start">
                                    <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="<?= e($module['icon']) ?>"></i><?= e($module['title']) ?></span>
                                    <h2 id="<?= e($module['anchor']) ?>-title"><?= e($module['heading']) ?></h2>
                                    <p data-aos="fade-up" data-aos-duration="1000"><?= e($module['intro']) ?></p>
                                </div>
                                <ul class="check-list<?= count($module['points']) > 5 ? ' check-list-columns' : '' ?>" data-aos="fade-up" data-aos-duration="800">
                                    <?php foreach ($module['points'] as $point): ?>
                                        <li><i data-lucide="check"></i><span><?= e($point) ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if ($module['anchor'] === 'consultations'): ?>
                                    <a href="<?= url('specialties') ?>" class="btn-outline mt-4" data-aos="fade-up" data-aos-duration="800"><span>Ver especialidades</span></a>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6<?= $isReversed ? ' order-lg-0' : '' ?>">
                                <?php if (!empty($module['image'])): ?>
                                    <img src="<?= asset($module['image']['src']) ?>" class="img-fluid" width="<?= (int) $module['image']['width'] ?>" height="<?= (int) $module['image']['height'] ?>" alt="<?= e($module['image']['alt']) ?>" loading="lazy" data-aos="fade-up" data-aos-duration="1000">
                                <?php else: ?>
                                    <div class="feature-visual" data-aos="fade-up" data-aos-duration="1000" aria-hidden="true">
                                        <span class="feature-visual-icon"><i data-lucide="<?= e($module['icon']) ?>"></i></span>
                                        <ul class="feature-visual-tags">
                                            <?php foreach ($module['tags'] as $tag): ?>
                                                <li><i data-lucide="check"></i><?= e($tag) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
        <!-- modules detail end -->

<?php
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
