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
        <h4 class="display-5 m-4 text-center">Sponsorship</h4>
        <div class="card-body">
            <form action="{{ route('admin.processPayment',$apartment) }}" method="POST" id="payment-form">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                    <label for="cardholder-name" class="form-label">Nome del Titolare della Carta</label>
                    <input type="text" class="form-control" id="cardholder-name" name="cardholder_name" required
                        placeholder="Nome e Cognome">
                </div>
                <div class="mb-3">
                    <label for="cardholder-name" class="form-label">Numero della Carta</label>
                    <input type="number" class="form-control" id="cardholder-name" name="cc-card" required
                        placeholder="xxxx-xxxx-xxxx-xxxx">
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                        name="pay_method">
                        <option value="1" name="1">Gold</option>
                        <option value="2" name="2">Diamond</option>
                        <option value="3" name="3">Platinum</option>
                    </select>
                    <label for="floatingSelect">Scegli la Promozione</label>
                </div>
                <input type="hidden" id="promotion" name="promotion_hidden">
                <input type="hidden" id="nonce" name="payment_method_nonce">
                <button type="submit" class="btn btn-primary mb-5" id="submit-button">Effettua Pagamento</button>
            </form>
        </div>
        <div class="d-flex justify-content-center gap-4">
            <a class="btn btn-outline-secondary flex-grow-1 shadow"
                href="{{ route('admin.apartments.edit', $apartment) }}">Edit</a>
            <form class="flex-grow-1 shadow" action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                id="deletionForm">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger w-100" id="deletion" type="submit" name="{{ $apartment }}">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection