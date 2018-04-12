<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserInfo extends Model
{
    protected $table = 'user_info';
    public $timestamps = false;
    protected $fillable = ['user_id', 'user_pw']; // 프로퍼티를 이용하는 허용 목록

    // 로그인(회원인증) select user_id, user_pw from user_info where user_id = $user_id;
    static public function loginCheck($userId, $userPw)
    {
        // user_info 테이블에서 입력받은 아이디의 정보를 가져온다.
        $userArray = UserInfo::where('user_id', '=', $userId)->get();

        // 아이디 유효검사
        if ($userArray == "[]") {
            return 'Invalid id';
        } // 비밀번호 유효검사
        else {
            // 아이디가 맞지만 비밀번호가 틀릴 경우
            if (!password_verify($userPw, $userArray[0]->user_pw)) {
                return 'Invalid password';
            } // 아이디와 비밀번호가 모두 맞을 경우
            else {
                // 해당 회원번호
                $userNum = $userArray[0]->user_no;
                // 로그인 시 필요한 회원의 정보를 반환하는 메소드 호출
                return UserProfile::loginUserInfo($userNum);
            }
        }
    }// loginCheck

    /*// user's password update
    static public function userUpdate($userNum, $userPw)
    {
        // 없는 회원번호일 경우 예외처리
        $result = DB::table('user_info')->where('user_no', $userNum)
            ->update
            (
                [
                    'user_pw' => bcrypt($userPw), // 비밀번호 암호화
                    'updated_date' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );
        if ($result == 0) {
            return "Invalid value";
        }
        return $result;
    }*/
}


