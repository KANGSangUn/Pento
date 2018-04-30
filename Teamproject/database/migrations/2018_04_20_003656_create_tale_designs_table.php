<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaleDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tale_designs', function (Blueprint $table) {
            $table->integer('fairy_tale_no')->unsigned()->comment('동화테이블의 동화번호를 참조');
            $table->integer('design_no')->unsigned()->comment('도안테이블의 pk 참조');
            $table->timestamp('registered_date')->nullable()->comment('등록날짜');


            // foreign key
            $table->foreign('fairy_tale_no')
                ->references('fairy_tale_no')->on('fairy_tales')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('design_no')
                ->references('design_no')->on('pento_designs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(array('fairy_tale_no', 'design_no'));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tale_designs');
    }
}
