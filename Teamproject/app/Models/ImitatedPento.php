<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\MockObject;

class ImitatedPento extends Model
{
    protected $table = 'imitated_pentos';



    // 추천수가 많은 순서대로 작품 리스트 반환
    static public function getReImitatedPentoList($designNum)
    {
        // 펜토미노 이미지가 저장된 경로 select 메서드 호출
        $routeName           =    ImageRoute::getImageRoute('imitatedPento');

        // 작품번호, 작품제목, 작성자 닉네임, 추천수 반환
        $imitatedResult      =    DB::table('imitated_pentos as ip')
            ->join('pento_designs as pd', 'pd.design_no', '=', 'ip.design_no')
            ->leftJoin('recommends as rm', 'rm.imitated_no', '=', 'ip.imitated_no')
            ->join('user_profiles as up','ip.user_no', '=', 'up.user_no')
            ->select
            (
                'ip.imitated_no',
                'pd.design_title',
                'up.user_nickname',
                DB::raw('concat ("' . $routeName .'", ip.imitated_image) as imitated_image'),
                DB::raw('count(rm.imitated_no) as reNum')
            )
            ->where('ip.design_no', $designNum)
            ->orderBy('reNum', 'desc')
            ->groupBy('ip.imitated_no')
            ->get();

        return $imitatedResult;
    }


