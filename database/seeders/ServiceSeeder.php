<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Wifi'
            ],
            [
                'name' => 'Pool'
            ],
            [
                'name' => 'Parking'
            ],
            [
                'name' => 'Gym'
            ],
            [
                'name' => 'Security'
            ],
            [
                'name' => 'Laundry'
            ],
            [
                'name' => 'Pets'
            ],
            [
                'name' => 'Clubhouse'
            ],
            [
                'name' => 'Maintenance'
            ],
            [
                'name' => 'Concierge'
            ]
        ];

        foreach ($services as $service) {
            $new_service = new Service;
            $new_service->name = $service['name'];

            $new_service->save();
        }
    }
}
