@extends('layouts.app')

@section('content')
<section class="container card py-3 my-3">
    <div class="d-flex justify-content-between">
        <h1 class="card-title">Your Apartments</h1>
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary align-self-center">View All</a>
    </div>
    <table class="card-body">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Apartment ID</th>
                <th>Name</th>
                <th>Address</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($apartments as $apartment)
            <tr>
                {{-- database fields --}}
                <td>{{ $apartment->user_id }} </td>
                <td>{{ $apartment->id }} </td>
        
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
<section class="container card py-3 mb-3">
    <div class="d-flex justify-content-between">
        <h1 class="card-title">Your Sponsorships</h1>
        {{-- creare una rotta per lo storico degli ordini --}}
        <a href="" class="btn btn-primary align-self-center">View All</a>
    </div>
    <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Sponsorship Level</th>
            <th>Sponsorship ON</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($apartment_orders as $order)
        <tr>
            {{-- database fields --}}
            <td>{{ $order->date_start }} </td>
            <td>{{ $order->date_end }} </td>
    
            <td>
                
            </td>
    
            <td>{{ $apartment->address }} </td>
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

<section class="container card py-3 mb-3">
    <div class="d-flex justify-content-between">
        <h1 class="card-title">Statistics</h1>
        {{-- creare una rotta per le statistiche --}}
        <a href="" class="btn btn-primary align-self-center">View All</a>
    </div>
    <table>
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        {{-- @forelse ($orders as $order)
        <tr>
            
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
        @endforelse --}}
</table>
</section>


@endsection
