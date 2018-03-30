
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
        Schema::create('userInfo', function (Blueprint $table) {

            // columns
            $table->increments('user_no')->comment('회원 정보 테이블의 Primary key');
            $table->string('user_id',20)->comment('회원 아이디. 동일한 아이디 사용 불가능');
            $table->string('user_pw', 32)->comment('비밀번호');

            //unique key
            $table->unique('user_id');

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
        // drop table if exist `users`;

        Schema::dropIfExists('userProfiles');
        Schema::dropIfExists('friendships');
        Schema::dropIfExists('pentoDesigns');
        Schema::dropIfExists('imitatedPentos');
        Schema::dropIfExists('myCollections');
        Schema::dropIfExists('pentoRecords');
        Schema::dropIfExists('buyLists');
        Schema::dropIfExists('recommends');
        Schema::dropIfExists('userInfo');
    }
}
