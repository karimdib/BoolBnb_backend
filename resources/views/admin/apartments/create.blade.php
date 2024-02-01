@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-3">
            <h1 class="display-6 text-center">Apartment Information</h1>
            <form class="mb-4" action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input class="form-control" type="file" id="cover_image" name="cover_image">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" placeholder="Description of the apartment"
                        name="description" value="{{ old('description') }}">
                </div>
                <div class="mb-3">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Number of rooms" name="rooms"
                        value="{{ old('rooms') }}">
                </div>
                <div class="mb-3">
                    <label for="beds" class="form-label">Beds</label>
                    <input type="text" class="form-control" id="beds" placeholder="Number of beds"
                        name="beds"value="{{ old('beds') }}">
                </div>
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="text" class="form-control" id="bathrooms" placeholder="Number of bathrooms"
                        name="bathrooms" value="{{ old('bathrooms') }}">
                </div>
                <div class="mb-3">
                    <label for="square_meters" class="form-label">Square Meters</label>
                    <input type="text" class="form-control" id="square_meters" placeholder="Size in square meters"
                        name="square_meters" value="{{ old('square_meters') }}">
                </div>
                <div class="mb-3">
                    <label for="street_name" class="form-label">Street Name</label>
                    <input type="text" class="form-control" id="street_name" placeholder="Via Paolo Rossi"
                        name="street_name" value="{{ old('street_name') }}">
                </div>
                <div class="mb-3">
                    <label for="street_number" class="form-label">Street Number</label>
                    <input type="text" class="form-control" id="street_number" placeholder="10" name="street_number"
                        value="{{ old('street_number') }}">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" placeholder="Roma" name="city"
                        value="{{ old('city') }}">
                </div>
                <div class="mb-4">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="number" class="form-control" id="postal_code" placeholder="00144" name="postal_code"
                        value="{{ old('postal_code') }}">
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Add more images</label>
                    <input class="form-control" type="file" id="images" name="images[]" multiple>
                </div>

                <button class="btn btn-outline-primary" type="submit">Save Apartment</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
