@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="m-3">
            <h1 class="display-5 mb-4 text-center">Messages</h1>
            <div class="card p-4 shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Apartment</th>
                            <th>Subject</th>
                            <th>Sender</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($messages) --}}
                        {{-- @dump($apartments_with_messages) --}}
                        @forelse ($apartments_with_messages as $apartment)
                            @foreach ($messages as $message)
                                @if ($apartment->id === $message->apartment_id)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.apartments.show', $apartment) }}">
                                            {{$apartment->name}}
                                        </a>                        
                                    </td>
                                    <td>
                                        {{ $message->subject }}
                                    </td>
    
                                    <td>{{ $message->sender }} </td>
    
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary modal-trigger" id="show-messages"
                                        name="{{ $apartment->name }}" address="{{ $apartment->address }}" apartmentId=" {{$apartment->id}}"messages="{{ $messages }}" >
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                            <div class="modal-header">
                                                <ul>
                                                    <li><span class="fw-bold">Sender : </span>{{$message->sender}}</li>
                                                    <li><span class="fw-bold">Email : </span>{{$message->email}}</li>
                                                    <li><span class="fw-bold">Subject : </span>{{$message->subject}}</li>
                                                    {{-- <li><span class="fw-bold">Apartment : </span>{{$apartment->name}}</li> --}}
                                                </ul>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$message->content}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach                           
                        @empty
                            <tr>
                                <td colspan="5">
                                    <p class="fs-4 text-center p-4 opacity-75">
                                        No Apartments...
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- <x-messages-modal /> --}}
        </div>
    </div>
        
        <style>
            .modal-body {
                overflow-x: auto;
            }
            .message-cell {
                max-width: 100px;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
                cursor: pointer;
            }
            .message-cell:hover {
                text-decoration: aquamarine; 
            }
        </style>
    @push('scripts')
        <script src="{{ asset('js/messagesModal.js') }}"></script>
    @endpush
@endsection