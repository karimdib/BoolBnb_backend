@extends('layouts.app')

@section('content')
    @if ($apartment->cover_image)
        <figure><img class="w-50" src="{{ asset('storage/' . $apartment->cover_image) }}"></figure>
    @endif

    <div class="container">
        <div class="m-3">
            <h1 class="display-5 mb-4 text-center">Apartment Info</h1>
            <ul class="list-group shadow mb-4">
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Description:
                    </span>{{ $apartment->description }}</li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Rooms: </span>{{ $apartment->rooms }}
                </li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Beds: </span>{{ $apartment->beds }}
                </li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Bathrooms:
                    </span>{{ $apartment->bathrooms }}</li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Square meters:
                    </span>{{ $apartment->square_meters }}
                </li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Street Name:
                    </span>{{ $apartment->street_name }}</li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Street n°:
                    </span>{{ $apartment->street_number }}</li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">City: </span>{{ $apartment->city }}
                </li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Postal Code:
                    </span>{{ $apartment->postal_code }}</li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Latitude:
                    </span>{{ $apartment->latitude }}</li>
                <li class="list-group-item p-4 text-uppercase"><span class="fw-bold">Longitude:
                    </span>{{ $apartment->longitude }}</li>
            </ul>
            <h4 class="display-5 mb-4 text-center">Services</h4>
            <ul class="list-group shadow mb-4">
                @forelse ($apartment->services as $service)
                    <li class="list-group-item p-4 text-uppercase">{{ $service->name }}</li>
                @empty
                    <li class="list-group-item p-4">Your apartment has no services!</li>
                @endforelse
            </ul>
            <ul class="shadow mb-4 row">
                @foreach ($images as $image)
                    <li class="d-flex col-4 p-2">
                        <img class="w-100" src="{{ asset('storage').'/'. $image->link }}" alt="">
                    </li>
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
