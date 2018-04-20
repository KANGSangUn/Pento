<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-13
 * Time: 오후 10:48
 */

namespace App\Http\Controllers;

use App\Models\BuyStory;
use App\Models\Collection;
use App\Models\PentoRecord;
use App\Models\Recommend;

class Contents extends Controller
{
    // 도안 검색 메서드
    public function Search_colletion($collection_name){

        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        // DB에서 도안정보 검색하기
        $result_value = PentoRecord::searchPentoRecord($user_no,$collection_name);

        // 검색된 도안 불러오기
        if($result_value == 'select fail'){
            $return_value = 'false';
        }
        else{
            $return_value = $result_value;
        }

        return $return_value;
    }

    // 구매 or 구독 메서드
    public function Buy_Contents($category,$contents_id){

        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        switch ($category){

            // 동화 구매
            case 'tale':
                // 구매 여부 확인

//                $contents_id = array(1,3,2,4,5);

                // 구매할 동화가 몇개인지 판별
                if(is_array($contents_id)){

                    // 동화갯수만큼 구매하기 기능 실행
                    for ($i=0; $i<count($contents_id); $i++){

                        $check_buylist = BuyStory::buyStory($user_no,$contents_id[$i]);

                        // 하나라도 이미 구매한 동화라면 false 반환
                        if($check_buylist != 'true'){
                            return 'false';
                        }
                    }
                }
                else{
                    $check_buylist = BuyStory::buyStory($user_no,$contents_id);
                }

                // 이미 구매한 동화면 false 반환
                if($check_buylist != 'true'){
                    $result_value = 'false';
                }
                else{
                    $result_value =  'true';
                }

                break;

            // 도안 구독
            case 'collection':

                // 구독 여부 확인
                $check_collection =  Collection::subscribePento($user_no,$contents_id);

                // 이미 구독한 도안이면 false 반환
                if($check_collection == 'Duplicate Value'){

                    $result_value = 'false';
                }
                else{
                    $result_value = 'true';
                }

        }

        return $result_value;
    }

    // 추천 메서드
    public function Recommend_Contents($imitatedNum){

        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        // 추천 하기
        return $check_recommend = Recommend::recommend($user_no, $imitatedNum);
    }

}
