<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class SavePento extends Model
{
    protected $table = 'pento_designs';

    // 창작한 펜토미노 저장 -> 도안 테이블, 작품 테이블, 컬렉션 테이블 insert
    static public function makePento($partition, $board_X, $board_Y, $userNum, $designTitle, $designExplain, $imitatedImage)
    {
        try {

            // 도안 테이블에 도안번호, 회원번호, 도안제목, 도안설명, 등록날짜 등록
            DB::table('pento_designs')
                ->insert
                (
                    [
                        'user_no'               =>  $userNum,
                        'design_title'          =>  $designTitle,
                        'design_explain'        =>  $designExplain,
                        'partition'             =>  $partition,
                        'registered_date'       =>  Carbon::now()
                    ]
                );


            // 중복 체크 테이블의 등록날짜와 도안번호 가져오기
            $designNumObject    =   DB::table('pento_designs')
                ->select('design_no', 'registered_date')
                ->where('partition', $partition)
                ->get();

            // 도안번호
            $designNum          =   $designNumObject[0]->design_no;
            // 등록날짜
            $registeredDate     =   $designNumObject[0]->registered_date;


            // 좌표 테이블에 좌표 값 등록
            for ($i = 0; $i < count($board_X); $i++)
            {
                DB::table('coordinate_values')
                    ->insert(
                        [
                            'design_no'         =>  $designNum,
                            'board_X'           =>  $board_X[$i],
                            'board_Y'           =>  $board_Y[$i],
                            'registered_date'   =>  $registeredDate
                        ]
                    );
            }

            // 작품테이블에 도안번호, 회원번호, 작품이미지, 등록날짜 등록
            DB::table('imitated_pentos')->insert
            (
                [
                    'design_no'         =>  $designNum,
                    'user_no'           =>  $userNum,
                    'imitated_photo'    =>  $imitatedImage,
                    'registered_date'   =>  $registeredDate
                ]
            );

            // 컬렉션 테이블에 도안번호, 회원번호 등록
            DB::table('collections')->insert
            (
                [
                    'design_no'         =>  $designNum,
                    'user_no'           =>  $userNum,
                    'registered_date'   =>  $registeredDate
                ]
            );


        } catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 등록시 등록된 값일 경우
            if ($errorCode == 1062)
            {
                // 문자열 반환
                return 'Duplicate Coordinate Values!';
            }
            else
            {
                return $errorCode;
            }
        }
        // 등록 성공
        return true;
    }

    // 펜토미노 게임 클리어시
    static public function clearPetno($designNum, $userNum, $imitatedPhoto, $clearTime)
    {
        try
        {
            // 작품테이블에 도안번호, 회원번호, 작품 이미지명, 등록날짜 등록
            DB::table('imitated_pentos')->insert
            (
                [
                    'design_no'         =>  $designNum,
                    'user_no'           =>  $userNum,
                    'imitated_photo'    =>  $imitatedPhoto,
                    'registered_date'   =>  Carbon::now()
                ]
            );

            // 등록날짜 가져오기
            $registeredDateObject       =   DB::table('imitated_pentos')
                                                ->select('registered_date')
                                                ->where('design_no', $designNum)
                                                ->where('user_no', $userNum)
                                                ->where('imitated_photo', $imitatedPhoto)
                                                ->get();

            // 등록 날짜
            $registerDate = $registeredDateObject[0]->registered_date;

            // 기록테이블에 회원번호, 도안번호, 클리어시간 등록
            DB::table('pento_records')->insert
            (
                [
                    'user_no'           =>  $userNum,
                    'design_no'         =>  $designNum,
                    'cleartime'         =>  $clearTime,
                    'register_date'     =>  $registerDate
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
            if ($errorCode == 1054)
            {
                return 'Unknown column';
            }
            if ($errorCode == 1062)
            {
                return 'Duplicate entry';
            }
        }
        return true;
    }
}
