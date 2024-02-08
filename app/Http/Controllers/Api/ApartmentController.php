<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    public function index()
    {
        $results = Apartment::with('user', 'services')->get();

        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }

    public function show(Apartment $apartment)
    {
        $apartment->load('user', 'services', 'images');

        return response()->json([
            'apartment' => $apartment
        ]);
    }

    public function fuzzySearch()
    {
        $data = request()->all();
        $query = $data["query"];
        $base_url = "https://api.tomtom.com/search/2/search/";
        $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
        $responseFormat = ".json";
        $query_url = $base_url . $query . $responseFormat . $api_key;
        $response = Http::withOptions(['verify' => false])->get($query_url)->json();
        $results = $response["results"];

        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }

    public function filter()
    {
        $data = request();

        $results = Apartment::with('user', 'services')
            ->select("*")
            ->selectRaw(
                'ROUND(ST_DISTANCE_SPHERE(POINT(longitude, latitude), POINT(?, ?)) / 1000, 2) AS distance',
                [$data->longitude, $data->latitude]
            )
            ->havingRaw('distance <= ' . $data->search_radius)
            ->where([
                ['rooms', '>=', $data->rooms],
                ['beds', '>=', $data->beds],
                ['bathrooms', '>=', $data->bathrooms],
                ['square_meters', '>=', $data->square_meters],
                ['visible', 1],
            ])->orderBy('distance')
            ->get();

        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }
}
