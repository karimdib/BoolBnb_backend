<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $apartments = Apartment::all();
        $apartmentIds = $apartments->pluck('id');
        $new_image = new Image();
        $new_image->apartment_id = $faker->randomElement($apartmentIds);
        $new_image->link = $faker->imageUrl(360, 360, true);
        $new_image->save();
    }
}
