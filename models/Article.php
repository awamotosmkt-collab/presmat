<?php

namespace Pandao\Models;

use Pandao\Common\Utils\StrUtils;

class Article extends Content
{
    public $lang;
    public $title;
    public $subtitle;
    public $alias;
    public $short_text;
    public $text;
    public $url;
    public $tags;
    public $id_page;
    public $users = [];
    public $home = 0;
    public $checked = 0;
    public $rank = 0;
    public $add_date;
    public $edit_date;
    public $publish_date;
    public $unpublish_date;
    public $comment = 0;
    public $rating = 0;
    public $show_langs = [];
    public $hide_langs = [];
    public $path;
    public $title_tag;

    public function getImages($limit = null, $size = 'big')
    {
        $images = [];
        foreach ($this->images as $image) {
            $imageUrl = 'medias/article/' . $size . '/' . $image['id'] . '/' . $image['file'];
            if (is_file(SYSBASE . 'public/' . $imageUrl)) {
                $images[] = [
                    'url' => DOCBASE . $imageUrl,
                    'label' => $image['label']
                ];
            }
            if ($limit !== null && count($images) >= $limit) {
                break;
            }
        }
        return $images;
    }
    
    public function populateProperties($articleData)
    {
        foreach ($articleData as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getShortText()
    {
        return !empty($this->short_text) ? $this->short_text : StrUtils::strtrunc(StrUtils::ripTags($this->text), 155);
    }

    public function getTags()
    {
        return !empty($this->tags) ? explode(',', $this->tags) : [];
    }
}
