<?php 
debug_backtrace() || die ('Direct access not permitted');

$siteContext = Pandao\Services\SiteContext::get();
$langTag = $siteContext->lang_tag ?? 'pt';

// Centralized translations
$_t = require dirname(__DIR__) . '/i18n/translations.php';

$ft = [
    'contact_title'  => $_t('footer.contact_title', $langTag),
    'products_title'  => $_t('footer.products_title', $langTag),
    'products'        => $_t('footer.products', $langTag),
    'products_page'   => $_t('footer.products_page', $langTag),
    'downloads_title'  => $_t('footer.downloads_title', $langTag),
    'downloads'        => $_t('footer.downloads', $langTag),
    'about_title'      => $_t('footer.about_title', $langTag),
    'about_text'       => $_t('footer.about_text', $langTag),
];

$socialLinks = [
    'whatsapp' => 'https://wa.me/5516997646232',
    'instagram' => 'https://instagram.com/pressmatik_oficial',
    'facebook' => 'https://www.facebook.com/pressmatikprensaseequipamentos',
    'linkedin' => 'https://www.linkedin.com/company/pressmatik/',
    'youtube' => 'https://www.youtube.com/channel/UCE7ZUUPzVg858f45I8nbByQ',
    'tiktok' => 'https://www.tiktok.com/@pressmatik?lang=pt-br',
];

$downloadLinks = [
    'general' => 'https://drive.google.com/drive/folders/1SnvFrVDrzrw_WWMhgXsYB6DAqe14NleD?usp=sharing',
    'prensas' => 'https://drive.google.com/drive/folders/1gF9vEBxNxxlKfO5AEnSWRwTXDCB5i545',
    'tecnicas' => 'https://drive.google.com/drive/folders/12H7rux8PX865Gk8EO4DON2ihbqoKsM1-',
];
?>

<footer class="footer-2 footer-wrap">
    <div class="footer-widgets-wrapper text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white text-uppercase mb-4"><?php echo htmlspecialchars($ft['contact_title']); ?></h5>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex text-white-50">
                            <i class="fa-solid fa-location-dot me-3 mt-1 text-danger"></i>
                            <span>Av. Caibar Schutel, 123<br>Jd. Aeroporto, Araraquara - SP<br>Brasil</span>
                        </li>
                        <li class="mb-3 d-flex text-white-50">
                            <i class="fa-solid fa-phone me-3 mt-1 text-danger"></i>
                            <div>
                                <a href="tel:+551630148368" class="text-white-50 text-decoration-none d-block">(16) 3014-8368</a>
                                <a href="tel:+5516997646232" class="text-white-50 text-decoration-none d-block">(16) 99764-6232</a>
                            </div>
                        </li>
                        <li class="mb-3 d-flex text-white-50">
                            <i class="fa-solid fa-envelope me-3 mt-1 text-danger"></i>
                            <a href="mailto:comercial@pressmatik.com.br" class="text-white-50 text-decoration-none">comercial@pressmatik.com.br</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white text-uppercase mb-4"><?php echo htmlspecialchars($ft['products_title']); ?></h5>
                    <ul class="list-unstyled footer-links">
                        <?php
                        $prodPage = $ft['products_page'] ?? 'produtos';
                        foreach ($ft['products'] as $product):
                            $prodUrl = DOCBASE . $langTag . '/' . $prodPage . '/' . $product['alias'];
                        ?>
                        <li class="mb-2"><a href="<?php echo $prodUrl; ?>" class="text-white-50 text-decoration-none"><i class="fa-solid fa-angle-right me-2 text-danger"></i><?php echo htmlspecialchars($product['name']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white text-uppercase mb-4"><?php echo htmlspecialchars($ft['downloads_title']); ?></h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="<?php echo $downloadLinks['general']; ?>" target="_blank" class="text-white-50 text-decoration-none"><i class="fa-solid fa-file-pdf me-2 text-danger"></i><?php echo htmlspecialchars($ft['downloads'][0]); ?></a></li>
                        <li class="mb-2"><a href="<?php echo $downloadLinks['prensas']; ?>" target="_blank" class="text-white-50 text-decoration-none"><i class="fa-solid fa-file-pdf me-2 text-danger"></i><?php echo htmlspecialchars($ft['downloads'][1]); ?></a></li>
                        <li class="mb-2"><a href="<?php echo $downloadLinks['tecnicas']; ?>" target="_blank" class="text-white-50 text-decoration-none"><i class="fa-solid fa-file-pdf me-2 text-danger"></i><?php echo htmlspecialchars($ft['downloads'][2]); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white text-uppercase mb-4"><?php echo htmlspecialchars($ft['about_title']); ?></h5>
                    <p class="text-white-50 mb-4"><?php echo htmlspecialchars($ft['about_text']); ?></p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?php echo $socialLinks['whatsapp']; ?>" target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; background-color: #25D366; border: none;" title="WhatsApp"><i class="fa-brands fa-whatsapp text-white"></i></a>
                        <a href="<?php echo $socialLinks['instagram']; ?>" target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); border: none;" title="Instagram"><i class="fa-brands fa-instagram text-white"></i></a>
                        <a href="<?php echo $socialLinks['facebook']; ?>" target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; background-color: #1877F2; border: none;" title="Facebook"><i class="fa-brands fa-facebook-f text-white"></i></a>
                        <a href="<?php echo $socialLinks['linkedin']; ?>" target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; background-color: #0A66C2; border: none;" title="LinkedIn"><i class="fa-brands fa-linkedin-in text-white"></i></a>
                        <a href="<?php echo $socialLinks['youtube']; ?>" target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; background-color: #FF0000; border: none;" title="YouTube"><i class="fa-brands fa-youtube text-white"></i></a>
                        <a href="<?php echo $socialLinks['tiktok']; ?>" target="_blank" class="btn btn-sm d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; background-color: #000000; border: none;" title="TikTok"><i class="fa-brands fa-tiktok text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 text-center text-md-start">
                    <div class="copyright-info">
                        <p>
                            <?php echo 'Copyright &copy; ' . date('Y') . ' ' . PMS_OWNER . ' ' . $siteContext->texts['ALL_RIGHTS_RESERVED'] . ' - ' . $siteContext->texts['CREATION']; ?>
                            <span class="text-white-50">SkillGrowth</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="footer-menu mt-3 mt-md-0 text-center text-md-end">
                        <ul>
                            <?php foreach($siteContext->footerMenu as $nav){ ?>
                                <li><a href="<?php echo $nav->href; ?>" title="<?php echo $nav->title; ?>"><?php echo $nav->name; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="<?php echo $socialLinks['whatsapp']; ?>" target="_blank" id="whatsapp-float" class="whatsapp-float" aria-label="WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
    <span class="whatsapp-tooltip"><?php echo $_t('whatsapp.tooltip', $langTag); ?></span>
</a>

<style>
.whatsapp-float {
    position: fixed; bottom: 30px; right: 30px;
    width: 60px; height: 60px;
    background-color: #25D366; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 15px rgba(37,211,102,0.4);
    z-index: 9999; transition: all 0.3s ease; text-decoration: none;
    animation: whatsapp-pulse 2s infinite;
}
.whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 6px 20px rgba(37,211,102,0.6); animation: none; }
.whatsapp-float i { color: white; font-size: 32px; }
.whatsapp-float .whatsapp-tooltip {
    position: absolute; right: 70px;
    background: #333; color: white; padding: 8px 15px;
    border-radius: 5px; font-size: 14px; white-space: nowrap;
    opacity: 0; visibility: hidden; transition: all 0.3s ease;
}
.whatsapp-float:hover .whatsapp-tooltip { opacity: 1; visibility: visible; }
.whatsapp-float .whatsapp-tooltip::after {
    content: ''; position: absolute; right: -8px; top: 50%;
    transform: translateY(-50%);
    border-width: 8px 0 8px 8px; border-style: solid;
    border-color: transparent transparent transparent #333;
}
@keyframes whatsapp-pulse {
    0% { box-shadow: 0 0 0 0 rgba(37,211,102,0.7); }
    70% { box-shadow: 0 0 0 15px rgba(37,211,102,0); }
    100% { box-shadow: 0 0 0 0 rgba(37,211,102,0); }
}
</style>

