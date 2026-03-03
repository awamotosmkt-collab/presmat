<?php

namespace Pandao\Core\Services;

class AssetsManager
{
    private static $css = [];
    private static $js = [];

    public static function addCss($path) { self::$css[] = $path; }
    public static function addJs($path) { self::$js[] = $path; }
    public static function getCss() { return self::$css; }
    public static function getJs() { return self::$js; }
}
