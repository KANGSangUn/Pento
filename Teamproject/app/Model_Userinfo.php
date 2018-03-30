<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-09
 * Time: 오후 3:33
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Model_Userinfo extends Model
{
    protected $table = 'userinfo';

    protected $fillable = ['user_id','user_photo','user_intro','user_point','user_grade','user_nickname'];

    public static function Check_Userinfo($check_userinfo){

        //$content_body = Post::where('id','=',$id)->get();
        $user_id = DB::table('userinfo')->where('user_id','=',$check_userinfo)->get();

        return $user_id;
    }
}