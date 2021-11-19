<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccessModifierLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_modifier_level', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name',20)->unique();
            $table->timestamps();
        });

        DB::table('access_modifier_level')->insert([
            'name' => 'Riêng tư'
        ]);
        DB::table('access_modifier_level')->insert([
            'name' => 'Công khai'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_modifier_level');
    }
}
