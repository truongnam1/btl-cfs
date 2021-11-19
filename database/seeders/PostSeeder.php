<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all()->pluck('id');
        $tags = Tag::all()->pluck('id');
        // ->random()
        for ($i = 0; $i < 100; $i++) {
            $post = [
                "user_id" => $users->random(),
                "title" => $faker->realText($faker->numberBetween(20, 40)),
                "content" => $faker->realText($faker->numberBetween(20, 800)),
                // 'access_level' => $accessLevelId,
                'tags' => '',
                'comments' => [
                    'total' => 0,
                ],
                'reacts' => [
                    'total' => 0
                ],
                'views' => [
                    'total' => 0
                ]
            ];
            $arrTag = [];
            $amountTag = $faker->numberBetween(2, 6);
            for ($j = 0; $j < $amountTag; $j++) {
                array_push($arrTag, $tags->random());
            }
            $post['tags'] = $arrTag;

            Post::create($post);
        }
    }
}
