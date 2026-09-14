<?php
/**
 * "Who is it for" section, shared by the home and specialties pages.
 */
?>
        <!-- audiences section start -->
        <section class="why-choose-style1 w-bg audiences-section section-t-space section-b-space" id="audiences">
            <div class="container">
                <div class="row g-4 g-lg-5 align-items-center">
                    <div class="col-lg-6 order-lg-0 order-1">
                        <img src="<?= asset('images/mockups/agenda-multi-doctor.svg') ?>" class="img-fluid" width="640" height="600" alt="Agendas de varios médicos de una clínica, lado a lado" loading="lazy" data-aos="fade-right" data-aos-duration="1000">
                    </div>
                    <div class="col-lg-6 order-lg-1 order-0">
                        <div class="theme-title">
                            <span class="subtitle" data-aos="fade-up" data-aos-duration="1000"><i data-lucide="users"></i>Para quién es</span>
                            <h2>Hecho para todo <span>el equipo del consultorio</span></h2>
                            <p data-aos="fade-up" data-aos-duration="1000">Desde el médico que trabaja por su cuenta hasta la clínica con varios especialistas.</p>
                        </div>
                        <ul class="why-choose-listing">
                            <?php foreach (AUDIENCES as $audience): ?>
                                <li data-aos="fade-up" data-aos-duration="600">
                                    <div class="icon-box"><i data-lucide="<?= e($audience['icon']) ?>"></i></div>
                                    <div class="why-choose-content">
                                        <h3><?= e($audience['title']) ?></h3>
                                        <p><?= e($audience['text']) ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- audiences section end -->
