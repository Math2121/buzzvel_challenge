<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Search
{

    public function getNearbyHotels()
    {
        $url = Http::get('https://buzzvel-interviews.s3.eu-west-1.amazonaws.com/hotels.json')->json()['message'];
      
        $newArray = array_map(function($item){
return array(
    'Hotel'=>$item[0],
    'Latitude'=>$item[1],
    'Longitude'=>$item[2],
    'Price'=>$item[3],
);
        },$url);
        foreach ($newArray as $item) {
            if($item['Hotel'] == '1555 Malabia House Hotel'){
                return $item;
            }
        }

        dd($newArray);
       
    }
}
