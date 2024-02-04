<?php

use Illuminate\Support\Facades\File;

$json = File::get('../database/data/results.json');
$decoded = json_decode($json);
$location_data = [];
$addresses = [];
foreach ($decoded as $id => $batch) {
    $batchItems = $batch->batchItems;
    foreach ($batchItems as $id => $item) {
        $address = $item->response->results[0]->address->freeformAddress;
        $latitude = $item->response->results[0]->position->lat;
        $longitude = $item->response->results[0]->position->lat;

        $location_data[$id]['address'] = $item->response->results[0]->address->freeformAddress;
        $location_data[$id]['latitude'] = $item->response->results[0]->position->lat;
        $location_data[$id]['longitude'] = $item->response->results[0]->position->lon;
        $addresses[] = $location_data[$id];
    }
}

dump($addresses);
$json = File::put('../database/data/convertedAddresses.json', json_encode($addresses));
