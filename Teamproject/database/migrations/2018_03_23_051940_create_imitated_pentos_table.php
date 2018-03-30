<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImitatedPentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'imitatedPentos'
        // 작품 관리 테이블. 도안테이블의 도안을 이용해 색다른 도안을 담아놓았다.
        Schema::create('imitatedPentos', function (Blueprint $table) {
            // columns
            $table->increments('imitated_pento_no')->comment('작품 테이블의 pk');
            $table->integer('design_no')->unsigned()->comment('도안 테이블의 도안번호를 참조');
            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원번호를 참조');
            $table->string('imitated_photo', 255)->comment('작품의 이미지 파일명');
            $table->datetime('writing_date')->comment('작품이 완성되는 날짜기록');

// foreign keys
            $table->foreign('design_no')
                ->references('design_no')->on('pentoDesigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_no')
                ->references('user_no')->on('userInfo')
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
        // DROP TABLE IF EXISTS `imitatedPentos`;
        Schema::dropIfExists('imitatedPentos');
    }
}
