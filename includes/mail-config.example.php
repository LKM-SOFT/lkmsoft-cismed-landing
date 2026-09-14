<?php
/**
 * Mail settings for the IONOS mailbox.
 *
 * Copy this file to includes/mail-config.php and fill in the password.
 * includes/mail-config.php is ignored by git: never commit real credentials.
 * Contact form requests are delivered to 'to_email' (defaults to CONTACT_EMAIL in config.php).
 */

return [
    'mail' => [
        'host'       => 'smtp.ionos.mx',
        'port'       => 587,
        'username'   => 'info@cismed.mx',
        'password'   => '',
        'from_email' => 'info@cismed.mx',
        'from_name'  => 'CISMED',
        'encryption' => 'tls', // TLS for SMTP
        'imap'       => [
            'host'       => 'imap.ionos.mx',
            'port'       => 993,
            'encryption' => 'ssl',
        ],
    ],
];
