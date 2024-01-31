<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
                [
                    'name' => 'silver',
                    'duration' => 24,
                    'cost' => 2.99
                ],
                [
                    'name' => 'gold',
                    'duration' => 48,
                    'cost' => 5.99
                ],
                [
                    'name' => 'platinum',
                    'duration' => 144,
                    'cost' => 9.99
                ],
            ];
        foreach ($sponsorships as $sponsorship){
            $new_sponsorship = new Sponsorship;
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->duration = $sponsorship['duration'];
            $new_sponsorship->cost = $sponsorship['cost'];

            $new_sponsorship->save();
        }
    }
}
