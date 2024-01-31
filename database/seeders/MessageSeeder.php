<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $new_message = new Message();
            $new_message->subject = $faker->word();
            $new_message->content = $faker->text();
            $new_message->sender = $faker->name();
            $new_message->email = $faker->email();
            $new_message->save();
        }
    }
}
