<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Models\Image;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = Auth::id();
        if ($current_user == '1') {
            $apartments = Apartment::all();
        } else {
            $apartments = Apartment::where('user_id',$current_user)->get();
        }

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::orderBy('name', 'ASC')->get();

        return view('admin.apartments.create', compact('services'));
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
            'cover_image' => 'file|max:2048'
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

        $data['user_id'] = Auth::id();

        $new_apartment = Apartment::create($data);

        if ($request->has('services')) {
            $new_apartment->services()->attach($data['services']);
        }

        
        if ($request->hasFile('images')) {
            
            $images = $request->images;
            
            foreach ($images as $image) {

                $link = Storage::put('images', $image);
                $current_image['link'] = $link;
                $current_image['apartment_id'] = $new_apartment->id;
                $new_image = Image::create($current_image);               
            }            
        }

        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if (Auth::id() == $apartment->user_id) {

            return view('admin.apartments.show', compact('apartment'));
            
        } else {
            return redirect()->route('admin.apartments.index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::orderBy('name', 'ASC')->get();

        return view('admin.apartments.edit', compact('apartment', 'services'));
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
            'cover_image' => 'file|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('cover_images', $request->cover_image);
            $data['cover_image'] = $path;

            if ($apartment->cover_image) {
                Storage::delete($apartment->cover_image);
            }
        }

        $apartment->update($data);

        if ($request->has('services')) {
            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->sync([]);
        }

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

        $apartment->services()->sync([]);

        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
