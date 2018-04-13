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
        // Table 'imitated_pentos'
        // 작품 관리 테이블. 도안테이블의 도안을 이용해 색다른 도안을 담아놓았다.
        Schema::create('imitated_pentos', function (Blueprint $table) {
            // columns
            $table->increments('imitated_no')->comment('작품 테이블의 pk');
            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원번호를 참조');
            $table->integer('design_no')->unsigned()->comment('도안 테이블의 도안번호를 참조');
            $table->string('imitated_photo', 255)->comment('작품의 이미지 파일명');
            $table->timestamp('registered_date')->nullable ();

// foreign keys

            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('design_no')
                ->references('design_no')->on('pento_designs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique('imitated_photo');
            $table->index(array('user_no', 'design_no'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `imitated_pentos`;
        Schema::dropIfExists('recommends');
        Schema::dropIfExists('imitated_pentos');
    }
}
