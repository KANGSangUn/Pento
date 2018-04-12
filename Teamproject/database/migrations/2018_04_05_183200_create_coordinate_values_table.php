<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'coordinate_values'
        // 도안의 좌표를 관리하는 테이블. 펜토미노의 도안의 좌표 값을 가지고 있다.

        Schema::create('coordinate_values', function (Blueprint $table) {
            // columns
            $table->increments('coordinate_no')->unsigned();
            $table->integer('design_no')->unsigned()->comment('도안테이블의 pk 참조');
            $table->integer('board_X')->unsigned()->comment('X좌표');
            $table->integer('board_Y')->unsigned()->comment('Y좌표');

            $table->timestamp('registered_date')->nullable ();

            // Foreign Key
            $table->foreign('design_no')
                ->references('design_no')->on('pento_designs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // primary key
            $table->index('design_no');
            // 얘를 primary or unique를 걸어버리면 도안 당 여러 개의 좌표를 가질 수 있는데 그게 불가능

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `coordinate_values`;
        Schema::dropIfExists('coordinate_values');
    }
}