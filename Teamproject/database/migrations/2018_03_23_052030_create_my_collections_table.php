<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'myCollections'
        // 컬렉션을 관리하는 테이블. 회원이 만든 도안, 구독한 도안들의 정보를 담고있다.

        Schema::create('myCollections', function (Blueprint $table) {
            // columns
            $table->increments('collection_no')->comment('컬렉션 테이블의 pk');
            $table->integer('design_no')->unsigned()->comment('도안테이블의 도안번호 참조');
            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원번호 참조');

// foreign keys
            $table->foreign('design_no')
                ->references('design_no')->on('pentoDesigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_no')
                ->references('user_no')->on('userInfo')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            // unique key
            $table->unique(array('design_no', 'user_no'));
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
        // DROP TABLE IF EXISTS `myCollections`;
        Schema::dropIfExists('myCollections');
    }
}