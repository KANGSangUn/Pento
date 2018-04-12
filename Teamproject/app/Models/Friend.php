<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class Friend extends Model
{
    protected $table = 'friendlists';

    // 회원의 친구 리스트 반환
    static public function getFriendList($userNum)
    {
        // 친구 번호, 친구 닉네임 반환
        $FriendList     =     DB::table('friendlists as fr')
                                ->join('user_profiles as up', 'up.user_no', '=', 'fr.user_no')
                                ->join('user_profiles as u', 'u.user_no', '=', 'fr.friend_user_no')
                                ->select
                                (
                                    'fr.friend_user_no',
                                    'u.user_nickname'
                                )
                                ->where('up.user_no', $userNum)
                                ->get();

        // 인자값이 올바른 값이 아닐 경우
        if ($FriendList == "[]")
        {
            return "not exist userNum";
        }

        return $FriendList;
    }


    // 친구 검색
    static public function findFriend($findFriendId)
    {

        if (empty($findFriendId)){
            return "Invalid value";
        }

        $result     =     DB::table('user_profiles')
                            ->select('user_no', 'user_nickname', 'user_intro')
                            ->where('user_nickname', 'regexp', $findFriendId)
                            ->get();

        // select 결과가 없을 경우
        if ($result == "[]")
        {
            return "select fail";
        }



        return $result;
    }

    // 친구 추가
    static public function addFriend($userNum, $addFriendNum)
    {
        try
        {
            $result     =   Friend::insert(
                            [
                                'user_no'           => $userNum,
                                'friend_user_no'    => $addFriendNum,
                                'registered_date'   => Carbon::now()->format('Y-m-d H:i:s'),
                            ]);
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 이미 친구로 등록되어 있는 경우
            if ($errorCode == 1062)
            {
                // 문자열 반환
                return 'already friend!';
            }
            // 인자값이 유효한 값이 아닌 경우
            else if ($errorCode == 1452)
            {
                return 'Invalid Number';
            }
        }
        return 'true';
    }

    // 친구 삭제
    static public function deleteFriend($userNo, $deleteFriendNo)
    {
        $result     =     Friend::where('user_no', $userNo)
                                ->where('friend_user_no', $deleteFriendNo)
                                ->delete();

        // 존재하지 않는 친구를 삭제할 경우
        if ($result == 0)
        {
            return "not exist friend";
        }

        return 'true';
    }
}
