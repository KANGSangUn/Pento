<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-13
 * Time: 오후 10:48
 */

namespace App\Http\Controllers;

use App\Model_Userinfo;
use App\Model_Fairytale;

class Page extends Controller
{
    // 페이지 기본값 반환 메서드
    public function Default_Value($page_name){

        // 사용자번호 불러오기
        //$user_id = session()->get('user_id');

        switch ($page_name){

            //  '동화리스트' 페이지
            case 'StoryList':
                // DB에서 '동화리스트' 페이지 default_value 불러오기
                $value_page = Model_Fairytale::prtAll();
                break;

            //  '펜토미노 컬렉션' 페이지
            case 'Collection':
                // DB에서 '펜토미노 컬렉션' 페이지 default_value 불러오기
                $value_page = Model_Fairytale::all();
                break;

            //  '얼마나 걸렸니?'(기록) 페이지
            case 'Rank':
                // DB에서 '얼마나 걸렸니?'(기록) 페이지 default_value 불러오기
                $value_page = Model_Fairytale::all();
                break;

            //  '내정보' 페이지
            case 'MyInfo':
                // DB에서 '내정보' 페이지 default_value 불러오기
                $value_page = Model_Userinfo::Check_Userinfo($user_id);
                break;

            //  '친구추가' 페이지
            case 'AddFriends':
                // DB에서 '친구추가' 페이지 default_value 불러오기
                $value_page = Model_Fairytale::all();
                break;
        }

        // view로 return
        return $value_page;
    }

    // 상세 설명 값 반환 메서드
    public function Detailed_Value($category,$id){
        // 1. $category, $id 값으로 DB에서 조회
        switch ($category){
            // 동화 상세정보 출력
            case 'story':
                $value_detail = Model_Fairytale::prtStoryInfo($id);
                break;

            // 도안 상세정보 출력
            case 'collection_default':
                $value_detail = Model_Fairytale::prtStoryInfo($id);
                break;

            // 작품 상세정보 출력
            case 'collection_custom':
                $value_detail = Model_Fairytale::prtStoryInfo($id);
                break;
        }

        // 2. view로 return
        return $value_detail;
    }
}

