<?php

use Pandao\Common\Utils\UrlUtils;

debug_backtrace() || die ('Direct access not permitted');

// Set Content-Language header for proper multilingual caching
header('Content-Language: ' . PMS_LANG_TAG);
?>

<!DOCTYPE html>
<html lang="<?php echo PMS_LANG_TAG; ?>">
<head>
    <meta charset="UTF-8">

    <title><?php echo $myView->title_tag; ?></title>

    <meta name="description" content="<?php echo $myView->descr; ?>">
    
    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo $myView->title_tag; ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo UrlUtils::getUrl(); ?>">
    <meta property="og:image" content="<?php echo $myView->object->getMainImagePath('medium', true); ?>">
    <meta property="og:description" content="<?php echo $myView->descr; ?>">
    <meta property="og:site_name" content="<?php echo addslashes(PMS_SITE_TITLE); ?>">
    <meta property="article:published_time" content="<?php echo $myView->published_time; ?>">
    <meta property="article:modified_time" content="<?php echo $myView->modified_time; ?>">
    <meta property="article:section" content="<?php echo $myPage->title; ?>">
    <?php
    if(isset($myArticle->tags)){ ?>
        <meta property="article:tag" content="<?php echo $myArticle->tags; ?>">
        <?php
    } ?>
    <meta property="article:author" content="<?php echo addslashes(PMS_OWNER); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo $myView->title_tag; ?>">
    <meta name="twitter:description" content="<?php echo $myView->descr; ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image:src" content="<?php echo $myView->object->getMainImagePath('medium', true); ?>">
    
    <meta name="robots" content="<?php echo $myView->robots; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    // Canonical (sem query string)
    $canonicalPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $canonicalUrl = UrlUtils::getUrl(true) . ($canonicalPath ?: '/');
    ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    
    <?php
    if(PMS_GMAPS_API_KEY != ""){ ?>
        <meta name="gmaps_api_key" content="<?php echo PMS_GMAPS_API_KEY; ?>">
        <?php
    } ?>
    <?php
    if(PMS_CAPTCHA_PKEY != ""){ ?>
        <meta name="recaptcha_pkey" content="<?php echo PMS_CAPTCHA_PKEY; ?>">
        <?php
    } ?>
    
    <link rel="icon" type="image/png" href="<?php echo DOCBASE; ?>public/assets/images/favicon.png">
    
    <?php
    // hreflang alternates (quando multilíngue está habilitado)
    if (PMS_LANG_ENABLED && isset($siteContext)) {
        $hrefLangs = [];
        // Priorizar artigo (mais específico) antes de página
        if (isset($myArticle) && $myArticle) {
            $hrefLangs = $siteContext->getAlternateLangUrls($myArticle);
        }
        if (empty($hrefLangs) && isset($myView) && isset($myView->object)) {
            $hrefLangs = $siteContext->getAlternateLangUrls($myView->object);
        }
        if (empty($hrefLangs) && isset($myPage)) {
            $hrefLangs = $siteContext->getAlternateLangUrls($myPage);
        }
        foreach ($hrefLangs as $tag => $url) { ?>
            <link rel="alternate" hreflang="<?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?>" href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>">
            <?php
        }
        // x-default: aponta para o idioma principal (pt) ou o primeiro disponível
        if (!empty($hrefLangs)) {
            $xDefaultUrl = $hrefLangs['pt'] ?? $hrefLangs['en'] ?? reset($hrefLangs);
            ?>
            <link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars($xDefaultUrl, ENT_QUOTES, 'UTF-8'); ?>">
            <?php
        }
    } ?>
    
    <?php
    //CSS required by the current model
    foreach (Pandao\Core\Services\AssetsManager::getCss() as $css) {
        $isExternal = (strpos($css, '//') !== false);
    ?>
        <link rel="preload" href="<?php echo $css; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'"<?php if ($isExternal) echo ' crossorigin="anonymous"'; ?>>
        <?php
    } ?>

    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" as="style" onload="this.onload=null;this.rel='stylesheet'" crossorigin="anonymous">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/magnific-popup@1.2.0/dist/magnific-popup.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" crossorigin="anonymous">

    <link rel="preload" href="<?php echo DOCBASE; ?>assets/js/plugins/meanmenu/meanmenu.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo DOCBASE; ?>assets/fontawesome/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>assets/css/helpers.min.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>assets/css/style.min.css">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>assets/css/custom.css">

    <!-- Preloader CSS failsafe: auto-hide after 3s even if JS fails -->
    <style>
        @keyframes preloaderFallback {
            0%, 90% { opacity: 1; visibility: visible; }
            100% { opacity: 0; visibility: hidden; }
        }
        #preloader {
            animation: preloaderFallback 3s forwards;
        }
    </style>
    <noscript><style>#preloader { display: none !important; }</style></noscript>

    <?php
    if(PMS_ANALYTICS_CODE != '' && mb_strstr(PMS_ANALYTICS_CODE, '<script') === false)
        echo '<script>'.stripslashes(PMS_ANALYTICS_CODE).'</script>';
    else
        echo stripslashes(PMS_ANALYTICS_CODE); ?>
</head>
