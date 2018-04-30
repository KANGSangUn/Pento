<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowlistsTable extends Migration
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
        Schema::create('followlists', function (Blueprint $table) {

            // colums
            $table->integer('follow_user_no')->unsigned()->comment('현재 로그인하고있는 회원의 번호. 친구정보테이블에서 회원정보테이블의 회원번호를 참조');
            $table->integer('follower_user_no')->unsigned()->comment('현재 로그인한 회원의 친구 회원 번호. 친구정보테이블에서 회원정보테이블의 회원번호를 참조');
            $table->timestamp('registered_date')->nullable ();

            // foreign keys
            // 회원테이블의 회원번호 참조
            // 없는 회원번호가 들어가면 안되기 때문에 외래키 제약조건
            $table->foreign('follow_user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('follower_user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // 인덱스 설정
            $table->primary(array('follow_user_no', 'follower_user_no'));

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
        Schema::dropIfExists('followlists');
    }
}