<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Collection extends Model
{
    protected $table    =   'collections';

    // 나만의 컬렉션 리스트 웹
    static public function collectionListWeb($userNum)
    {
        // 수정중
        // 도안번호, 제목, 이미지, 작성자, 만들었는 날짜
        $webCollectionList =   DB::table('collections as co')
                                ->join('pento_designs as pd','co.design_no', '=', 'pd.design_no')
                                ->join('user_profiles as up', 'pd.user_no', '=', 'up.user_no')
                                ->join('coordinate_values as cv', 'co.design_no', '=', 'cv.design_no')
                                ->select(
                                    'pd.design_no',
                                    'cv.board_X',
                                    'cv.board_Y',
                                    'pd.user_no',
                                    'pd.design_title',
                                    'up.user_nickname',
                                    'pd.registered_date'
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
    static public function collectionListUnity($userNum)
    {
        $unityCollectionList    =     DB::table('collections as co')
                                        ->join('pento_designs as pd','co.design_no', '=', 'pd.design_no')
                                        ->join('user_profiles as up', 'pd.user_no', '=', 'up.user_no')
                                        ->join('coordinate_values as cv', 'co.design_no', '=', 'cv.design_no')
                                        ->select(
                                            'pd.design_no',
                                            'cv.board_X',
                                            'cv.board_Y',
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

  /*  // 컬렉션 삭제 : 구독해제
    static public function deleteColletion($userNum, $designNum)
    {
        try
        {
            Collection::where('user_no', $userNum)
                        ->where('design_no', $designNum)
                        ->delete();
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            return $errorCode;
        }
        return true;
    }*/




    // 도안 구독하기
    static public function subscribePento($userNum, $designNum)
    {
        DB::table('collections as co')
            ->join('pento_designs as pd','co.design_no', '=', 'pd.design_no')
            ->join('user_profiles as up', 'pd.user_no', '=', 'up.user_no')
            ->join('coordinate_values as cv', 'co.design_no', '=', 'cv.design_no')
            ->select(
                'pd.design_no',
                'cv.board_X',
                'cv.board_Y',
                'pd.design_title',
                'up.user_nickname'
            )
            ->where('co.user_no', $userNum)
            ->get();

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

        }
        return true;
    }
}
