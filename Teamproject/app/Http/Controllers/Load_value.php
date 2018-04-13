<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-13
 * Time: 오후 10:48
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Design_Controller;
use App\Models\BuyStory;
use App\Models\Collection;
use App\Models\FairyTale;
use App\Models\Friend;
use App\Models\PentoDesign;
use App\Models\PentoRecord;
use App\Models\UserProfile;

use Illuminate\Support\Facades\Session;


class Load_value extends Controller
{
    public $obj_Design_Controller;

    public function __construct()
    {
        $this->obj_Design_Controller = new Design_Controller();
    }

    // 웹페이지 기본값 반환 메서드
    public function Default_Value($page_name){

        // 사용자번호 불러오기
        $user_no = session()->get('user_no');

        switch ($page_name){

            //  '동화리스트' 페이지
            case 'StoryList':
                // DB에서 '동화리스트' 페이지 default_value 불러오기
                $value_page = FairyTale::getStoryListWeb();
                break;

            //  '펜토미노 컬렉션' 페이지
            case 'Collection':
                // DB에서 '펜토미노 컬렉션' 페이지 default_value 불러오기
               $value_parameter = Collection::collectionListWeb($user_no);
               $value_page = $this->obj_Design_Controller->img($value_parameter);

                break;

            //  '내정보' 페이지
            case 'MyInfo':
                // DB에서 '내정보' 페이지 default_value 불러오기
                $value_page = UserProfile::myPageUserInfo($user_no);
                break;

            //  '구매동화 리스트' 페이지
            case 'BuyList':
                // DB에서 '구매동화 리스트' 페이지 default_value 불러오기
                $value_page = BuyStory::getBuyList($user_no);
                break;

            //  '친구추가' 페이지
            case 'Friends':
                // DB에서 '친구추가' 페이지 default_value 불러오기
                $value_page = Friend::getFriendList($user_no);
                break;
            case 'Rank':
                // DB에서 '친구추가' 페이지 default_value 불러오기
               $value_page = PentoRecord::recordPentolist($user_no);

                    break;

        }

        // view로 return
        return $value_page;
    }

    // 웹 상세 설명 값 반환 메서드
    public function Detailed_Value($category,$id){
        // 1. $category, $id 값으로 DB에서 조회
        switch ($category){
            // 동화 상세정보 출력
            case 'story':

                $array_result = FairyTale::getStoryInfo($id);
                // DB에서 값불러오기

                // DB값 중복데이터 제거후 새로운배열에 복사
                for($i=0; $i<count($array_result); $i++){

                    foreach ($array_result[$i] as $key => $value){

                        if($key != 'tale_image'){
                            $value_detail[$key] = $array_result[$i]->{$key};
                        }
                        else{
                            $value_detail = array_add($value_detail,$key.''.$i,$value);
                        }
                    }
                }

                break;

            // 도안 상세정보 출력
            case 'collection_default':

                $array_result = PentoDesign::getPentoInfo($id);
                $value_detail = $this->obj_Design_Controller->img($array_result['design_info']);

                break;

            //  '얼마나 걸렸니?'(기록) 페이지
            case 'Rank':
                // DB에서 '얼마나 걸렸니?'(기록) 페이지 value 불러오기
                $array_result = PentoRecord::showRecord(\session()->get('user_no'), $id);

                if($array_result == 'select Fail'){
                    $value_detail = 'false';
                }
                else{
                    $value_detail = $array_result;
                }

                break;
        }

        // 2. view로 return
        return $value_detail;
    }

    public function Load_Unity_Value($value_kinds){
        // Unity 로 단계별,동화,컬렉션 기본정보 및 도안값 전송

        $obj_unity = new Design_Controller();
        // 좌표를 변환하기 위한 클래스객체 생성
        $result_value_unity = array();
        // 유니티로 전송할 최종 데이터를 저장하기위한 배열 생성 ( 도안 좌표값 제외 )

        switch ($value_kinds['category']){

            // 단계별 학습
            case 'step':

                // 넘어오는 unity_value가 default일때
                if($value_kinds['unity_value'] == 'default'){
                    // return 사용자레벨
                    $result_value_unity =  array('user_grade' => session('user_grade'));
                }
                else{
                    //  return 도안좌표
                    $result_value_unity = $obj_unity->change($value_kinds['design_no']);
                }

                break;

            // 스토리 학습
            case 'story':

                // 넘어오는 unity_value가 default일때
                if($value_kinds['unity_value'] == 'default'){
                    // return 모든 동화 정보(동화id,이름,설명), 사용자의 동화 구매정보

                    $result_value_unity = ['story_value' => Model_Fairytale::prtAll(),
                        'buy_list' => Model_Buy::load_buylist(1)];
                    // DB값 불러오기
                }
                else{
                    //  return 도안좌표
                    $result_value_unity =  $obj_unity->change($value_kinds['design_no']);
                }

                // return 동화목록
                break;

            // 컬렉션
            case 'collection':

                // 넘어오는 unity_value가 default일때
                if($value_kinds['unity_value'] == 'default'){
                    // return 모든 컬렉션 정보(동화id,이름,설명)

                    $result_value_unity = ['collection_value' => Model_Collection::prtAll()];
                    // DB값 불러오기
                }
                else{
                    // return 도안좌표
                    $result_value_unity =  $obj_unity->change($value_kinds['design_no']);
                }

                // return 컬렉션 목록
                break;

        }

        return $result_value_unity;
    }

}

