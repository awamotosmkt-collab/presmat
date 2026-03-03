<?php
/**
 * Search Results Page Template
 */

use Pandao\Core\Services\AssetsManager;

AssetsManager::addCss(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.css');
AssetsManager::addJs(DOCBASE . 'assets/js/plugins/lazyloader/lazyloader.js');

$searchQuery = isset($_GET['q']) ? trim(htmlspecialchars($_GET['q'])) : '';
$searchResults = [];

if(!empty($searchQuery) && isset($pms_db)){
    $stmt = $pms_db->prepare("
        SELECT 'page' as type, id, name as title, alias, text, descr as description 
        FROM pm_page 
        WHERE lang = :lang AND checked = 1 
        AND (name LIKE :query OR text LIKE :query OR descr LIKE :query)
        LIMIT 20
    ");
    $stmt->execute(['lang' => PMS_LANG_ID, 'query' => '%' . $searchQuery . '%']);
    $pageResults = $stmt->fetchAll();
    
    $stmt = $pms_db->prepare("
        SELECT 'article' as type, a.id, a.title, a.alias, a.text, a.short_text as description, p.alias as page_alias
        FROM pm_article a
        LEFT JOIN pm_page p ON a.id_page = p.id AND p.lang = a.lang
        WHERE a.lang = :lang AND a.checked = 1 
        AND (a.title LIKE :query OR a.text LIKE :query OR a.short_text LIKE :query)
        LIMIT 20
    ");
    $stmt->execute(['lang' => PMS_LANG_ID, 'query' => '%' . $searchQuery . '%']);
    $articleResults = $stmt->fetchAll();
    
    $searchResults = array_merge($pageResults, $articleResults);
}
?>

<section id="page" class="search-page">
    
    <?php require_once __DIR__ . '/partials/page_header.php'; ?>
    
    <?php $myPage->renderWidgets('main_before'); ?>

    <div class="content section-padding">
        <div class="container">
            
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <form method="get" action="<?php echo $myPage->path; ?>" class="search-form">
                        <div class="input-group input-group-lg">
                            <input type="text" 
                                   class="form-control" 
                                   name="q" 
                                   value="<?php echo $searchQuery; ?>" 
                                   placeholder="<?php echo $siteContext->texts['SEARCH'] ?? 'Buscar...'; ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="search-results">
                <?php if(!empty($searchQuery)){ ?>
                    <h3 class="mb-4">
                        <?php echo $siteContext->texts['SEARCH_RESULTS'] ?? 'Resultados da busca'; ?>: 
                        <strong>"<?php echo $searchQuery; ?>"</strong>
                        <small class="text-muted">(<?php echo count($searchResults); ?> <?php echo $siteContext->texts['RESULTS'] ?? 'resultados'; ?>)</small>
                    </h3>
                    <?php if(!empty($searchResults)){ ?>
                        <div class="results-list">
                            <?php foreach($searchResults as $result){ 
                                if($result['type'] == 'page'){
                                    $url = DOCBASE . PMS_LANG_TAG . '/' . $result['alias'];
                                } else {
                                    $url = DOCBASE . PMS_LANG_TAG . '/' . $result['page_alias'] . '/' . $result['alias'];
                                }
                                $excerpt = strip_tags($result['description'] ?? $result['text']);
                                $excerpt = substr($excerpt, 0, 200) . (strlen($excerpt) > 200 ? '...' : '');
                            ?>
                                <div class="result-item card mb-3">
                                    <div class="card-body">
                                        <span class="badge bg-secondary mb-2">
                                            <?php echo $result['type'] == 'page' ? ($siteContext->texts['PAGE'] ?? 'Página') : ($siteContext->texts['ARTICLE'] ?? 'Artigo'); ?>
                                        </span>
                                        <h5 class="card-title">
                                            <a href="<?php echo $url; ?>"><?php echo htmlspecialchars($result['title']); ?></a>
                                        </h5>
                                        <p class="card-text text-muted"><?php echo $excerpt; ?></p>
                                        <a href="<?php echo $url; ?>" class="btn btn-sm btn-outline-primary">
                                            <?php echo $siteContext->texts['READ_MORE'] ?? 'Ler mais'; ?> <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-info">
                            <i class="fa-solid fa-info-circle"></i>
                            <?php echo $siteContext->texts['NO_RESULTS'] ?? 'Nenhum resultado encontrado para sua busca.'; ?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text-center text-muted">
                        <i class="fa-solid fa-search fa-3x mb-3"></i>
                        <p><?php echo $siteContext->texts['SEARCH_HINT'] ?? 'Digite um termo para buscar em nosso site.'; ?></p>
                    </div>
                <?php } ?>
            </div>
            
        </div>
    </div>

    <?php $myPage->renderWidgets('main_after'); ?>
    
</section>
