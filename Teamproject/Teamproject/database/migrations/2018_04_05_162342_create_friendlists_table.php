<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendlistsTable extends Migration
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
        Schema::create('friendlists', function (Blueprint $table) {

            // colums
            $table->integer('user_no')->unsigned()->comment('현재 로그인하고있는 회원의 번호. 친구정보테이블에서 회원정보테이블의 회원번호를 참조');
            $table->integer('friend_user_no')->unsigned()->comment('현재 로그인한 회원의 친구 회원 번호. 친구정보테이블에서 회원정보테이블의 회원번호를 참조');
            $table->timestamp('registered_date')->nullable ();

            // foreign keys
            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('friend_user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(array('user_no', 'friend_user_no'));

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
        Schema::dropIfExists('friendlists');
    }
}