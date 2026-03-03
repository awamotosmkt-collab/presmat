<?php

namespace Pandao\Models;

class Widget
{
    protected $pms_db;
    protected $siteContext;

    public $id;
    public $lang;
    public $title;
    public $subtitle;
    public $showtitle;
    public $pos;
    public $allpages;
    public $pages;
    public $type;
    public $class;
    public $content;
    public $checked = 0;
    public $rank = 0;

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

    public function render()
    {
        $output = '<div id="widget-' . $this->id . '" class="widget';
        if ($this->class) {
            $output .= ' ' . $this->class;
        }
        $output .= '">';
        if ($this->showtitle) {
            $output .= '<div class="wid-title">
                            <h5>' . $this->subtitle . '</h5>
                            <h3>' . $this->title . '</h3>
                        </div>';
        }
        $output .= '<div class="widget-content">';
        $path = SYSBASE . 'templates/' . PMS_TEMPLATE . '/widgets/';
        if ($this->type && is_file($path . $this->type . '.php')) {
            ob_start();
            include($path . $this->type . '.php');
            $output .= ob_get_clean();
        } else {
            $output .= $this->content;
        }
        $output .= '</div></div>';
        return $output;
    }

    public function getMainFile($isImg = true)
    {
        $type = $isImg ? 'image' : 'other';
        $stmt = $this->pms_db->prepare('SELECT * FROM pm_widget_file
            WHERE id_item = :widget_id AND checked = 1 AND lang = :lang AND `type` = :type ORDER BY `rank` LIMIT 1');
        if($stmt->execute(['widget_id' => $this->id, 'lang' => $this->lang, 'type' => $type]) !== false){
            $file = $stmt->fetch();
            
            if($file === false || empty($file)) {
                return null;
            }
            
            $type = $isImg ? 'big' : 'other';

            $path = 'medias/widget/' . $type . '/' . $file['id'] . '/' . $file['file'];
            if($isImg) $webp_path = preg_replace('/\.\w+$/', '.webp', $path);
            $filepath = ($isImg && file_exists(SYSBASE . 'public/' . $webp_path)) ? DOCBASE . $webp_path : DOCBASE . $path;

            return $filepath;
        }
        return null;
    }
}
