<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePentoRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'pento_records'
        // 펜토미노 게임의 클리어 기록 관리 데이블
        Schema::create('pento_records', function (Blueprint $table) {
            // columns
            $table->increments('record_no')->comment('펜토미노의 기록 번호pk');
            $table->integer('user_no')->unsigned()->comment('회원정보테이블의 회원번호를 참조');
            $table->integer('design_no')->unsigned()->comment('도안테이블의 도안번호를 참조');
            $table->time('cleartime')->comment('게임의 클리어 시간');
            $table->timestamp('register_date')->nullable ();

            // foreign keys
            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('design_no')
                ->references('design_no')->on('pento_designs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(array('user_no', 'design_no'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `pento_records`;
        Schema::dropIfExists('pento_records');
    }
}