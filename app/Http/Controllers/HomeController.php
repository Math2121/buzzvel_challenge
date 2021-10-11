<?php

namespace App\Http\Controllers;

use App\Services\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function getData()
    {
         $url  = new Search();
         dd($url->getNearbyHotels());

     

      
    }
}
