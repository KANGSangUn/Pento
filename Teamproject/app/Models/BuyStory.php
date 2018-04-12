<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class BuyStory extends Model
{
    protected $table    =   'buyLists';

    // 동화 구매
    static public function buyStory($userNum, $taleNum)
    {

        // 회원번호와 구매한 동화번호, 구입날짜 insert
        try
        {
            DB::table('buylists')->insert(
                                [
                                    'user_no'           => $userNum,
                                    'fairy_tale_no'     => $taleNum,
                                    'registered_date'   => Carbon::now()->format('Y-m-d H:i:s'),
                                ]
                            );

        } // 이미 구매한 동화일 경우
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 제약조건 위반
            if ($errorCode == 1452)
            {
                return 'Cannot add or update a child row: a foreign key constraint fails';
            }
            // 쿼리문 컬럼명 error
            if ($errorCode == 1054)
            {
                return 'Unknown column';
            }
            // 구입한 동화일 경우
            if ($errorCode == 1062)
            {
                return 'Duplicate entry';
            }
        }
        return 'true';
    }


    // 웹 마이페이지 구매목록
    static public function getBuyList($userNum)
    {
        // 회원 이미지 저장 경로 select 메소드 호출
        $routeName      =   ImageRoute::getImageRoute('storyPage');


        // 구매테이블에서 회원번호를 이용해 동화번호를 가져온다.
        // 동화번호를 이용해 동화테이블의 제목을 가져온다.
        // 구매테이블의 구매날짜를 가져온다.

        $buyList         =     DB::table('fairy_tales as ft')
                                ->join('buylists as bl', 'ft.fairy_tale_no', '=', 'bl.fairy_tale_no')
                                ->join('tale_images as ti', 'bl.fairy_tale_no', '=', 'ti.fairy_tale_no')
                                ->select
                                ('ft.fairy_tale_no',
                                    'ft.tale_title',
                                    DB::raw('concat( "' . $routeName . '", ti.tale_image) as tale_image'),
                                    'bl.registered_date'
                                )
                                ->where('bl.user_no', '=', $userNum)
                                ->where('ti.type_no', 1)
                                ->where('ti.tale_image', 'regexp', '_1$')
                                ->orderBy('ft.tale_title')
                                ->get();

        // 유저 넘버가 없는 경우
        if ($buyList == "[]") {
            return "fail select!";
        }

        return $buyList;
    }

}
    //}

