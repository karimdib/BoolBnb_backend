@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create</h1>
        <form action="{{ route('admin.apartments.store') }}" method="POST">
            @csrf
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
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="text" class="form-control" id="bathrooms" placeholder="bathrooms" name="bathrooms">
            </div>
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square Meters</label>
                <input type="text" class="form-control" id="square_meters" placeholder="square_meters"
                    name="square_meters">
            </div>
            <div class="mb-3">
                <label for="street_name" class="form-label">Street Name</label>
                <input type="text" class="form-control" id="street_name" placeholder="Via Paolo Rossi"
                    name="street_name">
            </div>
            <div class="mb-3">
                <label for="street_number" class="form-label">Street Number</label>
                <input type="text" class="form-control" id="street_number" placeholder="10" name="street_number">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="Roma" name="city">
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">City</label>
                <input type="number" class="form-control" id="postal_code" placeholder="00144" name="postal_code">
            </div>
            <button type="submit">CREA</button>
        </form>

    </div>
@endsection
