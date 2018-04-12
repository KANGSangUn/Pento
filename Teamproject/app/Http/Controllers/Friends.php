<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-13
 * Time: 오후 10:49
 */

namespace App\Http\Controllers;

use App\Model_Userinfo;
use App\Model_Friends;
use App\Models\Friend;

class Friends extends Controller
{
    // 친구 검색 메서드
    public function Search_Friends($friends_name){
        // 검색된 유저번호 불러오기
        $result_friends_search = Friend::findFriend($friends_name);

        // 검색된 유저가 없으면 false 반환
        if($result_friends_search == 'select fail' ||
            $result_friends_search == 'Invalid value'){

            $result_value = 'false';
        }
        else{
            $result_value = $result_friends_search;
        }

        return $result_value;
    }

    // 친구 추가 메서드
    public function Add_Friends($friends_no){
        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        // 친구 추가
        $result_friends_add =  Friend::addFriend($user_no, $friends_no);

        // 이미 친구추가 되어있는경우, 유저가 없는경우 false 반환
        if($result_friends_add == "already friend!" ||
            $result_friends_add == "Invalid Number"){
            $result_value = 'false';
        }
        else{
            $result_value = 'true';
        }

        return $result_value;
    }

    // 친구 삭제 메서드
    public function Delete_Friends($friends_no){

        $user_no = session()->get('user_no');

        // 친구 삭제
        $result_friends_delete =  Friend::deleteFriend($user_no,$friends_no);

        // 친구가 아닌경우 false 반환
        if($result_friends_delete == "not exist friend"){
            $result_value = 'false';
        }
        else{
            $result_value = 'true';
        }

        return $result_value;
    }
}