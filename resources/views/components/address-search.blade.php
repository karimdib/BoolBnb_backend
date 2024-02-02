<div class="mb-3">
    <div id="search-results">
        <label for="address-search">Address Finder</label>
        <div class="d-flex gap-3">
            <input class="form-control" type="search" name="address" id="address-search"
                placeholder="Search address and select match">
            <button class="btn btn-primary" id="search-button">Search</button>
        </div>
    </div>
</div>

<div class="mb-3 ">
    <label for="latitude">Latitude</label>
    <input class="form-control mb-3" type="text" name="latitude" id="latitude">
    <label for="latitude">Longitude</label>
    <input class="form-control mb-3" type="text" name="longitude" id="longitude">
</div>

<style>
    .search-result {
        cursor: pointer;
    }

    .search-result:hover {
        color: rgb(58, 80, 201);
        font-weight: 700;
    }
</style>
