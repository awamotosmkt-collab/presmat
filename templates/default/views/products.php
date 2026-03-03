<?php
/**
 * Products Page Template — PRESSMATIK
 * Professional product listing with card images, comparison table, and CTAs
 */

use Pandao\Core\Services\AssetsManager;
use Pandao\Services\SiteContext;

AssetsManager::addCss(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.css');
AssetsManager::addJs(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.js');

$sCtx = SiteContext::get();
$langTag = $sCtx->lang_tag ?? 'pt';

// Product metadata — icons, colors, type per alias
$productMeta = [
    'linha-pmc'  => ['icon' => 'fa-c', 'color' => '#971B26', 'gradient' => 'linear-gradient(135deg, #971B26 0%, #c0392b 100%)'],
    'linha-pmcd' => ['icon' => 'fa-arrows-left-right-to-line', 'color' => '#1a1a2e', 'gradient' => 'linear-gradient(135deg, #1a1a2e 0%, #34495e 100%)'],
    'linha-pmh'  => ['icon' => 'fa-droplet', 'color' => '#0f3460', 'gradient' => 'linear-gradient(135deg, #0f3460 0%, #2980b9 100%)'],
    'linha-pm4c' => ['icon' => 'fa-table-cells', 'color' => '#16213e', 'gradient' => 'linear-gradient(135deg, #16213e 0%, #2c3e50 100%)'],
    'unidades-transferencia' => ['icon' => 'fa-robot', 'color' => '#2d4059', 'gradient' => 'linear-gradient(135deg, #2d4059 0%, #546e7a 100%)'],
];

$modelCounts = [
    'linha-pmc' => 8, 'linha-pmcd' => 6, 'linha-pmh' => 5, 'linha-pm4c' => 4, 'unidades-transferencia' => 0,
];

// Product type badges
$productTypes = [
    'linha-pmc'  => ['pt' => 'Mecânica', 'en' => 'Mechanical', 'es' => 'Mecánica'],
    'linha-pmcd' => ['pt' => 'Mecânica', 'en' => 'Mechanical', 'es' => 'Mecánica'],
    'linha-pmh'  => ['pt' => 'Hidráulica', 'en' => 'Hydraulic', 'es' => 'Hidráulica'],
    'linha-pm4c' => ['pt' => 'Mecânica', 'en' => 'Mechanical', 'es' => 'Mecánica'],
    'unidades-transferencia' => ['pt' => 'Automação', 'en' => 'Automation', 'es' => 'Automatización'],
];

// Key features per product (3 per product, per language)
$productFeatures = [
    'linha-pmc' => [
        'pt' => ['Tipo C (Garganta)', 'Até 120 GPM', '8 configurações'],
        'en' => ['C-Frame Design', 'Up to 120 SPM', '8 configurations'],
        'es' => ['Tipo C (Garganta)', 'Hasta 120 GPM', '8 configuraciones'],
    ],
    'linha-pmcd' => [
        'pt' => ['Duplo Montante', 'Alta rigidez', '6 configurações'],
        'en' => ['Double Upright', 'High rigidity', '6 configurations'],
        'es' => ['Doble Montante', 'Alta rigidez', '6 configuraciones'],
    ],
    'linha-pmh' => [
        'pt' => ['Controle de força', 'Velocidade ajustável', '5 configurações'],
        'en' => ['Force control', 'Adjustable speed', '5 configurations'],
        'es' => ['Control de fuerza', 'Velocidad ajustable', '5 configuraciones'],
    ],
    'linha-pm4c' => [
        'pt' => ['4 Colunas', 'Cargas pesadas', '4 configurações'],
        'en' => ['4 Columns', 'Heavy loads', '4 configurations'],
        'es' => ['4 Columnas', 'Cargas pesadas', '4 configuraciones'],
    ],
    'unidades-transferencia' => [
        'pt' => ['Barra de transferência', 'Alimentação de bobina', 'Integração com prensas'],
        'en' => ['Transfer bar', 'Coil feeding', 'Press integration'],
        'es' => ['Barra de transferencia', 'Alimentación de bobina', 'Integración con prensas'],
    ],
];

// UI translations — loaded from centralized i18n
$_t = require dirname(__DIR__) . '/i18n/translations.php';

// Build $t as flat array for backward compatibility with template
$t = [];
$_productsKeys = [
    'hero_sub', 'cta_catalog', 'cta_whatsapp', 'view_details', 'capacity', 'models',
    'stat_range', 'stat_range_u', 'stat_lines', 'stat_lines_u', 'stat_models', 'stat_models_u',
    'stat_years', 'stat_years_u', 'compare_title', 'compare_sub',
    'col_line', 'col_type', 'col_capacity', 'col_models', 'col_action',
    'diff_title', 'diff_1_title', 'diff_1_desc', 'diff_2_title', 'diff_2_desc',
    'diff_3_title', 'diff_3_desc', 'diff_4_title', 'diff_4_desc',
    'cta_bottom', 'cta_bottom_sub', 'cta_bottom_btn',
];
foreach ($_productsKeys as $k) {
    // Try products-specific key first, then generic
    $t[$k] = $_t("products.$k", $langTag) !== "products.$k" ? $_t("products.$k", $langTag) : $_t($k, $langTag);
}

$whatsappLink = 'https://wa.me/5516997646232';
$catalogLink  = 'https://drive.google.com/drive/folders/1SnvFrVDrzrw_WWMhgXsYB6DAqe14NleD?usp=sharing';

// SEO meta description per language
$seoDescriptions = [
    'pt' => 'Conheça as linhas de prensas mecânicas e hidráulicas Pressmatik: PMC, PMCD, PMH, PM4C e Unidades de Transferência. De 25 a 1.500 toneladas, com mais de 23 configurações para conformação de metais.',
    'en' => 'Discover Pressmatik mechanical and hydraulic press lines: PMC, PMCD, PMH, PM4C and Transfer Units. From 25 to 1,500 tons, with over 23 configurations for metal forming.',
    'es' => 'Conozca las líneas de prensas mecánicas e hidráulicas Pressmatik: PMC, PMCD, PMH, PM4C y Unidades de Transferencia. De 25 a 1.500 toneladas, con más de 23 configuraciones para conformación de metales.',
];
if (isset($myView)) {
    $myView->descr = $seoDescriptions[$langTag] ?? $seoDescriptions['pt'];
}
?>

<section id="page" class="products-page">

    <!-- ===== HERO HEADER ===== -->
    <section class="products-hero" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); color: white; position: relative; overflow: hidden;">
        <div class="products-hero__pattern"></div>
        <div class="container position-relative py-5">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-7 py-4">
                    <nav class="mb-3" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0" style="background: none;">
                            <li class="breadcrumb-item"><a href="<?php echo DOCBASE . $langTag; ?>/" class="text-white-50 text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                            <li class="breadcrumb-item active text-white"><?php echo htmlspecialchars($myPage->title ?? $myPage->name); ?></li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3"><?php echo htmlspecialchars($myPage->title ?? $myPage->name); ?></h1>
                    <p class="lead mb-4" style="opacity: 0.9; font-size: 1.2rem;"><?php echo $t['hero_sub']; ?></p>

                    <!-- Stats bar -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="products-hero__stat">
                                <i class="fa-solid fa-gauge-high"></i>
                                <strong><?php echo $t['stat_range']; ?></strong>
                                <span><?php echo $t['stat_range_u']; ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="products-hero__stat">
                                <i class="fa-solid fa-industry"></i>
                                <strong><?php echo $t['stat_lines']; ?></strong>
                                <span><?php echo $t['stat_lines_u']; ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="products-hero__stat">
                                <i class="fa-solid fa-gears"></i>
                                <strong><?php echo $t['stat_models']; ?></strong>
                                <span><?php echo $t['stat_models_u']; ?></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="products-hero__stat">
                                <i class="fa-solid fa-award"></i>
                                <strong><?php echo $t['stat_years']; ?></strong>
                                <span><?php echo $t['stat_years_u']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?php echo $catalogLink; ?>" target="_blank" class="btn btn-danger btn-lg rounded-0 px-4 shadow-sm">
                            <i class="fa-solid fa-file-pdf me-2"></i><?php echo $t['cta_catalog']; ?>
                        </a>
                        <a href="<?php echo $whatsappLink; ?>" target="_blank" class="btn btn-success btn-lg rounded-0 px-4 shadow-sm">
                            <i class="fa-brands fa-whatsapp me-2"></i><?php echo $t['cta_whatsapp']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $myPage->renderWidgets('main_before'); ?>

    <!-- ===== PRODUCT CARDS ===== -->
    <div class="content py-5">
        <div class="container">

            <?php if(!empty($myPage->text)){ ?>
                <div class="intro-text mb-5 text-center" style="max-width: 800px; margin: 0 auto;">
                    <?php echo $myPage->text; ?>
                </div>
            <?php } ?>

            <?php if(!empty($articles)){ ?>
                <div class="row g-4">
                    <?php foreach($articles as $index => $article){
                        $alias = $article->alias ?? '';
                        $meta = $productMeta[$alias] ?? ['icon' => 'fa-industry', 'color' => '#333', 'gradient' => 'linear-gradient(135deg, #333 0%, #666 100%)'];
                        $modCount = $modelCounts[$alias] ?? 0;
                        $articleUrl = DOCBASE . $langTag . '/' . $myPage->alias . '/' . $alias;
                        $type = $productTypes[$alias][$langTag] ?? '';
                        $features = $productFeatures[$alias][$langTag] ?? [];

                        // Card image: prefer card/ directory, fallback to medium/
                        $cardImgPath = '';
                        if (!empty($article->images)) {
                            $img = $article->images[0];
                            $cardFile = 'medias/article/card/' . $img['id'] . '/' . $img['file'];
                            $mediumFile = 'medias/article/medium/' . $img['id'] . '/' . $img['file'];
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $cardFile)) {
                                $cardImgPath = $cardFile;
                            } else {
                                $cardImgPath = $mediumFile;
                            }
                        }
                    ?>
                        <div class="col-lg-4 col-md-6 products-card-col" style="--anim-delay: <?php echo $index * 0.1; ?>s;">
                            <a href="<?php echo $articleUrl; ?>" class="text-decoration-none d-block h-100">
                                <div class="products-card h-100" style="--card-color: <?php echo $meta['color']; ?>;">
                                    <?php if($cardImgPath){ ?>
                                        <div class="products-card__image">
                                            <img src="<?php echo DOCBASE . $cardImgPath; ?>" 
                                                 alt="<?php echo htmlspecialchars($article->title); ?>"
                                                 width="640" height="480"
                                                 loading="lazy">
                                            <div class="products-card__overlay" style="background: <?php echo $meta['gradient']; ?>;"></div>
                                            <?php if($type){ ?>
                                                <span class="products-card__type-badge"><?php echo $type; ?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="products-card__icon-hero" style="background: <?php echo $meta['gradient']; ?>;">
                                            <i class="fa-solid <?php echo $meta['icon']; ?>"></i>
                                            <?php if($type){ ?>
                                                <span class="products-card__type-badge"><?php echo $type; ?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                    <div class="products-card__body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="products-card__icon-sm" style="background: <?php echo $meta['color']; ?>;">
                                                <i class="fa-solid <?php echo $meta['icon']; ?> text-white"></i>
                                            </div>
                                            <h3 class="products-card__title mb-0">
                                                <?php echo htmlspecialchars($article->title); ?>
                                            </h3>
                                        </div>

                                        <?php if(!empty($article->subtitle) || $modCount > 0){ ?>
                                            <div class="products-card__badges">
                                                <?php if(!empty($article->subtitle)){ ?>
                                                    <span class="products-card__badge-cap" style="--badge-color: <?php echo $meta['color']; ?>;">
                                                        <i class="fa-solid fa-gauge-high me-1"></i><?php echo htmlspecialchars($article->subtitle); ?>
                                                    </span>
                                                <?php } ?>
                                                <?php if($modCount > 0){ ?>
                                                    <span class="products-card__badge-mod">
                                                        <?php echo $modCount; ?> <?php echo $t['models']; ?>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>

                                        <?php if(!empty($features)){ ?>
                                            <ul class="products-card__features">
                                                <?php foreach($features as $feat){ ?>
                                                    <li><i class="fa-solid fa-check"></i> <?php echo $feat; ?></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                        <div class="products-card__cta">
                                            <span class="btn btn-sm rounded-0 px-3 py-2 fw-bold" style="background: var(--card-color); color: #fff;">
                                                <?php echo $t['view_details']; ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <!-- ===== COMPARISON TABLE ===== -->
    <?php if(!empty($articles)){ ?>
    <section class="products-compare py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2" style="color: #1a1a2e;"><?php echo $t['compare_title']; ?></h2>
                <p class="text-muted"><?php echo $t['compare_sub']; ?></p>
            </div>
            <div class="table-responsive">
                <table class="table products-compare__table align-middle mb-0">
                    <thead>
                        <tr>
                            <th><?php echo $t['col_line']; ?></th>
                            <th><?php echo $t['col_type']; ?></th>
                            <th><?php echo $t['col_capacity']; ?></th>
                            <th class="text-center"><?php echo $t['col_models']; ?></th>
                            <th class="text-center"><?php echo $t['col_action']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($articles as $article){
                            $alias = $article->alias ?? '';
                            $meta = $productMeta[$alias] ?? ['icon' => 'fa-industry', 'color' => '#333'];
                            $modCount = $modelCounts[$alias] ?? 0;
                            $type = $productTypes[$alias][$langTag] ?? '—';
                            $articleUrl = DOCBASE . $langTag . '/' . $myPage->alias . '/' . $alias;
                        ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="products-card__icon-sm me-2" style="background: <?php echo $meta['color']; ?>; width: 32px; height: 32px; border-radius: 6px;">
                                        <i class="fa-solid <?php echo $meta['icon']; ?> text-white" style="font-size: 0.75rem;"></i>
                                    </div>
                                    <strong><?php echo htmlspecialchars($article->title); ?></strong>
                                </div>
                            </td>
                            <td><span class="badge rounded-0" style="background: <?php echo $meta['color']; ?>15; color: <?php echo $meta['color']; ?>; border: 1px solid <?php echo $meta['color']; ?>30;"><?php echo $type; ?></span></td>
                            <td><?php echo !empty($article->subtitle) ? htmlspecialchars($article->subtitle) : '—'; ?></td>
                            <td class="text-center"><?php echo $modCount > 0 ? $modCount : '—'; ?></td>
                            <td class="text-center">
                                <a href="<?php echo $articleUrl; ?>" class="btn btn-sm rounded-0 px-3" style="background: <?php echo $meta['color']; ?>; color: #fff;">
                                    <?php echo $t['view_details']; ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- ===== DIFFERENTIALS ===== -->
    <section class="products-diff py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" style="color: #1a1a2e;"><?php echo $t['diff_title']; ?></h2>
            <div class="row g-4">
                <?php
                $diffIcons = ['fa-flag', 'fa-shield-halved', 'fa-headset', 'fa-sliders'];
                for ($d = 1; $d <= 4; $d++) { ?>
                <div class="col-lg-3 col-md-6">
                    <div class="products-diff__card text-center h-100">
                        <div class="products-diff__icon">
                            <i class="fa-solid <?php echo $diffIcons[$d-1]; ?>"></i>
                        </div>
                        <h5 class="fw-bold mb-2"><?php echo $t["diff_{$d}_title"]; ?></h5>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;"><?php echo $t["diff_{$d}_desc"]; ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- ===== BOTTOM CTA ===== -->
    <section class="products-cta-bottom" style="background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%); color: white;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <h3 class="fw-bold mb-2"><?php echo $t['cta_bottom']; ?></h3>
                    <p class="mb-0" style="opacity: 0.85;"><?php echo $t['cta_bottom_sub']; ?></p>
                </div>
                <div class="col-lg-5 text-lg-end">
                    <a href="<?php echo $whatsappLink; ?>" target="_blank" class="btn btn-success btn-lg rounded-0 px-4 shadow me-2 mb-2">
                        <i class="fa-brands fa-whatsapp me-2"></i><?php echo $t['cta_bottom_btn']; ?>
                    </a>
                    <a href="<?php echo $catalogLink; ?>" target="_blank" class="btn btn-outline-light btn-lg rounded-0 px-4 mb-2">
                        <i class="fa-solid fa-file-pdf me-2"></i><?php echo $t['cta_catalog']; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php $myPage->renderWidgets('main_after'); ?>

</section>

<style>
/* ===== Hero ===== */
.products-hero { min-height: 340px; }
.products-hero__pattern {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%;
    background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.04) 1px, transparent 0);
    background-size: 40px 40px;
}
.products-hero__stat {
    display: flex; flex-direction: column; align-items: center;
    background: rgba(255,255,255,0.08); border-radius: 8px;
    padding: 12px 8px; text-align: center; backdrop-filter: blur(4px);
    border: 1px solid rgba(255,255,255,0.1);
}
.products-hero__stat i { font-size: 1.1rem; color: var(--highlight-color, #ed2f31); margin-bottom: 4px; }
.products-hero__stat strong { font-size: 1.3rem; line-height: 1.2; }
.products-hero__stat span { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.8; }

/* ===== Product Cards ===== */
.products-card-col {
    animation: prodCardIn 0.5s ease both;
    animation-delay: var(--anim-delay, 0s);
}
@keyframes prodCardIn {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.products-card {
    background: #fff; border-radius: 12px; overflow: hidden;
    box-shadow: 0 2px 20px rgba(0,0,0,0.07);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    border: 1px solid #eee; cursor: pointer;
    display: flex; flex-direction: column;
}
.products-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.13);
}
.products-card__image {
    position: relative; overflow: hidden; height: 240px;
}
.products-card__image img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.6s ease;
}
.products-card:hover .products-card__image img { transform: scale(1.06); }
.products-card__overlay {
    position: absolute; bottom: 0; left: 0; right: 0; height: 60%; opacity: 0.35;
    pointer-events: none;
}
.products-card__type-badge {
    position: absolute; top: 12px; right: 12px;
    background: rgba(0,0,0,0.65); color: #fff;
    font-size: 0.7rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: 1px; padding: 4px 10px; border-radius: 4px;
    backdrop-filter: blur(4px);
}
.products-card__icon-hero {
    display: flex; align-items: center; justify-content: center;
    height: 200px; position: relative;
}
.products-card__icon-hero i { font-size: 4rem; color: rgba(255,255,255,0.15); }
.products-card__body {
    padding: 20px; flex: 1; display: flex; flex-direction: column;
}
.products-card__icon-sm {
    width: 36px; height: 36px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-right: 12px;
}
.products-card__icon-sm i { font-size: 0.85rem; }
.products-card__title {
    font-size: 1.05rem; font-weight: 700; color: #1a1a2e;
}
.products-card__badges { margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 6px; }
.products-card__badge-cap {
    display: inline-block; font-size: 0.75rem; font-weight: 600; padding: 3px 8px;
    background: color-mix(in srgb, var(--badge-color) 12%, transparent);
    color: var(--badge-color); border: 1px solid color-mix(in srgb, var(--badge-color) 20%, transparent);
    border-radius: 2px;
}
.products-card__badge-mod {
    display: inline-block; font-size: 0.75rem; font-weight: 500; padding: 3px 8px;
    background: #f0f0f0; color: #555; border-radius: 2px;
}
.products-card__features {
    list-style: none; padding: 0; margin: 0 0 12px 0; flex: 1;
}
.products-card__features li {
    font-size: 0.82rem; color: #555; padding: 3px 0;
}
.products-card__features li i {
    color: var(--card-color); font-size: 0.65rem; margin-right: 6px; width: 14px; text-align: center;
}
.products-card__cta { margin-top: auto; }
.products-card__cta .btn { transition: all 0.3s ease; }
.products-card:hover .products-card__cta .btn {
    filter: brightness(1.1); box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateX(4px);
}

/* ===== Comparison Table ===== */
.products-compare__table {
    background: #fff; border-radius: 12px; overflow: hidden;
    box-shadow: 0 2px 16px rgba(0,0,0,0.06);
}
.products-compare__table thead th {
    background: #1a1a2e; color: #fff; font-weight: 600;
    font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;
    padding: 14px 16px; border: none;
}
.products-compare__table tbody td {
    padding: 14px 16px; border-bottom: 1px solid #f0f0f0;
    font-size: 0.9rem; vertical-align: middle;
}
.products-compare__table tbody tr:last-child td { border-bottom: none; }
.products-compare__table tbody tr:hover { background: #fafafa; }

/* ===== Differentials ===== */
.products-diff__card {
    padding: 30px 20px; border-radius: 12px;
    background: #fff; box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    border: 1px solid #f0f0f0; transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.products-diff__card:hover {
    transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1);
}
.products-diff__icon {
    width: 60px; height: 60px; border-radius: 50%;
    background: linear-gradient(135deg, #971B26 0%, #ed2f31 100%);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
}
.products-diff__icon i { font-size: 1.3rem; color: #fff; }

/* ===== Bottom CTA ===== */
.products-cta-bottom { position: relative; overflow: hidden; }
.products-cta-bottom::before {
    content: ''; position: absolute; top: -50%; right: -10%;
    width: 400px; height: 400px; border-radius: 50%;
    background: rgba(255,255,255,0.03);
}

/* ===== Responsive ===== */
@media (max-width: 767px) {
    .products-hero__stat { padding: 8px 6px; }
    .products-hero__stat strong { font-size: 1.1rem; }
    .products-hero__stat span { font-size: 0.65rem; }
    .products-card__image { height: 200px; }
    .products-compare__table { font-size: 0.82rem; }
    .products-compare__table thead th,
    .products-compare__table tbody td { padding: 10px 12px; }
}
</style>
