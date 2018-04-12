<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PentoDesign extends Model
{
    protected $table    = 'pento_designs';

    // 웹 도안리스트
    static public function getPentoListWeb()
    {
        // 도안의 정보들을 가져온다.
        // 도안번호, 제목, 난이도, 좌표값
        $designInfo     =   DB::table('pento_designs as pd')
                                ->join('level_rewards as lr', 'pd.design_no', '=', 'lr.design_no')
                                ->join('coordinate_values as cv', 'pd.design_no', '=', 'cv.design_no')
                                ->select
                                (
                                    'pd.design_no',
                                    'pd.design_title',
                                    'lr.level_of_difficultly',
                                    'cv.board_X',
                                    'cv.board_Y'
                                )
                                ->get();

        if ($designInfo == "[]") {
            return "select Fail";
        }

        return $designInfo;
    }

    // 도안상세설명
    static public function getPentoInfo($designNum)
    {

        // 도안의 상세설명 반환
        // 도안번호, 제목, 설명, 작성자, 난이도, 좌표값
        $designInfo         =   DB::table('pento_designs as pd')
                                    ->join('level_rewards as lr', 'pd.design_no', '=', 'lr.design_no')
                                    ->join('coordinate_values as cv', 'pd.design_no', '=', 'cv.design_no')
                                    ->join('user_profiles as up', 'up.user_no', '=', 'pd.user_no')
                                    ->select
                                    (
                                        'pd.design_no',
                                        'pd.design_title',
                                        'pd.design_explain',
                                        'up.user_nickname',
                                        'lr.level_of_difficultly',
                                        'cv.board_X',
                                        'cv.board_Y'
                                    )
                                    ->where('pd.design_no', $designNum)
                                    ->get();


        // 해당 도안번호를 가진 작품들의 추천수 총합 반환
        $designRecommendSum =   DB::table('imitated_pentos as ip')
                                    ->join('recommends as rc', 'ip.imitated_no', '=', 'rc.imitated_no')
                                    ->select(DB::raw('count(ip.imitated_no) as reNumSum'))
                                    ->where('ip.design_no', $designNum)
                                    ->get();


        if ($designInfo == "[]" || $designRecommendSum == "[]")
        {
            return "select Fail";
        }

        // 도안의 상세정보와 총합 반환
        $total =
            [
                'design_info' => $designInfo,
                'recommendNumSum' => $designRecommendSum
            ];

        return $total;
    }

    // 창작 도안 삭제
    static public function deletePento($designNum, $userNum)
    {
       try
        {
            // 창작한 작품일 경우 도안자체 삭제
          $result =   DB::table('pento_designs')
                ->where('user_no', $userNum)
                ->where('design_no', $designNum)
                ->delete();

          if($result == 0)
          {
              // 구독한 컬렉션일 경우 구독해제
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
          }
       }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            return $errorCode;
        }
        return true;
    }

    // 도안 좌표 가져오기(유니티)
    static public function getPentoCoordinate($design_no)
    {
        // 해당 도안의 좌표 값들을 반환
        $coordinateResult = DB::table('coordinate_values')
                                ->select('board_X', 'board_Y')
                                ->where('design_no', $design_no)
                                ->get();

        // 결과 값이 없을 경우
        if ($coordinateResult == "[]")
        {
            return "Invalid design_no!";
        }
        return $coordinateResult;
    }
}
