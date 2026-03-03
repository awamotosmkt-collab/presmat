<?php

namespace Pandao\Services;

use Pandao\Models\Page;
use Pandao\Common\Utils\StrUtils;
use Pandao\Services\WidgetService;
use \PDO;

class PageService
{
    protected $pms_db;
    protected $siteContext;
    protected $widgetService;

    public function __construct($db, $siteContext)
    {
        $this->pms_db = $db;
        $this->siteContext = $siteContext;
        $this->widgetService = new WidgetService($db, $siteContext);
    }

    public function getAllPages()
    {
        $pages = [];
        $parents = [];

        $stmt = $this->pms_db->prepare('SELECT * FROM pm_page
                                        WHERE (checked = 1 OR checked = 0) 
                                            AND lang = :lang 
                                            AND (show_langs IS NULL OR show_langs = \'\' OR show_langs REGEXP \'(^|,):lang(,|$)\') 
                                            AND (hide_langs IS NULL OR hide_langs = \'\' OR hide_langs NOT REGEXP \'(^|,):lang(,|$)\')
                                        ORDER BY `rank`');
        $stmt->execute(['lang' => PMS_LANG_ID]);

        if ($stmt !== false) {
            $pageFileStmt = $this->pms_db->prepare('SELECT * FROM pm_page_file
                                                    WHERE id_item = :page_id
                                                        AND checked = 1 AND lang = :lang
                                                        AND `type` = \'image\' 
                                                        AND file != \'\' 
                                                    ORDER BY `rank`');
            
            $pageCommentStmt = $this->pms_db->prepare('SELECT * 
                                                       FROM pm_comment 
                                                       WHERE id_item = :page_id 
                                                         AND item_type = \'page\' 
                                                         AND checked = 1 
                                                       ORDER BY add_date DESC');
            
            foreach ($stmt as $row) {
                $pageFileStmt->execute(['page_id' => $row['id'], 'lang' => PMS_LANG_ID]);
                $row['images'] = $pageFileStmt->fetchAll(PDO::FETCH_ASSOC);
                
                $pageCommentStmt->execute(['page_id' => $row['id']]);
                $itemComments = $pageCommentStmt->fetchAll(PDO::FETCH_ASSOC);
        
                $row['num_comments'] = count($itemComments);
                $row['comments'] = $itemComments;
        
                $page = new Page($this->pms_db, $this->siteContext);
                $page->populateProperties($row);
        
                $lang_tag = PMS_LANG_ENABLED ? PMS_LANG_TAG . '/' : '';
                $page->path = DOCBASE . $lang_tag . StrUtils::textFormat($page->alias);
                
                $page->images = $row['images'];
                $page->itemComments = $row['comments'];
                $page->num_comments = $row['num_comments'];
        
                $pages[$row['id']] = $page;
                $parents[$row['id_parent']][] = $row['id'];
            }
        }

        return ['pages' => $pages, 'parents' => $parents];
    }

    public function getPage($identifier)
    {
        foreach ($this->siteContext->allPages as $page) {
            if (is_numeric($identifier) && $page->id === $identifier)
                return $page;
            elseif (is_string($identifier) && $page->alias === $identifier)
                return $page;
        }
        return null;
    }

    public function getHomePage()
    {
        foreach ($this->siteContext->allPages as $page) {
            if ($page->home == 1) return $page;
        }
        return null;
    }

    public function getTopPageId()
    {
        $curr_page_id = $this->siteContext->currentPage->id;
        $top_page_id = $curr_page_id;

        if($curr_page_id > 0){
            $parent_id = $this->siteContext->allPages[$curr_page_id]->id_parent;

            while(!empty($parent_id) && isset($this->siteContext->allPages[$parent_id])){
                $top_page_id = $parent_id;
                $parent_id = $this->siteContext->allPages[$parent_id]->id_parent;
            }
        }
        return $top_page_id;
    }
}
