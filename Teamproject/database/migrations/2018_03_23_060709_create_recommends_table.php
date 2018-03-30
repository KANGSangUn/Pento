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
            $table->increments('recommend_no')->comment('');
            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원 번호 참조');
            $table->integer('category_no')->unsigned()->comment('카테고리 테이블의 카테고리 번호 참조');
            $table->integer('board_no')->unsigned()->comment('해당 게시글 번호');

            // foreign keys
            $table->foreign('user_no')
                ->references('user_no')->on('userInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_no')
                ->references('category_no')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique key
            $table->unique(array('user_no', 'category_no', 'board_no'));

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
        // DROP TABLE IF EXISTS `recommends`;
        Schema::dropIfExists('recommends');
    }
}