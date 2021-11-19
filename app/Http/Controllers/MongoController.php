<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Str;

class MongoController extends Controller
{
    public function create()
    {
        $faker = Faker::create();




        $res = "";
        for ($i = 0; $i < 5; $i++) {
            $arr  = [];

            for ($j = 0; $j < 1; $j++) {
                $users = [];
                for ($k = 0; $k < 5; $k++) {
                    $users[] = [$faker->uuid() => ["created_at" => $faker->unixTime('-1 month', 'now')]];
                }

                $postId = $faker->numberBetween(111111, 1111111111);
                $voteId = $faker->numberBetween(1111111, 9111111111);

                $question = $faker->text(100);
               
                $arrAnwserContent[Str::random(10)] = ["content" => $faker->text(100), "user_vote" => $users];

                $users = [];
                for ($k = 0; $k < 5; $k++) {
                    $users[] = [ "user_id" => Str::random(23) , "created_at" => $faker->unixTime('-1 month', 'now')];
                }

                $arrAnwserContent[$faker->numberBetween(111111, 1111111111)] = ["content" => $faker->text(100), "user_vote" => $users];
                


                $arrBase = [
                    "post_id" => "$postId",
                    "vote_id" => "$voteId",
                    "created_at" => $faker->unixTime('-1 month', 'now'),
                    "question" => $question,
                    "anwser_content" => $arrAnwserContent,
                    // "list_vote" => "",
                ];
                $arr[] = $arrBase;
            }
            $res = Book::insert($arr);
        }




        // return view('welcome');

        return $res;
    }
    public function get()
    {

        $res = DB::connection('mongodb')->collection('books')->get();


        return $res;
        // return view('welcome');
    }

    public function get2()
    {
        $book = Book::where("anwser_content.j177pbzeqs.content", 'like', "%cum%")->select(["anwser_content"])->get();
        // return $book;


        Debugbar::info($book);
        Debugbar::startMeasure('render', 'Time for rendering');
        Debugbar::stopMeasure('render');
        return view("welcome");
    }
}
