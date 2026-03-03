<?php

namespace Pandao\Models;

class Location
{
    protected $pms_db;

    public $name;
    public $address;
    public $lat;
    public $lng;

    public function __construct($name, $address, $lat, $lng)
    {
        $this->name = $name;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public static function getLocations($db, $page_id)
    {
        $locations = [];
        $result_location = $db->query("SELECT * FROM pm_location WHERE checked = 1 AND pages REGEXP '(^|,)" . $page_id . "(,|$)'");

        if ($result_location !== false) {
            foreach ($result_location as $row) {
                $locations[] = new self(
                    addslashes($row['name']),
                    addslashes($row['address']),
                    $row['lat'],
                    $row['lng']
                );
            }
        }
        return $locations;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
