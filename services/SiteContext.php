<?php

namespace Pandao\Services;

use Pandao\Services\PageService;
use Pandao\Services\ArticleService;
use Pandao\Services\MenuService;
use Pandao\Services\widgetService;
use Pandao\Common\Utils\StrUtils;
use Pandao\Common\Utils\UrlUtils;
use Pandao\Models\Article;
use Pandao\Models\Page;
use Pandao\Common\Models\LangManager;

class SiteContext
{
    private static $instance = null;

    protected $pms_db;
    protected $pageService;
    protected $articleService;
    protected $menuService;
    protected $widgetService;
    protected $commentService;
    protected $langManager;

    public $currentPage;
    public $currentArticle;
    public $view;
    public $mainMenu;
    public $footerMenu;
    public $allPages = [];
    public $allArticles = [];
    public $allNavItems = [];
    public $parents = [];
    public $texts = [];
    public $socials = [];
    public $langs = [];
    public $languages = [];
    public $lang_tag;

    private function __construct($db)
    {
        $this->pms_db = $db;

        $this->pageService = new PageService($this->pms_db, $this);
        $this->articleService = new ArticleService($this->pms_db, $this);
        $this->menuService = new MenuService($this->pms_db, $this);
        $this->widgetService = new WidgetService($this->pms_db, $this);
        $this->langManager = new LangManager($this->pms_db);
        $this->commentService = new CommentService($this->pms_db);

        $this->loadTexts();
        $this->loadSocials();
        $this->loadAllPages();
        $this->loadAllArticles();
        $this->loadAllNavItems();
        $this->mainMenu = $this->menuService->getTopLevelNavItems('main', $this->allNavItems);
        $this->footerMenu = $this->menuService->getTopLevelNavItems('footer', $this->allNavItems);
        $this->languages = (PMS_LANG_ENABLED) ? $this->langManager->getLanguagesWithImages() : [['id' => 0, 'title' => '', 'image' => '']];
        $this->lang_tag = defined('PMS_LANG_TAG') ? PMS_LANG_TAG : 'pt';
    }

    public static function get($db = null)
    {
        if (self::$instance === null) {
            if ($db === null) {
                throw new \Exception("Database connection is required for the first instance of SiteContext.");
            }
            self::$instance = new self($db);
        }
        return self::$instance;
    }

    private function loadAllPages()
    {
        $result = $this->pageService->getAllPages();
        $this->allPages = $result['pages'];
        $this->parents = $result['parents'];
    }

    private function loadAllArticles()
    {
        $this->allArticles = $this->articleService->getAllArticles(array_keys($this->allPages), $this->allPages);
    }

    private function loadAllNavItems()
    {
        $this->allNavItems = $this->menuService->getAllNavItems();
    }

    private function loadTexts()
    {
        $stmt = $this->pms_db->query('SELECT * FROM pm_text WHERE lang = ' . PMS_LANG_ID . ' ORDER BY id');
        $this->texts = [];
        foreach ($stmt as $row) {
            $this->texts[$row['name']] = $row['value'];
        }
    }

    public function getAlternateLangUrls($object)
    {
        if (!PMS_LANG_ENABLED) {
            return [];
        }

        if ($object instanceof Page) {
            return $this->getAlternateLangUrlsForPage((int)$object->id);
        }

        if ($object instanceof Article) {
            return $this->getAlternateLangUrlsForArticle((int)$object->id);
        }

        return [];
    }

    private function getAlternateLangUrlsForPage($pageId)
    {
        $urls = [];
        $stmt = $this->pms_db->prepare(
            'SELECT l.tag, p.alias, p.home
             FROM pm_page p
             INNER JOIN pm_lang l ON l.id = p.lang AND l.checked = 1
             WHERE p.id = :id AND p.checked = 1'
        );
        $stmt->execute(['id' => $pageId]);

        $host = UrlUtils::getUrl(true);
        foreach ($stmt->fetchAll() as $row) {
            $tag = $row['tag'];
            $alias = $row['alias'] ?? '';
            $home = (int)$row['home'] === 1;

            $path = DOCBASE . $tag . '/';
            if (!$home && $alias !== '') {
                $path .= StrUtils::textFormat($alias);
            }
            $urls[$tag] = $host . $path;
        }

        return $urls;
    }

    private function getAlternateLangUrlsForArticle($articleId)
    {
        $urls = [];
        $stmt = $this->pms_db->prepare(
            'SELECT l.tag, p.alias AS page_alias, a.alias AS article_alias
             FROM pm_article a
             INNER JOIN pm_lang l ON l.id = a.lang AND l.checked = 1
             INNER JOIN pm_page p ON p.id = a.id_page AND p.lang = a.lang AND p.checked = 1
             WHERE a.id = :id AND a.checked = 1'
        );
        $stmt->execute(['id' => $articleId]);

        $host = UrlUtils::getUrl(true);
        foreach ($stmt->fetchAll() as $row) {
            $tag = $row['tag'];
            $pageAlias = $row['page_alias'] ?? '';
            $articleAlias = $row['article_alias'] ?? '';

            if ($pageAlias === '' || $articleAlias === '') {
                continue;
            }

            $path = DOCBASE . $tag . '/' . StrUtils::textFormat($pageAlias) . '/' . StrUtils::textFormat($articleAlias);
            $urls[$tag] = $host . $path;
        }

        return $urls;
    }

    private function loadSocials()
    {
        $this->socials = $this->menuService->getAllSocials();
    }

    public function getPage($identifier)
    {
        return $this->pageService->getPage($identifier);
    }

    public function getArticle($identifier)
    {
        return $this->articleService->getArticle($identifier);
    }

    public function getArticleByAlias($alias)
    {
        return $this->articleService->getArticleByAlias($alias);
    }

    public function getArticlesByPageId($pageId)
    {
        return $this->articleService->getArticlesByPageId($pageId);
    }

    public function getHome()
    {
        return $this->pageService->getHomePage();
    }

    public function getTopPageId()
    {
        $currPageId = $this->currentPage->id;
        return $this->pageService->getTopPageId($currPageId);
    }

    public function getArticles($options = [])
    {
        return $this->articleService->getFilteredArticles($options);
    }

    public function filterArticlesByMonth($articles, $startMonth = null, $endMonth = null)
    {
        return $this->articleService->filterArticlesByMonth($articles, $startMonth, $endMonth);
    }

    public function getArticlesCountByMonth()
    {
        return $this->articleService->getArticlesCountByMonth($this->currentPage->id);
    }

    public function getWidgetService()
    {
        return $this->widgetService;
    }

    public function getCommentService()
    {
        return $this->commentService;
    }

    public function getMenuService()
    {
        return $this->menuService;
    }
}
