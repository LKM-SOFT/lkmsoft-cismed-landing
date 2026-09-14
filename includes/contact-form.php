<?php
/**
 * Contact form: session security, validation, rate limiting and email delivery.
 * Used by contact.php (rendering) and actions/send-contact.php (submission).
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../libraries/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../libraries/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libraries/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception as MailerException;
use PHPMailer\PHPMailer\PHPMailer;

/** Medical specialties offered in the form (the submitted value is the label itself). */
const MEDICAL_SPECIALTIES = [
    'Medicina General',
    'Alergología',
    'Angiología',
    'Cardiología',
    'Cardiología Intervencionista',
    'Dermatología',
    'Endocrinología',
    'Gastroenterología',
    'Geriatría',
    'Hematología',
    'Infectología',
    'Inmunología',
    'Medicina Interna',
    'Nefrología',
    'Neumología',
    'Neurología',
    'Oncología',
    'Reumatología',
    'Cirugía General',
    'Cirugía Bariátrica',
    'Cirugía Cardiovascular',
    'Cirugía Colorrectal',
    'Cirugía de Tórax',
    'Cirugía Endocrina',
    'Cirugía Endoscópica',
    'Cirugía Hepatobiliar',
    'Cirugía Maxilofacial',
    'Cirugía Oncológica',
    'Cirugía Plástica',
    'Cirugía sin Especificar',
    'Neurocirugía',
    'Urología',
    'Pediatría',
    'Alergología Pediátrica',
    'Dermatología Pediátrica',
    'Endocrinología Pediátrica',
    'Gastroenterología Pediátrica',
    'Genética Pediátrica',
    'Hematología Pediátrica',
    'Infectología Pediátrica',
    'Inmunología Pediátrica',
    'Medicina Interna Pediátrica',
    'Nefrología Pediátrica',
    'Neumología Pediátrica',
    'Neurocirugía Pediátrica',
    'Neurología Pediátrica',
    'Oftalmología Pediátrica',
    'Oncología Pediátrica',
    'Ortopedia Pediátrica',
    'Otorrinolaringología Pediátrica',
    'Psiquiatría Pediátrica',
    'Rehabilitación Pediátrica',
    'Reumatología Pediátrica',
    'Traumatología Pediátrica',
    'Urología Pediátrica',
    'Cardiología Intervencionista Pediátrica',
    'Cardiología Pediátrica',
    'Cirugía Cardiovascular Pediátrica',
    'Cirugía Colorrectal Pediátrica',
    'Cirugía de Tórax Pediátrica',
    'Cirugía Endoscópica Pediátrica',
    'Cirugía General Pediátrica',
    'Cirugía Maxilofacial Pediátrica',
    'Cirugía Neonatal',
    'Cirugía Oncológica Pediátrica',
    'Cirugía Plástica Pediátrica',
    'Estomatología Pediátrica',
    'Medicina Crítica Pediátrica',
    'Neonatología',
    'Otra Especialidad Pediátrica',
    'Radiología Pediátrica',
    'Ginecología',
    'Gineco Obstetricia',
    'Medicina Materno Fetal',
    'Obstetricia',
    'Urología Ginecológica',
    'Estomatología',
    'Genética',
    'Medicina Familiar',
    'Medicina Preventiva',
    'Medicina Transfuncional',
    'Oftalmología',
    'Ortopedia',
    'Otorrinolaringología',
    'Otra especialidad',
    'Otros Servicios de Adultos',
    'Patología',
    'Psiquiatría',
    'Quimioterapia',
    'Rehabilitación',
    'Traumatología',
];

const CONTACT_FIELDS = ['full_name', 'professional_license', 'specialty', 'mobile_phone', 'email', 'privacy_consent'];

/** Mexican professional license numbers (cédula profesional, SEP) are numeric; older ones are shorter. */
const PROFESSIONAL_LICENSE_PATTERN = '/^\d{5,8}$/';

/** Minimum seconds between rendering the form and submitting it (bots submit instantly). */
const CONTACT_MIN_FILL_SECONDS = 3;

/** Maximum submissions allowed per IP address within the time window. */
const CONTACT_RATE_LIMIT = 5;
const CONTACT_RATE_WINDOW_SECONDS = 3600;

/**
 * Starts a hardened PHP session for the contact form.
 */
function contact_start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name('cismed_session');
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'cookie_secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'use_strict_mode' => true,
    ]);
}

/**
 * Returns the CSRF token for the current session, creating it when needed.
 */
