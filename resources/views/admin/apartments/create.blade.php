@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-3">
        <h1 class="display-6 text-center">Apartment Information</h1>
        <form class="mb-4" action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="Luxury apartment in San Pietro" name="name" value="{{ old('name') }}">
                <div class="is-invalid" value="">@error('name') The name field is required @enderror</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" value="{{ old('description') }}"
                    placeholder="Exquisite luxury apartment nestled in the heart of San Pietro, boasting unparalleled elegance and sophistication.">
                <div class="is-invalid" value="">@error('description') The description field is required @enderror</div>
            </div>
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="text" class="form-control @error('rooms') is-invalid @enderror" id="last_name"
                    placeholder="6" name="rooms" value="{{ old('rooms') }}">
                <div class="is-invalid" value="">@error('rooms') The rooms field is required and must be greater than 0
                    @enderror</div>
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="text" class="form-control @error('beds') is-invalid @enderror" id="beds" placeholder="3"
                    name="beds" value="{{ old('beds') }}">
                <div class="is-invalid" value="">@error('beds') The beds field is required and must be greater than 0
                    @enderror</div>
            </div>
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="text" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
                    placeholder="1" name="bathrooms" value="{{ old('bathrooms') }}">
                <div class="is-invalid" value="">@error('bathrooms') The bathrooms field is required and must be greater
                    than
                    0 @enderror</div>
            </div>
            <div class="mb-3">
                <label for="square_meters" class="form-label ">Square Meters</label>
                <input type="text" class="form-control @error('square_meters') is-invalid @enderror " id="square_meters"
                    placeholder="80" name="square_meters" value="{{ old('square_meters') }}">
                <div class="is-invalid" value="">@error('square_metres') The square meters field is required and must be
                    greater
                    than 0 @enderror</div>
            </div>
            {{-- Address Search component --}}
            <x-address-search />

            <div class="form-group mb-3">
                <p>Choose apartment services:</p>
                <div class="d-flex flex-wrap gap-4 ">
                    @foreach ($services as $service)
                    <div class="form-check">
                        <input name="services[]" class="form-check-input @error('services') is-invalid @enderror"
                            type="checkbox" value="{{ $service->id }}" id="service-{{ $service->id }}"
                            @checked(in_array($service->id, old('services', [])))>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="is-invalid" value="">@error('services') The services field is required choose at least one
                    service @enderror</div>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input class="form-control" type="file" id="cover_image" name="cover_image">
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Add more images</label>
                <input class="form-control" type="file" id="images" name="images[]" multiple>
            </div>

                <div class="mb-3">
                    <div class="d-flex flex-wrap gap-4 ">
                        <div class="form-check">
                            <input type="checkbox" name="visible" class="form-check-input"
                            id="visible" value="1" @checked(old('visible'))>Make your apartment available
                        </div>
                    </div>
                </div>

            <button class="btn btn-outline-primary" type="submit">Save </button>
        </form>

    </div>
</div>
<style>
    .is-invalid {
        border-color: red;
        color: red;
    }
</style>
@endsection