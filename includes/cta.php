<?php
/**
 * Call to action block that leads to the contact form.
 */
?>
        <!-- call to action section start -->
        <section class="consult-section consult-full cta-section section-b-space">
            <div class="container">
                <div class="consult-box">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="theme-title text-start">
                                <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="send"></i>Hablemos</span>
                                <h2>¿Listo para <span>ordenar tu consultorio?</span></h2>
                                <p data-aos="fade-up" data-aos-duration="1000">Déjanos tus datos y te contactamos para platicarte cómo CISMed puede ayudarte en tu práctica diaria.</p>
                                <div class="btn-sec" data-aos="fade-up" data-aos-duration="1000">
                                    <a href="<?= url('contact') ?>" class="btn-main"><span>Solicitar información</span></a>
                                    <a <?= whatsapp_link_attributes('call_to_action') ?> class="btn-outline btn-whatsapp"><span><?= whatsapp_icon() ?>Escríbenos por WhatsApp</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 offset-xl-1">
                            <div class="app-box contact-box" data-aos="fade-up" data-aos-duration="1000">
                                <span class="contact-box-icon"><i data-lucide="mail"></i></span>
                                <h3>Escríbenos</h3>
                                <a href="mailto:<?= e(CONTACT_EMAIL) ?>"><?= e(CONTACT_EMAIL) ?></a>
                                <a <?= whatsapp_link_attributes('call_to_action_box') ?> class="contact-box-whatsapp"><?= whatsapp_icon() ?><?= e(WHATSAPP_DISPLAY) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- call to action section end -->
