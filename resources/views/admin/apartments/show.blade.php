@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h1 class="text-center">{{ $apartment->name }}</h1>
    </div>
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
        <h3>{{ $apartment->description }}</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="my-3">
                    <ul class="list-group shadow mb-4 text-capitalize">
                        <li class="list-group-item p-3 "><span class="fw-bold">Rooms: </span>{{ $apartment->rooms }}
                        </li>
                        <li class="list-group-item p-3 "><span class="fw-bold">Beds: </span>{{ $apartment->beds }}
                        </li>
                        <li class="list-group-item p-3 "><span class="fw-bold">Bathrooms:
                            </span>{{ $apartment->bathrooms }}</li>
                        <li class="list-group-item p-3 ">
                            <span class="fw-bold">Size:</span>
                            <span>{{ $apartment->square_meters }}sqm</span>
                        </li>
                        <li class="list-group-item p-3 ">
                            <span class="fw-bold">Address:</span>
                            {{ $apartment->address }}, {{ $apartment->country }}
                        </li>
                        <li class="list-group-item p-3">
                            <span class="fw-bold">Services:
                                @forelse ($apartment->services as $service)
                                    <span class="badge rounded-pill text-bg-primary">{{ $service->name }}</span>
                                @empty
                                    <span class="list-group-item p-2">Your apartment has no services!</span>
                                @endforelse
                        </li>
                        <li class="list-group-item p-3 ">
                            <span class="fw-bold">Visible: </span>
                            @if ($apartment->visible)
                                <span class="green">Yes</span>
                            @else
                                <span class="red">No</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-6">
                <section>
                    <canvas id="visits"></canvas>
                </section>

                <section>
                    <div class="container card py-2 my-3 shadow font-size-small">
                        <form action="{{ route('admin.processPayment', $apartment) }}" method="POST" id="payment-form">
                            @csrf
                            <label class="form-label" for="floatingSelect">Choose promotion</label>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="promo" aria-label="Floating label select example"
                                    name="pay_method font-size-small">
                                    <option class="font-size-small ps-2" value="1" name="1"> Gold
                                        <span class="amount">-- &euro;2.99</span>
                                    </option>
                                    <option class="font-size-small" value="2" name="2">Diamond
                                        <span class="amount">-- &euro;5.99</span>
                                    </option>
                                    <option class="font-size-small" value="3" name="3">Platinum
                                        <span class="amount">-- &euro;9.99</span>
                                    </option>
                                </select>
                                <div class="red"></div>
                            </div>

                            <div class="mb-3" id="card-name-father">
                                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                                <label for="cardholder-name" class="form-label">Cardholder's Name</label>
                                <input type="text" class="form-control" id="cardholder-name" name="cardholder_name"
                                    placeholder="Kevin Smith">
                                <div class="red"></div>
                            </div>

                            <div class="mb-3" id="card-number-father">
                                <label for="cardholder-name" class="form-label">Card Number</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text credit-card" id="addon-wrapping">
                                        <img class="creditcard width-card" id="image-credit" src="/images/creditcard.png"
                                            alt="" value="e">
                                    </span>
                                    <input type="text" class="form-control" id="number-card" name="cc-card"
                                        placeholder="xxxx-xxxx-xxxx-xxxx" maxlength="19">
                                </div>
                                <div id="error-card" class="red"></div>
                            </div>
                            <input type="hidden" id="promotion" name="promotion_hidden">
                            <input type="hidden" id="nonce" name="payment_method_nonce">
                            <button type="submit" class="btn btn-primary mb-2 font-size-small" id="submit-button">Make
                                Payment</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <div class="">
            <ul class="mb-4 row">
                @foreach ($images as $image)
                        <li class="d-flex col-4 p-2">
                            <img class="w-100" src="{{ asset('storage/images') . '/' . $image->link }}" alt="">
                        </li>
                @endforeach
            </ul>
        </div>


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


    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const visitsJS = @php echo json_encode($visits); @endphp
    </script>
    @push('scripts')
        <script type="module" src="{{ asset('/js/visitsGraph.js') }}"></script>
    @endpush

    <x-delete-modal />
    <style>
        .red {
            color: red;
            border-color: red;
        }

        .green {
            color: green;
        }

        .amount {
            color: grey !important;
            font-size: 7px !important;
        }

        .creditcard {
            width: 30px;
        }

        .font-size-small {
            font-size: 16px;
        }

        .form-select {
            width: 50%;
        }

        .form-control,
        .form-select,
        .input-group-text {
            padding: 10px !important;
            font-size: 18px;
            min-height: 0 !important;
            height: 40px !important;
        }
    </style>
    @push('scripts')
        <script src="{{ asset('./js/payment.js') }}"></script>
    @endpush
    @push('scripts')
        <script src="{{ asset('js/deleteModal.js') }}"></script>
    @endpush
@endsection
