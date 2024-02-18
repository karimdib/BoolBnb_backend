<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Order;
use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

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


        for ($i = 0; $i < 50; $i++) {
            $new_order = new Order();
            $new_order->apartment_id = $faker->randomElement($apartmentIds);
            $new_order->sponsorship_id = $faker->randomElement($sponsorIds);

            $startDate = Carbon::now()->subMonth(); // Ottieni la data di un mese fa
            $endDate = Carbon::now(); // Ottieni la data di oggi            
            $randomDateTime = $faker->dateTimeBetween($startDate, $endDate);// Genera una data compresa tra $startDate e $endDate

            $new_order->date_start = $randomDateTime->format('Y-m-d H:i:s');
            $randomDate = Carbon::instance($randomDateTime);
            if ($new_order->sponsorship_id == 1) { //1 giorno
                $new_order->date_end = $randomDate->addDay()->format('Y-m-d H:i:s');
            } else if ($new_order->sponsorship_id == 2) { //2 giorno
                $new_order->date_end = $randomDate->addDays(2)->format('Y-m-d H:i:s'); 
            } else { //6 giorno
                $new_order->date_end = $randomDate->addDays(6)->format('Y-m-d H:i:s');
            }

            $new_order->save();
        }
    }
}
