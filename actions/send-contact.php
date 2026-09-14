<?php
/**
 * Contact form submission handler.
 * Responds with JSON to fetch requests; otherwise redirects back to the contact page (no-JS fallback).
 */

require_once __DIR__ . '/../includes/contact-form.php';

contact_start_session();

define('WANTS_JSON', str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json'));

/**
 * Sends the response in the format the client expects and stops execution.
 */
function respond(bool $ok, string $message, int $status = 200, array $errors = [], array $oldInput = []): void
{
    if (WANTS_JSON) {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'message' => $message, 'errors' => (object) $errors], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $_SESSION['contact_flash'] = [
        'ok'      => $ok,
        'message' => $message,
        'errors'  => $errors,
        'old'     => $ok ? [] : $oldInput,
    ];

    header('Location: ' . url('contact') . '#contact-form', true, 303);
    exit;
}

const GENERIC_ERROR = 'No pudimos enviar tu solicitud en este momento. Inténtalo de nuevo más tarde o escríbenos a ' . CONTACT_EMAIL . '.';
const SUCCESS_MESSAGE = '¡Gracias! Recibimos tu solicitud y nos pondremos en contacto contigo pronto.';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . url('contact'), true, 303);
    exit;
}

// CSRF protection.
$token = (string) ($_POST['csrf_token'] ?? '');
if (empty($_SESSION['contact_csrf_token']) || !hash_equals($_SESSION['contact_csrf_token'], $token)) {
    respond(false, 'Tu sesión expiró. Recarga la página e inténtalo de nuevo.', 403);
}

// Spam traps: a filled hidden field or an instant submission. Pretend success so bots learn nothing.
$renderedAt = (int) ($_SESSION['contact_form_rendered_at'] ?? 0);
if (!empty($_POST['website']) || $renderedAt === 0 || time() - $renderedAt < CONTACT_MIN_FILL_SECONDS) {
    respond(true, SUCCESS_MESSAGE);
}

$data = contact_normalize_input($_POST);
$errors = contact_validate($data);

if ($errors) {
    respond(false, 'Revisa los campos marcados.', 422, $errors, $data);
}

if (!contact_register_attempt($_SERVER['REMOTE_ADDR'] ?? 'unknown')) {
    respond(false, 'Recibimos varias solicitudes desde tu conexión. Espera un momento antes de volver a intentarlo.', 429);
}

if (!contact_send_email($data)) {
    respond(false, GENERIC_ERROR, 500, [], $data);
}

// Rotate the token so the same form cannot be submitted twice.
unset($_SESSION['contact_csrf_token']);

respond(true, SUCCESS_MESSAGE);
