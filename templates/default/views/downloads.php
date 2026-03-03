<?php
debug_backtrace() || die("Direct access not permitted");

// Downloads page template - shows categorized file downloads
echo '<!-- downloads.php template -->';
?>

<section id="page" class="downloads-page">
    
    <?php require_once __DIR__ . '/partials/page_header.php'; ?>
    
    <?php $myPage->renderWidgets('main_before'); ?>

    <div class="content section-padding">
        <div class="container">

            <?php if(!empty($myPage->text)){ ?>
                <div class="intro-text mb-5 text-center">
                    <?php echo $myPage->text; ?>
                </div>
            <?php } ?>

            <!-- Downloads from Google Drive -->
            <?php
            $langTag = $siteContext->lang_tag ?? 'pt';
            $driveFolder = 'https://drive.google.com/drive/folders/1SnvFrVDrzrw_WWMhgXsYB6DAqe14NleD?usp=sharing';
            $catalogFolder = 'https://drive.google.com/drive/folders/1gF9vEBxNxxlKfO5AEnSWRwTXDCB5i545';
            $tableFolder = 'https://drive.google.com/drive/folders/12H7rux8PX865Gk8EO4DON2ihbqoKsM1-';
            
            // UI Translations
            $downloadsUi = [
               'pt' => [
                   'catalog_title' => 'Cat\u00e1logos de Prensas',
                   'catalog_desc' => 'Baixe o cat\u00e1logo completo de cada linha de prensas em formato PDF.',
                   'table_title' => 'Tabelas T\u00e9cnicas',
                   'table_desc' => 'Tabelas de especifica\u00e7\u00f5es t\u00e9cnicas com modelos, dimens\u00f5es e capacidades.',
                   'general_title' => 'Cat\u00e1logo Geral',
                   'general_desc' => 'Cat\u00e1logo completo com todas as linhas de prensas Pressmatik.',
                   'btn_download' => 'Baixar',
                   'btn_folder' => 'Ver Pasta',
                   'request_title' => 'Precisa de um arquivo espec\u00edfico?',
                   'request_desc' => 'Entre em contato e enviaremos o material t\u00e9cnico para sua aplica\u00e7\u00e3o.',
                   'request_btn' => 'Solicitar Material',
               ],
               'en' => [
                   'catalog_title' => 'Press Catalogs',
                   'catalog_desc' => 'Download the full catalog for each press line in PDF format.',
                   'table_title' => 'Technical Tables',
                   'table_desc' => 'Technical specification tables with models, dimensions and capacities.',
                   'general_title' => 'General Catalog',
                   'general_desc' => 'Complete catalog with all Pressmatik press lines.',
                   'btn_download' => 'Download',
                   'btn_folder' => 'View Folder',
                   'request_title' => 'Need a specific document?',
                   'request_desc' => 'Contact us and we will send the technical material for your application.',
                   'request_btn' => 'Request Material',
               ],
               'es' => [
                   'catalog_title' => 'Cat\u00e1logos de Prensas',
                   'catalog_desc' => 'Descargue el cat\u00e1logo completo de cada l\u00ednea de prensas en formato PDF.',
                   'table_title' => 'Tablas T\u00e9cnicas',
                   'table_desc' => 'Tablas de especificaciones t\u00e9cnicas con modelos, dimensiones y capacidades.',
                   'general_title' => 'Cat\u00e1logo General',
                   'general_desc' => 'Cat\u00e1logo completo con todas las l\u00edneas de prensas Pressmatik.',
                   'btn_download' => 'Descargar',
                   'btn_folder' => 'Ver Carpeta',
                   'request_title' => '\u00bfNecesita un archivo espec\u00edfico?',
                   'request_desc' => 'Cont\u00e1ctenos y le enviaremos el material t\u00e9cnico para su aplicaci\u00f3n.',
                   'request_btn' => 'Solicitar Material',
               ],
            ];
            $dt = $downloadsUi[$langTag] ?? $downloadsUi['pt'];
            
            $product_catalogs = [
                ['name' => 'PMC',  'file' => '1.PMC.pdf',  'desc' => '25 - 300 T'],
                ['name' => 'PMCD', 'file' => '2.PMCD.pdf', 'desc' => '100 - 600 T'],
                ['name' => 'PMH',  'file' => '5. PMH.pdf', 'desc' => '50 - 1000 T'],
                ['name' => 'PM4C', 'file' => '6. PM4C.pdf','desc' => '200 - 1500 T'],
                ['name' => ($langTag === 'en') ? 'Transfer Units' : 'Unidades de Transfer\u00eancia',
                 'file' => '7. UNIDADE DE TRANSFER\u00caNCIA.pdf', 'desc' => ''],
            ];
            ?>

            <!-- General Catalog -->
            <div class="downloads-section mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3><?php echo $dt['general_title']; ?></h3>
                        <p class="text-muted"><?php echo $dt['general_desc']; ?></p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="<?php echo $driveFolder; ?>" target="_blank" class="btn btn-danger btn-lg rounded-0 px-4">
                            <i class="fa-solid fa-folder-open me-2"></i><?php echo $dt['btn_folder']; ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product Catalogs -->
            <div class="downloads-section mb-5">
                <h3 class="mb-2"><?php echo $dt['catalog_title']; ?></h3>
                <p class="text-muted mb-4"><?php echo $dt['catalog_desc']; ?></p>
                <div class="row g-3">
                    <?php foreach($product_catalogs as $cat){ ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="download-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="d-flex align-items-start">
                                    <div class="me-3" style="flex-shrink:0;">
                                        <i class="fa-solid fa-file-pdf fa-2x text-danger"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($cat['name']); ?></h5>
                                        <?php if($cat['desc']){ ?>
                                            <p class="text-muted small mb-2"><?php echo htmlspecialchars($cat['desc']); ?></p>
                                        <?php } ?>
                                        <a href="<?php echo $catalogFolder; ?>" target="_blank" class="btn btn-sm btn-outline-danger rounded-0">
                                            <i class="fa-solid fa-download me-1"></i><?php echo $dt['btn_download']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Technical Tables -->
            <div class="downloads-section mb-5">
                <h3 class="mb-2"><?php echo $dt['table_title']; ?></h3>
                <p class="text-muted mb-4"><?php echo $dt['table_desc']; ?></p>
                <div class="row g-3">
                    <?php foreach($product_catalogs as $cat){ ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="download-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="d-flex align-items-start">
                                    <div class="me-3" style="flex-shrink:0;">
                                        <i class="fa-solid fa-file-excel fa-2x text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($cat['name']); ?></h5>
                                        <a href="<?php echo $tableFolder; ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-0">
                                            <i class="fa-solid fa-download me-1"></i><?php echo $dt['btn_download']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Contact for specific material -->
            <div class="downloads-request text-center p-5 bg-light rounded">
                <i class="fa-solid fa-envelope fa-2x mb-3 text-primary"></i>
                <h4><?php echo $dt['request_title']; ?></h4>
                <p class="text-muted"><?php echo $dt['request_desc']; ?></p>
                <a href="<?php echo DOCBASE . $langTag; ?>/contact" class="btn btn-primary rounded-0 px-4">
                    <?php echo $dt['request_btn']; ?>
                </a>
            </div>

        </div>
    </div>

    <?php $myPage->renderWidgets('main_after'); ?>

</section>
