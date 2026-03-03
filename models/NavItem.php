<?php

namespace Pandao\Models;

class NavItem
{
    protected $pms_db;

    public $id;
    public $title;
    public $name;
    public $alias;
    public $url;
    public $target;
    public $position;
    public $parent_id;
    public $item_type;
    public $page_id;
    public $id_parent;
    public $id_item;
    public $href;
    public $main;
    public $footer;
    public $siteContext;

    public function __construct($db, $siteContext)
    {
        $this->pms_db = $db;
        $this->siteContext = $siteContext;
    }

    public function populateProperties($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getNavUrl()
    {
        if ($this->item_type == 'page') {
            return $this->siteContext->getPage($this->id_item)->path;
        } elseif ($this->item_type == 'article') {
            return $this->siteContext->getArticle($this->id_item)->path;
        } elseif ($this->item_type == 'url') {
            return $this->url;
        } else {
            return '#';
        }
    }

    public function displaySubMenu()
    {
        $subMenus = $this->getSubMenus();

        if (!empty($subMenus)) {
            echo '<ul class="sub-menu">';
            foreach ($subMenus as $nav) {
                $hasChildNav = $nav->hasChildNav();
                echo '<li>';
                echo '<a href="' . $nav->href . '" title="' . $nav->title . '">' . $nav->name;
                if ($hasChildNav) echo ' <i class="fa-light fa-plus fa-fw"></i>';
                echo '</a>';
                if ($hasChildNav) $nav->displaySubMenu();
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    public function hasChildNav()
    {
        return !empty($this->getSubMenus());
    }

    private function getSubMenus()
    {
        $menuType = $this->main ? 'main' : 'footer';
        $menus = $this->siteContext->allNavItems[$menuType] ?? [];
        $subMenus = [];
        foreach ($menus as $nav) {
            if ($nav->id_parent == $this->id) {
                $subMenus[] = $nav;
            }
        }
        return $subMenus;
    }

    public function isActive()
    {
        if ($this->item_type == 'page' && $this->siteContext->currentPage !== null) {
            return $this->siteContext->currentPage->id == $this->id_item;
        }

        if ($this->item_type == 'article' && $this->siteContext->currentArticle !== null) {
            return $this->siteContext->currentArticle->id == $this->id_item;
        }

        return false;
    }
}
