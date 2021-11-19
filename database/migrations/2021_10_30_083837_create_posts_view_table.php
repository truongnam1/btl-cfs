<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('posts_view', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('post_id',20);
        //     $table->bigInteger('user_id');
        //     $table->ipAddress('ip');
        //     $table->string('agent', 200);
        //     $table->string('session_id',50);
        //     $table->timestamps();
        // }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_view');
    }
}
