@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if ($apartment->cover_image)
    <figure class="d-flex justify-content-center">
        @if (str_contains($apartment->cover_image, 'cover_images'))
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
            <li class="list-group-item p-4 "><span class="fw-bold">Apartment Name:
                </span>{{ $apartment->name }}</li>
            <li class="list-group-item p-4 "><span class="fw-bold">Slug:
                </span>{{ $apartment->slug }}</li>
            <li class="list-group-item p-4 "><span class="fw-bold">Apartment Description:
                </span>{{ $apartment->description }}</li>
            <li class="list-group-item p-4 "><span class="fw-bold">Rooms: </span>{{ $apartment->rooms }}
            </li>
            <li class="list-group-item p-4 "><span class="fw-bold">Beds: </span>{{ $apartment->beds }}
            </li>
            <li class="list-group-item p-4 "><span class="fw-bold">Bathrooms:
                </span>{{ $apartment->bathrooms }}</li>
            <li class="list-group-item p-4 "><span class="fw-bold">Square meters:
                </span>{{ $apartment->square_meters }}
            </li>
            <li class="list-group-item p-4 ">
                <span class="fw-bold">Address:</span>
                {{ $apartment->address }}, {{ $apartment->country }}
            </li>
            <li class="list-group-item p-4 ">
                <span class="fw-bold">Visible: </span>
                @if ($apartment->visible)
                <span>Yes</span>
                @else
                <span>No</span>
                @endif
            </li>
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
            @if (str_contains($image, 'image'))
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
            <a class="btn btn-outline-primary flex-grow-1 shadow"
                href="{{ route('admin.apartments.edit', $apartment) }}">Edit</a>
            <form class="flex-grow-1 shadow" action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                id="deletionForm">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger w-100 modal-trigger" name="{{ $apartment->name }}"
                    address="{{ $apartment->address }}" id="deletion" type="submit"
                    name="{{ $apartment }}">Delete</button>
            </form>
        </div>

        <h4 class="display-5 m-4 text-center">Sponsorship</h4>
        <div class="container card py-3 my-3 shadow">
            <form action="{{ route('admin.processPayment', $apartment) }}" method="POST" id="payment-form">
                @csrf
                <div class="form-floating mb-3">
                    <select class="form-select" id="promo" aria-label="Floating label select example" name="pay_method">
                        <option value="1" name="1">Gold <span class="amount">-- &euro;2.99</span></option>
                        <option value="2" name="2">Diamond <span class="amount">-- &euro;5.99</span>
                        </option>
                        <option value="3" name="3">Platinum <span class="amount">-- &euro;9.99</span>
                        </option>
                    </select>
                    <label for="floatingSelect">Scegli la Promozione</label>
                    <div class="red"></div>
                </div>
                <div class="mb-3" id="card-name-father">
                    <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                    <label for="cardholder-name" class="form-label">Cardholder's Name</label>
                    <input type="text" class="form-control" id="cardholder-name" name="cardholder_name"
                        placeholder="Nome e Cognome">
                    <div class="red"></div>
                </div>
                <div class="mb-3" id="card-number-father">
                    <label for="cardholder-name" class="form-label">Card Number</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text credit-card" id="addon-wrapping">
                            <img class="creditcard width-card" id="image-credit" src="/images/creditcard.png" alt=""
                                value="e">
                        </span>
                        <input type="text" class="form-control" id="number-card" name="cc-card"
                            placeholder="xxxx-xxxx-xxxx-xxxx" maxlength="19">
                    </div>
                    <div id="error-card" class="red"></div>
                </div>
                <input type="hidden" id="promotion" name="promotion_hidden">
                <input type="hidden" id="nonce" name="payment_method_nonce">
                <button type="submit" class="btn btn-primary mb-5" id="submit-button">Make Payment</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <canvas id="visits"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script> const visitsJS = @php echo json_encode($visits); @endphp </script>
@push('scripts')
    <script type="module" src="{{ asset('/js/visitsGraph.js') }}"></script>
@endpush

<x-delete-modal />
<style>
    .red {
        color: red;
        border-color: red;
    }

    .amount {
        color: grey !important;
        font-size: 7px !important;
    }

    .creditcard {
        width: 30px;
    }
</style>
{{-- @push('scripts')
<script src="{{ asset('./js/payment.js') }}"></script>
@endpush
@push('scripts')
<script src="{{ asset('js/deleteModal.js') }}"></script>
@endpush --}}
@endsection