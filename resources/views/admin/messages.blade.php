@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="m-3">
            <h1 class="display-5 mb-4 text-center">Apartments with Messages</h1>
            <div class="card p-4 shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Apartment ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apartments_with_messages as $apartment)
                            <tr>
                                {{-- database fields --}}
                                <td>{{ $apartment->id }} </td>

                                <td>
                                    <a href="{{ route('admin.apartments.show', $apartment) }}">
                                        {{ $apartment->name }}
                                    </a>
                                </td>

                                <td>{{ $apartment->address }} </td>

                                <td>
                                    <button class="btn btn-sm btn-outline-primary modal-trigger" id="show-messages"
                                    name="{{ $apartment->name }}" address="{{ $apartment->address }}" apartmentId=" {{$apartment->id}}"messages="{{ $messages }}" >
                                        Show messages
                                    </button>
                                </td>
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
            </div>
            <x-messages-modal />
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/messagesModal.js') }}"></script>
    @endpush
@endsection