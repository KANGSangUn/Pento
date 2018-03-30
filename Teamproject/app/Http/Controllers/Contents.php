<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-13
 * Time: 오후 10:48
 */

namespace App\Http\Controllers;

use App\Model_Buy;
use App\Model_Recommend;
use App\Model_Subscribe;
use App\Model_Records;

class Contents extends Controller
{
    // 도안 검색 메서드
    public function Search_colletion($collection_name){
        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        // 검색된 도안 불러오기
        return Model_Records::findPento($user_no,$collection_name);
    }

    // 구매 or 구독 메서드
    public function Buy_Contents($category,$contents_id,$method_id){

        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        switch ($category){

            // 동화 구매
            case 'tale':
                // 구매 여부 확인
                $check_buylist = Model_Buy::check_buylist($contents_id,$user_no);

                if(empty($check_buylist)){      // 구매목록에 없을때

                    if($method_id == 'Bucket'){     // 장바구니 추가 일때

                        $this->Bucket_Contents($contents_id);
                        return '장바구니 추가완료';
                    }
                    else{                           // 구매하기 일때

                        Model_Buy::buyStory($contents_id,$user_no);
                        return '동화구입 완료';
                    }
                }
                else{                           // 이미 구매한 동화일때
                    return '이미구입한 동화입니다.';
                }

                break;

            // 도안 구독
            case 'collection':
                // 구독 여부 확인
                $check_collection = Model_Subscribe::check_collection($contents_id,$user_no);

                if(empty($check_collection)){      // 구독목록에 없을때

                    Model_Subscribe::subscribe($contents_id,$user_no);
                    return '구독완료';
                }
                else{                           // 이미 구매한 동화일때
                    return '이미구독한 도안입니다.';
                }

                break;

        }
    }

    // 장바구니 메서드
//    public function Bucket_Contents($contents_id){
//
//        if(session()->has('Bucket')){
//            session()->push('Bucket', $contents_id);
//        }
//        else{
//            session()->put(['Bucket' => $contents_id]);
//        }
//    }

    // 추천 메서드
    public function Recommend_Contents($category,$contents_id){

        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        // 추천 여부 확인
        $check_recommend = Model_Recommend::check_recommend($category,$contents_id,$user_no);

        if(empty($check_recommend)){
            Model_Recommend::add_recommend($category,$contents_id,$user_no);       // 친구 추가
            return '추천추가';
        }
        else{
            Model_Recommend::delete_recommend($category,$contents_id,$user_no);    // 친구 삭제
            return '추천삭제';
        }
    }

}
