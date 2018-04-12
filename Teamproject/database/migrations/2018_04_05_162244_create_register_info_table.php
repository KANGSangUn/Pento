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
        // Table 'register_info'
        // 등록 정보 테이블. 회원이 어떤 기기를 등록하여 사용하고 있는지에 대한 정보를 담고있는 테이블
        Schema::create('register_info', function (Blueprint $table) {
            // columns

            $table->integer('arduino_no')->unsigned()->comment('기기 테이블의 기기번호 참조');
            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원번호 참조');
            $table->timestamp('registered_date')->nullable ();
            $table->timestamp('updated_date')->nullable ();

            // foreign keys
            $table->foreign('arduino_no')
                ->references('arduino_no')->on('arduino_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique keys

            $table->primary('arduino_no');
            $table->unique('user_no');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `register_info`;
        Schema::dropIfExists('register_info');
    }
}