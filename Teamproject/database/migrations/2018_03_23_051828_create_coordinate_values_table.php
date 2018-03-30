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
        // Table 'coordinateValues'
        // 도안의 좌표를 관리하는 테이블. 펜토미노의 도안의 좌표 값을 가지고 있다.

        Schema::create('coordinateValues', function (Blueprint $table) {
            // columns
            $table->increments('coordinates_no')->comment('도안의 좌표번호');
            $table->integer('design_no')->unsigned()->comment('도안테이블의 pk 참조');
            $table->integer('board_X')->unsigned()->comment('X좌표');
            $table->integer('board_Y')->unsigned()->comment('Y좌표');

            // Foreign Key
            $table->foreign('design_no')
                ->references('design_no')->on('pentoDesigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        // DROP TABLE IF EXISTS `coordinateValues`;
        Schema::dropIfExists('coordinateValues');
    }
}