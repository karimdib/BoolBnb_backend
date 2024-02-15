<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
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
        foreach ($apartments as $apartment) {

            // Create, name and assign to user
            $new_apartment = new Apartment();
            $new_apartment->cover_image = $faker->file('public\storage\apartment_images', 'public\storage\cover_images', false);
            $new_apartment->name = $faker->sentence(3);
            $new_apartment->slug = Str::slug($new_apartment->name);
            $new_apartment->description = $faker->text();
            $new_apartment->visible = $faker->boolean(80);
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

            // Get address, latitude and longitude from json
            $new_apartment->address = $apartment->address->freeformAddress;
            $new_apartment->region = $apartment->address->countrySubdivision;
            $new_apartment->country = $apartment->address->country;
            $new_apartment->latitude = $apartment->position->lat;
            $new_apartment->longitude = $apartment->position->lon;

            // Save appartment
            $new_apartment->save();

            // Attach 3 random services
            $new_apartment->services()->attach(Service::all()->random(3));
        }
    }
}
