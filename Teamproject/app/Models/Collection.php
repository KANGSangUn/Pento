<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Collection extends Model
{

    protected $table        =   'collections';


    // 나만의 펜토미노 리스트 웹
    static public function getCollectionListWeb($userNum)
    {
        // 도안이미지 경로 가져오기
        $routeName          =      ImageRoute::getImageRoute('everyPento');

        // 도안번호, 제목, 이미지, 작성자, 만들었는 날짜
        $webCollectionList  =       DB::table('collections as co')
                                        ->join('pento_designs as pd','co.design_no', '=', 'pd.design_no')
                                        ->select(
                                            'pd.design_no',
                                            DB::raw('concat( "' . $routeName . '", pd.design_image) as design_image')
                                        )
                                        ->where('co.user_no', $userNum)
                                        ->get();

        if($webCollectionList == "[]")
        {
            return "Invalid Value!";
        }

        return $webCollectionList;
    }



    // 유니티 컬렉션 리스트
    static public function getCollectionListUnity($userNum)
    {
        // 도안이미지 경로 가져오기
        $routeName       =      ImageRoute::getImageRoute('everyPento');

        // 도안번호, 도안이미지, 제목, 작성자
        $unityCollectionList    =     DB::table('collections as co')
                                        ->join('pento_designs as pd','co.design_no', '=', 'pd.design_no')
                                        ->join('user_profiles as up', 'pd.user_no', '=', 'up.user_no')
                                        ->select(
                                            'pd.design_no',
                                             DB::raw('concat( "' . $routeName . '", pd.design_image) as design_image'),
                                            'pd.design_title',
                                            'up.user_nickname'
                                        )
                                        ->where('co.user_no', $userNum)
                                        ->get();


        if($unityCollectionList == "[]")
        {
            return "Invalid Value!";
        }
        return $unityCollectionList;
    }


    // 도안 구독하기
    static public function subscribePento($userNum, $designNum)
    {
        try
        {
            Collection::insert(
                [
                    'user_no' => $userNum,
                    'design_no' => $designNum,
                    'registered_date' => Carbon::now(),
                ]
            );
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 구독한 도안을 구독하려고 할 경우
            if ($errorCode == 1062)
            {
                // 문자열 반환
                return 'Duplicate Value';
            }
            else
            {
                return $errorCode;
            }

        }
        return "true";
    }


    // 컬렉션 테이블에 도안 추가하기
    static public function saveDesign($userNum, $designNum, $registeredDate)
    {
        // 컬렉션 테이블에 도안번호, 회원번호 등록
        try
        {
            Collection::insert
            (
                [
                    'user_no'           =>  $userNum,
                    'design_no'         =>  $designNum,
                    'registered_date'   =>  $registeredDate
                ]
            );
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            // 구독한 도안을 구독하려고 할 경우
            if ($errorCode == 1062)
            {
                // 문자열 반환
                return 'Duplicate Value';
            }
            else
            {
                return $errorCode;
            }

        }
        return "true";
    }



    // 유니티 자유모드, 단계별모드, 스토리모드 플레이 시 저장
    static public function saveImitatedDesign($userNum, $designNum, $putNumber, $imitatedImage, $clearTime)
    {
        try
        {
        // 현재 시간 저장
        $currentTime = Carbon::now();

        // 컬렉션 테이블에 도안 저장
        Collection::saveDesign($userNum, $designNum, $currentTime);

        // 작품 테이블에 도안과 기록 저장
        ImitatedPento::saveImitatedDesign($userNum, $designNum, $putNumber, $imitatedImage, $clearTime, $currentTime);
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

                return $errorCode;

        }
        return "true";
    }
}
