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
        // Table 'level_rewards'
        // 레벨에 따른 포인트 관리 테이블.
        Schema::create('level_rewards', function (Blueprint $table) {
            // columns

            $table->integer('design_no')->unsigned()->comment('도안 테이블의 도안번호를 참조');
            $table->integer('level_of_difficultly')->unsigned()->comment('난이도');
            $table->integer('reward_point')->unsigned()->comment('보상 포인트');
            $table->timestamp('registered_date')->nullable ();

            // foreign key
            $table->foreign('design_no')
                ->references('design_no')->on('pento_designs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // primary key
            $table->primary(array('design_no', 'level_of_difficultly'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `level_rewards`;
        Schema::dropIfExists('level_rewards');
    }
}