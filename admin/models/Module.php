<?php

namespace Pandao\Admin\Models;

class Module
{
    public $name;
    public $title;
    public $dir;
    public $multi;
    public $ranking;
    public $home;
    public $main;
    public $validation;
    public $dates;
    public $release;
    public $library;
    public $dashboard;
    public $max_medias;
    public $medias_multi;
    public $resizing;
    public $max_w_big;
    public $max_h_big;
    public $max_w_medium;
    public $max_h_medium;
    public $max_w_small;
    public $max_h_small;
    public $icon = 'puzzle-piece';
    public $permissions = [];
    public $count = 0;
    public $last_date;
    public $configDom;
    public $classname;
    public $editorType;

    public function __construct($name, $title, $dir, $multi, $ranking, $home, $main, $validation, $dates, $release, $library, $dashboard, 
                                $max_medias, $medias_multi, $resizing, $max_w_big, $max_h_big, $max_w_medium, $max_h_medium, $max_w_small, 
                                $max_h_small, $icon, $permissions, $dom, $editorType) {
        $this->name = $name;
        $this->title = $title;
        $this->dir = $dir;
        $this->multi = $multi;
        $this->ranking = $ranking;
        $this->home = $home;
        $this->main = $main;
        $this->validation = $validation;
        $this->dates = $dates;
        $this->release = $release;
        $this->library = $library;
        $this->dashboard = $dashboard;
        $this->max_medias = $max_medias;
        $this->medias_multi = $medias_multi;
        $this->resizing = $resizing;
        $this->max_w_big = $max_w_big;
        $this->max_h_big = $max_h_big;
        $this->max_w_medium = $max_w_medium;
        $this->max_h_medium = $max_h_medium;
        $this->max_w_small = $max_w_small;
        $this->max_h_small = $max_h_small;
        $this->icon = $icon;
        $this->permissions = $permissions;
        $this->configDom = $dom;
        $this->editorType = $editorType;
    }
}
