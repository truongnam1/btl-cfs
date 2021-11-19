<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reacts', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('react_name',20)->unique();
            $table->string('image');

            $table->timestamps();
        });
        DB::table('reacts')->insert([
            'react_name' => 'Thích',
            'image' => 'https://i.ibb.co/XXDCgJJ/Thumb-up-like-icon-social-media-transparent-PNG.png'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reacts');
    }
}
