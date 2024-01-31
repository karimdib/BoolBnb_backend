@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create</h1>
    <form action="{{route('admin.apartments.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" placeholder="description" name="description">
        </div>
        <div class="mb-3">
            <label for="rooms" class="form-label">Rooms</label>
            <input type="text" class="form-control" id="last_name" placeholder="rooms" name="rooms">
        </div>
        <div class="mb-3">
            <label for="beds" class="form-label">Beds</label>
            <input type="text" class="form-control" id="beds" placeholder="beds" name="beds">
        </div>
        <div class="mb-3">
            <label for="bathrooms" class="form-label">bathrooms</label>
            <input type="text" class="form-control" id="bathrooms" placeholder="bathrooms" name="bathrooms">
        </div>
        <div class="mb-3">
            <label for="square_meters" class="form-label">square_meters</label>
            <input type="text" class="form-control" id="square_meters" placeholder="square_meters" name="square_meters">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">address</label>
            <input type="text" class="form-control" id="address" placeholder="address" name="address">
        </div>
        <button type="submit">CREA</button>
    </form>

</div>
@endsection