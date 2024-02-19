@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="display-5 mb-4 text-center">Messages</h1>
        <div class="card shadow">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="apartment-cell">Apartment</th>
                            <th class="date-cell-lg">Date</th>
                            <th>Sender</th>
                            <th>Subject</th>
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
                                        <td class="apartment-cell">
                                            <a href="{{ route('admin.apartments.show', $apartment) }}">
                                                {{ $apartment->name }}
                                            </a>
                                        </td>
                                        <td class="date-cell-lg">
                                            <span class="message-date">{{ $message->created_at }}</span>
                                        </td>
                                        <td class="sender-cell">
                                            {{ $message->sender }}
                                        </td>

                                        <td class="sender-cell">
                                            {{ $message->subject }}
                                        </td>

                                        <td class="sender-cell">
                                            <button class="btn btn-sm btn-outline-primary modal-trigger" id="show-messages"
                                                message="{{ $message }}" apartment="{{ $apartment }}">
                                                Show
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="date-cell-sm" colspan="3">
                                            <span class="message-date">{{ $message->created_at }}</span>
                                        </td>
                                    </tr>
                                    <div class="modal" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <ul>
                                                        <li>
                                                            <span class="fw-bold">Sender : </span>
                                                            <span id="message-sender"></span>
                                                        </li>
                                                        <li>
                                                            <span class="fw-bold">Date : </span>
                                                            <span id="message-date"></span>
                                                        </li>
                                                        <li>
                                                            <span class="fw-bold message-email">Email : </span>
                                                            <span id="message-email"></span>
                                                        </li>
                                                        <li>
                                                            <span class="fw-bold message-subject">Subject : </span>
                                                            <span id="message-subject"></span>
                                                        </li>
                                                        <li>
                                                            <span class="fw-bold message-apartment">Apartment : </span>
                                                            <a href="{{ route('admin.apartments.show', $apartment) }}">
                                                                <span id="message-apartment"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="message-content">{{ $message->content }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary close-modal"
                                                        data-bs-dismiss="modal">Close</button>
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
                                        No Messages
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style lang="scss" scoped>
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

        .apartment-cell,
        .date-cell-lg {
            display: none;
        }

        .sender-cell {
            border-bottom-width: 0 !important;
        }

        @media (min-width: 768px) {

            .apartment-cell,
            .date-cell-lg {
                display: table-cell;
            }

            .date-cell-sm {
                display: none;
            }

            .sender-cell {
                border-bottom-width: var(--bs-border-width) !important;
            }
        }
    </style>
    @push('scripts')
        <script src="{{ asset('js/messagesModal.js') }}"></script>
        <script src="{{ asset('js/messagesDateFormat.js') }}"></script>
    @endpush
@endsection
