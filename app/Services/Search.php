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
                'Latitude' => $item[1],
                'Longitude' => $item[2],
                'Price' => number_format($item[3], 2),
            );
        }, $url);

        $new_test = array();
        foreach ($newArray as $item) {
            if ((intval($item['Latitude']) - 34.5918855804444125) > 0.00200 && (intval($item['Longitude']) - -0.228499) > 0.00200) {
                array_push($new_test, $item);
            }
        }
        return $new_test;
    }

   
}
