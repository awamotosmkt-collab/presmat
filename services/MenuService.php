<?php

namespace Pandao\Services;

use Pandao\Models\NavItem;
use Pandao\Common\Utils\UrlUtils;
use \PDO;

class MenuService
{
    protected $pms_db;
    protected $siteContext;

    public function __construct($db, $siteContext)
    {
        $this->pms_db = $db;
        $this->siteContext = $siteContext;
    }

    public function getAllNavItems()
    {
        $navItems = ['main' => [], 'footer' => []];

        $query = 'SELECT * FROM pm_menu WHERE checked = 1 AND lang = :lang ORDER BY `rank`';
        $stmt = $this->pms_db->prepare($query);
        $stmt->execute(['lang' => PMS_LANG_ID]);
    
        $result = $stmt->fetchAll();
        if ($result !== false) {
            foreach ($result as $row) {
                if ($this->isValidNavItem($row)) {
                    $navItem = new NavItem($row, $this->siteContext);
                    $navItem->populateProperties($row);

                    $href = $navItem->getNavUrl();
                    $navItem->href = $href;
    
                    $target = (strpos($href, 'http') !== false) ? '_blank' : '_self';
                    if (strpos($href, UrlUtils::getUrl(true)) !== false) {
                        $target = '_self';
                    }
                    $navItem->target = $target;
    
                    if ($navItem->main == 1) $navItems['main'][$navItem->id] = $navItem;
                    if ($navItem->footer == 1) $navItems['footer'][$navItem->id] = $navItem;
                }
            }
        }

        return $navItems;
    }

    private function isValidNavItem($row)
    {
        if ($row['item_type'] == 'page') {
            $page = $this->siteContext->getPage($row['id_item']);
            return $page !== null && $page->checked == 1;
        }
        if ($row['item_type'] == 'article') {
            $article = $this->siteContext->getArticle($row['id_item']);
            return $article !== null;
        }
        return in_array($row['item_type'], ['url', 'none']);
    }

    public function getAllSocials()
    {
        $stmt = $this->pms_db->query('SELECT * FROM pm_social WHERE checked = 1 ORDER BY `rank`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuItems($menuType)
    {
        $stmt = $this->pms_db->prepare('SELECT * FROM pm_menu WHERE checked = 1 AND lang = :lang ORDER BY `rank`');
        $stmt->execute(['lang' => PMS_LANG_ID]);
        $navItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($itemData) {
            $navItem = new NavItem($this->pms_db, $this->siteContext);
            $navItem->populateProperties($itemData);
            return $navItem;
        }, $navItems);
    }

    public function getTopLevelNavItems($menuType, array $allNavItems)
    {
        $topLevelItems = [];

        if (isset($allNavItems[$menuType])) {
            foreach ($allNavItems[$menuType] as $navItem) {
                if (empty($navItem->idParent) || (
                    isset($allNavItems[$menuType][$navItem->idParent]) &&
                    $allNavItems[$menuType][$navItem->idParent]->idItem == $this->getHomePage()->id
                )) {
                    $topLevelItems[] = $navItem;
                }
            }
        }

        return $topLevelItems;
    }

    public function getHomePage()
    {
        foreach ($this->siteContext->allPages as $page) {
            if ($page->home == 1) return $page;
        }
        return null;
    }
}
