<?php
require_once __DIR__ . '/includes/contact-form.php';

contact_start_session();
contact_mark_form_rendered();
$csrfToken = contact_csrf_token();

// Result of a submission without JavaScript (see actions/send-contact.php).
$flash = $_SESSION['contact_flash'] ?? null;
unset($_SESSION['contact_flash']);

$errors = $flash['errors'] ?? [];
$old = $flash['old'] ?? [];
$isSent = !empty($flash['ok']);

$page = [
    'slug'        => 'contact',
    'title'       => 'Contacto',
    'heading'     => 'Solicita información sobre CISMed',
    'lead'        => 'Déjanos tus datos y nos pondremos en contacto contigo para resolver tus dudas.',
    'description' => 'Solicita información sobre CISMed, el expediente clínico electrónico en la nube para médicos y clínicas en México.',
    'scripts'     => ['js/contact-form.js'],
];

/**
 * Returns the previous value of a field after a failed no-JS submission.
 */
function old_value(array $old, string $field): string
{
    return e((string) ($old[$field] ?? ''));
}

/**
 * Renders the Bootstrap validation classes and message for a field.
 */
function field_error(array $errors, string $field): array
{
    $message = $errors[$field] ?? '';

    return [
        'class'   => $message !== '' ? ' is-invalid' : '',
        'message' => e($message),
    ];
}

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';
?>

        <!-- contact section start -->
        <section class="contact-section section-t-space section-b-space">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-4 order-lg-0 order-1">
                        <div class="contact-details">
                            <div class="contact-wrap" data-aos="fade-up" data-aos-duration="1000">
                                <i data-lucide="message-circle-more"></i>
                                <div>
                                    <h2>Te contactamos</h2>
                                    <ul>
                                        <li>Con tus datos nos comunicamos contigo por teléfono o correo electrónico para platicarte cómo CISMed puede ayudarte.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="contact-wrap contact-wrap-whatsapp" data-aos="fade-up" data-aos-duration="1000">
                                <?= whatsapp_icon() ?>
                                <div>
                                    <h2>WhatsApp</h2>
                                    <ul>
                                        <li><a <?= whatsapp_link_attributes('contact_page') ?>><?= e(WHATSAPP_DISPLAY) ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="contact-wrap" data-aos="fade-up" data-aos-duration="1000">
                                <i data-lucide="at-sign"></i>
                                <div>
                                    <h2>Correo electrónico</h2>
                                    <ul>
                                        <li><a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="contact-wrap" data-aos="fade-up" data-aos-duration="1000">
                                <i data-lucide="shield-check"></i>
                                <div>
                                    <h2>Tus datos, protegidos</h2>
                                    <ul>
                                        <li>Usamos tus datos solo para validar tu cédula profesional y ponernos en contacto contigo. Consulta nuestro <a href="<?= url('privacy-notice') ?>">aviso de privacidad</a>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 order-lg-1 order-0">
                        <div class="contact-wrap" id="contact-form" data-aos="fade-up" data-aos-duration="1000">
                            <div class="form-alert alert alert-success<?= $isSent ? '' : ' d-none' ?>" role="status" data-form-success>
                                <i data-lucide="circle-check"></i>
                                <div>
                                    <strong>Solicitud enviada</strong>
                                    <p data-form-success-message><?= $isSent ? e($flash['message']) : '' ?></p>
                                </div>
                            </div>

                            <form class="theme-form contact-form<?= $isSent ? ' d-none' : '' ?>" action="<?= url('actions/send-contact.php') ?>" method="post" novalidate data-contact-form>
                                <h2 class="main-title">Déjanos tus datos</h2>
                                <p class="form-intro">Todos los campos son obligatorios.</p>

                                <div class="form-alert alert alert-danger<?= !$isSent && $flash ? '' : ' d-none' ?>" role="alert" data-form-error>
                                    <i data-lucide="circle-alert"></i>
                                    <p data-form-error-message><?= !$isSent && $flash ? e($flash['message']) : '' ?></p>
                                </div>

                                <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">

                                <!-- Honeypot: hidden from people, bots tend to fill it. -->
                                <div class="form-honeypot" aria-hidden="true">
                                    <label for="website">Sitio web</label>
                                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                                </div>

                                <div class="row g-sm-4 g-3">
                                    <div class="col-12">
                                        <?php $field = field_error($errors, 'full_name'); ?>
                                        <label for="full_name" class="form-label">Nombre y apellidos</label>
                                        <input type="text" class="form-control<?= $field['class'] ?>" id="full_name" name="full_name" value="<?= old_value($old, 'full_name') ?>" autocomplete="name" maxlength="120" required aria-describedby="full_name-error">
                                        <div class="invalid-feedback" id="full_name-error"><?= $field['message'] ?></div>
                                    </div>

                                    <div class="col-sm-6">
                                        <?php $field = field_error($errors, 'professional_license'); ?>
                                        <label for="professional_license" class="form-label">Cédula profesional</label>
                                        <input type="text" class="form-control<?= $field['class'] ?>" id="professional_license" name="professional_license" value="<?= old_value($old, 'professional_license') ?>" inputmode="numeric" maxlength="10" autocomplete="off" spellcheck="false" required aria-describedby="professional_license-help professional_license-error">
                                        <div class="form-text" id="professional_license-help">Solo números, como aparece en tu cédula.</div>
                                        <div class="invalid-feedback" id="professional_license-error"><?= $field['message'] ?></div>
                                    </div>

                                    <div class="col-sm-6">
                                        <?php $field = field_error($errors, 'specialty'); ?>
                                        <label for="specialty" class="form-label">Especialidad</label>
                                        <select class="form-select<?= $field['class'] ?>" id="specialty" name="specialty" required aria-describedby="specialty-error">
                                            <option value="">Selecciona una opción</option>
                                            <?php foreach (MEDICAL_SPECIALTIES as $specialty): ?>
                                                <option value="<?= e($specialty) ?>"<?= ($old['specialty'] ?? '') === $specialty ? ' selected' : '' ?>><?= e($specialty) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback" id="specialty-error"><?= $field['message'] ?></div>
                                    </div>

                                    <div class="col-sm-6">
                                        <?php $field = field_error($errors, 'mobile_phone'); ?>
                                        <label for="mobile_phone" class="form-label">Celular</label>
                                        <input type="tel" class="form-control<?= $field['class'] ?>" id="mobile_phone" name="mobile_phone" value="<?= old_value($old, 'mobile_phone') ?>" inputmode="tel" autocomplete="tel-national" maxlength="20" required aria-describedby="mobile_phone-help mobile_phone-error">
                                        <div class="form-text" id="mobile_phone-help">10 dígitos.</div>
                                        <div class="invalid-feedback" id="mobile_phone-error"><?= $field['message'] ?></div>
                                    </div>

                                    <div class="col-sm-6">
                                        <?php $field = field_error($errors, 'email'); ?>
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control<?= $field['class'] ?>" id="email" name="email" value="<?= old_value($old, 'email') ?>" autocomplete="email" maxlength="254" required aria-describedby="email-error">
                                        <div class="invalid-feedback" id="email-error"><?= $field['message'] ?></div>
                                    </div>

                                    <div class="col-12">
                                        <?php $field = field_error($errors, 'privacy_consent'); ?>
                                        <div class="form-check">
                                            <input class="form-check-input<?= $field['class'] ?>" type="checkbox" id="privacy_consent" name="privacy_consent" value="1" required aria-describedby="privacy_consent-error">
                                            <label class="form-check-label" for="privacy_consent">
                                                He leído y acepto el <a href="<?= url('privacy-notice') ?>" target="_blank" rel="noopener">aviso de privacidad</a>.
                                            </label>
                                            <div class="invalid-feedback" id="privacy_consent-error"><?= $field['message'] ?></div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn-main" data-submit-button>
                                            <span>
                                                <span class="spinner-border spinner-border-sm d-none" aria-hidden="true" data-submit-spinner></span>
                                                <i data-lucide="send-horizontal"></i>
                                                <span data-submit-label>Enviar solicitud</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact section end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
