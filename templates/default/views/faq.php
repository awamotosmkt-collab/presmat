<?php
/**
 * FAQ Page Template
 */

use Pandao\Core\Services\AssetsManager;

AssetsManager::addCss(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.css');
AssetsManager::addJs(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.js');
?>

<section id="page" class="faq-page">
    
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
                <div class="faq-list">
                    <div class="accordion" id="faqAccordion">
                        <?php foreach($articles as $i => $article){ 
                            $collapseId = 'faq-' . $i;
                            $isFirst = ($i === 0);
                        ?>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="heading-<?php echo $collapseId; ?>">
                                    <button class="accordion-button <?php echo $isFirst ? '' : 'collapsed'; ?>" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#<?php echo $collapseId; ?>" 
                                            aria-expanded="<?php echo $isFirst ? 'true' : 'false'; ?>" 
                                            aria-controls="<?php echo $collapseId; ?>">
                                        <i class="fa-solid fa-question-circle me-3 text-primary"></i>
                                        <?php echo $article->title; ?>
                                    </button>
                                </h2>
                                <div id="<?php echo $collapseId; ?>" 
                                     class="accordion-collapse collapse <?php echo $isFirst ? 'show' : ''; ?>" 
                                     aria-labelledby="heading-<?php echo $collapseId; ?>" 
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <?php echo $article->text; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="faq-contact text-center mt-5 p-5 bg-light rounded">
                <h4><?php
                    $ctaTitle = [
                        'pt' => 'Não encontrou o que procurava?',
                        'en' => 'Didn\'t find what you were looking for?',
                        'es' => '¿No encontró lo que buscaba?',
                    ];
                    echo $ctaTitle[$siteContext->lang_tag] ?? $ctaTitle['pt'];
                ?></h4>
                <p class="text-muted"><?php
                    $ctaText = [
                        'pt' => 'Entre em contato conosco e teremos prazer em ajudá-lo.',
                        'en' => 'Contact us and we will be happy to help you.',
                        'es' => 'Contáctenos y estaremos encantados de ayudarle.',
                    ];
                    echo $ctaText[$siteContext->lang_tag] ?? $ctaText['pt'];
                ?></p>
                <a href="<?php echo DOCBASE . $siteContext->lang_tag; ?>/contact" class="btn btn-primary">
                    <?php echo $siteContext->texts['GET_IN_TOUCH']; ?>
                </a>
            </div>

        </div>
    </div>

    <?php $myPage->renderWidgets('main_after'); ?>

</section>

<style>
.accordion-button {
    font-weight: 500;
}
.accordion-button:not(.collapsed) {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
}
.accordion-item {
    border-radius: 8px;
    overflow: hidden;
}
</style>
