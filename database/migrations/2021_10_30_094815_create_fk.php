<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('report_posts', function (Blueprint $table) {
        //     $table->foreign('status_id')->references('id')->on('status_report');

        //     $table->foreign('status_id')
        //     ->references('id')
        //     ->on('status_report')
        //     ->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('report_posts', function (Blueprint $table) {
        //     $table->dropForeign('status_report_id_foreign');
        // });
    }
}
