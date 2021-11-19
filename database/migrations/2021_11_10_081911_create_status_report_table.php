<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStatusReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_report', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('status_name',30);
            $table->timestamps();
        });
       
        DB::table('status_report')->insert([
            'status_name' => 'Chưa xử lý'
        ]);
        DB::table('status_report')->insert([
            'status_name' => 'Đang xử lý'
        ]);
        DB::table('status_report')->insert([
            'status_name' => 'Đã xử lý'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_report');
    }
}
