<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-17
 * Time: 오전 1:10
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Model_Friends extends Model
{
    public static function prtStoryInfo($friends_name){
        // 친구페이지 기본값 출력 메서드

//        $value_story = DB::table('friendships')->where('friend_user_no','=',$friends_name)->get();

//        return $value_story;
    }

    public static function Search_Friends($friends_no){
        // 친구페이지 친구검색 메서드

        $value_story = DB::table('friendships')->where('friend_user_no','=',$friends_no)->get();

        return $value_story;
    }

    public static function Add_Friends($user_no,$friends_no){

        // 친구페이지 친구추가 메서드
        DB::table('friendships')
            ->insert(['user_no' => $user_no,
                'friend_user_no' => $friends_no]);
    }

    public static function Delete_Friends($friends_no){
        // 친구페이지 친구 삭제 메서드

        $value_story = DB::table('friendships')->where('friend_user_no','=',$friends_no)->get();

        return $value_story;
    }
}