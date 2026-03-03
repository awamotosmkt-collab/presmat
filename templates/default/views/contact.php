<section id="page">

    <?php
    require_once __DIR__ . '/partials/page_header.php';
        
    //-----------------------------------
    // Widgets before the main content
    $myPage->renderWidgets('main_before'); ?>
    
    <div class="content section-padding">
        <div class="container">
            
            <?php
            if(!empty($myPage->text)){ ?>
                <div class="clearfix mb20"><?php echo $myPage->text; ?></div>
                <?php
            } ?>
            
            <div class="row">
                <!-- Contact Info Column -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="contact-info-card p-4 bg-light rounded h-100">
                        <h4 class="mb-4 text-dark"><?php echo htmlspecialchars($ct['info_title']); ?></h4>
                        
                        <div class="contact-item mb-4">
                            <div class="d-flex">
                                <div class="contact-icon me-3">
                                    <span class="d-inline-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: var(--main-color); border-radius: 50%;">
                                        <i class="fa-solid fa-location-dot text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($ct['address_label']); ?></h6>
                                    <p class="text-muted mb-0">Av. Caibar Schutel, 123<br>Jd. Aeroporto<br>Araraquara - SP, Brasil<br>CEP: 14801-320</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <div class="d-flex">
                                <div class="contact-icon me-3">
                                    <span class="d-inline-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: var(--main-color); border-radius: 50%;">
                                        <i class="fa-solid fa-phone text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($ct['phone_label']); ?></h6>
                                    <p class="text-muted mb-0">
                                        <a href="tel:+551630148368" class="text-muted text-decoration-none">(16) 3014-8368</a><br>
                                        <a href="tel:+5516997646232" class="text-muted text-decoration-none">(16) 99764-6232</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <div class="d-flex">
                                <div class="contact-icon me-3">
                                    <span class="d-inline-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: var(--main-color); border-radius: 50%;">
                                        <i class="fa-solid fa-envelope text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($ct['email_label']); ?></h6>
                                    <p class="text-muted mb-0">
                                        <a href="mailto:comercial@pressmatik.com.br" class="text-muted text-decoration-none">comercial@pressmatik.com.br</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <div class="d-flex">
                                <div class="contact-icon me-3">
                                    <span class="d-inline-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: var(--main-color); border-radius: 50%;">
                                        <i class="fa-solid fa-clock text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($ct['hours_label']); ?></h6>
                                    <p class="text-muted mb-0"><?php echo htmlspecialchars($ct['hours_value']); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="<?php echo $whatsappLink; ?>" target="_blank" class="btn btn-success w-100 py-3 rounded-0">
                            <i class="fa-brands fa-whatsapp me-2"></i><?php echo htmlspecialchars($ct['whatsapp_cta']); ?>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Form Column -->
                <div class="col-lg-8">
                    <form method="post" action="<?php echo $myPage->path; ?>">
                        <input type="hidden" name="captchaHoney" value="" class="hide">

                        <div class="alert alert-success" style="display:none;"></div>
                        <div class="alert alert-danger" style="display:none;"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-fw fa-user"></i></span>
                                        <input type="text" class="form-control" name="name" value="<?php echo $contactForm->name; ?>" placeholder="<?php echo $siteContext->texts['LASTNAME']." ".$siteContext->texts['FIRSTNAME']; ?> *">
                                    </div>
                                    <div class="field-notice" rel="name"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-fw fa-envelope"></i></span>
                                        <input type="text" class="form-control" name="email" value="<?php echo $contactForm->email; ?>" placeholder="<?php echo $siteContext->texts['EMAIL']; ?> *">
                                    </div>
                                    <div class="field-notice" rel="email"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-fw fa-phone"></i></span>
                                        <input type="text" class="form-control" name="phone" value="<?php echo $contactForm->phone; ?>" placeholder="<?php echo $siteContext->texts['PHONE']; ?>">
                                    </div>
                                    <div class="field-notice" rel="phone"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-fw fa-building"></i></span>
                                        <input type="text" class="form-control" name="company" value="<?php echo $contactForm->company ?? ''; ?>" placeholder="<?php echo ($langTag == 'en') ? 'Company' : (($langTag == 'es') ? 'Empresa' : 'Empresa'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-fw fa-question"></i></span>
                                <input type="text" class="form-control" name="subject" value="<?php echo $contactForm->subject; ?>" placeholder="<?php echo $siteContext->texts['SUBJECT']; ?>">
                            </div>
                            <div class="field-notice" rel="subject"></div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-fw fa-quote-left"></i></span>
                                <textarea class="form-control" name="msg" placeholder="<?php echo $siteContext->texts['MESSAGE']; ?> *" rows="5"><?php echo $contactForm->msg; ?></textarea>
                            </div>
                            <div class="field-notice" rel="msg"></div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <input class="form-check-input" type="checkbox" name="privacy_agreement" value="1"<?php if($contactForm->privacy_agreement) echo ' checked="checked"'; ?>> <?php echo $siteContext->texts['PRIVACY_POLICY_AGREEMENT']; ?>
                            <div class="field-notice" rel="privacy_agreement"></div>
                        </div>
                        
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"> 
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg rounded-0 px-5" name="send" value="1"><?php echo $siteContext->texts['SEND']; ?></button>
                            <span class="ms-3 text-muted"><i>* <?php echo $siteContext->texts['REQUIRED_FIELD']; ?></i></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Maps Section -->
<section class="map-section">
    <div class="container-fluid p-0">
        <h4 class="text-center py-4 bg-light mb-0"><?php echo htmlspecialchars($ct['map_title']); ?></h4>
        <div class="google-map-embed">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3702.9876401825607!2d-48.14999!3d-21.814055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94b8f3ca207bffe5%3A0x8f549c30f9c2e200!2sPressmatik%20Prensas%20e%20Equipamentos%20Hidr%C3%A1ulicos!5e0!3m2!1spt-BR!2sbr!4v1700000000000!5m2!1spt-BR!2sbr" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<script>
    var pms_locations = [
        <?php
        foreach ($locations as $i => $location) { ?>
            ['<?php echo $location->name; ?>', '<?php echo $location->address; ?>', <?php echo $location->lat; ?>, <?php echo $location->lng; ?>]
            <?php if ($i + 1 < count($locations)) echo ",\n";
        } ?>
    ];
</script>

<?php
if(!empty($locations) && PMS_GMAPS_API_KEY) { ?>

    <div id="contact-map-wrap"></div><div id="map-marker"></div>

    <?php
} ?>
