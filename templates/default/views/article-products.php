<?php
/**
 * Article Products Template — PRESSMATIK
 * Template for individual press line product pages
 * Used when article_model = 'article-products' on the parent page
 */

use Pandao\Core\Services\AssetsManager;
use Pandao\Services\SiteContext;

AssetsManager::addCss(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.css');
AssetsManager::addJs(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.js');
AssetsManager::addCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
AssetsManager::addCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
AssetsManager::addJs('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');

$siteContext = SiteContext::get();
$langTag = $siteContext->lang_tag ?? 'pt';

// Dynamic SEO overrides
$seoDescriptions = [
    'linha-pmc' => [
        'pt' => 'Prensas Mecânicas Tipo C de 25 a 300 toneladas. Alta performance para estamparia, corte e conformação. 8 modelos disponíveis. Solicite orçamento!',
        'en' => 'C-Frame Mechanical Presses from 25 to 300 tons. High performance for stamping, cutting and forming. 8 models available. Request a quote!',
        'es' => 'Prensas Mecánicas Tipo C de 25 a 300 toneladas. Alto rendimiento para estampado, corte y conformación. 8 modelos disponibles. ¡Solicite presupuesto!',
    ],
    'linha-pmcd' => [
        'pt' => 'Prensas Duplo Montante de 100 a 600 toneladas. Robustez e precisão para estamparia progressiva e pesada. 6 modelos disponíveis.',
        'en' => 'Double Column Presses from 100 to 600 tons. Robustness and precision for progressive and heavy stamping. 6 models available.',
        'es' => 'Prensas Doble Columna de 100 a 600 toneladas. Robustez y precisión para estampado progresivo y pesado. 6 modelos disponibles.',
    ],
    'linha-pmh' => [
        'pt' => 'Prensas Hidráulicas de 50 a 1000 toneladas. Versatilidade para repuxo, conformação e operações especiais. 5 modelos disponíveis.',
        'en' => 'Hydraulic Presses from 50 to 1000 tons. Versatility for deep drawing, forming and special operations. 5 models available.',
        'es' => 'Prensas Hidráulicas de 50 a 1000 toneladas. Versatilidad para embutiçión, conformación y operaciones especiales. 5 modelos disponibles.',
    ],
    'linha-pm4c' => [
        'pt' => 'Prensas Quatro Colunas de 200 a 1500 toneladas. Máxima capacidade para estampagem pesada e transfer. 4 modelos disponíveis.',
        'en' => 'Four Column Presses from 200 to 1500 tons. Maximum capacity for heavy stamping and transfer operations. 4 models available.',
        'es' => 'Prensas Cuatro Columnas de 200 a 1500 toneladas. Máxima capacidad para estampado pesado y transfer. 4 modelos disponibles.',
    ],
    'unidades-transferencia' => [
        'pt' => 'Unidades de Transferência PRESSMATIK. Sistemas automatizados para alimentação e movimentação de peças em linhas de prensas.',
        'en' => 'PRESSMATIK Transfer Units. Automated systems for part feeding and handling in press lines.',
        'es' => 'Unidades de Transferencia PRESSMATIK. Sistemas automatizados para alimentación y manipulación de piezas en líneas de prensas.',
    ],
];

$articleAlias = $myArticle->alias ?? '';
if (isset($seoDescriptions[$articleAlias][$langTag]) && isset($myView)) {
    $myView->descr = htmlentities($seoDescriptions[$articleAlias][$langTag], ENT_QUOTES);
}

// Trilingual UI labels
$ui = [
    'pt' => [
        'specs_title'       => 'Especificações Técnicas',
        'models_title'      => 'Modelos Disponíveis',
        'gallery_title'     => 'Galeria',
        'download_catalog'  => 'Baixar Catálogo Completo',
        'download_table'    => 'Ver Tabela Técnica',
        'contact_title'     => 'Solicite um Orçamento',
        'contact_desc'      => 'Nossa equipe de engenharia está pronta para especificar a prensa ideal para sua aplicação.',
        'contact_btn'       => 'Falar com Especialista',
        'back_to_products'  => 'Voltar para Produtos',
        'related_title'     => 'Outras Linhas de Prensas',
        'tonnage_label'     => 'Capacidade',
        'type_label'        => 'Tipo',
        'application_label' => 'Aplicação',
        'view_details'      => 'Ver Detalhes',
    ],
    'en' => [
        'specs_title'       => 'Technical Specifications',
        'models_title'      => 'Available Models',
        'gallery_title'     => 'Gallery',
        'download_catalog'  => 'Download Full Catalog',
        'download_table'    => 'View Technical Table',
        'contact_title'     => 'Request a Quote',
        'contact_desc'      => 'Our engineering team is ready to specify the ideal press for your application.',
        'contact_btn'       => 'Talk to a Specialist',
        'back_to_products'  => 'Back to Products',
        'related_title'     => 'Other Press Lines',
        'tonnage_label'     => 'Capacity',
        'type_label'        => 'Type',
        'application_label' => 'Application',
        'view_details'      => 'View Details',
    ],
    'es' => [
        'specs_title'       => 'Especificaciones Técnicas',
        'models_title'      => 'Modelos Disponibles',
        'gallery_title'     => 'Galería',
        'download_catalog'  => 'Descargar Catálogo Completo',
        'download_table'    => 'Ver Tabla Técnica',
        'contact_title'     => 'Solicite un Presupuesto',
        'contact_desc'      => 'Nuestro equipo de ingeniería está listo para especificar la prensa ideal para su aplicación.',
        'contact_btn'       => 'Hablar con Especialista',
        'back_to_products'  => 'Volver a Productos',
        'related_title'     => 'Otras Líneas de Prensas',
        'tonnage_label'     => 'Capacidad',
        'type_label'        => 'Tipo',
        'application_label' => 'Aplicación',
        'view_details'      => 'Ver Detalles',
    ],
];

$t = $ui[$langTag] ?? $ui['pt'];

// Product catalog data
$catalogFolder = 'https://drive.google.com/drive/folders/1gF9vEBxNxxlKfO5AEnSWRwTXDCB5i545';
$tableFolder   = 'https://drive.google.com/drive/folders/12H7rux8PX865Gk8EO4DON2ihbqoKsM1-';

$productData = [
    'linha-pmc' => [
        'icon'        => 'fa-c',
        'color'       => '#971B26',
        'catalog'     => $catalogFolder,
        'catalogFile' => '1.PMC.pdf',
        'table'       => $tableFolder,
        'tablePrefix' => 'A',
        'models'  => [
            ['code' => 'PMC-ST', 'tableFile' => 'A1-PMC-ST.pdf', 'name' => ['pt' => 'Standard', 'en' => 'Standard', 'es' => 'Estándar']],
            ['code' => 'PMC-SM', 'tableFile' => 'A2 PMC-SM.pdf', 'name' => ['pt' => 'Semimontante', 'en' => 'Semi-frame', 'es' => 'Semi-montante']],
            ['code' => 'PMC-BC', 'tableFile' => 'A3 - PMC-BC.pdf', 'name' => ['pt' => 'Bancada Compacta', 'en' => 'Compact Bench', 'es' => 'Bancada Compacta']],
            ['code' => 'PMC-GT', 'tableFile' => 'A4 - PMC-GT.pdf', 'name' => ['pt' => 'Garganta Profunda', 'en' => 'Gap Frame', 'es' => 'Garganta Profunda']],
            ['code' => 'PMC-TR', 'tableFile' => 'A5 - PMC-TR.pdf', 'name' => ['pt' => 'Tração', 'en' => 'Draw', 'es' => 'Tracción']],
            ['code' => 'PMC-MT', 'tableFile' => 'A6 - PMC-MT.pdf', 'name' => ['pt' => 'Montante', 'en' => 'Frame', 'es' => 'Montante']],
            ['code' => 'PMC-AL', 'tableFile' => 'A7 - PMC-AL.pdf', 'name' => ['pt' => 'Alimentador', 'en' => 'Feeder', 'es' => 'Alimentador']],
            ['code' => 'PMC-HZ', 'tableFile' => 'A8 - PMC-HZ.pdf', 'name' => ['pt' => 'Horizontal', 'en' => 'Horizontal', 'es' => 'Horizontal']],
        ],
    ],
    'linha-pmcd' => [
        'icon'        => 'fa-arrows-left-right-to-line',
        'color'       => '#1a1a2e',
        'catalog'     => $catalogFolder,
        'catalogFile' => '2.PMCD.pdf',
        'table'       => $tableFolder,
        'tablePrefix' => 'B',
        'models'  => [
            ['code' => 'PMCD-ST', 'tableFile' => 'B1 - PMCD-ST.pdf', 'name' => ['pt' => 'Standard', 'en' => 'Standard', 'es' => 'Estándar']],
            ['code' => 'PMCD-SM', 'tableFile' => 'B2 - PMCD-SM.pdf', 'name' => ['pt' => 'Semimontante', 'en' => 'Semi-frame', 'es' => 'Semi-montante']],
            ['code' => 'PMCD-BC', 'tableFile' => 'B3 - PMCD-BC.pdf', 'name' => ['pt' => 'Bancada Compacta', 'en' => 'Compact Bench', 'es' => 'Bancada Compacta']],
            ['code' => 'PMCD-GT', 'tableFile' => 'B4 - PMCD-GT.pdf', 'name' => ['pt' => 'Garganta Profunda', 'en' => 'Gap Frame', 'es' => 'Garganta Profunda']],
            ['code' => 'PMCD-TR', 'tableFile' => 'B5 - PMCD_TR.pdf', 'name' => ['pt' => 'Tração', 'en' => 'Draw', 'es' => 'Tracción']],
            ['code' => 'PMCD-MT', 'tableFile' => 'B6 PMCD-MT.pdf', 'name' => ['pt' => 'Montante', 'en' => 'Frame', 'es' => 'Montante']],
        ],
    ],
    'linha-pmh' => [
        'icon'        => 'fa-droplet',
        'color'       => '#0f3460',
        'catalog'     => $catalogFolder,
        'catalogFile' => '5. PMH.pdf',
        'table'       => $tableFolder,
        'tablePrefix' => 'C',
        'models'  => [
            ['code' => 'PMH-ST', 'tableFile' => 'C1 - PMH-ST.pdf', 'name' => ['pt' => 'Standard', 'en' => 'Standard', 'es' => 'Estándar']],
            ['code' => 'PMH-PR', 'tableFile' => 'C2-PMH-PR.pdf', 'name' => ['pt' => 'Prensa Rápida', 'en' => 'Fast Press', 'es' => 'Prensa Rápida']],
            ['code' => 'PMH-WP', 'tableFile' => 'C3 - PMH - WP.pdf', 'name' => ['pt' => 'Workshop Press', 'en' => 'Workshop Press', 'es' => 'Prensa de Taller']],
            ['code' => 'PMH-WK', 'tableFile' => 'C4-PMH-WK.pdf', 'name' => ['pt' => 'Workbench', 'en' => 'Workbench', 'es' => 'Banco de Trabajo']],
            ['code' => 'PMH-VB', 'tableFile' => 'C5 - PMH -VB.pdf', 'name' => ['pt' => 'Vibratória', 'en' => 'Vibratory', 'es' => 'Vibratoria']],
        ],
    ],
    'linha-pm4c' => [
        'icon'        => 'fa-table-cells',
        'color'       => '#16213e',
        'catalog'     => $catalogFolder,
        'catalogFile' => '6. PM4C.pdf',
        'table'       => $tableFolder,
        'tablePrefix' => 'D',
        'models'  => [
            ['code' => 'PM4C-ST', 'tableFile' => 'D1 - PM4C-ST.pdf', 'name' => ['pt' => 'Standard', 'en' => 'Standard', 'es' => 'Estándar']],
            ['code' => 'PM4C-RP', 'tableFile' => 'D2 - PM4C-RP.pdf', 'name' => ['pt' => 'Repuxo', 'en' => 'Deep Draw', 'es' => 'Embutiçión']],
            ['code' => 'PM4C-TR', 'tableFile' => 'D3 - PM4C-TR.pdf', 'name' => ['pt' => 'Tryout', 'en' => 'Tryout', 'es' => 'Tryout']],
            ['code' => 'PM4C-TY', 'tableFile' => 'D4 - PM4C - TY.pdf', 'name' => ['pt' => 'Tipo Y', 'en' => 'Y-Type', 'es' => 'Tipo Y']],
        ],
    ],
    'unidades-transferencia' => [
        'icon'        => 'fa-robot',
        'color'       => '#2d4059',
        'catalog'     => $catalogFolder,
        'catalogFile' => '7. UNIDADE DE TRANSFERÊNCIA.pdf',
        'table'       => $tableFolder,
        'tablePrefix' => '',
        'models'  => [],
    ],
];

$alias = $myArticle->alias ?? '';
$data = $productData[$alias] ?? null;
$whatsappBase = 'https://wa.me/5516997646232';

$articleTitle = $myArticle->title ?? '';
$whatsappMessages = [
    'pt' => 'Olá! Gostaria de mais informações sobre a ' . $articleTitle,
    'en' => 'Hello! I would like more information about the ' . $articleTitle,
    'es' => '¡Hola! Me gustaría más información sobre la ' . $articleTitle,
];
$whatsappMsg = $whatsappMessages[$langTag] ?? $whatsappMessages['pt'];
$whatsappLink = $whatsappBase . '?text=' . rawurlencode($whatsappMsg);

$productsAlias = [
    'pt' => 'produtos',
    'en' => 'products',
    'es' => 'productos',
];
$prodAlias = $productsAlias[$langTag] ?? 'produtos';
?>

<article id="page" class="product-detail-page">

    <!-- Product Hero -->
    <section class="product-hero py-5" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($data['color'] ?? '#1a1a2e'); ?> 0%, #0f3460 100%); color: white; position: relative; overflow: hidden;">
        <div class="hero-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;50&quot; cy=&quot;50&quot; r=&quot;1&quot; fill=&quot;rgba(255,255,255,0.03)&quot;/></svg>'); background-size: 50px 50px; opacity: 0.5;"></div>
        <div class="container position-relative">
            <!-- Breadcrumb -->
            <nav class="mb-3">
                <ol class="breadcrumb mb-0" style="background: none;">
                    <li class="breadcrumb-item"><a href="<?php echo DOCBASE . $langTag; ?>/" class="text-white-50 text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?php echo DOCBASE . $langTag . '/' . $prodAlias; ?>" class="text-white-50 text-decoration-none"><?php echo ($langTag === 'en') ? 'Products' : (($langTag === 'es') ? 'Productos' : 'Produtos'); ?></a></li>
                    <li class="breadcrumb-item active text-white"><?php echo htmlspecialchars($myArticle->title); ?></li>
                </ol>
            </nav>

            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center mb-3">
                        <?php if ($data): ?>
                        <div class="product-icon me-3" style="width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid <?php echo htmlspecialchars($data['icon']); ?> fa-xl text-white"></i>
                        </div>
                        <?php endif; ?>
                        <div>
                            <h1 class="display-4 font-weight-bold mb-0"><?php echo htmlspecialchars($myArticle->title); ?></h1>
                        </div>
                    </div>
                    <?php if (!empty($myArticle->subtitle)): ?>
                    <p class="lead mb-4" style="opacity: 0.9; font-size: 1.3rem;">
                        <i class="fa-solid fa-gauge-high me-2"></i><?php echo htmlspecialchars($t['tonnage_label']); ?>: <strong><?php echo htmlspecialchars($myArticle->subtitle); ?></strong>
                    </p>
                    <?php endif; ?>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <?php if ($data && !empty($data['catalog'])): ?>
                        <a href="<?php echo htmlspecialchars($data['catalog']); ?>" target="_blank" class="btn btn-danger btn-lg rounded-0 px-4">
                            <i class="fa-solid fa-file-pdf me-2"></i><?php echo htmlspecialchars($t['download_catalog']); ?>
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo htmlspecialchars($whatsappLink); ?>" target="_blank" class="btn btn-success btn-lg rounded-0 px-4">
                            <i class="fa-brands fa-whatsapp me-2"></i><?php echo htmlspecialchars($t['contact_btn']); ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0 text-center">
                    <?php
                    $img = $myArticle->getMainImage();
                    if (!empty($img)): ?>
                    <img src="<?php echo $img['path']; ?>" alt="<?php echo htmlspecialchars($myArticle->title); ?>" class="img-fluid rounded shadow" style="aspect-ratio: 1320/413; object-fit: cover; background: rgba(255,255,255,0.1); border-radius: 12px !important; width: 100%;">
                    <?php else: ?>
                    <div class="hero-icon-placeholder" style="opacity: 0.15;">
                        <i class="fa-solid <?php echo htmlspecialchars($data['icon'] ?? 'fa-gears'); ?>" style="font-size: 220px;"></i>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="product-content py-5">
        <div class="container">
            <div class="row">
                <!-- Description -->
                <div class="col-lg-8">
                    <?php if (!empty($myArticle->text)): ?>
                    <div class="product-description mb-5">
                        <?php echo $myArticle->text; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Quick Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3"><i class="fa-solid fa-circle-info me-2 text-danger"></i><?php echo htmlspecialchars($t['specs_title']); ?></h5>
                            <ul class="list-unstyled mb-0">
                                <?php if (!empty($myArticle->subtitle)): ?>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted"><?php echo htmlspecialchars($t['tonnage_label']); ?></span>
                                    <strong><?php echo htmlspecialchars($myArticle->subtitle); ?></strong>
                                </li>
                                <?php endif; ?>
                                <?php if ($data && !empty($data['models'])): ?>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted"><?php echo ($langTag === 'en') ? 'Models' : (($langTag === 'es') ? 'Modelos' : 'Modelos'); ?></span>
                                    <strong><?php echo count($data['models']); ?></strong>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Download Card -->
                    <?php if ($data): ?>
                    <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #971B26, #c0392b); color: white;">
                        <div class="card-body p-4 text-center">
                            <i class="fa-solid fa-file-pdf fa-3x mb-3" style="opacity: 0.9;"></i>
                            <h5 class="text-white mb-3"><?php echo htmlspecialchars($t['download_catalog']); ?></h5>
                            <a href="<?php echo htmlspecialchars($data['catalog']); ?>" target="_blank" class="btn btn-light rounded-0 px-4 mb-2 w-100">
                                <i class="fa-solid fa-download me-2"></i><?php echo htmlspecialchars($t['download_catalog']); ?>
                            </a>
                            <?php if (!empty($data['catalogFile'])): ?>
                            <small class="d-block mb-3" style="opacity: 0.8;"><i class="fa-solid fa-file me-1"></i><?php echo htmlspecialchars($data['catalogFile']); ?></small>
                            <?php endif; ?>
                            <a href="<?php echo htmlspecialchars($data['table']); ?>" target="_blank" class="btn btn-outline-light rounded-0 px-4 w-100">
                                <i class="fa-solid fa-table me-2"></i><?php echo htmlspecialchars($t['download_table']); ?>
                            </a>
                            <?php if (!empty($data['tablePrefix'])): ?>
                            <small class="d-block mt-2" style="opacity: 0.8;"><i class="fa-solid fa-folder-open me-1"></i><?php echo ($langTag === 'en') ? 'Files' : (($langTag === 'es') ? 'Archivos' : 'Arquivos'); ?>: <?php echo htmlspecialchars($data['tablePrefix']); ?>1 – <?php echo htmlspecialchars($data['tablePrefix'] . count($data['models'])); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- WhatsApp CTA Card -->
                    <div class="card border-0 shadow-sm" style="background: #25D366; color: white;">
                        <div class="card-body p-4 text-center">
                            <i class="fa-brands fa-whatsapp fa-3x mb-3"></i>
                            <h5 class="text-white mb-2"><?php echo htmlspecialchars($t['contact_title']); ?></h5>
                            <p class="mb-3" style="opacity: 0.9; font-size: 0.9rem;"><?php echo htmlspecialchars($t['contact_desc']); ?></p>
                            <a href="<?php echo htmlspecialchars($whatsappLink); ?>" target="_blank" class="btn btn-light rounded-0 px-4 w-100 text-success fw-bold">
                                <i class="fa-brands fa-whatsapp me-2"></i><?php echo htmlspecialchars($t['contact_btn']); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Models Section -->
    <?php if ($data && !empty($data['models'])): ?>
    <section class="models-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['models_title']); ?></h5>
                    <h2 class="display-6 mb-3"><?php echo htmlspecialchars($myArticle->title); ?></h2>
                    <div class="divider bg-danger mx-auto" style="width: 60px; height: 3px;"></div>
                </div>
            </div>
            <div class="row g-3 justify-content-center">
                <?php foreach ($data['models'] as $model):
                    $modelWhatsappMsg = ($langTag === 'en')
                        ? 'Hello! I would like a quote for the ' . $model['code'] . ' press.'
                        : (($langTag === 'es')
                            ? '¡Hola! Me gustaría un presupuesto para la prensa ' . $model['code'] . '.'
                            : 'Olá! Gostaria de um orçamento para a prensa ' . $model['code'] . '.');
                    $modelWhatsappUrl = $whatsappBase . '?text=' . rawurlencode($modelWhatsappMsg);
                    $tableFileHint = $model['tableFile'] ?? '';
                ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="<?php echo htmlspecialchars($modelWhatsappUrl); ?>" target="_blank" class="text-decoration-none">
                    <div class="model-card text-center p-3 bg-white rounded shadow-sm h-100" style="cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="model-code mb-2" style="font-size: 1.3rem; font-weight: 700; color: <?php echo htmlspecialchars($data['color']); ?>;"><?php echo htmlspecialchars($model['code']); ?></div>
                        <p class="mb-1 text-muted small"><?php echo htmlspecialchars($model['name'][$langTag] ?? $model['name']['pt']); ?></p>
                        <div class="mt-2">
                            <small class="text-success"><i class="fa-brands fa-whatsapp me-1"></i><?php echo ($langTag === 'en') ? 'Request Quote' : (($langTag === 'es') ? 'Solicitar Presupuesto' : 'Solicitar Orçamento'); ?></small>
                        </div>
                        <?php if ($tableFileHint): ?>
                        <div class="mt-1"><small class="text-muted" style="font-size: 0.7rem;"><i class="fa-solid fa-file-pdf me-1"></i><?php echo htmlspecialchars($tableFileHint); ?></small></div>
                        <?php endif; ?>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Image Gallery -->
    <?php
    $imgs = $myArticle->getImages();
    if (count($imgs) > 1): ?>
    <section class="gallery-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['gallery_title']); ?></h5>
                    <div class="divider bg-danger mx-auto" style="width: 60px; height: 3px;"></div>
                </div>
            </div>
            <div class="row g-3">
                <?php for ($i = 1; $i < count($imgs); $i++): ?>
                <div class="col-lg-4 col-md-6">
                    <a href="<?php echo $imgs[$i]['url']; ?>" class="image-link d-block gallery-item">
                        <img src="<?php echo $imgs[$i]['url']; ?>" alt="<?php echo htmlspecialchars($imgs[$i]['label'] ?? $myArticle->title); ?>" class="img-fluid rounded shadow-sm w-100" style="height: 250px; object-fit: cover;">
                    </a>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Related Products -->
    <?php if (!empty($articles)): ?>
    <section class="related-products py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['related_title']); ?></h5>
                    <div class="divider bg-danger mx-auto" style="width: 60px; height: 3px;"></div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <?php foreach ($articles as $relArticle):
                    if ($relArticle->alias === $alias) continue;
                    $relData = $productData[$relArticle->alias] ?? null;
                ?>
                <div class="col-lg-3 col-md-6">
                    <a href="<?php echo DOCBASE . $langTag . '/' . $prodAlias . '/' . $relArticle->alias; ?>" class="text-decoration-none">
                        <div class="card border-0 shadow-sm hover-lift h-100 text-center">
                            <div class="card-body p-4">
                                <div class="mb-3" style="width: 55px; height: 55px; background: <?php echo htmlspecialchars($relData['color'] ?? '#1a1a2e'); ?>; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid <?php echo htmlspecialchars($relData['icon'] ?? 'fa-gears'); ?> text-white fa-lg"></i>
                                </div>
                                <h5 class="text-dark mb-1"><?php echo htmlspecialchars($relArticle->title); ?></h5>
                                <?php if (!empty($relArticle->subtitle)): ?>
                                <p class="text-muted small mb-2"><?php echo htmlspecialchars($relArticle->subtitle); ?></p>
                                <?php endif; ?>
                                <span class="btn btn-sm btn-outline-danger rounded-0 mt-2"><?php echo htmlspecialchars($t['view_details']); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Back to Products -->
    <section class="py-4 text-center">
        <a href="<?php echo DOCBASE . $langTag . '/' . $prodAlias; ?>" class="btn btn-outline-dark rounded-0 px-4">
            <i class="fa-solid fa-arrow-left me-2"></i><?php echo htmlspecialchars($t['back_to_products']); ?>
        </a>
    </section>

</article>

<style>
.product-detail-page .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}
.product-detail-page .product-description h3,
.product-detail-page .product-description h4 {
    color: #1a1a2e;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
}
.product-detail-page .product-description table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}
.product-detail-page .product-description table th,
.product-detail-page .product-description table td {
    padding: 10px 15px;
    border: 1px solid #dee2e6;
    text-align: left;
}
.product-detail-page .product-description table th {
    background: #f8f9fa;
    font-weight: 600;
}
.product-detail-page .product-description table tr:hover {
    background: #f8f9fa;
}
.model-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.model-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
}
.gallery-item {
    transition: transform 0.3s ease;
    overflow: hidden;
    border-radius: 8px;
}
.gallery-item:hover {
    transform: scale(1.02);
}
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}
</style>
