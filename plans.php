<?php
$page = [
    'slug'        => 'plans',
    'title'       => 'Planes',
    'heading'     => 'Planes para cada tamaño de consultorio',
    'lead'        => 'Elige el plan según cuántos médicos y asistentes trabajan contigo. Todos los planes incluyen la agenda, el expediente y las recetas.',
    'description' => 'Planes y precios de CISMed: 6 licencias desde $400 MXN al mes con IVA incluido, para consultorios de 1 a 10 médicos, con pago mensual, trimestral, semestral o anual.',
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';
?>

        <!-- plans section start -->
        <section class="plans-section section-t-space section-b-space">
            <div class="container">
                <div class="billing-cycles" data-aos="fade-up" data-aos-duration="800">
                    <span class="billing-cycles-icon"><i data-lucide="calendar-clock"></i></span>
                    <div>
                        <h2>Paga como mejor te convenga</h2>
                        <?php
                        $cycles = array_map(static fn (string $cycle): string => '<strong>' . e(mb_strtolower($cycle)) . '</strong>', BILLING_CYCLES);
                        $lastCycle = array_pop($cycles);
                        ?>
                        <p>
                            Todos los planes se pueden contratar en modalidad <?= implode(', ', $cycles) ?> o <?= $lastCycle ?>,
                            con distintos descuentos según la modalidad que elijas
                        </p>
                    </div>
                </div>

                <div class="row g-4">
                    <?php foreach (PLANS as $plan): ?>
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="500">
                            <article class="plan-card">
                                <h3><?= e($plan['name']) ?></h3>
                                <p class="plan-price">$<?= number_format($plan['price']) ?><span>.00</span></p>
                                <p class="plan-price-note">MXN al mes, IVA incluido</p>

                                <ul class="plan-limits">
                                    <li><i data-lucide="stethoscope"></i><span>Médicos: <strong><?= e((string) $plan['doctors']) ?></strong></span></li>
                                    <li><i data-lucide="users"></i><span>Enfermeros(as) y asistentes: <strong><?= e($plan['assistants']) ?></strong></span></li>
                                </ul>

                                <ul class="plan-features">
                                    <?php foreach (PLAN_FEATURES as $index => $feature): ?>
                                        <?php $isIncluded = $index < $plan['included']; ?>
                                        <li class="<?= $isIncluded ? 'is-included' : 'is-excluded' ?>">
                                            <?php if ($isIncluded): ?>
                                                <i data-lucide="circle-check"></i>
                                            <?php else: ?>
                                                <i data-lucide="circle-x"></i>
                                            <?php endif; ?>
                                            <span><?= e($feature) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <a <?= account_link_attributes('plan_' . mb_strtolower($plan['name'])) ?> class="btn-main w-100">
                                    <span>Crear cuenta</span>
                                </a>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="plans-custom" data-aos="fade-up" data-aos-duration="600">
                    <span class="plans-custom-icon"><i data-lucide="message-circle-more"></i></span>
                    <div>
                        <h2>¿Necesitas algo diferente?</h2>
                        <p>Si tu clínica necesita más médicos, otra combinación de funciones o un esquema distinto, escríbenos y lo revisamos contigo</p>
                    </div>
                    <a href="<?= url('contact') ?>" class="btn-outline"><span>Contáctanos</span></a>
                </div>
            </div>
        </section>
        <!-- plans section end -->

<?php
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
