<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

$json = File::get('C:\Coding\fp\BoolBnb_backend\database\data\addressList.json');
$apartments = json_decode($json);
$jsonQuery = [];
$addresses = [];

foreach (array_chunk($apartments, 50) as $chunk) {
    $jsonQuery = [];
    foreach ($chunk as $id => $apartment) {
        $jsonQuery['batchItems'][$id]['query'] = '/search/' . $apartment->position->lat . ',' . $apartment->position->lon . '.json?limit=1';
    }

    // Axios call to TomTom Api
    $base_url = 'https://api.tomtom.com/search/2/batch/sync';
    $api_key = '?key=XT5xzBM08iLmm4Ejz9AOcw37ilcrZqqm';
    $responseFormat = '.json';
    $query_url = $base_url . $responseFormat . $api_key;
    $response = Http::withOptions(['verify' => false])->post($query_url, $jsonQuery);
    $results = $response->json();
    $addresses[] = $results;
    dump($results);
}

File::put('C:\Coding\fp\BoolBnb_backend\database\data\results.json', json_encode($addresses));
dump('DONE');
