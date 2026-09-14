<?php
require_once __DIR__ . '/includes/content.php';

// Structured data so search engines can read the questions and answers.
$faqSchema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [],
];
foreach (FAQ_GROUPS as $group) {
    foreach ($group['items'] as $item) {
        $faqSchema['mainEntity'][] = [
            '@type'          => 'Question',
            'name'           => $item['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
        ];
    }
}

$page = [
    'slug'        => 'faq',
    'title'       => 'Preguntas frecuentes',
    'heading'     => 'Preguntas frecuentes',
    'lead'        => 'Resolvemos las dudas más comunes sobre CISMed. Si no encuentras lo que buscas, escríbenos.',
    'description' => 'Preguntas frecuentes sobre CISMed: instalación, agenda médica, recordatorios, historia clínica, facturación CFDI, seguridad de los datos y licencias.',
    'schema'      => [$faqSchema],
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';
?>

        <!-- faq section start -->
        <section class="faq-style1 faq-page section-t-space section-b-space">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-8 theme-accordion">
                        <?php foreach (FAQ_GROUPS as $groupIndex => $group): ?>
                            <?php $accordionId = 'faq-' . $group['id']; ?>
                            <div class="faq-group" id="<?= e($group['id']) ?>">
                                <h2 class="faq-title" data-aos="fade-up" data-aos-duration="1000">
                                    <i data-lucide="<?= e($group['icon']) ?>"></i><?= e($group['title']) ?>
                                </h2>
                                <div class="accordion" id="<?= e($accordionId) ?>" data-aos="fade-up" data-aos-duration="1000">
                                    <?php foreach ($group['items'] as $index => $item): ?>
                                        <?php
                                        $itemId = $accordionId . '-' . $index;
                                        $isOpen = $groupIndex === 0 && $index === 0;
                                        ?>
                                        <div class="accordion-item">
                                            <h3 class="accordion-header">
                                                <button class="accordion-button<?= $isOpen ? '' : ' collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= e($itemId) ?>" aria-expanded="<?= $isOpen ? 'true' : 'false' ?>" aria-controls="<?= e($itemId) ?>">
                                                    <?= e($item['q']) ?>
                                                </button>
                                            </h3>
                                            <div id="<?= e($itemId) ?>" class="accordion-collapse collapse<?= $isOpen ? ' show' : '' ?>" data-bs-parent="#<?= e($accordionId) ?>">
                                                <div class="accordion-body">
                                                    <p><?= e($item['a']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="col-lg-4">
                        <aside class="faq-sidebar">
                            <nav class="faq-topics" aria-label="Temas" data-aos="fade-up" data-aos-duration="1000">
                                <span>Temas</span>
                                <ul>
                                    <?php foreach (FAQ_GROUPS as $group): ?>
                                        <li><a href="#<?= e($group['id']) ?>"><i data-lucide="<?= e($group['icon']) ?>"></i><?= e($group['title']) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>
                            <div class="faq-help-box" data-aos="fade-up" data-aos-duration="1000">
                                <span class="contact-box-icon"><i data-lucide="message-circle-question"></i></span>
                                <h2>¿Tienes otra pregunta?</h2>
                                <p>Déjanos tus datos y te contactamos, o escríbenos a <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>.</p>
                                <div class="faq-help-actions">
                                    <a href="<?= url('contact') ?>" class="btn-main"><span>Solicitar información</span></a>
                                    <a <?= whatsapp_link_attributes('faq') ?> class="btn-outline btn-whatsapp"><span><?= whatsapp_icon() ?>WhatsApp</span></a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq section end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
