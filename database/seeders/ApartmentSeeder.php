<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $users = User::all();
        $userIds = $users->pluck('id');
        for ($i = 0; $i < 50; $i++) {

            $new_apartment = new Apartment();
            $new_apartment->description = $faker->text(50);
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

            // $new_apartment->address = $faker->address();
            $new_apartment->visible = $faker->boolean();
            $new_apartment->cover_image = $faker->imageUrl(360, 360, true);
            $new_apartment->user_id = $faker->randomElement($userIds);

            $new_apartment->save();

            $new_apartment->services()->attach(Service::all()->random(3));
        }
    }
}
