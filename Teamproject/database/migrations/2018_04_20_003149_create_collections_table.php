<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'collections'
        // 컬렉션을 관리하는 테이블. 회원이 만든 도안, 구독한 도안들의 정보를 담고있다.

        Schema::create('collections', function (Blueprint $table) {
            // columns

            $table->integer('user_no')->unsigned()->comment('회원 테이블의 회원번호 참조');
            $table->integer('design_no')->unsigned()->comment('도안테이블의 도안번호 참조');
            $table->timestamp('registered_date')->nullable ();

            // foreign keys

            $table->foreign('user_no')
                ->references('user_no')->on('user_info')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('design_no')
                ->references('design_no')->on('pento_designs')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            // primary key
            $table->primary(array('user_no', 'design_no'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DROP TABLE IF EXISTS `collections`;
        Schema::dropIfExists('imitated_pentos');
        Schema::dropIfExists('collections');
    }
}