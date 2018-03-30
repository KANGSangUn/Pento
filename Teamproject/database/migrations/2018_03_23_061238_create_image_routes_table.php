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
        // Table 'imageRoutes'
        // 경로 관리 테이블.
        Schema::create('imageRoutes', function (Blueprint $table) {
            $table->increments('route_no')->comment('경로 테이블의 pk');
            $table->string('route_name', 32)->comment('경로(path) 저장');

            // unique key
            $table->unique('route_name');

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
        // DROP TABLE IF EXISTS `imageRoutes`;
        Schema::dropIfExists('imageRoutes');
    }
}