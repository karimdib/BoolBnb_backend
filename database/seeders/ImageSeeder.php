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
        $apartment_ids = $apartments->pluck('id');

        foreach ($apartment_ids as $apartment_id) {
            
            $new_image = new Image();
            $new_image->apartment_id = $faker->randomElement($apartment_ids);
            $new_image->link = $faker->file('public\storage\apartment_images','public\storage\images',false);
            $new_image->save();            
        }

    }
}
