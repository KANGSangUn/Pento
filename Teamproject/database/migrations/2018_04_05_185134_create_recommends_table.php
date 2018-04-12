<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'recommends'
        // 게시글 추천 관리 테이블. 회원이 어떤 게시글을 추천했는지에 대한 정보를 담고있다.
        Schema::create('recommends', function (Blueprint $table) {

            // columns

            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원 번호 참조');
            $table->integer('imitated_no')->unsigned()->comment('해당 게시글 번호');
            $table->timestamp('registered_date')->nullable ();

            // foreign keys
            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('imitated_no')
                ->references('imitated_no')->on('imitated_pentos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // primary key
            $table->primary(array('user_no', 'imitated_no'));


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `recommends`;
        Schema::dropIfExists('recommends');
    }
}