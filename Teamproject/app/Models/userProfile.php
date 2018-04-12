<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    public $timestamps = false;
    // 로그인 후 필요한 회원의 정보를 반환
    static public function loginUserInfo($userNum)
    {
        $routeName = ImageRoute::getImageRoute('userPage');
        // 해당 회원의 사진, 적립금, 닉네임 반환

        $result = UserProfile::select
        (
            'user_intro',
            'user_grade',
            'user_nickname',
            'user_no',
            DB::raw('concat( "' . $routeName .'", user_photo) as image'),
            'user_point'
        )
            ->where('user_no', '=', $userNum)
            ->get();

        if ($result == "[]") {
            return "Invalid User Number";
        }
        return $result;
    }

    // 마이페이지에서 필요한 회원 정보 select
    static public function myPageUserInfo($userNum)
    {
        $routeName = ImageRoute::getImageRoute('userPage');

        // 회원 프로필 테이블의 닉네임, 소개글, 사진, 레벨, 포인트 반환
        $result = UserProfile::select
        (
            'user_nickname', 'user_intro',
            DB::raw('concat ("' . $routeName .'", user_photo) as image'),
            'user_grade',
            'user_point')
            ->where('user_no', '=', $userNum)
            ->get();

        if ($result == "[]") {
            return "Invalid User Number";
        }
        return $result;
    }

    // user's profile update
    static public function modifyUserInfo($ModifyUserInfoArray)
    {
        // 사용자 프로필 업데이트

        $result = UserProfile::where('user_no', $ModifyUserInfoArray['user_no'])
            ->update(
                [
                    'user_photo' => $ModifyUserInfoArray['user_photo'],
                    'user_intro' => $ModifyUserInfoArray['user_intro'],
                    'user_nickname' => $ModifyUserInfoArray['user_nickname'],
                    'updated_date'   => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );

        // update 실패했을 경우
        if ($result == 0) {
            return "update fail";
        }
        echo $result;
    }


}