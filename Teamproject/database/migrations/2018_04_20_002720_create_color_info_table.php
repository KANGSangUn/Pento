<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_info', function (Blueprint $table) {
            $table->increments('color_no')->comment('색상테이블 pk');
            $table->string('color_name', 20)->comment('색상명');
            $table->integer('R')->unsigned();
            $table->integer('G')->unsigned();
            $table->integer('B')->unsigned();
            $table->timestamp('registered_date')->nullable()->comment('등록날짜');

            // unique key
            $table->unique(array('R', 'G','B'));
            $table->unique('color_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_info');
    }
}