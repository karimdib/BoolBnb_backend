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
        $data = $request->all();

        // Geocode apartment address to latitude and longitude using tomtom api
        $response = Http::withOptions(['verify' => false])
            ->get('https://api.tomtom.com/search/2/search/' . $data['address'] . '.json?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c');
        $results = $response->json()["results"];
        $data["latitude"] = $results[0]["position"]["lat"];
        $data["longitude"] = $results[0]["position"]["lon"];

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('cover_images',$request->cover_image);
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
            'address' => 'required|max:255',
            'cover_image' => 'required|string'
        ]);

        $data = $request->all();

        $apartment->update($data);

        return redirect()->route('admin.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        Storage::delete($apartment->cover_image);

        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
