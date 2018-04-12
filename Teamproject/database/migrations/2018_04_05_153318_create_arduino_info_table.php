<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArduinoInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'arduino_info'
        // 하드웨어 아두이노의 고유번호 관리 테이블.

        Schema::create('arduino_info', function (Blueprint $table) {

            // columns
            $table->increments('arduino_no')->comment('아두이노 테이블의 pk');
            $table->string('serial_num', 32)->comment('아두이노 고유번호');
            $table->timestamp('registered_date')->nullable ();

            // unique key
            $table->unique('serial_num');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `arduinoInfo`;
        Schema::dropIfExists('register_info');
        Schema::dropIfExists('arduino_info');
    }
}