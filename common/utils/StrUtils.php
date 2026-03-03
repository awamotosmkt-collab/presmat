<?php

namespace Pandao\Common\Utils;

class StrUtils
{
    /**
     * Converts a string to a URL-friendly format.
     * Replaces spaces, special characters with hyphens and lowercases the string.
     *
     * @param string $text The text to convert.
     * @return string URL-friendly text.
     */
    public static function textFormat($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = str_replace(
            ['\u00e0','\u00e1','\u00e2','\u00e3','\u00e4','\u00e5','\u00e6','\u00e8','\u00e9','\u00ea','\u00eb',
             '\u00ec','\u00ed','\u00ee','\u00ef','\u00f2','\u00f3','\u00f4','\u00f5','\u00f6','\u00f8',
             '\u00f9','\u00fa','\u00fb','\u00fc','\u00fd','\u00ff','\u00f1','\u00e7','\u00df',
             '\u0119','\u0105','\u015b','\u017a','\u017c','\u00f3','\u0142','\u017e',
             '\u010d','\u0161','\u017e','\u0159','\u011b','\u00fd','\u00fa','\u016f'],
            ['a','a','a','a','a','a','ae','e','e','e','e',
             'i','i','i','i','o','o','o','o','o','o',
             'u','u','u','u','y','y','n','c','ss',
             'e','a','s','z','z','o','l','z',
             'c','s','z','r','e','y','u','u'],
            $text
        );
        $text = preg_replace('/[^a-z0-9\-]/', '-', $text);
        $text = preg_replace('/-+/', '-', $text);
        $text = trim($text, '-');
        return $text;
    }

    /**
     * Truncates a string to the specified length at a word boundary.
     *
     * @param string $text The string to truncate.
     * @param int $limit Max number of characters.
     * @param string $end The string to append at end.
     * @return string Truncated string.
     */
    public static function strtrunc($text, $limit, $end = '...')
    {
        if (mb_strlen($text, 'UTF-8') <= $limit) {
            return $text;
        }
        $text = mb_substr($text, 0, $limit, 'UTF-8');
        $lastSpace = mb_strrpos($text, ' ', 0, 'UTF-8');
        if ($lastSpace !== false) {
            $text = mb_substr($text, 0, $lastSpace, 'UTF-8');
        }
        return $text . $end;
    }

    /**
     * Strips HTML and PHP tags from a string.
     *
     * @param string $text The input text.
     * @return string Text with all tags removed.
     */
    public static function ripTags($text)
    {
        return strip_tags($text);
    }

    /**
     * Creates an excerpt of the given text.
     *
     * @param string $text The source text.
     * @param int $limit Max chars.
     * @return string Excerpt.
     */
    public static function excerpt($text, $limit = 155)
    {
        $text = self::ripTags($text);
        return self::strtrunc(trim($text), $limit);
    }

    /**
     * Highlights search keywords within a string.
     *
     * @param string $text The target text.
     * @param string $keywords Space-separated keywords.
     * @return string Text with keywords wrapped in <mark> tags.
     */
    public static function highlightKeywords($text, $keywords)
    {
        if (empty($keywords)) return $text;
        $words = explode(' ', trim($keywords));
        foreach ($words as $w) {
            if (strlen($w) > 1) {
                $text = preg_replace('/(' . preg_quote($w, '/') . ')/i', '<mark>$1</mark>', $text);
            }
        }
        return $text;
    }

    /**
     * Converts a slug/alias back to a readable title.
     *
     * @param string $alias URL alias.
     * @return string Readable title.
     */
    public static function aliasToTitle($alias)
    {
        return ucwords(str_replace(['-', '_'], ' ', $alias));
    }
}
