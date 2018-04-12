<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class LevelReward extends Model
{
    // 단계별 모드 리스트 반환
    static public function getLevelDesign($userNum)
    {
        // 회원 레벨 가져오기
        $userGrade      =       DB::table('user_profiles')
                                    ->select('user_grade')
                                    ->where('user_no', $userNum)
                                    ->get();

        $userLevel      =       $userGrade[0]->user_grade;

        // 펜토미노 도안 리스트 가져오기
        // 도안번호, 도안제목, 좌표값
        $designInfo     =       DB::table('pento_designs as pd')
                                    ->join('level_rewards as lr', 'pd.design_no', '=', 'lr.design_no')
                                    ->join('coordinate_values as co', 'pd.design_no', '=', 'co.design_no')
                                    ->select
                                    (
                                        'pd.design_no',
                                        'pd.design_title',
                                        'co.board_X',
                                        'co.board_Y'
                                    )
                                    ->where('lr.level_of_difficultly', $userLevel)
                                    ->get();

        $total =
            [
                'coordinate_info' => $designInfo,
                'user_level_info' => $userGrade
            ];

        return $total;

    }

    // 단계별 게임 클리어시 포인트 update
    static public function updateUserPoint($designNum, $userNum)
    {
        try
        {
            // 해당 도안의 보상 포인트 정보를 가져온다.
            $pointObject        =   DB::table('level_rewards')
                                    ->select('reward_point')
                                    ->where('design_no', $designNum)
                                    ->get();

            $point              =   $pointObject[0]->reward_point;


            // 회원의 현재 가지고있는 포인트 정보를 가져온다.
            $userPointObject    =   DB::table('user_profiles')
                                        ->select('user_point')
                                        ->where('user_no', $userNum)
                                        ->get();

            $userPoint          =   $userPointObject[0]->user_point;


            // 현재 회원의 포인트에서 보상포인트를 더한 값으로 update
            $result             =   DB::table('user_profiles')
                                        ->where('user_no', $userNum)
                                        ->update(
                                            [
                                                'user_point' => $userPoint + $point
                                            ]
                                        );
            // update 실패
            if ($result == 0)
            {
                return "update fail";
            }
            return $result;
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            return "Invalid Value error code : $errorCode";
        }
    }
}
