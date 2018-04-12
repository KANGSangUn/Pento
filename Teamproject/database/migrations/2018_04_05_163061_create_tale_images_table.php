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
        // Table 'tale_images'
        // 동화의 이미지 관리 테이블. 동화의 이미지들을 담고있다.
        Schema::create('tale_images', function (Blueprint $table) {
            // columns

            $table->integer('fairy_tale_no')->unsigned()->comment('동화테이블의 동화번호를 참조');
            $table->integer('type_no')->unsigned()->comment('이미지 타입 테이블에서 참조');
            $table->string('tale_image', 255)->comment('동화 이미지 파일명');

            $table->timestamp('registered_date')->nullable ();

            // foreign key

            $table->foreign('fairy_tale_no')
                ->references('fairy_tale_no')->on('fairy_tales')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_no')
                ->references('type_no')->on('image_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->index(array('fairy_tale_no', 'type_no'));
            $table->unique('tale_image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `tale_images`;
        Schema::dropIfExists('tale_images');
    }
}