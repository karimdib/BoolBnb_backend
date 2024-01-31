@extends('layouts.app')

@section('content')

<div class="container">
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
</div>

@endsection