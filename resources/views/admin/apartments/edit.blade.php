@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit</h1>
    <form action="{{route ('admin.apartments.update', $apartment )}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{old('description', $apartment->description)}}">
        </div>
        <div class="mb-3">
            <label for="rooms" class="form-label">Rooms</label>
            <input type="text" class="form-control" id="last_name" name="rooms" value="{{old('rooms', $apartment->rooms)}}">
        </div>
        <div class="mb-3">
            <label for="beds" class="form-label">Beds</label>
            <input type="text" class="form-control" id="beds" name="beds" value="{{old('beds', $apartment->beds)}}">
        </div>
        <div class="mb-3">
            <label for="bathrooms" class="form-label">bathrooms</label>
            <input type="text" class="form-control" id="bathrooms" name="bathrooms" value="{{old('bathrooms', $apartment->bathrooms)}}">
        </div>
        <div class="mb-3">
            <label for="square_meters" class="form-label">square_meters</label>
            <input type="text" class="form-control" id="square_meters" name="square_meters" value="{{old('square_meters', $apartment->square_meters)}}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{old('address', $apartment->address)}}">
        </div>
        <button type="submit">Edit</button>
    </form>

</div>
@endsection