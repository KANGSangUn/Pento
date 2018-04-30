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
            $table->integer('division_no')->unsigned()->default(0)->comment('창작인지 아닌지 구분');
            $table->integer('put_number')->unsigned()->comment('블록을 놓은 횟수');
            $table->string('imitated_image', 255)->comment('작품의 이미지 파일명');
            $table->time('clear_time')->comment('게임의 클리어 시간');
            $table->timestamp('registered_date')->nullable()->comment('등록날짜');

            // foreign keys
            $table->foreign(array('user_no', 'design_no'))
                ->references(array('user_no', 'design_no'))->on('collections')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unique(array('user_no','design_no', 'imitated_image'));
            $table->index(array('design_no', 'division_no', 'imitated_no'));
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
        Schema::dropIfExists('pento_records');
        Schema::dropIfExists('imitated_pentos');
    }
}