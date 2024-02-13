@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-3">
            <h1 class="display-6 text-center">Edit Apartment Information</h1>
            <form class="mb-4" action="{{ route('admin.apartments.update', $apartment) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input class="form-control" type="file" id="cover_image" name="cover_image">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ old('description', $apartment->description) }}">
                </div>
                <div class="mb-3">
                    <label for="rooms" class="form-label">Rooms</label>
                    <input type="text" class="form-control" id="last_name" name="rooms"
                        value="{{ old('rooms', $apartment->rooms) }}">
                </div>
                <div class="mb-3">
                    <label for="beds" class="form-label">Beds</label>
                    <input type="text" class="form-control" id="beds" name="beds"
                        value="{{ old('beds', $apartment->beds) }}">
                </div>
                <div class="mb-3">
                    <label for="bathrooms" class="form-label">Bathrooms</label>
                    <input type="text" class="form-control" id="bathrooms" name="bathrooms"
                        value="{{ old('bathrooms', $apartment->bathrooms) }}">
                </div>
                <div class="mb-3">
                    <label for="square_meters" class="form-label">Square meters</label>
                    <input type="text" class="form-control" id="square_meters" name="square_meters"
                        value="{{ old('square_meters', $apartment->square_meters) }}">
                </div>
                <div class="mb-3">
                    <label for="street_name" class="form-label">Street name</label>
                    <input type="text" class="form-control" id="street_name" name="street_name"
                        value="{{ old('street_name', $apartment->street_name) }}">
                </div>
                <div class="mb-3">
                    <label for="street_number" class="form-label">Street number</label>
                    <input type="text" class="form-control" id="street_number" name="street_number"
                        value="{{ old('street_number', $apartment->street_number) }}">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ old('city', $apartment->city) }}">
                </div>
                <div class="mb-4">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                        value="{{ old('postal_code', $apartment->postal_code) }}">
                </div>
                <div class="form-group mb-3">
                    <p>Choose apartment services:</p>
                    <div class="d-flex flex-wrap gap-4 ">
                        @foreach ($services as $service)
                            <div class="form-check">
                                <input name="services[]" class="form-check-input" type="checkbox"
                                    value="{{ $service->id }}" id="service-{{ $service->id }}"
                                    @checked(in_array($service->id, old('services', $apartment->services->pluck('id')->all())))>
                                <label class="form-check-label" for="service-{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button class="btn btn-outline-primary" type="submit">Edit</button>
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
