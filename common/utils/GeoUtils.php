<?php

namespace Pandao\Common\Utils;

class GeoUtils
{
    /**
     * Calculates the distance between two lat/lng coordinates using Haversine formula.
     *
     * @param float $lat1
     * @param float $lng1
     * @param float $lat2
     * @param float $lng2
     * @param string $unit 'km' or 'mi'
     * @return float Distance.
     */
    public static function haversineDistance($lat1, $lng1, $lat2, $lng2, $unit = 'km')
    {
        $R = ($unit === 'mi') ? 3958.8 : 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $R * $c;
    }
}
