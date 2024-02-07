@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-3">
        <h1 class="display-6 text-center">Edit Apartment Information</h1>
        <form class="mb-4 apartment-form" action="{{ route('admin.apartments.update', $apartment) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $apartment->name) }}">
                <div class="is-invalid" value="">@error('name') The name field is required @enderror</div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control  @error('description') is-invalid @enderror" id="description"
                    name="description" value="{{ old('description', $apartment->name) }}">
                <div class="is-invalid" value="">@error('description') The description field is required @enderror</div>
            </div>
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="text" class="form-control @error('rooms') is-invalid @enderror" id="rooms" name="rooms"
                    value="{{ old('rooms', $apartment->rooms) }}">
                <div class="is-invalid" value="">@error('rooms') The rooms field is required and must be greater than 0
                    @enderror</div>
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="text" class="form-control @error('beds') is-invalid @enderror" id="beds" name="beds"
                    value="{{ old('beds', $apartment->beds) }}">
                <div class="is-invalid" value="">@error('beds') The beds field is required and must be greater than 0
                    @enderror</div>
            </div>
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="text" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
                    name="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
                <div class="is-invalid" value="">@error('bathrooms') The bathrooms field is required and must be greater
                    than
                    0 @enderror</div>
            </div>
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="text" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                    name="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
                <div class="is-invalid" value="">@error('square_metres') The square meters field is required and must be
                    greater
                    than 0 @enderror</div>
            </div>
            <div class="form-group mb-3">
                <p>Choose apartment services:</p>
                <div class="d-flex flex-wrap gap-4 ">
                    @foreach ($services as $service)
                    <div class="form-check">
                        <input name="services[]"
                            class="form-check-input @error('services') is-invalid @enderror service" type="checkbox"
                            value="{{ $service->id }}" id="service-{{ $service->id }}" @checked(in_array($service->id,
                        old('services',
                        $apartment->services->pluck('id')->all())))>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="is-invalid" id="service-error" value="">@error('services') The services field is required
                    choose at least one
                    service @enderror</div>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input class="form-control" type="file" id="cover_image" name="cover_image">
            </div>
            <div class="form-group mb-3">
                <p>Delete old images:</p>
                <div class="d-flex flex-wrap gap-4 ">
                    @foreach ($images as $image)
                    <div class="form-check">
                        <input name="old_images[]" class="form-check-input" type="checkbox" value="{{ $image }}"
                            id="old_image-{{ $image->id }}">
                        <label class="form-check-label" for="old_image-{{ $image }}">
                            @if (str_contains($image,'image'))
                            <img class="w-25" src="{{ asset('storage') . '/' . $image->link }}" alt="">
                            @else
                            <img class="w-25" src="{{ asset('storage/images') . '/' . $image->link }}" alt="">
                            @endif
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Add more images</label>
                <input class="form-control" type="file" id="images" name="images[]" multiple>
            </div>
            
            <div class="mb-3">
                <div class="d-flex flex-wrap gap-4 ">
                    <div class="form-check">
                        <input type="radio" name="visible" class="form-check-input"
                        id="visible" value="1">
                        <label for="1">Make your apartment visible</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="visible" class="form-check-input"
                        id="invisible" value="0">
                        <label for="0">Make your apartment invisible</label>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-outline-primary" type="submit">Edit</button>
        </form>
        @push('scripts')
        <script src="{{asset('./js/apartmentValidation.js')}}"></script>
        @endpush
    </div>
</div>
<style>
    .is-invalid {
        border-color: red;
        color: red;
    }
</style>

@push('scripts')
<script src="{{ asset('js/apartmentValidation.js') }}"></script>
@endpush

@endsection