<?php include( __DIR__ . '/popup.php'); ?>

<a href="#" id="toTop" aria-label="Go to top"><i class="fa-solid fa-fw fa-angle-up"></i></a>

<?php
if(PMS_ENABLE_COOKIES_NOTICE == 1 && !isset($_COOKIE['cookies_enabled'])){ ?>
    <div id="cookies-notice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <i class="fa-light fa-2x fa-cookie me-2"></i> <?php echo $siteContext->texts['COOKIES_NOTICE']; ?>
                    <button class="btn ms-3">OK</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.2.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.4.1/jquery.appear.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<script src="<?php echo DOCBASE; ?>assets/js/plugins/meanmenu/meanmenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
<script src="<?php echo DOCBASE; ?>assets/js/plugins/imagefill/js/jquery-imagefill.min.js"></script>
<?php foreach (Pandao\Core\Services\AssetsManager::getJs() as $js) echo '<script src="' . $js . '"></script>'."\n"; ?>
<script src="<?php echo DOCBASE; ?>common/js/utils.min.js"></script>
<script src="<?php echo DOCBASE; ?>assets/js/main.min.js"></script>

<script>
document.addEventListener('click', function(e) {
    document.querySelectorAll('.lang-switcher.open').forEach(function(el) {
        if (!el.contains(e.target)) el.classList.remove('open');
    });
});
</script>

<script>
$(function(){
    <?php
    $msg_error = isset($msg_error) ? mb_ereg_replace("(\r\n|\n|\r)","'+\n'",nl2br($msg_error)) : '';
    $msg_success = isset($msg_success) ? mb_ereg_replace("(\r\n|\n|\r)","'+\n'",nl2br($msg_success)) : '';
    if(!empty($msg_error)){ ?>
        $('.alert-danger').html('<?php echo $msg_error; ?>').slideDown();
        setTimeout(function(){$('html, body').animate({scrollTop: ($('.alert-danger').position().top-230)+'px'})}, 800);
        <?php
    }
    if(!empty($msg_success)){ ?>
        $('.alert-success').html('<?php echo $msg_success; ?>').slideDown();
        setTimeout(function(){$('html, body').animate({scrollTop: ($('.alert-success').position().top-230)+'px'})}, 800);
        <?php
    }
    if(isset($field_notice) && !empty($field_notice)){
        foreach($field_notice as $field => $notice){ ?>
            $('.field-notice[rel="<?php echo $field; ?>"]').html('<?php echo $notice; ?>').fadeIn('slow').parent().addClass('error').find('.form-control, .form-select').addClass('is-invalid');
            <?php
        }
    } ?>
});
</script>
</body>
</html>
