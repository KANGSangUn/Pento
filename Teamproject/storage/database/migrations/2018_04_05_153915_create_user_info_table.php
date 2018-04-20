<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table 'users'
        // 회원의 아이디와 패스워드 정보를 담고있는 테이블
        Schema::create('user_info', function (Blueprint $table) {

            // columns
            $table->increments('user_no')->comment('회원 정보 테이블의 Primary key');
            $table->string('user_id',20)->comment('회원 아이디. 동일한 아이디 사용 불가능');
            $table->string('user_pw', 200)->comment('비밀번호');
            $table->timestamp('registered_date')->nullable ();
            $table->timestamp('updated_date')->nullable ();

            //unique key
            $table->unique('user_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // drop table if exist `users`;

        Schema::dropIfExists('register_info');
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('friendlists');
        Schema::dropIfExists('pento_designs');
        Schema::dropIfExists('imitated_pentos');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('pento_records');
        Schema::dropIfExists('buylists');
        Schema::dropIfExists('recommends');
        Schema::dropIfExists('user_info');
    }
}