function contact_csrf_token(): string
{
    if (empty($_SESSION['contact_csrf_token'])) {
        $_SESSION['contact_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['contact_csrf_token'];
}

/**
 * Records when the form was rendered, for the minimum fill time check.
 */
function contact_mark_form_rendered(): void
{
    $_SESSION['contact_form_rendered_at'] = time();
}

/**
 * Trims and normalizes raw POST input.
 */
function contact_normalize_input(array $input): array
{
    $text = static fn (string $key): string => trim(preg_replace('/\s+/u', ' ', (string) ($input[$key] ?? '')));

    $mobile = preg_replace('/\D+/', '', (string) ($input['mobile_phone'] ?? ''));
    // Accept numbers typed with the Mexico country code (+52 or the legacy +521).
    if (strlen($mobile) === 13 && str_starts_with($mobile, '521')) {
        $mobile = substr($mobile, 3);
    } elseif (strlen($mobile) === 12 && str_starts_with($mobile, '52')) {
        $mobile = substr($mobile, 2);
    }

    return [
        'full_name'       => $text('full_name'),
        'professional_license' => preg_replace('/[\s-]+/', '', $text('professional_license')),
        'specialty'            => $text('specialty'),
        'mobile_phone'         => $mobile,
        'email'                => strtolower($text('email')),
        'privacy_consent'      => !empty($input['privacy_consent']),
    ];
}

/**
 * Validates normalized data. Returns an array of field => error message (empty when valid).
 */
function contact_validate(array $data): array
{
    $errors = [];

    $nameLength = mb_strlen($data['full_name']);
    if ($data['full_name'] === '') {
        $errors['full_name'] = 'Escribe tu nombre y apellidos.';
    } elseif ($nameLength < 5 || $nameLength > 120 || !preg_match("/^[\p{L}\p{M}]+(?:[\s'.-][\p{L}\p{M}]+)+\.?$/u", $data['full_name'])) {
        $errors['full_name'] = 'Escribe tu nombre y al menos un apellido, solo con letras.';
    }

    if ($data['professional_license'] === '') {
        $errors['professional_license'] = 'Escribe tu cédula profesional.';
    } elseif (!preg_match(PROFESSIONAL_LICENSE_PATTERN, $data['professional_license'])) {
        $errors['professional_license'] = 'La cédula profesional debe tener entre 5 y 8 dígitos, solo números.';
    }

    if ($data['specialty'] === '') {
        $errors['specialty'] = 'Selecciona tu especialidad.';
    } elseif (!in_array($data['specialty'], MEDICAL_SPECIALTIES, true)) {
        $errors['specialty'] = 'Selecciona una especialidad de la lista.';
    }

    if ($data['mobile_phone'] === '') {
        $errors['mobile_phone'] = 'Escribe tu número de celular.';
    } elseif (!preg_match('/^\d{10}$/', $data['mobile_phone'])) {
        $errors['mobile_phone'] = 'El celular debe tener 10 dígitos.';
    }

    if ($data['email'] === '') {
        $errors['email'] = 'Escribe tu correo electrónico.';
    } elseif (strlen($data['email']) > 254 || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Escribe un correo electrónico válido.';
    }

    if (!$data['privacy_consent']) {
        $errors['privacy_consent'] = 'Debes aceptar el aviso de privacidad para enviar tus datos.';
    }

    return $errors;
}

/**
 * Returns true when the IP address is still under the submission limit, and records the attempt.
 */
function contact_register_attempt(string $ipAddress): bool
{
    $file = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'cismed-contact-' . hash('sha256', $ipAddress) . '.json';
    $now = time();

    $attempts = [];
    if (is_file($file)) {
        $attempts = json_decode((string) file_get_contents($file), true) ?: [];
    }

    $attempts = array_values(array_filter($attempts, static fn ($time) => is_int($time) && $time > $now - CONTACT_RATE_WINDOW_SECONDS));

    if (count($attempts) >= CONTACT_RATE_LIMIT) {
        return false;
    }

    $attempts[] = $now;
    file_put_contents($file, json_encode($attempts), LOCK_EX);

    return true;
}

/**
 * Loads the SMTP settings ('mail' section of includes/mail-config.php), or null when the file is missing.
 */
function contact_mail_config(): ?array
{
    $file = __DIR__ . '/mail-config.php';
    if (!is_file($file)) {
        return null;
    }

    $settings = require $file;
    $mail = $settings['mail'] ?? null;

    return is_array($mail) ? $mail + ['to_email' => CONTACT_EMAIL] : null;
}

/**
 * Sends the contact request by email. Returns true on success.
 */
function contact_send_email(array $data): bool
{
    $config = contact_mail_config();
    if ($config === null || empty($config['password'])) {
        error_log('[contact-form] Missing SMTP configuration: create includes/mail-config.php.');
        return false;
    }

    $formattedPhone = preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '$1 $2 $3', $data['mobile_phone']);

    $rows = [
        'Nombre y apellidos'  => $data['full_name'],
        'Cédula profesional'  => $data['professional_license'],
        'Especialidad'        => $data['specialty'],
        'Celular'             => $formattedPhone,
        'Correo electrónico'  => $data['email'],
        'Aviso de privacidad' => 'Aceptado',
        'Fecha'               => date('d/m/Y H:i'),
    ];

    $htmlRows = '';
    $textRows = '';
    foreach ($rows as $label => $value) {
        $htmlRows .= '<tr><td style="padding:8px 12px;color:#64748b;white-space:nowrap;">' . e($label) . '</td>'
            . '<td style="padding:8px 12px;color:#06284b;font-weight:600;">' . e($value) . '</td></tr>';
        $textRows .= $label . ': ' . $value . "\n";
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->Port = (int) $config['port'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $config['encryption'] === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->Timeout = 15;
        $mail->CharSet = PHPMailer::CHARSET_UTF8;

        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($config['to_email']);
        $mail->addReplyTo($data['email'], $data['full_name']);

        $mail->isHTML(true);
        $mail->Subject = 'Nueva solicitud de información: ' . $data['full_name'];
        $mail->Body = '<div style="font-family:Arial,sans-serif;font-size:15px;">'
            . '<h2 style="color:#0072e8;margin:0 0 16px;">Nueva solicitud de información desde ' . e(SITE_NAME) . '</h2>'
            . '<table style="border-collapse:collapse;background:#f5f8fc;border-radius:8px;">' . $htmlRows . '</table>'
            . '<p style="color:#64748b;font-size:13px;margin-top:16px;">Responde a este correo para contestar directamente a la persona.</p>'
            . '</div>';
        $mail->AltBody = "Nueva solicitud de información desde " . SITE_NAME . "\n\n" . $textRows;

        $mail->send();

        return true;
    } catch (MailerException $exception) {
        // Log only the transport error, never the submitted personal data.
        error_log('[contact-form] Email could not be sent: ' . $mail->ErrorInfo);

        return false;
    }
}
