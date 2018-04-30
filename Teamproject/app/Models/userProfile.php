<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    public $timestamps = false;

    // 로그인 후 필요한 회원의 정보를 반환 웹
    static public function loginUserInfoWeb($userNum)
    {

        // 회원이미지가 저장되어 있는 파일경로 가져오기
        $routeName          =   ImageRoute::getImageRoute('userPage');


        // 해당 회원의 사진, 적립금, 닉네임 반환
        $result             =   UserProfile::select
                                (
                                    'user_no',
                                    'user_nickname',
                                    DB::raw('concat( "' . $routeName . '", user_photo) as image'),
                                    'user_point'
                                )
                                ->where('user_no', '=', $userNum)
                                ->get();

        if ($result == "[]")
        {
            return "Invalid User Number";
        }

        return $result;

    }



    // 유니티에서 로그인
    static public function loginUserInfoUnity($userNum)
    {

        // 회원번호 반환
        $result             =   UserProfile::select('user_no')
                                ->where('user_no', '=', $userNum)
                                ->get();

        return $result;

    }



    // 마이페이지에서 필요한 회원 정보 select
    static public function myPageUserInfo($userNum)
    {

        // 회원 이미지가 저장되어 있는 경로 가져오기
        $routeName          =   ImageRoute::getImageRoute('userPage');

        // 회원 프로필 테이블의 닉네임, 소개글, 사진, 레벨, 포인트 반환
        $result             =   UserProfile::select
                                (
                                    'user_nickname',
                                    'user_intro',
                                    DB::raw('concat ("' . $routeName . '", user_photo) as image'),
                                    'user_grade',
                                    'user_point'
                                )
                                ->where('user_no', '=', $userNum)
                                ->get();


        // 빈 객체일 select fail
        if ($result == "[]")
        {
            return "select fail";
        }

        // 회원 정보 반환
        return $result;

    }



    // 사용자 비밀번호, 프로필 업데이트
    static public function modifyUserInfo($modifyUserInfoArray)
    {

        // 사용자 프로필 업데이트
        $updateProfileResult    =   UserProfile::where('user_no', $modifyUserInfoArray['user_no'])
                                    ->update(
                                        [
                                            'user_photo'    =>  $modifyUserInfoArray['user_photo'],
                                            'user_intro'    =>  $modifyUserInfoArray['user_intro'],
                                            'user_nickname' =>  $modifyUserInfoArray['user_nickname'],
                                            'updated_date'  =>  Carbon::now()->format('Y-m-d H:i:s'),
                                        ]
                                    );


        // 비밀번호 업데이트 메서드 호출
        $updatePWResult         =   UserInfo::odifyPassword($modifyUserInfoArray['user_no'], $modifyUserInfoArray['user_pw']);

        // update 가 실패했을 경우
        if ($updateProfileResult == 0 || $updatePWResult == 0)
        {
            return "update Fail";
        }

        return "true";

    }



    // 회원 레벨 가져오기
    static public function getUserLevelNum($userNum)
    {

        // 해당 회원의 레벨을 가져온다.
        $userGrade              =   UserProfile::select('user_grade')
                                    ->where('user_no', $userNum)
                                    ->get();


        // 비어있는 객체일 경우 select 실패
        if ($userGrade == "[]")
        {
            return "select fail";
        }

        // 회원 레벨 반환
        return $userGrade[0]->user_grade;

    }



    // 해당 단계의 레벨을 모두 클리어시 유저 레벨업
    static public function updateUserGrade($userNum)
    {

        // 회원 레벨 가져오기
        $userGrade          =    UserProfile::getUserLevelNum($userNum);

        // 단계별 도안번호 가져오기
        $levelDesignNum     =    PentoDesign::getLevelDesignNum($userGrade);

        // 회원이 플레이한 도안번호 가져오기
        $reDesignNum        =    ImitatedPento::getRecordDesignNum($userNum);




        // 단계별 도안번호와 플레이한 도안번호가 같은 경우의 횟수를 담는 변수
        $count = 0;

        if ($userGrade <= 5)
        {
            // 단계별 도안번호($levelDesignNum)의 키 값($value1)과
            // 플레이한 도안번호($reDesignNum)의 키 값($value2)를 추출
            foreach ($reDesignNum as $key1 => $value1)
            {
                foreach ($levelDesignNum as $key2 => $value2)
                {
                    // 단계별 도안번호와 플레이한 도안번호가 같을 경우
                    if ($value1->design_no == $value2->design_no)
                    {
                        // count 증가
                        $count++;
                    }
                }
            }

            // 같은 경우의 횟수와 단계별 도안번호의 개수가 같으면
            if ($count == count($levelDesignNum))
            {
                // 회원 레벨 업데이트
               UserProfile::where('user_no', $userNum)
                    ->update
                    (
                        [
                            'user_grade'    =>  $userGrade + 1,
                        ]
                    );


               // 레벨업
                return "true";
            }
            else
            {
                // 레벨업 실패
                return "false";
            }
        }

        // 최대 레벨 5
        else return "user level is 5";
    }



    // 해당 회원의 포인트 가져오기
    static public function getUserPoint($userNum)
    {
        // 회원의 현재 가지고있는 포인트 정보를 가져온다.
        $userPointObject    =   UserProfile::select('user_point')
            ->where('user_no', $userNum)
            ->get();

        return   $userPointObject[0]->user_point;
    }



    // 단계별 게임 클리어시 포인트 update
    static public function updateUserPoint($designNum, $userNum)
    {

        try {

            // 해당 도안의 포인트를 가져온다
            $point              =    PentoDesign::getRewardPoint($designNum);

            // 회원의 현재 가지고있는 포인트 정보를 가져온다.

            $userPoint          =   UserProfile::getUserPoint($userNum);


            // 현재 회원의 포인트에서 보상포인트를 더한 값으로 update
            $updateResult       =   UserProfile::where('user_no', $userNum)
                                                ->update(
                                                    [
                                                        'user_point' => $userPoint + $point
                                                    ]
                                                );

            // update 실패
            if ($updateResult == 0)
            {
                return "update fail";
            }

        }
        // query 에러시 에러문 반환
        catch (QueryException $e)
        {
            $errorCode          =    $e->errorInfo[1];

            return "Invalid Value error code : $errorCode";
        }

        // 업데이트 성공시 true 반환
        return "true";
    }


}
