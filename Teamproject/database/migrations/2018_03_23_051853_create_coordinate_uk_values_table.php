<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinateUkValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'coordinateUkValues'
        // 도안 좌표 중복체크 테이블. 좌표의 비트를 계산한 값을 담고있다.
        Schema::create('coordinateUkValues', function (Blueprint $table) {
            // columns
            $table->increments('design_check_no')->comment('도안 좌표 중복체크 테이블 pk');
            $table->integer('design_no')->unsigned()->comment('도안테이블의 도안번호 참조');
            $table->biginteger('partition_1')->unsigned()->comment('좌표 비트 계산 결과 1, 2, 3, 4, 5');
            $table->biginteger('partition_2')->unsigned();
            $table->biginteger('partition_3')->unsigned();
            $table->biginteger('partition_4')->unsigned();
            $table->biginteger('partition_5')->unsigned();

            // foreign key
            $table->foreign('design_no')
                ->references('design_no')->on('pentoDesigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique key
            $table->unique('design_no');

            $table->unique(array('partition_1','partition_2','partition_3','partition_4','partition_5'),'coordinate_uk_values_partition' );

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
        // DROP TABLE IF EXISTS `CoordinateUkValues`;
        Schema::dropIfExists('coordinateUkValues');
    }
}