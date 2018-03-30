<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'levelRewards'
        // 레벨에 따른 포인트 관리 테이블.
        Schema::create('levelRewards', function (Blueprint $table) {
            // columns
            $table->increments('reward_no')->comment('보상 테이블의 pk');
            $table->integer('design_no')->unsigned()->comment('도안 테이블의 도안번호를 참조');
            $table->integer('level_of_difficultly')->unsigned()->comment('난이도');
            $table->integer('reward_point')->unsigned()->comment('보상 포인트');

            // foreign key
            $table->foreign('design_no')
                ->references('design_no')->on('pentoDesigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique key
            $table->unique('design_no');

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
        // DROP TABLE IF EXISTS `levelRewards`;
        Schema::dropIfExists('levelRewards');
    }
}