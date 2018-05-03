<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class Follow extends Model
{
    protected $table = 'followlists';

    // 회원의 친구 리스트 반환
    static public function getFollowList($userNum)
    {
        // 친구 번호, 친구 닉네임 반환
        $FollowList     =     DB::table('followlists as fl')
                                ->join('user_profiles as up', 'up.user_no', '=', 'fl.follow_user_no')
                                ->join('user_profiles as u', 'u.user_no', '=', 'fl.follower_user_no')
                                ->select
                                (
                                    'fl.follower_user_no',
                                    'u.user_nickname'
                                )
                                ->where('up.user_no', $userNum)
                                ->get();

        // 인자값이 올바른 값이 아닐 경우
        if ($FollowList == "[]")
        {
            return "not exist userNum";
        }

        return $FollowList;
    }


    // 친구 검색
    static public function findFollowerID($findFollowerId)
    {
        return $followerResult     =     DB::table('user_profiles')
                            ->select('user_no', 'user_nickname', 'user_intro')
                            ->where('user_nickname', 'regexp', $findFollowerId)
                            ->get();

        // select 결과가 없을 경우
        if ($followerResult == "[]")
        {
            return "select fail";
        }

        return $followerResult;
    }

    // 친구 추가
    static public function addFollow($userNum, $addFollowerNum)
    {
        try
        {
             Follow::insert(
                            [
                                'follow_user_no'           => $userNum,
                                'follower_user_no'         => $addFollowerNum,
                                'registered_date'          => Carbon::now()->format('Y-m-d H:i:s'),
                            ]);

        }

        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 이미 친구로 등록되어 있는 경우
            if ($errorCode == 1062)
            {
                // 문자열 반환
                return 'already follower!';
            }
            // 인자값이 유효한 값이 아닌 경우
            else if ($errorCode == 1452)
            {
                return 'Invalid Number';
            }
            else
            {
                return $errorCode;
            }
        }
        return "true";

    }

    // 친구 삭제
    static public function deleteFollow($userNo, $deleteFollowerNum)
    {
        $deleteResult     =     Follow::where('follow_user_no', $userNo)
                                ->where('follower_user_no', $deleteFollowerNum)
                                ->delete();

        // 존재하지 않는 친구를 삭제할 경우
        if ($deleteResult == 0)
        {
            return "not exist friend";
        }

        return "true";
    }
}
