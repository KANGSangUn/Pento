<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePentoDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'pento_designs'
        // 도안(교재안과 같은 역할)을 관리하는 테이블.펜토미노의 모든 도안의 정보를 담고있다.
        Schema::create('pento_designs', function (Blueprint $table) {

            //columns
            $table->increments('design_no')->unsigned()->comment('도안테이블의 도안번호 참조');
            $table->integer('user_no')->unsigned()->comment('도안을 작성한 회원의 번호');
            $table->integer('reward_point')->unsigned()->comment('적립할 포인트');
            $table->string('identifier', 20)->comment('단계별/동화/모두의 펜토미노인지 구분');
            $table->string('design_title', 40)->comment('도안의 제목');
            $table->string('design_explain', 200)->comment('도안에 대한 설명');
            $table->string('coordinate_value',255)->comment('좌표값');
            $table->string('design_image', 255)->comment('도안 이미지');
            $table->timestamp('registered_date')->nullable()->comment('등록날짜');
            $table->timestamp('updated_date')->nullable()->comment('최종 수정날짜');

            // Foreign Key
            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique key
            $table->unique('coordinate_value');
            $table->unique('design_image');

            // index key
            $table->index(array('user_no', 'identifier'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `PentoDesigns`;

        //Schema::dropIfExists('imitated_pentos');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('pento_records');
        Schema::dropIfExists('pento_designs');

    }
}