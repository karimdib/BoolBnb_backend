@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($apartment->cover_image)
        <figure class="d-flex justify-content-center">
            @if (str_contains($apartment->cover_image,'cover_images'))
                <img class="w-50" src="{{ asset('storage/' . $apartment->cover_image) }}">
            @else
                <img class="w-50" src="{{ asset('storage/cover_images/' . $apartment->cover_image) }}">                
            @endif
        </figure>
        @endif
    </div>

    <div class="container">
        <div class="m-3">
            <h1 class="display-5 mb-4 text-center">Apartment Info</h1>
            <ul class="list-group shadow mb-4 text-capitalize">

                <li class="list-group-item p-4 "><span class="fw-bold">Description:
                    </span>{{ $apartment->description }}</li>
                <li class="list-group-item p-4 "><span class="fw-bold">Slug:
                    </span>{{ $apartment->slug }}</li>
                <li class="list-group-item p-4 "><span class="fw-bold">Rooms: </span>{{ $apartment->rooms }}
                </li>
                <li class="list-group-item p-4 "><span class="fw-bold">Beds: </span>{{ $apartment->beds }}
                </li>
                <li class="list-group-item p-4 "><span class="fw-bold">Bathrooms:
                    </span>{{ $apartment->bathrooms }}</li>
                <li class="list-group-item p-4 "><span class="fw-bold">Square meters:
                    </span>{{ $apartment->square_meters }}
                </li>
                <li class="list-group-item p-4 "><span class="fw-bold">Address:
                    </span>{{ $apartment->address }}</li>
                <li class="list-group-item p-4 "><span class="fw-bold">Latitude:
                    </span>{{ $apartment->latitude }}</li>
                <li class="list-group-item p-4 "><span class="fw-bold">Longitude:
                    </span>{{ $apartment->longitude }}</li>
            </ul>



            <h4 class="display-5 mb-4 text-center">Services</h4>
            <ul class="list-group shadow mb-4">
                @forelse ($apartment->services as $service)
                    <li class="list-group-item p-4 ">{{ $service->name }}</li>
                @empty
                    <li class="list-group-item p-4">Your apartment has no services!</li>
                @endforelse
            </ul>
            <ul class="shadow mb-4 row">
                @foreach ($images as $image)
                    @if (str_contains($image,'image'))
                        <li class="d-flex col-4 p-2">
                            <img class="w-100" src="{{ asset('storage') . '/' . $image->link }}" alt="">
                        </li>                         
                    @else
                        <li class="d-flex col-4 p-2">
                            <img class="w-100" src="{{ asset('storage/images') . '/' . $image->link }}" alt="">
                        </li>                    
                    @endif
                @endforeach
            </ul>
            <div class="d-flex justify-content-center gap-4">
                <a class="btn btn-outline-secondary flex-grow-1 shadow"
                    href="{{ route('admin.apartments.edit', $apartment) }}">Edit</a>
                <form class="flex-grow-1 shadow" action="{{ route('admin.apartments.destroy', $apartment) }}"
                    method="POST" id="deletionForm">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger w-100" id="deletion" type="submit"
                        name="{{ $apartment }}">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
