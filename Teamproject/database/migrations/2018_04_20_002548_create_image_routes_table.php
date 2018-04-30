<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'image_routes'
        // 경로 관리 테이블.
        Schema::create('image_routes', function (Blueprint $table) {

            $table->increments('route_no')->comment('경로 테이블의 pk');
            $table->string('route_name', 32)->comment('경로(path)명 저장');
            $table->timestamp('registered_date')->nullable ()->comment('등록 날짜');

            // unique key
            // 경로명은 중복되면 안됨
            $table->unique('route_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `imageRoutes`;
        Schema::dropIfExists('image_routes');
    }
}