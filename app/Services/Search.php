<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Search
{

    public function getNearbyHotels($latitude, $longitude, $orderby = 0)
    {
        $url = Http::get('https://buzzvel-interviews.s3.eu-west-1.amazonaws.com/hotels.json')->json()['message'];

        $newArray = array_map(function ($item) {
            return array(
                'Hotel' => $item[0],
                'Latitude' => (float) $item[1],
                'Longitude' => (float) $item[2],
                'Price' => (float) number_format($item[3], 2),
            );
        }, $url);
        $result = array();
 
        if ($orderby > 1) {
            foreach ($newArray as $item) {
                if ($this->distance($latitude, $longitude, $item['Latitude'], $item['Longitude']) <= 1.0 && $orderby <= $item['Price']) {
                    $result['hotels'] = $item;
                    $result['miles'] = $this->distance($latitude, $longitude, $item['Latitude'], $item['Longitude']);
                    return $result;
                }
            }
        } else {
            foreach ($newArray as $item) {
                if ($this->distance($latitude, $longitude, $item['Latitude'], $item['Longitude']) <= 1.0) {
                    $result['hotels'] = $item;
                    $result['miles'] = $this->distance($latitude, $longitude, $item['Latitude'], $item['Longitude']);
                    return $result;
                }
            }
        }
    }

    private function distance($lat1, $lon1, $lat2, $lon2)
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
