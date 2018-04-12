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
        // Table 'coordinate_uk_values'
        // 도안 좌표 중복체크 테이블. 좌표의 비트를 계산한 값을 담고있다.
        Schema::create('coordinate_uk_values', function (Blueprint $table) {
            // columns

            $table->increments('design_no')->unsigned()->comment('도안테이블의 도안번호 참조');
            $table->string('partition',255)->comment('좌표값');
            $table->timestamp('registered_date')->nullable ();


            // unique key

            $table->unique('partition');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `coordinate_uk_values`;
        Schema::dropIfExists('pento_designs');
        Schema::dropIfExists('coordinate_values');
        Schema::dropIfExists('imitated_pentos');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('pento_records');
        Schema::dropIfExists('coordinate_uk_values');
    }
}