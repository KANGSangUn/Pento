<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-04-23
 * Time: 오전 10:46
 */

namespace App\Http\Controllers;


use App\Models\Buylist;
use App\Models\BuyStory;
use App\Models\Collection;
use App\Models\FairyTale;
use App\Models\Follow;
use App\Models\Friend;
use App\Models\ImitatedPento;
use App\Models\PentoDesign;
use App\Models\PentoRecord;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class Web_DefaultValue extends Controller
{

    // 동화리스트 초기값 불러오기
    public function StoryList(){

        // DB에서 데이터 가져오기
        $this->return_value = FairyTale::getStoryListWeb ();

        // View로 반환
        return $this->return_value;
    }

    // 구매리스트 불러오기
    public function BuyList(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = Buylist::getBuyList($request->input('user_no'));

        // View로 반환
        return $this->return_value;
    }


    // 나만의 컬렉션 초기값 불러오기, 인자값 : 유저 번호
    public function MyCollection(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = Collection::getCollectionListWeb($request->input('user_no'));

        // View로 반환
        return $this->return_value;
    }


    // 모두의 컬렉션 초기값 불러오기
    public function EveryCollection(){

        // DB에서 데이터 가져오기
        $this->return_value = PentoDesign::getPentoListWeb();

        // View로 반환
        return $this->return_value;

    }

    // 내정보 초기값 불러오기, 인자값 : 유저 번호
    public function MyPage(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = UserProfile::myPageUserInfo($request->input('user_no'));

        // View로 반환
        return $this->return_value;
    }


    // 친구페이지 초기값 불러오기, 인자값 : 유저 번호
    public function Friends(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = Follow::getFollowList($request->input('user_no'));

        // View로 반환
        
        return $this->return_value;
    }

    // 랭크 초기값 불러오기, 인자값 : 유저 번호
    public function Rank(Request $request){

        // DB에서 데이터 가져오기
        $this->return_value = ImitatedPento::getImitatedPentoList ($request->input('user_no'));

        // View로 반환

        return $this->return_value;
    }

}