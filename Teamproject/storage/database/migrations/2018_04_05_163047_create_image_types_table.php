<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'image_types'
        // 유니티인지 서버인지 구분하는 테이블.
        Schema::create('image_types', function (Blueprint $table) {

            $table->increments('type_no')->comment('이미지 타입테이블의 pk');
            $table->string('check_type', 32)->comment('유니티/서버에서 필요로하는 이미지 타입');
            $table->timestamp('registered_date')->nullable ();


            // unique key
            $table->unique('check_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `image_types`;
        Schema::dropIfExists('tale_images');
        Schema::dropIfExists('image_types');
    }
}