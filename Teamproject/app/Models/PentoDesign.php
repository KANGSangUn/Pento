<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class PentoDesign extends Model
{
    protected $table = 'pento_designs';

    // 도안테이블의 도안번호와 등록날짜 가져오기
    static public function getDesignData($coordinateValue)
    {

        $designNumObject        =   PentoDesign::select('design_no', 'registered_date')
            ->where('coordinate_value', $coordinateValue)
            ->get();

        // 도안번호와 등록날짜
        $designData             =   [$designNumObject[0]->design_no, $designNumObject[0]->registered_date];

        // 도안번호, 등록날짜 반환
        return $designData;

    }


    // 도안 리스트(웹)
    static public function getPentoListWeb()
    {
        // 모든 도안의 이미지를 저장한 경로 가져오기
        $routeName          =   ImageRoute::getImageRoute('everyPento');

        // 도안번호, 제목, 난이도, 이미지 가져오기
        $designInfo         =   DB::table('pento_designs as pd')
            ->join('user_profiles as up', 'pd.user_no', '=', 'up.user_no')
            ->select
        (
            'pd.design_no',
            'pd.design_title',
            DB::raw('concat( "' . $routeName . '", pd.design_image) as design_image'),
            'pd.identifier as level',
            'up.user_nickname'

        )
            ->where('pd.identifier', 'every')
            ->orderBy('pd.registered_date')
            ->get();


        if ($designInfo == "[]")
        {
            return "select Fail";
        }

        // 도안 목록 반환
        return $designInfo;

    }


    // 도안 상세설명(웹)
    static public function getPentoInfo($designNum)
    {

        // 도안 이미지 경로 가져오기
        $routeName              =   ImageRoute::getImageRoute('everyPento');


        // 도안의 상세설명 반환
        // 도안번호, 제목, 설명, 작성자, 이미지, 좌표값
        $designInfo             =   DB::table('pento_designs as pd')
                                        ->join('user_profiles as up', 'up.user_no', '=', 'pd.user_no')
                                        ->select
                                        (
                                            'pd.design_no',
                                            'pd.design_title',
                                            DB::raw('concat( "' . $routeName . '", pd.design_image) as design_image'),
                                            'pd.design_explain',
                                            'up.user_nickname',
                                            'pd.registered_date'
                                        )
                                        ->where('pd.design_no', $designNum)
                                        ->get();


        // 해당 도안번호를 가진 작품들의 추천수 총합 반환
        $designRecommendSum     = ImitatedPento::getRecommendNum($designNum);


        if ($designInfo == "[]")
        {
            return "false";
        }

        // 도안의 상세정보와 총합 반환
        $total =
            [
                'design_info'       =>  $designInfo,
                'recommendNumSum'   =>  $designRecommendSum
            ];

        return $total;

    }

    // 창작한 도안일 경우 도안 자체를 삭제 & 구독한 컬렉션일 경우 구독해제(웹)
    static public function deletePento($userNum, $designNum)
    {


        try {

            // 창작한 작품일 경우 도안자체 삭제
            $deleteResult               = DB::table('pento_designs')
                                        ->where('user_no', $userNum)
                                        ->where('design_no', $designNum)
                                        ->delete();

            if ($deleteResult == 0)
            {

                // 구독한 컬렉션일 경우 구독해제
                try
                {

                    Collection::where('user_no', $userNum)
                                ->where('design_no', $designNum)
                                ->delete();
                }

                // 쿼리문 에러시 에러코드 반환
                catch (QueryException $e)
                {
                    $errorCode = $e->errorInfo[1];

                    return $errorCode;
                }

                // 삭제 성공시 true 반환
                return "true";
            }
        }
        catch (QueryException $e)
        {
            // 에러일 경우 에러코드 반환
            $errorCode = $e->errorInfo[1];

            return $errorCode;

        }

        return "true";
    }


    // 도안 좌표 가져오기(유니티)
    static public function getPentoCoordinate($design_no)
    {

        // 해당 도안의 좌표 값들을 반환
        $coordinateResult       =   PentoDesign::select('coordinate_value')
                                               ->where('design_no', $design_no)
                                               ->get();


        // 결과 값이 없을 경우
        if ($coordinateResult == "[]")
        {
            return "Invalid design_no!";
        }

        return $coordinateResult;

    }



    // 단계별 모드 리스트 반환(유니티)
    static public function getLevelDesignList($level)
    {

        // 단계별 도안 경로 가져오기
        $routeName          =   ImageRoute::getImageRoute('everyPento');

        // 펜토미노 도안 리스트 가져오기
        // 도안번호, 도안제목, 좌표값
        $designList         =   PentoDesign::select
                                (
                                    'design_no',
                                    'design_title',
                                    DB::raw('concat( "' . $routeName . '", design_image) as design_image'),
                                    'design_explain'
                                )
                                ->where('identifier', $level)
                                ->get();

        // 단계별 도안 목록 반환
        return $designList;

    }



    // 단계별 보상 포인트 정보 가져오기
    static public function getRewardPoint($designNum)
    {

        try
        {

            // 해당 도안번호의 포인트 가져오기
            $pointResult        =   PentoDesign::select('reward_point')
                                    ->whereIn('identifier', [1, 2, 3, 4, 5])
                                    ->where('design_no', $designNum)
                                    ->get();

        }

        catch (QueryException $e)
        {
            // 쿼리문 에러시 에러코드 반환
            $errorCode = $e->errorInfo[1];
            return "Invalid Value error code : $errorCode";

        }

        // 클리어 포인트 반환
        return $pointResult[0]->reward_point;

    }


    // 단계별 도안 번호 가져오기
    static public function getLevelDesignNum($userGrade)
    {

        // 해당 회원의 레벨을 가져와서
        $designNum      =   DB::table('pento_designs')
            ->select('design_no')
            ->where('identifier', $userGrade)
            ->get();

        if ($designNum == "[]")
        {
            return "select fail";
        }

        // 레벨 반환
        return $designNum;
    }



    // 창작한 펜토미노 도안테이블(pento_designs)에 저장
    static public function savePentoDesign($designArray)
    {

        try {

            PentoDesign::insert
            (
                [
                    'user_no'               =>  $designArray['user_no'],
                    'identifier'            =>  'every',
                    'design_title'          =>  $designArray['design_title'],
                    'design_explain'        =>  $designArray['design_explain'],
                    'coordinate_value'      =>  $designArray['coordinate_value'],
                    'design_image'          =>  $designArray['image_name'],
                    'registered_date'       =>  Carbon::now()
                ]
            );

            // 방금 저장한 도안의 번호와 등록날짜 가져오기
            $dataResult         =   PentoDesign::getDesignData($designArray['coordinate_value']);

            // 컬렉션 테이블에 저장
            Collection::saveDesign($designArray['user_no'], $dataResult[0], $dataResult[1]);

            // 작품 테이블에 저장
            ImitatedPento::saveMakeDesign($designArray['user_no'], $dataResult[0], $designArray['image_name'], $dataResult[1]);

        }
        catch (QueryException $e)
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
        return "true";
    }

    public static function test($level)
    {
        return DB::table('pento_designs')
            ->select('coordinate_value','design_title')
            ->where('identifier','=',$level)
            ->get();
    }


}