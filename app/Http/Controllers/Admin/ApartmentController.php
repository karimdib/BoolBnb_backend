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
            $apartments = Apartment::where('user_id', $current_user)->get();
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
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'address' => 'required|max:255|same:a_searched_address',
            'cover_image' => 'file|max:2048'
        ]);

        $data = $request->all();

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
        $images = Image::where('apartment_id', $apartment->id)->get();

        if (Auth::id() == $apartment->user_id || Auth::id() == 1) {
            return view('admin.apartments.show', compact('apartment', 'images'));
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
        $images = Image::where('apartment_id', $apartment->id)->get();

        return view('admin.apartments.edit', compact('apartment', 'services', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|max:500',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'square_meters' => 'required|numeric',
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->cover_image) {
            if (str_contains($apartment->cover_image,'cover_images')) {
                Storage::delete($apartment->cover_image);
            } else {
                Storage::delete('cover_images/'. $apartment->cover_image);
            }
        }

        $images = Image::where('apartment_id', $apartment->id)->get();
        if ($images) {
            foreach ($images as $image) {
                if (str_contains($image->link,'images')) {
                    Storage::delete( $image->link );
                } else {
                    Storage::delete('images/'. $image->link);
                }
                Image::destroy($images);
            }
        }

        $apartment->services()->sync([]);

        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
