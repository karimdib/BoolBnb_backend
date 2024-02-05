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

                {{-- Address Search component --}}
                <x-address-search />

                <div class="form-group mb-3">
                    <p>Choose apartment services:</p>
                    <div class="d-flex flex-wrap gap-4 ">
                        @foreach ($services as $service)
                            <div class="form-check">
                                <input name="services[]" class="form-check-input" type="checkbox"
                                    value="{{ $service->id }}" id="service-{{ $service->id }}"
                                    @checked(in_array($service->id, old('services', [])))>
                                <label class="form-check-label" for="service-{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
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
