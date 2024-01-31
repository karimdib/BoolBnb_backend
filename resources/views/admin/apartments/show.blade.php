@extends('layouts.app')

@section('content')
    <ul class="container">
        <li><img src="{{ $apartment->cover_image }}" alt=""></li>
        <li>{{ $apartment->description }}</li>
        <li>{{ $apartment->rooms }}</li>
        <li>{{ $apartment->beds }}</li>
        <li>{{ $apartment->bathrooms }}</li>
        <li>{{ $apartment->square_meters }}</li>
        <li>{{ $apartment->address }}</li>
    </ul>

    <div class="container">
        <p>
            <a href="{{route('admin.apartments.edit',$apartment)}}">Edit</a>
        </p>
        <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST" id="deletionForm">
            @csrf
            @method('DELETE')
            <button id="deletion" type="submit" name="{{ $apartment}}">Delete</button>
        </form>
    </div>

@endsection