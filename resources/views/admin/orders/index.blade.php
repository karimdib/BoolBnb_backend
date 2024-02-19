@extends('layouts.app')

@section('content')
<section class="container card py-3 mb-3 shadow">
    <div class="d-flex justify-content-between">
        <h1 class="card-title">All your sponsorships</h1>
    </div>
    <table class="table">
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
                <td>
                    <a href="{{ route('admin.apartments.show', $order->apartment_id) }}">
                        {{ $order->apartment->address }}</a>
                </td>
                @if ($order->sponsorship_id === 1)
                <td>Gold</td>
                @elseif($order->sponsorship_id === 2)
                <td>Diamond</td>
                @elseif($order->sponsorship_id === 3)
                <td>Platinum</td>
                @endif
                @if ($date_now <= $order->date_end)
                    <td class="active status" id="index-status-active">Active</td>
                    @elseif($date_now >= $order->date_end)
                    <td class="inactive status" id="index-status-inactive">Inactive</td>
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
@endsection

<style lang="scss" scoped>
    .table {
        border-style: none !important;
        border-color: white !important;
    }

    @media screen and (min-width:769px) {
        #index-status-active {
            margin-top: 0px !important;
        }

        #index-status-inactive {
            margin-top: 0px !important;
        }
    }

    @media screen and (max-width:488px) {
        #index-status-active {
            margin-top: 0px !important;
        }

        #index-status-inactive {
            margin-top: 0px !important;
        }
    }
</style>