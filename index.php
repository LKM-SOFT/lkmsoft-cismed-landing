<?php
require_once __DIR__ . '/includes/config.php';

$page = [
    'slug'        => '',
    'title'       => '',
    'description' => 'CISMed es un expediente clínico electrónico con agenda médica, historia clínica, recetas y facturación CFDI, en la nube y pensado para médicos y clínicas en México',
    'schema'      => [
        [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => COMPANY_NAME,
            'url'      => SITE_URL . '/',
            'email'     => CONTACT_EMAIL,
            'telephone' => '+' . WHATSAPP_NUMBER,
        ],
        [
            '@context'            => 'https://schema.org',
            '@type'               => 'SoftwareApplication',
            'name'                => SITE_NAME,
            'description'         => 'Expediente clínico electrónico con gestión integral del consultorio, en la nube y pensado para médicos y clínicas en México',
            'applicationCategory' => 'HealthApplication',
            'operatingSystem'     => 'Web',
            'url'                 => SITE_URL . '/',
            'inLanguage'          => 'es-MX',
            'publisher'           => ['@type' => 'Organization', 'name' => COMPANY_NAME],
        ],
    ],
];

$highlights = [
    ['icon' => 'receipt',      'title' => 'Facturación CFDI integrada', 'text' => 'Factura tus consultas sin otro sistema'],
    ['icon' => 'id-card',      'title' => 'Validación de CURP',         'text' => 'Registros de pacientes más confiables'],
    ['icon' => 'syringe',      'title' => 'Cartilla de vacunación',     'text' => 'Basada en las cartillas oficiales vigentes'],
    ['icon' => 'shield-check', 'title' => 'Datos protegidos',           'text' => 'Cifrado de datos sensibles conforme a la LFPDPPP'],
];

