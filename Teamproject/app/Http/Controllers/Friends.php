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

class Friends extends Controller
{
    // 친구 검색 메서드
    public function Search_Friends($friends_name){

        // 검색된 유저번호 불러오기
        return $friends_no = Model_Userinfo::Check_Userinfo($friends_name);
    }

    // 친구 추가 메서드
    public function Add_Friends($friends_no){
        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        // 이미 추가된 친구인지 확인
        $check_collection = Model_Friends::Search_Friends($friends_no);

        if(empty($check_collection)){
            // 친구 추가
            Model_Friends::Add_Friends($user_no,$friends_no);
            return '친구추가 완료';
        }
        else{
            return '이미 추가된 친구입니다.';
        }
    }

    // 친구 삭제 메서드
    public function Delete_Friends($friends_no){

        // 친구 삭제
        Model_Friends::Delete_Friends($friends_no);
        return '친구삭제 완료';
    }
}