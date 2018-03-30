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
        Schema::create('userProfiles', function (Blueprint $table) {
            // columns
            $table->increments('profile_no')->comment('회원 프로필 테이블의 pk');
            $table->integer('user_no')->unsigned()->comment('로그인 회원 테이블의 회원번호 참조');
            $table->string('user_photo',255)->default('basic_user_photograph.jpg')->comment('회원사진');
            $table->string('user_intro', 200)->default('please write your introduce')->comment('회원 소개글');
            $table->integer('user_point')->unsigned()->default(0)->comment('회원의 보유금액(= 적립금)');
            $table->integer('user_grade')->unsigned()->default(1)->comment('회원의 레벨');
            $table->string('user_nickname', 32)->comment('회원의 닉네임');

            // foreign key
            $table->foreign('user_no')
                ->references('user_no')->on('userInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // unique key
            $table->unique('user_no');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   // DROP TABLE IF EXISTS `UserProfiles`;
        Schema::dropIfExists('userProfiles');
    }
}