    // 창작한 펜토미노 작품 테이블에 저장
    static public function saveMakeDesign($userNum, $designNum, $imitatedImage, $registeredDate)
    {
        try
        {

            // 작품테이블에 도안번호, 회원번호, 작품이미지, 등록날짜 등록
            ImitatedPento::insert
            (
                [
                    'user_no'           =>  $userNum,
                    'design_no'         =>  $designNum,
                    'division_no'       =>  1,
                    'imitated_image'    =>  $imitatedImage,
                    'put_number'        => 0,
                    'clear_time'        => 'null',
                    'registered_date'   =>  $registeredDate
                ]
            );
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1452)
            {
                return 'Cannot add or update a child row: a foreign key constraint fails';
            }
            else if ($errorCode == 1054)
            {
                return 'Unknown column';
            }
            else if ($errorCode == 1062)
            {
                return 'Duplicate entry';
            }
            else
            {
                return $errorCode;
            }
        }
        return "true";
    }

    // 자유모드, 스토리모드, 단계별 모드 작품테이블에 저장하기
    static public function saveImitatedDesign($userNum, $designNum, $putNumber, $imitatedImage, $clearTime, $registeredDate)
    {
        try
        {

            // 작품테이블에 도안번호, 회원번호, 작품이미지, 등록날짜 등록
            ImitatedPento::insert
            (
                [
                    'user_no'           =>  $userNum,
                    'design_no'         =>  $designNum,
                    'division_no'       =>  1,
                    'put_number'        =>  $putNumber,
                    'imitated_image'    =>  $imitatedImage,
                    'clear_time'        =>  $clearTime,
                    'registered_date'   =>  $registeredDate
                ]
            );
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1452)
            {
                return 'Cannot add or update a child row: a foreign key constraint fails';
            }
            else if ($errorCode == 1054)
            {
                return 'Unknown column';
            }
            else if ($errorCode == 1062)
            {
                return 'Duplicate entry';
            }
            else
            {
                return $errorCode;
            }
        }
        return "true";
    }



    // 작품 테이블의 해당 도안의 등록날짜 가져오기
    static public function getImitatedData($userNum, $designNum, $imitatedImage)
    {
        // 등록날짜 가져오기
        $registeredDateObject       =   ImitatedPento::select('registered_date')
            ->where('design_no', $designNum)
            ->where('user_no', $userNum)
            ->where('imitated_image', $imitatedImage)
            ->get();

        // 등록 날짜 반환
        return $registeredDateObject[0]->registered_date;
    }


    // 작품의 총 추천수 반환
    static public function getRecommendNum($designNum)
    {
        // 해당 도안번호를 가진 작품들의 추천수 총합 반환
        $designRecommendSum     =    DB::table('imitated_pentos as ip')
            ->join('recommends as rc', 'ip.imitated_no', '=', 'rc.imitated_no')
            ->select(DB::raw('count(ip.imitated_no) as reNumSum'))
            ->where('ip.design_no', $designNum)
            ->get();

        return $designRecommendSum[0]->reNumSum;
    }


    // 기록테이블에서 유저가 플레이한 도안번호를 가져오기
    static public function getRecordDesignNum($userNum)
    {


        $reDesignNumObject = ImitatedPento::select('design_no')
            ->where('user_no', $userNum)
            ->groupBy('design_no')
            ->get();



        return $reDesignNumObject;
    }



    // 웹 기록 작품 목록
    static public function getImitatedPentolist($userNum)
    {

        // 펜토미노 이미지가 저장되어 있는 이미지 경로 select
        $routeName          =       ImageRoute::getImageRoute('imitatedPento');

        // 작품 테이블과 기록 테이블의 도안번호가 같을 시에 해당 도안번호와 도안 사진을 반환

        $recordPentoList   =       DB::table(DB::raw('imitated_pentos as a, (select design_no, max(registered_date) as maxdate from imitated_pentos  where user_no = '.$userNum.' and put_number != 0 group by design_no) as b'))
            ->select
            ('a.design_no',
                DB::raw('concat ("' . $routeName .'", a.imitated_image) as imitated_image'),
                'a.registered_date'
            )
            ->where('a.design_no', DB::raw('b.design_no'))
            ->where('a.registered_date', DB::raw('b.maxdate'))
            ->groupBy('a.design_no')
            ->orderBy('a.registered_date', 'desc')
            ->get();


        // 비어있는 값일 경우 select 실패
        if(!isset($recordPentoList[0]))
        {
            return "select Fail";
        }

        return $recordPentoList;

    }



    // 기록 페이지 펜토미노 검색해서 목록 가져오기
    static public function findImitatedPentoList($userNum, $pentoTitle)
    {

        // 작품 도안 이미지가 저장되어 있는 경로 가져오기
        $routeName = ImageRoute::getImageRoute('imitatedPento');

        $searchResult = DB::table('imitated_pentos as ip')
            ->join('pento_designs as pd', 'ip.design_no', '=', 'pd.design_no')
            ->select
            (
                'ip.design_no',
                DB::raw('concat ("' . $routeName .'", ip.imitated_image) as imitated_image')
            )
            ->where('ip.user_no', $userNum)
            ->where('pd.design_title', 'regexp', $pentoTitle)
            ->where('ip.put_number', '>', 0)
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
    static public function getRecordList($userNum, $designNum)
    {

        $title              = ImitatedPento::join('pento_designs', 'imitated_pentos.design_no', '=', 'pento_designs.design_no')
            ->select('pento_designs.design_title')
            ->where('imitated_pentos.design_no', $designNum)
            ->where('put_number', '>', 0)
            ->get();
        // 회원의 기록이 있는 작품 리스트
        // 클리어시간 반환
        $userRecord         =   ImitatedPento::select('clear_time', 'registered_date', 'put_number')
            ->where('user_no', $userNum)
            ->where('design_no', $designNum)
            ->where('put_number', '>', 0)
            ->get();

        // 해당 도안을 푼 사용자들의 평균 클리어 시간 반환
        $avgTime            =   ImitatedPento::select
        (
            DB::raw('sec_to_time(floor(avg(time_to_sec(clear_time)))) as avgTime')
        )
            ->where('design_no', $designNum)
            ->where('put_number', '>', 0)
            ->get();


        // 해당 도안의 유저 랭킹 정보 반환
        $userRank           =     DB::table(DB::raw('imitated_pentos as ip join user_profiles as up on ip.user_no = up.user_no,(select @rnum :=0) clear_time'))
            ->select(DB::raw('@rnum := @rnum + 1 as rank, up.user_nickname, ip.clear_time, cast(ip.clear_time as unsigned) as int_clearTime, ip.put_number'))
            ->where('ip.design_no', $designNum)
            ->where('put_number', '>', 0)
            ->orderby('ip.clear_time')
            ->get();


        // 키 값으로 객체에 저장
        $total =
            [
                'title'         =>  $title,
                'userRecord'    =>  $userRecord,
                'avgTime'       =>  $avgTime,
                'userRank'      =>  $userRank

            ];

        // select 실패시
        if ($title = "[]" && $userRecord == "[]" && $avgTime == "[]" && $userRank == "[]")
        {
            return "select Fail";
        }

        // 객체 반환
        return $total;

    }

}