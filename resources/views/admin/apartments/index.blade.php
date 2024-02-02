@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="m-3">
            <h1 class="display-5 mb-4 text-center">Apartment List</h1>
            <a class="btn btn-outline-primary mb-4 w-100 shadow" href="{{ route('admin.apartments.create') }}">
                Create Apartment
            </a>
            <div class="card p-4 shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                            <tr>
                                <td> <a href="{{ route('admin.apartments.show', $apartment) }}">
                                        {{ $apartment->street_name . ' ' . $apartment->street_number . ' ' . $apartment->city . ' ' . $apartment->postal_code }}
                                    </a>
                                </td>
                                <td>{{ $apartment->latitude }}</td>
                                <td>{{ $apartment->longitude }}</td>
                                <td><a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('admin.apartments.edit', $apartment) }}">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                                        id="deletionForm">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" id="deletion" type="submit"
                                            name="{{ $apartment }}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <p class="fs-4 text-center p-4 opacity-75">
                                        No Apartments...
                                    </p>
                                </td>
                            </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="container">
    <h1>Apartments</h1>
</div>

<div class="container">
    <a href="{{ route('admin.apartments.create') }}">
        <h4 class="">Create Apartment</h4>
    </a>
</div>

<div class="container">

    <div>
        @forelse ($apartments as $apartment)
        <div class="d-flex">
            <p>
                <a href="{{ route('admin.apartments.show', $apartment) }}">Details</a>
                {{ $apartment->address}}
            </p>
            <p>
                <a href="{{route('admin.apartments.edit',$apartment)}}">Edit</a>
            </p>
            <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST" id="deletionForm">
                @csrf
                @method('DELETE')
                <button id="deletion" type="submit" name="{{ $apartment}}">Delete</button>
            </form>
        </div>
        @empty

        @endforelse
    </div>
</div> --}}
@endsection
