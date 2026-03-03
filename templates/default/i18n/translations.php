<?php
/**
 * Centralized Translation Dictionary — PRESSMATIK
 * 
 * All UI text translations for PT, EN, ES in one place.
 * Usage: $t = require __DIR__ . '/translations.php'; echo $t('key', $langTag);
 * 
 * Returns a closure: function(string $key, string $lang = 'pt'): string
 */

declare(strict_types=1);

$_translations = [

    // ==============================
    // GLOBAL / SHARED
    // ==============================
    'view_details'      => ['pt' => 'Ver Detalhes',         'en' => 'View Details',         'es' => 'Ver Detalles'],
    'cta_catalog'       => ['pt' => 'Catálogo Geral',       'en' => 'General Catalog',      'es' => 'Catálogo General'],
    'cta_whatsapp'      => ['pt' => 'Falar com Especialista','en' => 'Talk to a Specialist', 'es' => 'Hablar con un Especialista'],
    'capacity'          => ['pt' => 'Capacidade',            'en' => 'Capacity',             'es' => 'Capacidad'],
    'models'            => ['pt' => 'modelos',               'en' => 'models',               'es' => 'modelos'],
    'read_more'         => ['pt' => 'Saiba Mais',            'en' => 'Read More',            'es' => 'Leer Más'],
    'back'              => ['pt' => 'Voltar',                'en' => 'Back',                 'es' => 'Volver'],
    'contact_us'        => ['pt' => 'Fale Conosco',          'en' => 'Contact Us',           'es' => 'Contáctenos'],
    'send'              => ['pt' => 'Enviar',                'en' => 'Send',                 'es' => 'Enviar'],
    'close'             => ['pt' => 'Fechar',                'en' => 'Close',                'es' => 'Cerrar'],

    // ==============================
    // PRODUCTS PAGE
    // ==============================
    'products.hero_sub'       => ['pt' => 'Soluções completas em conformação de metais para a indústria', 'en' => 'Complete metal forming solutions for the industry', 'es' => 'Soluciones completas de conformación de metales para la industria'],
    'products.stat_range'     => ['pt' => '25–1.500',   'en' => '25–1,500',   'es' => '25–1.500'],
    'products.stat_range_u'   => ['pt' => 'toneladas',  'en' => 'tons',       'es' => 'toneladas'],
    'products.stat_lines'     => ['pt' => '5',           'en' => '5',          'es' => '5'],
    'products.stat_lines_u'   => ['pt' => 'linhas de prensas', 'en' => 'press lines', 'es' => 'líneas de prensas'],
    'products.stat_models'    => ['pt' => '23+',         'en' => '23+',        'es' => '23+'],
    'products.stat_models_u'  => ['pt' => 'configurações', 'en' => 'configurations', 'es' => 'configuraciones'],
    'products.stat_years'     => ['pt' => '30+',         'en' => '30+',        'es' => '30+'],
    'products.stat_years_u'   => ['pt' => 'anos de experiência', 'en' => 'years of experience', 'es' => 'años de experiencia'],
    'products.compare_title'  => ['pt' => 'Comparativo Rápido', 'en' => 'Quick Comparison', 'es' => 'Comparación Rápida'],
    'products.compare_sub'    => ['pt' => 'Compare as características principais de cada linha', 'en' => 'Compare the main features of each line', 'es' => 'Compare las características principales de cada línea'],
    'products.col_line'       => ['pt' => 'Linha',       'en' => 'Line',       'es' => 'Línea'],
    'products.col_type'       => ['pt' => 'Tipo',        'en' => 'Type',       'es' => 'Tipo'],
    'products.col_capacity'   => ['pt' => 'Capacidade',  'en' => 'Capacity',   'es' => 'Capacidad'],
    'products.col_models'     => ['pt' => 'Modelos',     'en' => 'Models',     'es' => 'Modelos'],
    'products.col_action'     => ['pt' => 'Ação',        'en' => 'Action',     'es' => 'Acción'],
    'products.diff_title'     => ['pt' => 'Por que escolher a Pressmatik?', 'en' => 'Why choose Pressmatik?', 'es' => '¿Por qué elegir Pressmatik?'],
    'products.diff_1_title'   => ['pt' => 'Engenharia Nacional', 'en' => 'National Engineering', 'es' => 'Ingeniería Nacional'],
    'products.diff_1_desc'    => ['pt' => 'Projeto e fabricação 100% brasileiros com padrão internacional', 'en' => '100% Brazilian design and manufacturing with international standards', 'es' => 'Diseño y fabricación 100% brasileños con estándar internacional'],
    'products.diff_2_title'   => ['pt' => 'Conforme NR-12', 'en' => 'Safety Compliant', 'es' => 'Conforme NR-12'],
    'products.diff_2_desc'    => ['pt' => 'Todas as prensas atendem às normas de segurança vigentes', 'en' => 'All presses meet current safety regulations', 'es' => 'Todas las prensas cumplen las normas de seguridad vigentes'],
    'products.diff_3_title'   => ['pt' => 'Assistência Técnica', 'en' => 'Technical Support', 'es' => 'Asistencia Técnica'],
    'products.diff_3_desc'    => ['pt' => 'Suporte especializado em todo o Brasil e América Latina', 'en' => 'Specialized support throughout Brazil and Latin America', 'es' => 'Soporte especializado en todo Brasil y América Latina'],
    'products.diff_4_title'   => ['pt' => 'Personalização', 'en' => 'Customization', 'es' => 'Personalización'],
    'products.diff_4_desc'    => ['pt' => 'Soluções sob medida para cada aplicação industrial', 'en' => 'Tailored solutions for each industrial application', 'es' => 'Soluciones a medida para cada aplicación industrial'],
    'products.cta_bottom'     => ['pt' => 'Precisa de ajuda para escolher a prensa ideal?', 'en' => 'Need help choosing the right press?', 'es' => '¿Necesita ayuda para elegir la prensa ideal?'],
    'products.cta_bottom_sub' => ['pt' => 'Nossa equipe de engenharia está pronta para especificar a melhor solução para sua aplicação.', 'en' => 'Our engineering team is ready to specify the best solution for your application.', 'es' => 'Nuestro equipo de ingeniería está listo para especificar la mejor solución para su aplicación.'],
    'products.cta_bottom_btn' => ['pt' => 'Solicitar Consultoria', 'en' => 'Request Consultation', 'es' => 'Solicitar Consultoría'],

    // Product type badges
    'product_type.mecanica'   => ['pt' => 'Mecânica',    'en' => 'Mechanical',  'es' => 'Mecánica'],
    'product_type.hidraulica' => ['pt' => 'Hidráulica',  'en' => 'Hydraulic',   'es' => 'Hidráulica'],
    'product_type.automacao'  => ['pt' => 'Automação',   'en' => 'Automation',  'es' => 'Automatización'],

    // ==============================
    // ARTICLE-PRODUCTS PAGE
    // ==============================
    'article.specifications' => ['pt' => 'Especificações Técnicas', 'en' => 'Technical Specifications', 'es' => 'Especificaciones Técnicas'],
    'article.features'      => ['pt' => 'Características',          'en' => 'Features',                 'es' => 'Características'],
    'article.gallery'       => ['pt' => 'Galeria',                  'en' => 'Gallery',                  'es' => 'Galería'],
    'article.download_pdf'  => ['pt' => 'Baixar Catálogo PDF',      'en' => 'Download PDF Catalog',     'es' => 'Descargar Catálogo PDF'],
    'article.request_quote' => ['pt' => 'Solicitar Orçamento',      'en' => 'Request Quote',            'es' => 'Solicitar Presupuesto'],
    'article.related'       => ['pt' => 'Produtos Relacionados',    'en' => 'Related Products',         'es' => 'Productos Relacionados'],
    'article.see_all'       => ['pt' => 'Ver Todos os Produtos',    'en' => 'See All Products',         'es' => 'Ver Todos los Productos'],

    // ==============================
    // HOME PAGE
    // ==============================
    'home.hero_tag'          => ['pt' => 'Engenharia Industrial',    'en' => 'Industrial Engineering',   'es' => 'Ingeniería Industrial'],
    'home.hero_title'        => ['pt' => 'A Força Confiável Por Trás das', 'en' => 'The Reliable Force Behind', 'es' => 'La Fuerza Confiable Detrás de las'],
    'home.hero_highlight'    => ['pt' => 'Linhas de Produção',       'en' => 'Production Lines',         'es' => 'Líneas de Producción'],
    'home.hero_subtitle'     => [
        'pt' => 'Prensas mecânicas e hidráulicas com potência, precisão e suporte técnico especializado para conformação de metais.',
        'en' => 'Mechanical and hydraulic presses with power, precision and specialized technical support for metal forming.',
        'es' => 'Prensas mecánicas e hidráulicas con potencia, precisión y soporte técnico especializado para conformación de metales.',
    ],
    'home.cta_products'      => ['pt' => 'Ver Linha de Prensas',     'en' => 'View Press Lines',         'es' => 'Ver Líneas de Prensas'],
    'home.cta_contact'       => ['pt' => 'Falar com Especialista',   'en' => 'Talk to a Specialist',     'es' => 'Hablar con un Especialista'],
    'home.products_tag'      => ['pt' => 'NOSSAS LINHAS',            'en' => 'OUR LINES',                'es' => 'NUESTRAS LÍNEAS'],
    'home.products_title'    => ['pt' => 'Linhas de Prensas',        'en' => 'Press Lines',              'es' => 'Líneas de Prensas'],
    'home.about_tag'         => ['pt' => 'QUEM SOMOS',               'en' => 'ABOUT US',                 'es' => 'QUIÉNES SOMOS'],
    'home.about_title'       => ['pt' => 'Tradição e Inovação em Conformação de Metais', 'en' => 'Tradition and Innovation in Metal Forming', 'es' => 'Tradición e Innovación en Conformación de Metales'],
    'home.about_text'        => [
        'pt' => 'Empresa brasileira sediada em Araraquara-SP com mais de 30 anos de experiência no desenvolvimento e fabricação de prensas mecânicas, hidráulicas e unidades de transferência para conformação de metais. Nossa infraestrutura própria de mais de 5.000m² nos permite entregar soluções robustas e personalizadas.',
        'en' => 'Brazilian company headquartered in Araraquara-SP with over 30 years of experience in the development and manufacturing of mechanical presses, hydraulic presses and transfer units for metal forming. Our own infrastructure of over 5,000m² allows us to deliver robust and customized solutions.',
        'es' => 'Empresa brasileña con sede en Araraquara-SP con más de 30 años de experiencia en el desarrollo y fabricación de prensas mecánicas, hidráulicas y unidades de transferencia para conformación de metales. Nuestra infraestructura propia de más de 5.000m² nos permite entregar soluciones robustas y personalizadas.',
    ],
    'home.about_cta'         => ['pt' => 'Conheça Nossa História',   'en' => 'Learn Our Story',          'es' => 'Conozca Nuestra Historia'],
    'home.sectors_tag'       => ['pt' => 'SETORES ATENDIDOS',        'en' => 'SECTORS SERVED',            'es' => 'SECTORES ATENDIDOS'],

    // ==============================
    // FOOTER
    // ==============================
    'footer.contact_title'   => ['pt' => 'Fale Conosco',     'en' => 'Contact Us',           'es' => 'Contáctenos'],
    'footer.products_title'  => ['pt' => 'Linhas de Prensas','en' => 'Press Lines',           'es' => 'Líneas de Prensas'],
    'footer.downloads_title' => ['pt' => 'Downloads',        'en' => 'Downloads',             'es' => 'Descargas'],
    'footer.downloads'       => [
        'pt' => ['Catálogo Geral', 'Catálogos de Prensas', 'Tabelas Técnicas'],
        'en' => ['General Catalog', 'Press Catalogs', 'Technical Tables'],
        'es' => ['Catálogo General', 'Catálogos de Prensas', 'Tablas Técnicas'],
    ],
    'footer.about_title'     => ['pt' => 'Qualidade Garantida','en' => 'Guaranteed Quality',  'es' => 'Calidad Garantizada'],
    'footer.about_text'      => [
        'pt' => 'Mais de 30 anos de experiência em conformação de metais. Atendemos todo o Brasil e América Latina com equipe especializada.',
        'en' => 'Over 30 years of experience in metal forming. We serve all of Brazil and Latin America with a specialized team.',
        'es' => 'Más de 30 años de experiencia en conformación de metales. Atendemos todo Brasil y América Latina con un equipo especializado.',
    ],
    'footer.products_page'   => ['pt' => 'produtos', 'en' => 'products', 'es' => 'productos'],
    'footer.products'        => [
        'pt' => [
            ['name' => 'Linha PMC (25-300 ton)', 'alias' => 'linha-pmc'],
            ['name' => 'Linha PMCD (100-600 ton)', 'alias' => 'linha-pmcd'],
            ['name' => 'Linha PMH (50-1000 ton)', 'alias' => 'linha-pmh'],
            ['name' => 'Linha PM4C (200-1500 ton)', 'alias' => 'linha-pm4c'],
            ['name' => 'Unidades de Transferência', 'alias' => 'unidades-transferencia'],
        ],
        'en' => [
            ['name' => 'PMC Line (25-300 ton)', 'alias' => 'linha-pmc'],
            ['name' => 'PMCD Line (100-600 ton)', 'alias' => 'linha-pmcd'],
            ['name' => 'PMH Line (50-1000 ton)', 'alias' => 'linha-pmh'],
            ['name' => 'PM4C Line (200-1500 ton)', 'alias' => 'linha-pm4c'],
            ['name' => 'Transfer Units', 'alias' => 'unidades-transferencia'],
        ],
        'es' => [
            ['name' => 'Línea PMC (25-300 ton)', 'alias' => 'linha-pmc'],
            ['name' => 'Línea PMCD (100-600 ton)', 'alias' => 'linha-pmcd'],
            ['name' => 'Línea PMH (50-1000 ton)', 'alias' => 'linha-pmh'],
            ['name' => 'Línea PM4C (200-1500 ton)', 'alias' => 'linha-pm4c'],
            ['name' => 'Unidades de Transferencia', 'alias' => 'unidades-transferencia'],
        ],
    ],

    // WhatsApp float
    'whatsapp.tooltip'  => ['pt' => 'Fale conosco!', 'en' => 'Chat with us!', 'es' => '¡Chatea con nosotros!'],
];

/**
 * Translation helper function.
 * Returns the translation for the given key and language, with fallback to 'pt' then to the key itself.
 *
 * @param string $key   Translation key (e.g., 'products.hero_sub')
 * @param string $lang  Language tag ('pt', 'en', 'es')
 * @return mixed        Translated string or array (for complex keys like footer.products)
 */
return function (string $key, string $lang = 'pt') use ($_translations) {
    if (!isset($_translations[$key])) {
        return $key; // Fallback: return the key itself
    }
    // Try requested language, fallback to pt, then en, then first available
    return $_translations[$key][$lang]
        ?? $_translations[$key]['pt']
        ?? $_translations[$key]['en']
        ?? reset($_translations[$key])
        ?: $key;
};
