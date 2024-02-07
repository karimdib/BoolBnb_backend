<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $apartments = Apartment::with('user', 'services')->get();

        return response()->json([
            'results' => ['apartments' => $apartments, 'services' => $services],
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
        // Get the request data
        $query = request();

        // Get all services
        $services = Service::all();

        // Get the selected services from the request
        $servicesChecked = request()->services;

        // Initialize the apartments query with eager loading of user and services
        $apartments = Apartment::with('user', 'services');

        // Add select and distance calculation for sorting
        $apartments->select("*")
            ->selectRaw(
                'ROUND(ST_DISTANCE_SPHERE(POINT(longitude, latitude), POINT(?, ?)) / 1000, 2) AS distance',
                [$query->longitude, $query->latitude]
            )
            ->havingRaw('distance <= ' . $query->search_radius)
            ->where([
                ['rooms', '>=', $query->rooms],
                ['beds', '>=', $query->beds],
                ['bathrooms', '>=', $query->bathrooms],
                ['square_meters', '>=', $query->square_meters],
                ['visible', 1],
            ]);

        // Loop through selected services and filter apartments accordingly
        foreach ($servicesChecked as $service) {
            $apartments->whereHas('services', function (Builder $query) use ($service) {
                $query->where("name", $service);
            });
        }

        // Get the filtered apartments, ordered by distance
        $filteredApartments = $apartments->orderBy('distance')->get();

        // Return JSON response with filtered apartments and all services
        return response()->json([
            'results' => ['apartments' => $filteredApartments, 'services' => $services],
            'success' => true
        ]);
    }
}