$agendaPoints = [
    'Vista clásica o de calendario por día y por semana, según prefiera cada usuario',
    'Agenda con un clic en un espacio libre y reprograma arrastrando la cita',
    'Duración de cita, límite de pacientes por día y cupos extra',
    'Confirma, reprograma, cancela o cambia la cita a otro médico',
    'Registra tus días no laborables',
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

        <!-- hero section start -->
        <section class="home-style1 hero-section">
            <div class="container">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-lg-6 order-lg-0 order-1">
                        <div class="home-content">
                            <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="cloud"></i>Expediente clínico electrónico en la nube</span>
                            <h1>Tu consultorio, <span>en orden y en la nube</span></h1>
                            <p data-aos="fade-up" data-aos-duration="1000">Agenda médica, historia clínica, recetas y facturación CFDI en un solo sistema, pensado para médicos y clínicas en México</p>
                            <div class="btn-panel" data-aos="fade-up" data-aos-duration="1000">
                                <a href="<?= url('contact') ?>" class="btn-main"><span>Solicitar información</span></a>
                                <a href="<?= url('features') ?>" class="btn-outline"><span>Ver funciones</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1 order-0">
                        <div class="hero-mockup" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="<?= asset('images/mockups/dashboard-overview.svg') ?>" class="img-fluid" width="960" height="640" alt="Vista de las citas del día en CISMed" fetchpriority="high">
                            <div class="hero-float-card hero-float-card-top d-none d-md-flex" data-aos="fade-left" data-aos-delay="300" data-aos-duration="800">
                                <span class="float-icon bg-success-soft"><i data-lucide="bell-ring"></i></span>
                                <div>
                                    <strong>Recordatorio enviado</strong>
                                    <small>Por correo electrónico, SMS y WhatsApp</small>
                                </div>
                            </div>
                            <div class="hero-float-card hero-float-card-bottom d-none d-md-flex" data-aos="fade-right" data-aos-delay="500" data-aos-duration="800">
                                <span class="float-icon bg-primary-soft"><i data-lucide="receipt"></i></span>
                                <div>
                                    <strong>Factura CFDI timbrada</strong>
                                    <small>Consulta general</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- hero section end -->

        <!-- highlights section start -->
        <section class="highlights-section">
            <div class="container">
                <ul class="highlights-strip" data-aos="fade-up" data-aos-duration="800">
                    <?php foreach ($highlights as $item): ?>
                        <li>
                            <span class="highlight-icon"><i data-lucide="<?= e($item['icon']) ?>"></i></span>
                            <div>
                                <h2><?= e($item['title']) ?></h2>
                                <p><?= e($item['text']) ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <!-- highlights section end -->

        <!-- modules section start -->
        <section class="category-style2 modules-section section-t-space section-b-space">
            <div class="container">
                <div class="theme-title">
                    <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="layout-dashboard"></i>Todo en un solo sistema</span>
                    <h2>Lo que CISMed hace <span>por tu consultorio</span></h2>
                    <p data-aos="fade-up" data-aos-duration="1000">Desde la cita hasta la factura: cada módulo trabaja con los demás para que no captures lo mismo dos veces</p>
                </div>
                <div class="row g-4">
                    <?php foreach (MODULES as $module): ?>
                        <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-duration="500">
                            <a href="<?= url('features') ?>#<?= e($module['anchor']) ?>" class="category-box module-card">
                                <div class="icon-box"><i data-lucide="<?= e($module['icon']) ?>"></i></div>
                                <h3><?= e($module['title']) ?></h3>
                                <p><?= e($module['summary']) ?></p>
                                <span class="module-link">Ver más <i data-lucide="arrow-right"></i></span>
                                <div class="effect"></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- modules section end -->

        <!-- agenda section start -->
        <section class="feature-showcase section-b-space">
            <div class="container">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="theme-title text-start">
                            <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="calendar-days"></i>Agenda médica</span>
                            <h2>Una agenda que <span>se adapta a tu forma de trabajar</span></h2>
                            <p data-aos="fade-up" data-aos-duration="1000">Configura tu horario por especialidad, con horario fijo o distinto por día, y organiza tus citas como te resulte más cómodo</p>
                        </div>
                        <ul class="check-list" data-aos="fade-up" data-aos-duration="800">
                            <?php foreach ($agendaPoints as $point): ?>
                                <li><i data-lucide="check"></i><span><?= e($point) ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?= url('features') ?>#scheduling" class="btn-outline mt-4" data-aos="fade-up" data-aos-duration="800"><span>Conocer la agenda</span></a>
                    </div>
                    <div class="col-lg-7">
                        <img src="<?= asset('images/mockups/agenda-week.svg') ?>" class="img-fluid" width="760" height="560" alt="Vista semanal de la agenda de CISMed con una cita siendo reprogramada" loading="lazy" data-aos="fade-left" data-aos-duration="1000">
                    </div>
                </div>
            </div>
        </section>
        <!-- agenda section end -->

        <!-- specialties section start -->
        <section class="specialties-section section-t-space section-b-space">
            <div class="container">
                <div class="theme-title">
                    <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="heart-pulse"></i>Consultas por especialidad</span>
                    <h2>Hojas de consulta <span>para tu especialidad</span></h2>
                    <p data-aos="fade-up" data-aos-duration="1000">CISMed incluye 4 hojas de consulta especializadas, cada una con la información que realmente necesitas registrar. <?= e(CONSULTATION_SHEETS_NOTE) ?></p>
                </div>
                <div class="row g-4">
                    <?php foreach (SPECIALTIES as $specialty): ?>
                        <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-duration="500">
                            <a href="<?= url('specialties') ?>#<?= e($specialty['slug']) ?>" class="specialty-card">
                                <span class="specialty-icon"><i data-lucide="<?= e($specialty['icon']) ?>"></i></span>
                                <h3><?= e($specialty['title']) ?></h3>
                                <p><?= e($specialty['summary']) ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- specialties section end -->

<?php require __DIR__ . '/includes/audiences.php'; ?>

        <!-- faq section start -->
        <section class="faq-section section-t-space section-b-space">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-4">
                        <div class="theme-title text-start">
                            <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="circle-help"></i>Preguntas frecuentes</span>
                            <h2>Resolvemos <span>tus dudas</span></h2>
                            <p data-aos="fade-up" data-aos-duration="1000">Si no encuentras lo que buscas, escríbenos y con gusto te ayudamos</p>
                        </div>
                        <a href="<?= url('faq') ?>" class="btn-outline" data-aos="fade-up" data-aos-duration="1000"><span>Ver todas las preguntas</span></a>
                    </div>
                    <div class="col-lg-8">
                        <div class="accordion theme-accordion" id="homeFaq">
                            <?php foreach (featured_faqs() as $index => $faq): ?>
                                <div class="accordion-item" data-aos="fade-up" data-aos-duration="600">
                                    <h3 class="accordion-header">
                                        <button class="accordion-button<?= $index === 0 ? '' : ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#homeFaq<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="homeFaq<?= $index ?>">
                                            <?= e($faq['q']) ?>
                                        </button>
                                    </h3>
                                    <div id="homeFaq<?= $index ?>" class="accordion-collapse collapse<?= $index === 0 ? ' show' : '' ?>" data-bs-parent="#homeFaq">
                                        <div class="accordion-body">
                                            <p><?= e($faq['a']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq section end -->

<?php
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
