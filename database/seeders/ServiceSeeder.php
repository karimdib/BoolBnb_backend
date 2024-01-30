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
                'name' => 'wifi'
            ],
            [
                'name' => 'pool'
            ],
            [
                'name' => 'parking'
            ],
            [
                'name' => 'gym'
            ],
            [
                'name' => 'security'
            ],
            [
                'name' => 'laundry'
            ],
            [
                'name' => 'pets'
            ],
            [
                'name' => 'clubhouse'
            ],
            [
                'name' => 'maintenance'
            ],
            [
                'name' => 'concierge'
            ]
        ];

        foreach ($services as $service) {
            $new_service = new Service;
            $new_service->name = $service['name'];

            $new_service->save();
        }
    }
}










