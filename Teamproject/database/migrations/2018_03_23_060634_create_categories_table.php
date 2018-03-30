<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table `categories`
        // 카테고리 관리 테이블. 어떤 카테고리가 들어있는지에 대한 정보를 담고있다.
        Schema::create('categories', function (Blueprint $table) {
            // columns
            $table->increments('category_no')->comment('카테고리 테이블의 pk');
            $table->string('category_name', 32)->comment('카테고리 이름');


            // unique key
            $table->unique('category_name');

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
        // DROP TABLE IF EXISTS `categories`;
        Schema::dropIfExists('recommends');
        Schema::dropIfExists('categories');
    }
}