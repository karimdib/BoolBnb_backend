<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

function TomTomLoad()
{
    dump("TomTom Functions Loaded...");
}

function TomTomBatchSearch()
{
    $jsonQuery = [];
    $addresses = [];

    // Load and decode Json with list of 262 positions (latitude, longitude)
    $json = File::get('../database/data/addressList.json');
    $apartments = json_decode($json);

    // Split apartments into chunks of 50 (TomTom batch limitation)
    foreach (array_chunk($apartments, 50) as $chunk) {
        $jsonQuery = [];

        // Save each query to the $jsonQuery array
        foreach ($chunk as $id => $apartment) {
            $jsonQuery['batchItems'][$id]['query'] = '/search/' . $apartment->position->lat . ',' . $apartment->position->lon . '.json?limit=1';
        }

        // Call the batch of queries, returning full address data for each position
        $base_url = 'https://api.tomtom.com/search/2/batch/sync';
        $api_key = '?key=XT5xzBM08iLmm4Ejz9AOcw37ilcrZqqm';
        $responseFormat = '.json';
        $query_url = $base_url . $responseFormat . $api_key;
        $response = Http::withOptions(['verify' => false])->post($query_url, $jsonQuery);
        $results = $response->json();

        // Append batch of results to addresses array
        $addresses[] = $results;
    }

    // Write new json file with full TomTom response
    File::put('../database/data/results.json', json_encode($addresses));
}

function TomTomBatchConvert()
{
    $location_data = [];
    $addresses = [];

    // Load and decode json with TomTom Batch Search response
    $json = File::get('../database/data/results.json');
    $decoded = json_decode($json);

    // Loop through decoded json and extract needed data
    foreach ($decoded as $id => $batch) {
        $batchItems = $batch->batchItems;
        foreach ($batchItems as $id => $item) {

            // Store address and position and append to arresses array
            $location_data[$id]['address'] = $item->response->results[0]->address;
            $location_data[$id]['position'] = $item->response->results[0]->position;
            $addresses[] = $location_data[$id];
        }
    }
    // Write json with data with converted addresses, to use for database seeding
    File::put('../database/data/convertedAddressList.json', json_encode($addresses));
}
