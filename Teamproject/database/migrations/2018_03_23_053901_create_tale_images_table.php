<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'taleImages'
        // 동화의 이미지 관리 테이블. 동화의 이미지들을 담고있다.
        Schema::create('taleImages', function (Blueprint $table) {
            // columns
            $table->increments('image_no')->comment('동화 이미지 테이블의 pk');
            $table->integer('fairy_tale_no')->unsigned()->comment('동화테이블의 동화번호를 참조');
            $table->string('tale_image', 255)->comment('동화 이미지 파일명');
            $table->integer('type_no')->unsigned()->comment('이미지 타입 테이블에서 참조');

            // foreign key
            $table->foreign('type_no')
                ->references('type_no')->on('imageTypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('fairy_tale_no')
                ->references('fairy_tale_no')->on('fairyTales')
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
        // DROP TABLE IF EXISTS `taleImages`;
        Schema::dropIfExists('taleImages');
    }
}