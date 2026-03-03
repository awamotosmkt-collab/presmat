<?php
/**
 * Default Page Template
 * Template padão para páginas simples de conteúdo
 * Usado para: Governança, Privacidade, Termos, Ética
 */

use Pandao\Core\Services\AssetsManager;

AssetsManager::addCss(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.css');
AssetsManager::addJs(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.js');
?>

<section id="page" class="default-page">
    
    <?php require_once __DIR__ . '/partials/page_header.php'; ?>
    
    <?php $myPage->renderWidgets('main_before'); ?>

    <div class="content section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <?php if(!empty($myPage->text)){ ?>
                        <div class="page-content">
                            <?php echo $myPage->text; ?>
                        </div>
                    <?php } ?>
                    
                    <?php 
                    // Galeria de imagens se houver
                    if(!empty($myPage->images) && count($myPage->images) >= 1){ ?>
                        <div class="page-gallery mt-5">
                            <div class="row">
                                <?php foreach($myPage->images as $img){
                                    $path = 'medias/page/big/' . $img['id'] . '/' . $img['file'];
                                    if(is_file(SYSBASE . 'public/' . $path)){ ?>
                                        <div class="col-md-4 mb-4">
                                            <a href="<?php echo DOCBASE . $path; ?>" class="image-link">
                                                <img src="<?php echo DOCBASE . $path; ?>" 
                                                     alt="<?php echo htmlspecialchars($img['label']); ?>"
                                                     class="img-fluid rounded">
                                            </a>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>

    <?php $myPage->renderWidgets('main_after'); ?>
    
</section>
