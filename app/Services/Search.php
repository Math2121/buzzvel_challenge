<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Search
{

    public function getNearbyHotels()
    {
        $url = Http::get('https://buzzvel-interviews.s3.eu-west-1.amazonaws.com/hotels.json')->json()['message'];

        $newArray = array_map(function ($item) {
            return array(
                'Hotel' => $item[0],
                'Latitude' => floatval($item[1]),
                'Longitude' => floatval($item[2]),
                'Price' => number_format($item[3], 2),
            );
        }, $url);

        $new_test = array();
        $lat =  1.28210155945393;
        $long = 103.81722480263163;
        foreach ($newArray as $item) {
            if ($this->distance($lat, $long, $item['Latitude'], $item['Longitude'])) {
                array_push($new_test, $item);
            }
        }
        return $new_test;
    }

    public function distance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;



            return ($miles * 1.609344);
        }
    }
}
