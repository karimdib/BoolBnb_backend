@extends('layouts.app')

@section('content')
    <section class="container card py-3 my-3 shadow">
        <div class="d-flex justify-content-between">
            <h1 class="card-title">Your Apartments</h1>
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-primary align-self-center">View All</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($apartments as $apartment)
                    <tr>
                        <td>
                            <a href="{{ route('admin.apartments.show', $apartment) }}">
                                {{ $apartment->description }}
                            </a>
                        </td>

                        <td>{{ $apartment->address }} </td>
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
    </section>
    <section class="container card py-3 mb-3 shadow">
        <div class="d-flex justify-content-between">
            <h1 class="card-title">Your Sponsorships</h1>
            {{-- creare una rotta per lo storico degli ordini --}}
            <a href="{{ route('admin.orders.index') }}" 
            class="btn btn-outline-primary align-self-center">View All</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Name</th>
                    <th class="status">Status</th>
                    <th class="start">Sponsorship Start</th>
                    <th class="end">Sponsorship End</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($apartment_orders as $order)
                    <tr>
                        {{-- database fields --}}
                        <td>{{ $order->apartment->address }}</td>
                        @if ($order->sponsorship_id === 1)
                            <td>Gold</td>
                        @elseif($order->sponsorship_id === 2)
                            <td>Diamond</td>
                        @elseif($order->sponsorship_id === 3)
                            <td>Platinum</td>
                        @endif
                        @if ($date_now <= $order->date_end)
                            <td class="active status">Active</td>
                        @elseif($date_now >= $order->date_end)
                            <td class="inactive status">Inactive</td>
                        @endif
                        <td class="data-start">{{ $order->date_start }} </td>
                        <td class="data-end">{{ $order->date_end }} </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <p class="fs-4 text-center p-4 opacity-75">
                                No Sponsorships
                            </p>
                        </td>
                    </tr>
            </tbody>
            @endforelse
        </table>

    </section>

    @push('scripts')
        <script src="{{ asset('./js/formatDataSponsor.js') }}"></script>
    @endpush
@endsection
