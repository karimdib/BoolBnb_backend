<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $json = File::get("database/data/convertedAddressList.json");
        $apartments = json_decode($json);
        foreach ($apartments as $id => $apartment) {

            // Create, name and assign to user
            $new_apartment = new Apartment();
            $new_apartment->description = $faker->sentence(3);
            $new_apartment->slug = Str::slug($new_apartment->description);
            $new_apartment->user_id = User::all()->random()->id;

            // Generate coherent rooms, beds, bathrooms, square meters
            $new_apartment->rooms = $faker->numberBetween(1, 12);
            if ($new_apartment->rooms <= 4) {
                $new_apartment->beds = $faker->numberBetween(1, 2);
                $new_apartment->bathrooms = 1;
                $new_apartment->square_meters = $faker->numberBetween(50, 80);
            } elseif ($new_apartment->rooms > 4 && $new_apartment->rooms <= 8) {
                $new_apartment->bathrooms = 2;
                $new_apartment->beds = $faker->numberBetween(3, 4);
                $new_apartment->square_meters = $faker->numberBetween(81, 120);
            } else {
                $new_apartment->bathrooms = 3;
                $new_apartment->beds = $faker->numberBetween(5, 6);
                $new_apartment->square_meters = $faker->numberBetween(121, 200);
            }

            // Get latitude and longitude from json
            $new_apartment->address = $apartment->address;
            $new_apartment->latitude = $apartment->latitude;
            $new_apartment->longitude = $apartment->longitude;

            $new_apartment->save();
        }
    }
}
















// $jsonQuery = [];
// foreach ($apartments as $id => $apartment) {
//     $jsonQuery["batchItems"][$id]["query"] = "/search/" . $apartment->city . ".json";
// }
// $base_url = "https://api.tomtom.com/search/2/batch/sync";
// $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
// $responseFormat = ".json";
// $query_url = $base_url . $responseFormat . $api_key;
// $response = Http::withOptions(['verify' => false])->post($query_url, $jsonQuery);
// // File::put("database/data/test.json", json_encode($jsonQuery));
// File::put("database/data/test.json", $response);



// $results = $response->json()["results"];



// $new_apartment = new Apartment();
// $new_apartment->description = $faker->sentence(3);
// $new_apartment->latitude = $apartment->position->lat;
// $new_apartment->longitude = $apartment->position->lon;
// $position = $new_apartment->latitude . "," . $new_apartment->longitude;
// $base_url = "https://api.tomtom.com/search/2/search/";
// $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
// $responseFormat = ".json";
// $query_url = $base_url . $position . $responseFormat . $api_key;
// $response = Http::withOptions(['verify' => false])->get($query_url);
// $results = $response->json()["results"];
// $new_apartment->address =  $results[0]["address"]["freeformAddress"];
// $new_apartment->address = $position;
// $new_apartment->user_id = User::all()->random()->id;
// $new_apartment->save();
// File::put("database/data/test.json", json_encode($apartments));

// function getAddress($position)
// {
//     $base_url = "https://api.tomtom.com/search/2/search/";
//     $api_key = "?key=qD5AjlcGdPMFjUKdDAYqT7xYi3yIRo3c";
//     $responseFormat = ".json";
//     $query_url = $base_url . $position . $responseFormat . $api_key;
//     $response = Http::withOptions(['verify' => false])->get($query_url);
//     return $response->json()["results"];
// }


// for ($i = 0; $i < 50; $i++) {

//     $new_apartment = new Apartment();
//     $new_apartment->save();
// }

// $new_apartment->description = $faker->text(50);


// // $new_apartment->address = $faker->address();
// $new_apartment->visible = $faker->boolean();
// $new_apartment->cover_image = $faker->imageUrl(360, 360, true);
// $new_apartment->user_id = $faker->randomElement($userIds);


// $new_apartment->services()->attach(Service::all()->random(3));