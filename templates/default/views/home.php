<?php

use Pandao\Core\Services\AssetsManager;
use Pandao\Services\SiteContext;

AssetsManager::addCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
AssetsManager::addCss('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
AssetsManager::addJs('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
AssetsManager::addCss('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

$siteContext = SiteContext::get();
$langTag = $siteContext->lang_tag ?? 'pt';

// ============================================
// TRANSLATION DICTIONARY
// ============================================
$copy = [
    'pt' => [
        'hero_tag' => 'Engenharia Industrial',
        'hero_title' => 'A Força Confiável Por Trás das',
        'hero_title_highlight' => 'Linhas de Produção',
        'hero_subtitle' => 'Prensas mecânicas e hidráulicas com potência, precisão e suporte técnico especializado para conformação de metais.',
        'cta_products' => 'Ver Linha de Prensas',
        'cta_catalog' => 'Baixar Catálogo',
        'cta_contact' => 'Falar com Especialista',
        
        'products_tag' => 'NOSSAS LINHAS',
        'products_title' => 'Linhas de Prensas',
        'products' => [
            ['name' => 'Linha PMC', 'tonnage' => '25 - 300 ton', 'desc' => 'Prensas mecânicas tipo C para corte, estampagem e dobra de alta precisão.', 'icon' => 'fa-c', 'alias' => 'linha-pmc'],
            ['name' => 'Linha PMCD', 'tonnage' => '100 - 600 ton', 'desc' => 'Prensas mecânicas de duplo montante para ferramentas progressivas e conformação pesada.', 'icon' => 'fa-arrows-left-right-to-line', 'alias' => 'linha-pmcd'],
            ['name' => 'Linha PMH', 'tonnage' => '50 - 1000 ton', 'desc' => 'Prensas hidráulicas com controle preciso de força e velocidade para repuxo e calibração.', 'icon' => 'fa-droplet', 'alias' => 'linha-pmh'],
            ['name' => 'Linha PM4C', 'tonnage' => '200 - 1500 ton', 'desc' => 'Prensas de 4 colunas para peças grandes e conformação automotiva.', 'icon' => 'fa-table-cells', 'alias' => 'linha-pm4c'],
            ['name' => 'Unidades de Transferência', 'tonnage' => 'Sob Medida', 'desc' => 'Sistemas de automação para linhas de prensas, incluindo transfers automáticos e alimentadores.', 'icon' => 'fa-robot', 'alias' => 'unidades-transferencia'],
        ],
        'products_page' => 'produtos',
        
        'about_tag' => 'QUEM SOMOS',
        'about_title' => 'Tradição e Inovação em Conformação de Metais',
        'about_text' => 'Empresa brasileira sediada em Araraquara-SP com mais de 30 anos de experiência no desenvolvimento e fabricação de prensas mecânicas, hidráulicas e unidades de transferência para conformação de metais. Nossa infraestrutura própria de mais de 5.000m² nos permite entregar soluções robustas e personalizadas.',
        'about_cta' => 'Conheça Nossa História',
        
        'stats' => [
            ['number' => '30+', 'label' => 'Anos de Experiência'],
            ['number' => '500+', 'label' => 'Máquinas Instaladas'],
            ['number' => '200+', 'label' => 'Clientes Ativos'],
            ['number' => '15+', 'label' => 'Estados Atendidos'],
        ],
        
        'sectors_tag' => 'SETORES ATENDIDOS',
        'sectors_title' => 'Aplicações Industriais',
        'sectors' => [
            ['name' => 'Automotivo', 'desc' => 'Estampagem de chassis e carroceria', 'icon' => 'fa-car'],
            ['name' => 'Autopeças', 'desc' => 'Peças de suspensão, suportes e fixadores', 'icon' => 'fa-gears'],
            ['name' => 'Linha Branca', 'desc' => 'Gabinetes e componentes internos', 'icon' => 'fa-box'],
            ['name' => 'Metalurgia Geral', 'desc' => 'Corte, dobra e repuxo diversos', 'icon' => 'fa-industry'],
            ['name' => 'Eletrônicos', 'desc' => 'Componentes de precisão e carcaças', 'icon' => 'fa-microchip'],
            ['name' => 'Construção Civil', 'desc' => 'Perfis metálicos e esquadrias', 'icon' => 'fa-building'],
        ],
        
        'diff_tag' => 'DIFERENCIAIS',
        'diff_title' => 'Por Que Escolher a PRESSMATIK',
        'differentiators' => [
            ['title' => 'Engenharia Própria', 'desc' => 'Soluções personalizadas para suas necessidades específicas.', 'icon' => 'fa-drafting-compass'],
            ['title' => 'Robustez Comprovada', 'desc' => 'Equipamentos construídos para operação contínua em ambientes exigentes.', 'icon' => 'fa-shield-halved'],
            ['title' => 'Segurança NR-12', 'desc' => 'Todas as máquinas em conformidade com as normas brasileiras de segurança.', 'icon' => 'fa-check-circle'],
            ['title' => 'Logística Própria', 'desc' => 'Frota própria e equipes especializadas de instalação.', 'icon' => 'fa-truck'],
            ['title' => 'Pós-Venda Ativo', 'desc' => 'Suporte contínuo com peças de reposição e contratos de manutenção.', 'icon' => 'fa-headset'],
        ],
    ],
    'en' => [
        'hero_tag' => 'Industrial Engineering',
        'hero_title' => 'The Reliable Force Behind',
        'hero_title_highlight' => 'Production Lines',
        'hero_subtitle' => 'Mechanical and hydraulic presses with power, precision, and specialized technical support for metal forming.',
        'cta_products' => 'View Press Lines',
        'cta_catalog' => 'Download Catalog',
        'cta_contact' => 'Talk to a Specialist',
        
        'products_tag' => 'OUR LINES',
        'products_title' => 'Press Lines',
        'products' => [
            ['name' => 'PMC Line', 'tonnage' => '25 - 300 ton', 'desc' => 'C-frame mechanical presses for high-precision cutting, stamping, and bending.', 'icon' => 'fa-c', 'alias' => 'linha-pmc'],
            ['name' => 'PMCD Line', 'tonnage' => '100 - 600 ton', 'desc' => 'Double-side mechanical presses for progressive tools and heavy forming.', 'icon' => 'fa-arrows-left-right-to-line', 'alias' => 'linha-pmcd'],
            ['name' => 'PMH Line', 'tonnage' => '50 - 1000 ton', 'desc' => 'Hydraulic presses with precise force/speed control for deep drawing and calibration.', 'icon' => 'fa-droplet', 'alias' => 'linha-pmh'],
            ['name' => 'PM4C Line', 'tonnage' => '200 - 1500 ton', 'desc' => '4-column presses for large parts and automotive forming.', 'icon' => 'fa-table-cells', 'alias' => 'linha-pm4c'],
            ['name' => 'Transfer Units', 'tonnage' => 'Custom', 'desc' => 'Automation systems for press lines, including automatic transfers and coil feeders.', 'icon' => 'fa-robot', 'alias' => 'unidades-transferencia'],
        ],
        'products_page' => 'products',
        
        'about_tag' => 'ABOUT US',
        'about_title' => 'Tradition and Innovation in Metal Forming',
        'about_text' => 'A Brazilian company based in Araraquara-SP with over 30 years of experience in developing and manufacturing mechanical presses, hydraulic presses, and transfer units for metal forming. Our own infrastructure of over 5,000m² allows us to deliver robust and customized solutions.',
        'about_cta' => 'Learn Our Story',
        
        'stats' => [
            ['number' => '30+', 'label' => 'Years of Experience'],
            ['number' => '500+', 'label' => 'Machines Installed'],
            ['number' => '200+', 'label' => 'Active Clients'],
            ['number' => '15+', 'label' => 'States Served'],
        ],
        
        'sectors_tag' => 'SECTORS SERVED',
        'sectors_title' => 'Industrial Applications',
        'sectors' => [
            ['name' => 'Automotive', 'desc' => 'Chassis and body stamping', 'icon' => 'fa-car'],
            ['name' => 'Auto Parts', 'desc' => 'Suspension parts, supports, and fasteners', 'icon' => 'fa-gears'],
            ['name' => 'Home Appliances', 'desc' => 'Cabinets and internal components', 'icon' => 'fa-box'],
            ['name' => 'General Metallurgical', 'desc' => 'Cutting, bending, and drawing', 'icon' => 'fa-industry'],
            ['name' => 'Electronics', 'desc' => 'Precision components and housings', 'icon' => 'fa-microchip'],
            ['name' => 'Civil Construction', 'desc' => 'Metal profiles and frames', 'icon' => 'fa-building'],
        ],
        
        'diff_tag' => 'DIFFERENTIATORS',
        'diff_title' => 'Why Choose PRESSMATIK',
        'differentiators' => [
            ['title' => 'Own Engineering', 'desc' => 'Custom solutions tailored to your specific needs.', 'icon' => 'fa-drafting-compass'],
            ['title' => 'Proven Robustness', 'desc' => 'Equipment built for continuous operation in demanding environments.', 'icon' => 'fa-shield-halved'],
            ['title' => 'NR-12 Safety', 'desc' => 'All machines comply with Brazilian safety standards.', 'icon' => 'fa-check-circle'],
            ['title' => 'Own Logistics', 'desc' => 'Own fleet and specialized installation teams.', 'icon' => 'fa-truck'],
            ['title' => 'Active Post-Sales', 'desc' => 'Ongoing support with spare parts and maintenance contracts.', 'icon' => 'fa-headset'],
        ],
    ],
    'es' => [
        'hero_tag' => 'Ingeniería Industrial',
        'hero_title' => 'La Fuerza Confiable Detrás de las',
        'hero_title_highlight' => 'Líneas de Producción',
        'hero_subtitle' => 'Prensas mecánicas e hidráulicas con potencia, precisión y soporte técnico especializado para conformación de metales.',
        'cta_products' => 'Ver Línea de Prensas',
        'cta_catalog' => 'Descargar Catálogo',
        'cta_contact' => 'Hablar con Especialista',
        
        'products_tag' => 'NUESTRAS LÍNEAS',
        'products_title' => 'Líneas de Prensas',
        'products' => [
            ['name' => 'Línea PMC', 'tonnage' => '25 - 300 ton', 'desc' => 'Prensas mecánicas tipo C para corte, estampado y doblado de alta precisión.', 'icon' => 'fa-c', 'alias' => 'linha-pmc'],
            ['name' => 'Línea PMCD', 'tonnage' => '100 - 600 ton', 'desc' => 'Prensas mecánicas de doble montante para herramientas progresivas y conformación pesada.', 'icon' => 'fa-arrows-left-right-to-line', 'alias' => 'linha-pmcd'],
            ['name' => 'Línea PMH', 'tonnage' => '50 - 1000 ton', 'desc' => 'Prensas hidráulicas con control preciso de fuerza y velocidad para embutión y calibración.', 'icon' => 'fa-droplet', 'alias' => 'linha-pmh'],
            ['name' => 'Línea PM4C', 'tonnage' => '200 - 1500 ton', 'desc' => 'Prensas de 4 columnas para piezas grandes y conformación automotriz.', 'icon' => 'fa-table-cells', 'alias' => 'linha-pm4c'],
            ['name' => 'Unidades de Transferencia', 'tonnage' => 'A Medida', 'desc' => 'Sistemas de automatización para líneas de prensas, incluyendo transfers automáticos y alimentadores.', 'icon' => 'fa-robot', 'alias' => 'unidades-transferencia'],
        ],
        'products_page' => 'productos',
        
        'about_tag' => 'QUIÉNES SOMOS',
        'about_title' => 'Tradición e Innovación en Conformación de Metales',
        'about_text' => 'Empresa brasileña con sede en Araraquara-SP con más de 30 años de experiencia en desarrollo y fabricación de prensas mecánicas, hidráulicas y unidades de transferencia para conformación de metales. Nuestra infraestructura propia de más de 5.000m² nos permite entregar soluciones robustas y personalizadas.',
        'about_cta' => 'Conozca Nuestra Historia',
        
        'stats' => [
            ['number' => '30+', 'label' => 'Años de Experiencia'],
            ['number' => '500+', 'label' => 'Máquinas Instaladas'],
            ['number' => '200+', 'label' => 'Clientes Activos'],
            ['number' => '15+', 'label' => 'Estados Atendidos'],
        ],
        
        'sectors_tag' => 'SECTORES ATENDIDOS',
        'sectors_title' => 'Aplicaciones Industriales',
        'sectors' => [
            ['name' => 'Automotriz', 'desc' => 'Estampado de chasis y carrocería', 'icon' => 'fa-car'],
            ['name' => 'Autopartes', 'desc' => 'Piezas de suspensión, soportes y fijadores', 'icon' => 'fa-gears'],
            ['name' => 'Línea Blanca', 'desc' => 'Gabinetes y componentes internos', 'icon' => 'fa-box'],
            ['name' => 'Metalurgia General', 'desc' => 'Corte, doblado y embutión diversos', 'icon' => 'fa-industry'],
            ['name' => 'Electrónicos', 'desc' => 'Componentes de precisión y carcasas', 'icon' => 'fa-microchip'],
            ['name' => 'Construcción Civil', 'desc' => 'Perfiles metálicos y marcos', 'icon' => 'fa-building'],
        ],
        
        'diff_tag' => 'DIFERENCIALES',
        'diff_title' => 'Por Qué Elegir PRESSMATIK',
        'differentiators' => [
            ['title' => 'Ingeniería Propia', 'desc' => 'Soluciones personalizadas para sus necesidades específicas.', 'icon' => 'fa-drafting-compass'],
            ['title' => 'Robustez Comprobada', 'desc' => 'Equipos construidos para operación continua en ambientes exigentes.', 'icon' => 'fa-shield-halved'],
            ['title' => 'Seguridad NR-12', 'desc' => 'Todas las máquinas cumplen con las normas brasileñas de seguridad.', 'icon' => 'fa-check-circle'],
            ['title' => 'Logística Propia', 'desc' => 'Flota propia y equipos especializados de instalación.', 'icon' => 'fa-truck'],
            ['title' => 'Posventa Activo', 'desc' => 'Soporte continuo con repuestos y contratos de mantenimiento.', 'icon' => 'fa-headset'],
        ],
    ],
];

$t = $copy[$langTag] ?? $copy['pt'];
?>

<!-- Hero Section -->
<section class="hero-static d-flex align-items-center" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 120px 0; color: white; position: relative; overflow: hidden;">
    <div class="hero-bg-pattern" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><circle cx=\"50\" cy=\"50\" r=\"1\" fill=\"rgba(255,255,255,0.03)\"/></svg>'); background-size: 50px 50px; opacity: 0.5;"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h5 class="text-uppercase text-danger mb-3 font-weight-bold" style="letter-spacing: 3px; font-size: 0.9rem;"><?php echo htmlspecialchars($t['hero_tag']); ?></h5>
                <h1 class="display-3 font-weight-bold mb-4" style="line-height: 1.1;">
                    <?php echo htmlspecialchars($t['hero_title']); ?> <span class="text-danger"><?php echo htmlspecialchars($t['hero_title_highlight']); ?></span>
                </h1>
                <p class="lead mb-5" style="opacity: 0.9; font-size: 1.25rem; max-width: 600px;"><?php echo htmlspecialchars($t['hero_subtitle']); ?></p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo DOCBASE . $langTag . '/' . ($t['products_page'] ?? 'produtos'); ?>" class="btn btn-danger btn-lg px-4 py-3 rounded-0"><?php echo htmlspecialchars($t['cta_products']); ?></a>
                    <a href="<?php echo DOCBASE . $langTag; ?>/downloads" class="btn btn-outline-light btn-lg px-4 py-3 rounded-0"><?php echo htmlspecialchars($t['cta_catalog']); ?></a>
                    <a href="<?php echo DOCBASE . $langTag; ?>/contact" class="btn btn-light btn-lg px-4 py-3 rounded-0 text-dark"><?php echo htmlspecialchars($t['cta_contact']); ?></a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                <div class="hero-icon-wrapper" style="position: relative;">
                    <i class="fa-solid fa-gears" style="font-size: 280px; color: rgba(255,255,255,0.08);"></i>
                    <i class="fa-solid fa-industry" style="font-size: 120px; color: var(--highlight-color); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section py-4" style="background: var(--main-color);">
    <div class="container">
        <div class="row text-center text-white">
            <?php foreach ($t['stats'] as $stat): ?>
            <div class="col-6 col-md-3 py-3">
                <h2 class="display-4 font-weight-bold mb-0"><?php echo htmlspecialchars($stat['number']); ?></h2>
                <p class="mb-0 text-uppercase" style="font-size: 0.85rem; opacity: 0.9;"><?php echo htmlspecialchars($stat['label']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Product Lines Section -->
<section class="products-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['products_tag']); ?></h5>
                <h2 class="mb-4 text-dark display-5"><?php echo htmlspecialchars($t['products_title']); ?></h2>
                <div class="divider bg-danger mx-auto" style="width: 60px; height: 3px;"></div>
            </div>
        </div>
        <div class="row g-4">
            <?php
            $prodPage = $t['products_page'] ?? 'produtos';
            foreach ($t['products'] as $product):
                $productUrl = DOCBASE . $langTag . '/' . $prodPage . '/' . $product['alias'];
            ?>
            <div class="col-md-6 col-lg-4">
                <a href="<?php echo $productUrl; ?>" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm hover-lift" style="border-radius: 8px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box me-3" style="width: 50px; height: 50px; background: var(--main-color); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid <?php echo htmlspecialchars($product['icon']); ?> text-white fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 text-dark"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <small class="text-danger font-weight-bold"><?php echo htmlspecialchars($product['tonnage']); ?></small>
                            </div>
                        </div>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($product['desc']); ?></p>
                        <div class="mt-3 text-danger">
                            <small class="fw-bold"><?php echo ($langTag === 'en') ? 'View Details' : (($langTag === 'es') ? 'Ver Detalles' : 'Ver Detalhes'); ?> <i class="fa-solid fa-arrow-right ms-1"></i></small>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['about_tag']); ?></h5>
                <h2 class="mb-4 display-5"><?php echo htmlspecialchars($t['about_title']); ?></h2>
                <p class="lead text-muted mb-4"><?php echo htmlspecialchars($t['about_text']); ?></p>
                <a href="<?php echo DOCBASE . $langTag; ?>/empresa" class="btn btn-dark rounded-0 px-4 py-3"><?php echo htmlspecialchars($t['about_cta']); ?></a>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <?php foreach (array_slice($t['stats'], 0, 4) as $stat): ?>
                    <div class="col-6">
                        <div class="p-4 bg-light rounded text-center border">
                            <h3 class="display-5 font-weight-bold text-danger mb-1"><?php echo htmlspecialchars($stat['number']); ?></h3>
                            <p class="mb-0 text-muted text-uppercase small"><?php echo htmlspecialchars($stat['label']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sectors Section -->
<section class="sectors-section py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['sectors_tag']); ?></h5>
                <h2 class="mb-4 text-dark display-5"><?php echo htmlspecialchars($t['sectors_title']); ?></h2>
                <div class="divider bg-danger mx-auto" style="width: 60px; height: 3px;"></div>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($t['sectors'] as $sector): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4" style="border-radius: 8px;">
                    <div class="card-body">
                        <div class="icon-circle mb-3 mx-auto" style="width: 70px; height: 70px; background: rgba(151, 27, 38, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid <?php echo htmlspecialchars($sector['icon']); ?> fa-2x text-danger"></i>
                        </div>
                        <h5 class="mb-2"><?php echo htmlspecialchars($sector['name']); ?></h5>
                        <p class="text-muted mb-0 small"><?php echo htmlspecialchars($sector['desc']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Differentiators Section -->
<section class="differentiators-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h5 class="text-danger text-uppercase mb-2" style="letter-spacing: 2px;"><?php echo htmlspecialchars($t['diff_tag']); ?></h5>
                <h2 class="mb-4 text-dark display-5"><?php echo htmlspecialchars($t['diff_title']); ?></h2>
                <div class="divider bg-danger mx-auto" style="width: 60px; height: 3px;"></div>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($t['differentiators'] as $index => $diff): ?>
            <div class="col-md-6 col-lg-<?php echo ($index < 3) ? '4' : '6'; ?>">
                <div class="d-flex align-items-start p-4 bg-white rounded shadow-sm hover-lift h-100">
                    <div class="icon-box me-3 flex-shrink-0" style="width: 50px; height: 50px; background: var(--main-color); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid <?php echo htmlspecialchars($diff['icon']); ?> text-white"></i>
                    </div>
                    <div>
                        <h5 class="mb-2"><?php echo htmlspecialchars($diff['title']); ?></h5>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($diff['desc']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Widgets -->
<?php $myPage->renderWidgets('main_before'); ?>
<?php // $myPage->renderWidgets('main_after'); ?>
