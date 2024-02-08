<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Models\Image;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use illuminate\support\Facades\Gate;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $current_user = Auth::id();
        if ($current_user == '1') {
            $apartments = Apartment::paginate(16);
        } else {
            $apartments = Apartment::where('user_id', $current_user)->paginate(16);
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
            'name' => 'required',
            'description' => 'required|max:500',
            'rooms' => 'required|numeric|gt:0',
            'beds' => 'required|numeric|gt:0',
            'bathrooms' => 'required|numeric|gt:0',
            'square_meters' => 'required|numeric|gt:0',
            'address' => 'required|max:255|same:a_searched_address',
            'cover_image' => 'file|max:2048|extensions:jpg,png',
            'services' => 'required|min:1'
        ]);

        $data = $request->all();

        // Chiamata all'API di Tomtom e inserimento country,latitude e longitude in data

        $query = $data['address'];
        $base_url = "https://api.tomtom.com/search/2/search/";
        $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
        $responseFormat = ".json";
        $query_url = $base_url . $query . $responseFormat . $api_key;
        $response = Http::withOptions(['verify' => false])->get($query_url)->json();
        $results = $response["results"];
        $data["country"] = $results[0]['address']['country'];
        $data["latitude"] = $results[0]['position']['lat'];
        $data["longitude"] = $results[0]['position']['lon'];

        $data["slug"] = Str::slug($data["description"]);

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
        // Validazione id utente tramite policy

        $response = Gate::inspect('view', $apartment);

        if ($response->allowed()) {

            $images = Image::where('apartment_id', $apartment->id)->get();

            return view('admin.apartments.show', compact('apartment', 'images'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        // Validazione id utente tramite policy

        $response = Gate::inspect('update', $apartment);

        if ($response->allowed()) {

            $services = Service::orderBy('name', 'ASC')->get();
            $images = Image::where('apartment_id', $apartment->id)->get();

            return view('admin.apartments.edit', compact('apartment', 'services', 'images'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        // Validazione id utente tramite policy

        $response = Gate::inspect('update', $apartment);

        if ($response->allowed()) {

            $request->validate([
                'name' => 'required',
                'description' => 'required|max:500',
                'rooms' => 'required|numeric|gt:0',
                'beds' => 'required|numeric|gt:0',
                'bathrooms' => 'required|numeric|gt:0',
                'square_meters' => 'required|numeric|gt:0',
                'cover_image' => 'file|max:2048',
                'services' => 'required|min:1'
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

            if ($request->hasFile('images')) {



                $images = $request->images;
                foreach ($images as $image) {
                    $link = Storage::put('images', $image);
                    $current_image['link'] = $link;
                    $current_image['apartment_id'] = $apartment->id;
                    $new_image = Image::create($current_image);
                }
            }

            if ($request->has('old_images')) {
                $old_images = $request->old_images;
                foreach ($old_images as $old_image) {
                    $current_image = json_decode($old_image);
                    Storage::delete($current_image->link);
                    Image::destroy($current_image->id);
                }
            }

            if ($request->has('services')) {
                $apartment->services()->sync($data['services']);
            } else {
                $apartment->services()->sync([]);
            }

            return redirect()->route('admin.apartments.show', $apartment);
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->cover_image) {
            if (str_contains($apartment->cover_image, 'cover_images')) {
                Storage::delete($apartment->cover_image);
            } else {
                Storage::delete('cover_images/' . $apartment->cover_image);
            }
        }

        $images = Image::where('apartment_id', $apartment->id)->get();
        if ($images) {
            foreach ($images as $image) {
                if (str_contains($image->link, 'images')) {
                    Storage::delete($image->link);
                } else {
                    Storage::delete('images/' . $image->link);
                }
                Image::destroy($images);
            }
        }

        $apartment->services()->sync([]);

        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
