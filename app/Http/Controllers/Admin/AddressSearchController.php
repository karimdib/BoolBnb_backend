<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressSearchController extends Controller
{
    public function searchAddress(Request $request)
    {
        $data = $request->all();
        $query = $data["query"];
        $base_url = "https://api.tomtom.com/search/2/search/";
        $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
        $responseFormat = ".json";
        $query_url = $base_url . $query . $responseFormat . $api_key;
        $response = Http::withOptions(['verify' => false])->get($query_url);
        return $response->json()["results"];
    }
}
