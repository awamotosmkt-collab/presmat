<?php

namespace Pandao\Core\Services;

class WidgetData
{
    private static $data = [];

    public static function set($key, $value) { self::$data[$key] = $value; }
    public static function get($key) { return self::$data[$key] ?? null; }
}
