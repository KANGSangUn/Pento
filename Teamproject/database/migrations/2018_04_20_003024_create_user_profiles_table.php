<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            // columns
            $table->integer('user_no')->unsigned()->comment('로그인 회원 테이블의 회원번호 참조');
            $table->integer('user_point')->unsigned()->default(0)->comment('회원의 보유금액(= 적립금)');
            $table->integer('user_grade')->unsigned()->default(1)->comment('회원의 레벨');
            $table->string('user_photo',255)->default('basic_user_photograph.jpg')->comment('회원사진');
            $table->string('user_nickname', 32)->comment('회원의 닉네임');
            $table->string('user_intro', 200)->default('please write your introduce')->comment('회원 소개글');


            // foreign key
            // 회원 테이블의 회원번호 참조
            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            // primary key
            // 회원번호, 회원 닉네임, 회원 사진 인덱스

            $table->primary(array('user_no', 'user_photo'));
            // unique key
            $table->unique('user_nickname');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   // DROP TABLE IF EXISTS `user_profiles`;
        Schema::dropIfExists('user_profiles');
    }
}