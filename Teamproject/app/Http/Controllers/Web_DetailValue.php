<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-04-23
 * Time: 오전 10:51
 */

namespace App\Http\Controllers;

use App\Models\FairyTale;
use App\Models\ImitatedPento;
use App\Models\PentoDesign;
use Illuminate\Http\Request;

class Web_DetailValue extends Controller
{
    // 동화 상세정보 불러오기, 인자값 : 동화 번호
    public function StoryValue(Request $request){

        // DB에서 데이터 가져오기
        $result_query = FairyTale::getStoryInfo($request->input('story_no'));

        // 데이터 가공
        foreach ($result_query as $key => $value){

            // 동화 번호 저장
            $this->return_value['fairy_tale_no'] = $value->fairy_tale_no;
            // 동화 제목 저장
            $this->return_value['title'] = $value->tale_title;
            // 동화 이미지명 저장
            $this->return_value['tale_image'.$key] = $value->tale_image;
            // 동화 설명 저장
            $this->return_value['tale_explain'] = $value->tale_explain;
            // 동화 가격 저장
            $this->return_value['tale_price'] = $value->tale_price;
        }

        // View로 반환
        return $this->return_value;
    }

    // 도안 상세정보 불러오기, 인자값 : 도안 번호
    public function CollectionValue(Request $request){

//        return $request->input('design_no');
        // DB에서 데이터 가져오기
        $this->return_value = PentoDesign::getPentoInfo($request->input('design_no'));

        // View로 반환
        return $this->return_value;
    }

    // 랭크(유저검색), 인자값 : 유저 ID
    public function RankSearchValue(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = ImitatedPento::findImitatedPentoList($request->input('user_no'),
                                                                $request->input('pento_title'));

        // View로 반환
        return $this->return_value;
    }

    // 랭크페이지 해당회원 기록을 반환
    public function RankRecordValue(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = ImitatedPento::getRecordList($request->input('user_no'),
                                                            $request->input('design_no'));

        // View로 반환
        return $this->return_value;
    }

}