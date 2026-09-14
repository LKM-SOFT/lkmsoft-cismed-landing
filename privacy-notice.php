<?php
$page = [
    'slug'        => 'privacy-notice',
    'title'       => 'Aviso de privacidad',
    'heading'     => 'Aviso de privacidad',
    'lead'        => 'Conoce cómo tratamos los datos personales que nos compartes a través de este sitio.',
    'description' => 'Aviso de privacidad de CISMed: datos personales que recabamos en el sitio, finalidades, derechos ARCO y uso de cookies.',
];

/** Sections of the notice, used for the table of contents. Keys are anchors. */
$sections = [
    'responsible'    => 'Responsable de tus datos',
    'data-collected' => 'Datos personales que recabamos',
    'purposes'       => 'Finalidades del tratamiento',
    'transfers'      => 'Transferencias de datos',
    'arco-rights'    => 'Derechos ARCO',
    'revocation'     => 'Revocación del consentimiento',
    'cookies'        => 'Cookies y tecnologías similares',
    'changes'        => 'Cambios al aviso de privacidad',
];

const PRIVACY_NOTICE_UPDATED_AT = '01/09/2026';

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-header.php';
?>

        <!-- privacy notice section start -->
        <section class="terms-section legal-section section-t-space section-b-space">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-4 d-none d-lg-block">
                        <nav class="list-group" id="legal-toc" aria-label="Contenido del aviso">
                            <span>Contenido</span>
                            <?php $number = 1; ?>
                            <?php foreach ($sections as $anchor => $title): ?>
                                <a class="list-group-item list-group-item-action" href="#<?= e($anchor) ?>"><?= $number++ ?>. <?= e($title) ?></a>
                            <?php endforeach; ?>
                        </nav>
                    </div>

                    <div class="col-lg-8">
                        <div class="legal-content" data-bs-spy="scroll" data-bs-target="#legal-toc" data-bs-root-margin="0px 0px -60%">
                            <p class="legal-updated">Última actualización: <?= PRIVACY_NOTICE_UPDATED_AT ?></p>

                            <p>
                                En cumplimiento de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP),
                                ponemos a tu disposición este aviso de privacidad, que aplica a los datos personales que nos proporcionas a través
                                del sitio web de <?= e(SITE_NAME) ?>.
                            </p>

                            <article id="responsible">
                                <h2>1. Responsable de tus datos</h2>
                                <p><?= e(SITE_NAME) ?> es responsable del tratamiento de tus datos personales.</p>
                                <p>Para cualquier asunto relacionado con este aviso puedes escribirnos a <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>.</p>
                            </article>

                            <article id="data-collected">
                                <h2>2. Datos personales que recabamos</h2>
                                <p>Cuando llenas el formulario de contacto de este sitio, recabamos los siguientes datos:</p>
                                <ol>
                                    <li>Nombre y apellidos.</li>
                                    <li>Cédula profesional.</li>
                                    <li>Especialidad médica.</li>
                                    <li>Número de celular.</li>
                                    <li>Correo electrónico.</li>
                                </ol>
                                <p>A través de este formulario no solicitamos datos personales sensibles.</p>
                            </article>

                            <article id="purposes">
                                <h2>3. Finalidades del tratamiento</h2>
                                <h3>Finalidades primarias</h3>
                                <p>Usamos tus datos personales para las siguientes finalidades, necesarias para atender tu solicitud:</p>
                                <ol>
                                    <li>Atender tu solicitud de información sobre <?= e(SITE_NAME) ?>.</li>
                                    <li>Ponernos en contacto contigo por teléfono, WhatsApp o correo electrónico.</li>
                                    <li>Validar tu cédula profesional ante la Secretaría de Educación Pública (SEP). Tu cédula profesional se usa únicamente para esta validación.</li>
                                </ol>
                                <h3>Finalidades secundarias</h3>
                                <p>No tratamos tus datos personales para ninguna finalidad secundaria.</p>
                            </article>

                            <article id="transfers">
                                <h2>4. Transferencias de datos</h2>
                                <p>
                                    No transferimos tus datos personales a ningún tercero. La información solo se utiliza para verificar tu cédula
                                    profesional y ponernos en contacto contigo.
                                </p>
                            </article>

                            <article id="arco-rights">
                                <h2>5. Derechos ARCO</h2>
                                <p>
                                    Tienes derecho a conocer qué datos personales tenemos de ti y para qué los usamos (Acceso), a solicitar su corrección
                                    si están desactualizados o son inexactos (Rectificación), a que los eliminemos de nuestros registros (Cancelación)
                                    y a oponerte a su uso para fines específicos (Oposición).
                                </p>
                                <p>Para ejercer estos derechos, envía tu solicitud a <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>.</p>
                            </article>

                            <article id="revocation">
                                <h2>6. Revocación del consentimiento y limitación del uso</h2>
                                <p>
                                    Puedes revocar el consentimiento que nos otorgaste para el tratamiento de tus datos personales, así como limitar su uso
                                    o divulgación, escribiendo a <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>.
                                </p>
                            </article>

                            <article id="cookies">
                                <h2>7. Cookies y tecnologías similares</h2>
                                <p>Este sitio utiliza:</p>
                                <ol>
                                    <li>
                                        Una cookie de sesión técnica, necesaria para proteger el formulario de contacto contra envíos automatizados.
                                        No se usa para identificarte ni para fines publicitarios, y se elimina al cerrar tu navegador.
                                    </li>
                                    <li>
                                        Tipografías de Google Fonts, que se cargan desde servidores de Google. Al visitar el sitio, tu navegador se conecta
                                        con esos servidores, que reciben datos técnicos como tu dirección IP.
                                    </li>
                                </ol>
                                <p>Actualmente este sitio no utiliza cookies de análisis ni de publicidad.</p>
                            </article>

                            <article id="changes">
                                <h2>8. Cambios al aviso de privacidad</h2>
                                <p>
                                    Este aviso de privacidad puede modificarse por cambios legales o en nuestros procesos. Cualquier cambio se publicará
                                    en esta misma página, con su fecha de última actualización.
                                </p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- privacy notice section end -->

<?php require __DIR__ . '/includes/footer.php'; ?>
