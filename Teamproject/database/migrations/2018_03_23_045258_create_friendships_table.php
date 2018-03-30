<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'friendships'
        // 친구 관리 테이블. 회원의 친구 정보를 담고있다.
        Schema::create('friendships', function (Blueprint $table) {
            // colums
            $table->increments('friendship_no')->unsigned()->comment('친구테이블 pk');
            $table->integer('user_no')->unsigned()->comment('현재 로그인하고있는 회원의 번호. 친구정보테이블에서 회원정보테이블의 회원번호를 참조');
            $table->integer('friend_user_no')->unsigned()->comment('현재 로그인한 회원의 친구 회원 번호. 친구정보테이블에서 회원정보테이블의 회원번호를 참조');

            // foreign keys
            $table->foreign('user_no')
                ->references('user_no')->on('userInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('friend_user_no')
                ->references('user_no')->on('userInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(array('user_no', 'friend_user_no'));

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
        // DROP TABLE IF EXISTS `friendships`;
        Schema::dropIfExists('friendships');
    }
}