<?php

namespace Pandao\Common\Utils;

class DateUtils
{
    /**
     * Formats a Unix timestamp using strftime format string.
     *
     * @param int $timestamp Unix timestamp.
     * @param string $format strftime format.
     * @return string Formatted date string.
     */
    public static function format($timestamp, $format = null)
    {
        $format = $format ?? PMS_DATE_FORMAT;
        return strftime($format, $timestamp);
    }

    /**
     * Returns a human-readable relative time string ("x minutes ago").
     *
     * @param int $timestamp Unix timestamp.
     * @return string Relative time string.
     */
    public static function timeAgo($timestamp)
    {
        $diff = time() - $timestamp;

        if ($diff < 60) return $diff . ' segundo(s) atr\u00e1s';
        if ($diff < 3600) return floor($diff / 60) . ' minuto(s) atr\u00e1s';
        if ($diff < 86400) return floor($diff / 3600) . ' hora(s) atr\u00e1s';
        if ($diff < 604800) return floor($diff / 86400) . ' dia(s) atr\u00e1s';
        return date('d/m/Y', $timestamp);
    }
}
