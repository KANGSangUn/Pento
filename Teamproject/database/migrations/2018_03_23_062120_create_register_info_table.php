<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'registerInfo'
        // 등록 정보 테이블. 회원이 어떤 기기를 등록하여 사용하고 있는지에 대한 정보를 담고있는 테이블
        Schema::create('registerInfo', function (Blueprint $table) {
            // columns
            $table->increments('register_no')->comment('등록 정보 테이블의 pk');
            $table->integer('arduino_no')->unsigned()->comment('기기 테이블의 기기번호 참조');
            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원번호 참조');

            // foreign keys
            $table->foreign('arduino_no')
                ->references('arduino_no')->on('arduinoInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_no')
                ->references('user_no')->on('userInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique keys
            $table->unique('user_no');
            $table->unique('arduino_no');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `registerInfo`;
        Schema::dropIfExists('registerInfo');
    }
}