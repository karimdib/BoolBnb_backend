@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="m-3">
            <h1 class="display-5 mb-4 text-center">Apartment List</h1>
            <a class="btn btn-outline-primary mb-4 w-100 shadow" href="{{ route('admin.apartments.create') }}">
                Create Apartment
            </a>
            <div class="card p-4 shadow">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th class="large-button"></th>
                                <th class="large-button"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($apartments as $apartment)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.apartments.show', $apartment) }}">
                                            {{ $apartment->name }}
                                        </a>
                                    </td>
    
                                    <td>{{ $apartment->address }} </td>
    
                                    {{-- edit and delete buttons --}}
                                    <td class="large-button">
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('admin.apartments.edit', $apartment) }}">Edit
                                        </a>
                                    </td>
                                    <td class="large-button">
                                        <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                                            id="deletionForm">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger modal-trigger" id="deletion" type="submit"
                                                name="{{ $apartment->name }}" address="{{ $apartment->address }}">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mobile-button">
                                        <div class="d-flex gap-3 align-items-start">
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.apartments.edit', $apartment) }}">Edit
                                            </a>
                                            <form action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST"
                                                id="deletionForm">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger modal-trigger" id="deletion" type="submit"
                                                    name="{{ $apartment->name }}" address="{{ $apartment->address }}">Delete
                                                </button>
                                            </form>
                                        </div>
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
            </div>
            <div class="mt-4">
                {{ $apartments->links('pagination::bootstrap-5') }}
            </div>
            <x-delete-modal />
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/deleteModal.js') }}"></script>
    @endpush
@endsection

<style lang="scss" scoped>
    .table > :not(caption) > * > * {
        border-bottom-width: 0 !important;
        border-top-width: var(--bs-border-width);
    }
    .mobile-button {
        border-top-width: 0 !important;
    }
    .large-button {
        visibility: hidden;
       }

    @media (min-width: 768px) { 
       .large-button {
        visibility: visible;
       }
       .mobile-button {
          display: none;
      }
     }

</style>
