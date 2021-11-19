<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user = User::all()->first();


        for ($i=0; $i < 20; $i++) { 
            $temp = [
                'tag_name' => $faker->city,
                'description' => $faker->text(100),
                'user_id' => $user->id
            ];

            Tag::create($temp);
        }
    }
}
