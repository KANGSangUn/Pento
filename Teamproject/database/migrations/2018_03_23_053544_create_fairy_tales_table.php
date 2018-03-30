<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFairyTalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'fairyTales'
        // 동화를 관리하는 테이블. 동화 정보를 담고있다.
        Schema::create('fairyTales', function (Blueprint $table) {
            // colums
            $table->increments('fairy_tale_no')->comment('동화 테이블의 pk번호');
            $table->string('tale_title', 40)->comment('동화 제목');
            $table->string('tale_explain', 200)->comment('동화 설명');
            $table->integer('tale_price')->unsigned()->comment('동화 가격');

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
        // DROP TABLE IF EXISTS `fairyTales`;
        Schema::dropIfExists('taleImages');
        Schema::dropIfExists('buyLists');
        Schema::dropIfExists('fairyTales');
    }
}