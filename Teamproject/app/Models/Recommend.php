<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class Recommend extends Model
{
    protected $table = 'recommends';

    // 작품 추천하기
    static public function recommend($userNum, $imitatedNum)
    {

        try
        {
            // 추천한 회원번호, 추천한 도안번호, 추천 날짜 등록
            DB::table('recommends')
                ->insert(
                    [
                        'user_no'           => $userNum,
                        'imitated_no'       => $imitatedNum,
                        'registered_date'   => Carbon::now(),
                    ]
                );

            // 추천 성공
            return "true";

        }

        catch (QueryException $e)
        {

            $errorCode = $e->errorInfo[1];

            // 추천을 했던 작품일 경우 추천 해제(= 레코드 삭제)
            if ($errorCode == 1062)
            {
                // 문자열 반환
                DB::table('recommends')
                    ->where('user_no', $userNum)
                    ->where('imitated_no', $imitatedNum)
                    ->delete();

                // 추천해제
                return "false";

            }
            else
            {
                return $errorCode;
            }
        }
    }
}
