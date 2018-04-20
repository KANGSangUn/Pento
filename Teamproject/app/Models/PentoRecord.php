<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PentoRecord extends Model
{
    protected $table = 'pento_records';

    // 게임 기록 저장
    static public function saveRecord($pentoArray)
    {
        // 회원번호, 도안번호, 클리어시간, 등록시간 insert
        try
        {
            return PentoRecord::insert(
                [
                    'user_no'           =>   $pentoArray['userNum'],
                    'design_no'         =>   $pentoArray['designNum'],
                    'cleartime'         =>   $pentoArray['clearTime'],
                    'registered_date'   =>   Carbon::now()
                ]
            );
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 컬럼이 잘못되었을 경우
            if ($errorCode == 1054)
            {
                // 문자열 반환
                return 'Unknown column';
            }
            // 인자값이 유효한 값이 아닌 경우
            else if ($errorCode == 1452)
            {
                return "Invalid Value";
            }
            // 타임형으로 들어오지 않을 경우
            else if ($errorCode == 1292)
            {
                return "Time format kudasai";
            }
            // 이 외의 에러 발생시 에러코드 반환
            else
                return $errorCode;
        }
    }

    // 웹 기록 작품 목록
    static public function recordPentolist($userNum)
    {
        // 펜토미노 이미지가 저장되어 있는 이미지 경로 select
        $routeName = ImageRoute::getImageRoute('pentoImg');

        // 작품 테이블과 기록 테이블의 도안번호가 같을 시에 해당 도안번호와 도안 사진을 반환
        $recordPentoList    =     DB::table('imitated_pentos as ip')
                                    ->join('pento_records as pr', 'ip.design_no', '=', 'pr.design_no')
                                    ->select
                                    (
                                        'ip.design_no',
                                        DB::raw('concat ("' . $routeName .'", ip.imitated_photo) as imitated_photo')
                                    )
                                    ->where('ip.user_no', 1)
                                    ->groupby('ip.design_no')
                                    ->orderby('ip.registered_date desc')
                                    ->get();

        // 비어있는 값일 경우 select 실패
        if($recordPentoList == "[]")
        {
            return "select Fail";
        }

        return $recordPentoList;

    }

    // 기록 페이지 펜토미노 검색해서 목록 가져오기
    static public function searchPentoRecord($userNum, $pentoTitle)
    {
        $routeName = ImageRoute::getImageRoute('pentoImg');

        if (empty($pentoTitle))
        {
            return "select fail";
        }

        $searchResult = DB::table('imitated_pentos as ip')
            ->join('pento_records as pr', 'ip.design_no', '=', 'pr.design_no')
            ->join('pento_designs as pd', 'ip.design_no', '=', 'pd.design_no')
            ->select
            (
                'ip.design_no',
                DB::raw('concat ("' . $routeName .'", ip.imitated_photo) as imitated_photo')
            )
            ->where('ip.user_no', $userNum)
            //->where('ip.design_no', $designNum[$i]->design_no)
            ->where('pd.design_title', 'regexp', $pentoTitle)
            ->groupby('ip.design_no')
            ->orderby('ip.registered_date', 'desc')
            ->get();

        // select 결과가 없을 경우
        if ($searchResult == "[]")
        {
            return "select fail";
        }

        return $searchResult;
    }

    // 웹 마이페이지 기록반환
    static public function showRecord($userNum, $designNum)
    {
        // 회원의 기록이 있는 작품 리스트
        // 클리어시간 반환
        $userRecord         =     DB::table('pento_records')
                                ->select('cleartime', 'register_date')
                                ->where('user_no', $userNum)
                                ->where('design_no', $designNum)->get();

        // 해당 도안을 푼 사용자들의 평균 클리어 시간 반환
        $avgTime            =     DB::table('pento_records')
                                    ->select
                                    (
                                        DB::raw('sec_to_time(floor(avg(time_to_sec(cleartime)))) as avgTime')
                                    )
                                    ->where('design_no', $designNum)
                                    ->get();

        // 해당 도안의 유저 랭킹 정보 반환
        $userRank           =     DB::table(DB::raw('pento_records as pr join user_profiles as up on pr.user_no = up.user_no,(select @rnum :=0) cleartime'))
                                    ->select(DB::raw('@rnum := @rnum + 1 as rank, up.user_nickname, pr.cleartime'))
                                    ->where('pr.design_no', $designNum)
                                    ->orderby('pr.cleartime')
                                    ->get();


        // 키 값으로 객체에 저장
        $total =
            [
                'userRecord' => $userRecord,
                'avgTime' => $avgTime,
                'userRank' => $userRank

            ];

        // select 실패시
        if ($userRecord == "[]" || $avgTime == "[]" || $userRank == "[]")
        {
            return "select Fail";
        }

        // 객체 반환
        return $total;
    }


}
