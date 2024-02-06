<div class="mb-3">
    <div id="search-results">
        <label for="address-search">Address</label>
        <div class="d-flex gap-3">
            <input class="form-control" type="search" name="address" id="address-search" value="{{ old('address') }}"
                placeholder="Search address and select match">
            <button class="btn btn-primary" id="search-button">Search</button>
        </div>
    </div>
</div>

<div class="mb-3 p-3 border rounded d-none">

    <label for="matched_address">Matched Address</label>
    <input class="form-control mb-3" type="text" name="a_searched_address" id="match"
        value="{{ old('matched_address') }}">

</div>

@push('scripts')
    <script src="{{ asset('js/addressSearch.js') }}"></script>
@endpush

<style>
    .search-result {
        cursor: pointer;
    }

    .search-result:hover {
        color: rgb(58, 80, 201);
        font-weight: 700;
    }
</style>
