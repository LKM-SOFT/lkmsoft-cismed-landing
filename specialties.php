<?php
$page = [
    'slug'        => 'specialties',
    'title'       => 'Especialidades',
    'heading'     => 'Hojas de consulta para tu especialidad',
    'lead'        => 'CISMed incluye 5 hojas de consulta especializadas: medicina general, ginecología, pediatría, estomatología y oftalmología, integradas a la historia clínica del paciente.',
    'description' => 'Especialidades de CISMed: hojas de consulta de medicina general, ginecología con control prenatal y climaterio, pediatría con cartilla de vacunación y gráficas de crecimiento, estomatología con odontograma, y oftalmología con examen optométrico, segmento anterior, fondo de ojo y graduación de lentes.',
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';
?>

        <!-- specialties detail start -->
        <section class="specialties-detail section-t-space section-b-space">
            <div class="container">
                <div class="row g-4">
                    <?php foreach (SPECIALTIES as $specialty): ?>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-duration="600">
                            <article class="specialty-detail-card" id="<?= e($specialty['slug']) ?>">
                                <div class="specialty-detail-heading">
                                    <span class="specialty-icon"><i data-lucide="<?= e($specialty['icon']) ?>"></i></span>
                                    <h2><?= e($specialty['title']) ?></h2>
                                </div>
                                <p><?= e($specialty['intro']) ?></p>
                                <ul class="check-list">
                                    <?php foreach ($specialty['points'] as $point): ?>
                                        <li><i data-lucide="check"></i><span><?= e($point) ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="specialties-coming" data-aos="fade-up" data-aos-duration="600">
                    <span class="specialties-coming-icon"><i data-lucide="sparkles"></i></span>
                    <p><strong>Más especialidades en camino.</strong> <?= e(CONSULTATION_SHEETS_NOTE) ?></p>
                </div>
                <p class="specialties-note" data-aos="fade-up" data-aos-duration="600">
                    Todas las especialidades comparten la agenda, las recetas, la facturación CFDI y la seguridad de CISMed.
                    <a href="<?= url('features') ?>">Ver todas las funciones</a>
                </p>
            </div>
        </section>
        <!-- specialties detail end -->

<?php
require __DIR__ . '/includes/audiences.php';
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
