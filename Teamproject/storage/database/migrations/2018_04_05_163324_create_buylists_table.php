<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /// Table 'buyLists'
        // 구매 정보를 관리하는 테이블. 동화를 구매한 정보를 담고있다.
        Schema::create('buylists', function (Blueprint $table) {
            // colums
            $table->integer('user_no')->unsigned()->comment('회원정보테이블의 회원번호를 참조');
            $table->integer('fairy_tale_no')->unsigned()->comment(' 동화테이블의 동화번호를 참조');
            $table->timestamp('registered_date')->comment('동화 구매 날짜');

            // foreign keys

            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('fairy_tale_no')
                ->references('fairy_tale_no')->on('fairy_tales')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            // primary key

            $table->primary(array('user_no', 'fairy_tale_no'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `buyLists`;
        Schema::dropIfExists('buylists');
    }
}