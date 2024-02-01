<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $new_user = new User();
        $new_user->first_name = 'admin';
        $new_user->last_name = 'admin';
        $new_user->date_of_birth = '1999-01-12';
        $new_user->email = 'admin@gmail.com';
        $new_user->password = Hash::make('ciaomamma');
        $new_user->save();
        
        for ($i = 0; $i < 10; $i++) {
            $new_user = new User();
            $new_user->first_name = $faker->firstName();
            $new_user->last_name = $faker->lastName();
            $new_user->date_of_birth = $faker->date();
            $new_user->password = Hash::make($faker->password());
            $new_user->email = $faker->email();
            $new_user->save();
        }

    }
}
