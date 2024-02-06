<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
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

    public function filter()
    {
        $data = request();

        $results = Apartment::with('user', 'services')
            ->selectRaw('*, ROUND(ST_DISTANCE_SPHERE(POINT(longitude, latitude), POINT(' . $data->longitude . ',  ' . $data->latitude . ')) / 1000, 2) AS distance')
            ->havingRaw('distance <= ' . $data->search_radius)
            ->where([
                ['rooms', '>=', $data->rooms],
                ['beds', '>=', $data->beds],
                ['bathrooms', '>=', $data->bathrooms],
                ['square_meters', '>=', $data->square_meters],
            ])->orderBy('distance')
            ->get();

        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }
}
