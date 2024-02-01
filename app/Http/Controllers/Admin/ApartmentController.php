<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {

        $request->validate([
            'description' => 'required|max:500',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'street_name' => 'required|max:255',
            'street_number' => 'required|max:255',
            'city' => 'required|max:255',
            'postal_code' => 'required|max:255',
            'cover_image' => 'string'
        ]);

        $data = $request->all();

        $full_address =
            $data['street_name'] . ', ' .
            $data['street_number'] . ', ' .
            $data['city'] . ', ' .
            $data['postal_code'];

        $base_url = "https://api.tomtom.com/search/2/search/";
        $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
        $responseFormat = ".json";
        $query_url = $base_url . $full_address . $responseFormat . $api_key;

        $response = Http::withOptions(['verify' => false])->get($query_url);
        $results = $response->json()["results"];
        $data["latitude"] = $results[0]["position"]["lat"];
        $data["longitude"] = $results[0]["position"]["lon"];

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('cover_images', $request->cover_image);
            $data['cover_image'] = $path;
        }

        $new_apartment = Apartment::create($data);
        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {

        return view('admin.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {

        $request->validate([
            'description' => 'required|max:500',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'street_name' => 'required|max:255',
            'street_number' => 'required|max:255',
            'city' => 'required|max:255',
            'postal_code' => 'required|max:255',
            'cover_image' => 'string'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('cover_images',$request->cover_image);
            $data['cover_image'] = $path;

            if ($apartment->cover_image) {
                Storage::delete($apartment->cover_image);
            }
        }

        $apartment->update($data);

        return redirect()->route('admin.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->cover_image) {
            Storage::delete($apartment->cover_image);
        }

        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
