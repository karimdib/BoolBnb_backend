<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Order;
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
        $apartments = Apartment::all();
        $apartmentIds = $apartments->pluck('id');
        $new_order = new Order();
        $new_order->apartment_id = $faker->randomElement($apartmentIds);
        $new_order->save();
    }
}
