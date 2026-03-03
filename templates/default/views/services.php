<?php
/**
 * Services Page Template
 */

use Pandao\Core\Services\AssetsManager;

AssetsManager::addCss(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.css');
AssetsManager::addJs(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.js');
?>

<section id="page" class="services-page">
    
    <?php require_once __DIR__ . '/partials/page_header.php'; ?>
    
    <?php $myPage->renderWidgets('main_before'); ?>

    <div class="content section-padding">
        <div class="container">
            
            <?php if(!empty($myPage->text)){ ?>
                <div class="intro-text mb-5 text-center">
                    <?php echo $myPage->text; ?>
                </div>
            <?php } ?>

            <?php if(!empty($articles)){ ?>
                <div class="row services-list">
                    <?php foreach($articles as $i => $article){ 
                        $isEven = ($i % 2 == 0);
                    ?>
                        <div class="col-12 mb-5">
                            <div class="service-item row align-items-center <?php echo $isEven ? '' : 'flex-row-reverse'; ?>">
                                <?php if(!empty($article->images)){ 
                                    $img = $article->images[0];
                                    $path = 'medias/article/big/' . $img['id'] . '/' . $img['file'];
                                ?>
                                    <div class="col-md-6">
                                        <div class="service-image">
                                            <img src="<?php echo DOCBASE . $path; ?>" 
                                                 alt="<?php echo htmlspecialchars($article->title); ?>"
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="service-content <?php echo $isEven ? 'ps-md-5' : 'pe-md-5'; ?>">
                                        <h3 class="service-title"><?php echo $article->title; ?></h3>
                                        <?php if(!empty($article->subtitle)){ ?>
                                            <p class="service-subtitle lead text-primary"><?php echo $article->subtitle; ?></p>
                                        <?php } ?>
                                        <div class="service-description">
                                            <?php echo $article->text; ?>
                                        </div>
                                        <?php if(!empty($article->alias)){ ?>
                                            <a href="<?php echo DOCBASE . $siteContext->lang_tag . '/' . $myPage->alias . '/' . $article->alias; ?>" 
                                               class="btn btn-outline-primary mt-3">
                                                <?php echo $siteContext->texts['READMORE']; ?> <i class="fa-solid fa-arrow-right ms-2"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <?php $myPage->renderWidgets('main_after'); ?>

</section>

<style>
.service-item {
    padding: 30px 0;
    border-bottom: 1px solid #eee;
}
.service-item:last-child {
    border-bottom: none;
}
.service-image img {
    transition: transform 0.3s ease;
}
.service-image:hover img {
    transform: scale(1.02);
}
.service-title {
    font-size: 1.5rem;
    margin-bottom: 10px;
}
</style>
