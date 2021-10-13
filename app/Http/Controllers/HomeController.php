<?php

namespace App\Http\Controllers;

use App\Services\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    //


    public function getData(Request $request)
    {

        try {
            $result = new Search();
            $res = $result->getNearbyHotels($request->latitude, $request->longitude, $request->orderBy);

            return response()->json([$res['hotels']['Hotel'], $res['miles'] . ' Km', $res['hotels']['Price'] . ' EUR'], 200);
        } catch (\Throwable $th) {
            return response()->json(['Erro na requisição'], 404);
        }
    }
}
