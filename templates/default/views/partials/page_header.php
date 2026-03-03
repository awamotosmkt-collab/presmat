<?php debug_backtrace() || die ("Direct access not permitted");

$pageBanner = $myPage->getMainImagePath('big', false, 1500);
if(!isset($myArticle)) $img = $pageBanner;
else {
    $img = $myArticle->getMainImagePath('big', false, 1500);
    if(empty($img)) $img = $pageBanner;
} 

// Translation helper for page titles/breadcrumbs
$langTag = $siteContext->lang_tag ?? 'pt';
$pageTitle = $myView->title;
$breadcrumbName = $myView->name;

if ($langTag !== 'pt') {
    $translations = [
        'en' => [
            'PRODUTOS' => 'PRODUCTS',
            'EMPRESA' => 'COMPANY',
            'SERVIÇOS' => 'SERVICES',
            'APLICAÇÕES' => 'APPLICATIONS',
            'CONTATO' => 'CONTACT',
            'NOTÍCIAS' => 'NEWS',
            'SOLICITAR ORÇAMENTO' => 'REQUEST QUOTE'
        ],
        'es' => [
            'PRODUTOS' => 'PRODUCTOS',
            'EMPRESA' => 'EMPRESA',
            'SERVIÇOS' => 'SERVICIOS',
            'APLICAÇÕES' => 'APLICACIONES',
            'CONTATO' => 'CONTACTO',
            'NOTÍCIAS' => 'NOTICIAS',
            'SOLICITAR ORÇAMENTO' => 'SOLICITAR PRESUPUESTO'
        ]
    ];

    $upperName = mb_strtoupper($breadcrumbName, 'UTF-8');
    if (isset($translations[$langTag][$upperName])) {
        $breadcrumbName = $translations[$langTag][$upperName];
        if (mb_strtoupper($pageTitle, 'UTF-8') === $upperName) {
            $pageTitle = $breadcrumbName;
        }
    }
}
?>

<div class="page-banner-wrap bg-cover" style="background-image: url('<?php echo $img; ?>')">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="page-heading text-white">
                    <h1 itemprop="name"><?php echo $pageTitle; ?></h1>
                    <?php if(!empty($myView->subtitle)) echo '<p class="lead mb0">' . $myView->subtitle . '</p>'; ?>
                </div>
                <div class="breadcrumb-wrap">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $siteContext->getHome()->path; ?>" title="<?php echo $siteContext->getHome()->title; ?>"><?php echo $siteContext->getHome()->name; ?></a></li>
                            
                            <?php
                            foreach($myPage->breadcrumbs as $id_parent){
                                if(isset($siteContext->parents[$id_parent])){ 
                                    $parentName = $siteContext->parents[$id_parent]->name;
                                    $upperParent = mb_strtoupper($parentName, 'UTF-8');
                                    if ($langTag !== 'pt' && isset($translations[$langTag][$upperParent])) {
                                        $parentName = $translations[$langTag][$upperParent];
                                    }
                                    ?>

                                    <li class="breadcrumb-item">
                                        <a href="<?php echo $siteContext->parents[$id_parent]->path; ?>" title="<?php echo $siteContext->parents[$id_parent]->title; ?>">
                                            <?php echo $parentName; ?>
                                        </a>
                                    </li>

                                    <?php
                                }
                            }
                            if(!empty($myArticle)){ ?>
                                <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $myPage->path; ?>" title="<?php echo $myPage->title; ?>"><?php echo $breadcrumbName; ?></a></li>
                                <?php
                            } ?>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo (!empty($myArticle) ? $myView->name : $breadcrumbName); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
