<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Visit;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {   


        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            //Genero 20 visite per ogni appartamento nell'ultimo mese
            for ($i=0; $i < 20; $i++) { 
                // Genero una data casuale tra oggi e una settimana fa
                $startDate = strtotime('-1 week');
                $endDate = time();
                $randomTimestamp = rand($startDate, $endDate);
                // Formatto la data nel formato YY-MM-DD hh:mm:ss
                $randomDate = date('y-m-d H:i:s', $randomTimestamp);
    
                // Creo una nuova visita
                $new_visit = new Visit();
                $new_visit->apartment_id = $apartment->id;
                $new_visit->ip_address = $faker->ipv4();
                $new_visit->date = $randomDate;
                $new_visit->save();
            }
        }
    }
}
