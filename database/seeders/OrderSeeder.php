<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Order;
use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $sponsors = Sponsorship::all();
        $sponsorIds = $sponsors->pluck('id');

        $activeApartments = Apartment::where('visible', 1)->get();
        $apartmentIds = $activeApartments->pluck('id');


        for ($i = 0; $i < 23; $i++) {
            $new_order = new Order();
            $new_order->apartment_id = $faker->randomElement($apartmentIds);
            $new_order->sponsorship_id = $faker->randomElement($sponsorIds);
            $new_order->save();
        }
    }
}
