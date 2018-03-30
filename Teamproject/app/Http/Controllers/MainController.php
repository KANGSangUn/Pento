<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model_Userinfo;
use Illuminate\Routing\Controller as BaseController;


class MainController extends BaseController
{
    // 각 컨트롤러 객체 저장
    public $obj_Page;               // Page 클래스 객체
    public $obj_Contents;           // Contents 클래스 객체
    public $obj_Friends;            // Friends 클래스 객체

    //  각 컨트롤러 객체생성 및 세션저장
    public function __construct()
    {
       $this->obj_Page = new Page();
       $this->obj_Contents = new Contents();
       $this->obj_Friends = new Friends();

       $this->Save_Session();
    }

    //  회원정보 세션에 저장
    public function Save_Session(){

        $userinfo = Model_Userinfo::Check_Userinfo('aa');

        // userinfo_TB 에서 data check
        if(empty($userinfo)){
            return '존재하지 않는 아이디입니다.';
        }
        else{
            foreach ( $userinfo[0] as $key => $value){
                session()->put( [$key => $value] );
            }
        }
    }


    //  인자값에 해당하는 컨트롤러 호출
    public function Load_Controller(Request $request){

        switch ($request->input('kinds')){

            case 'Page':            // 호출할 클래스가 Page 일때

                // Page 클래스의 상세설명을 호출
                if($request->has('detailed_value')){
                    return $this->obj_Page->Detailed_Value($request->input('category'),
                        $request->input('detailed_value'));

                }

                // Page 클래스의 기본값 호출
                return $this->obj_Page->Default_Value($request->input('page_name'));


                break;

            case 'Contents':        // 호출할 클래스가 Contents 일때

                switch ($request->input('method_id')){

                    // Contents 클래스의 검색 메서드 호출
                    case 'Search':
                        return $this->obj_Contents
                            ->Search_colletion($request->input('collection_name'));
                        break;

                    // Contents 클래스의 구독하기(도안,작품) 메서드 호출
                    case 'Subscribe':
                        return $this->obj_Contents
                            ->Buy_Contents($request->input('category'),$request->input('detailed_value'),$request->input('method_id'));
                        break;

                    // Contents 클래스의 구매하기(동화) 메서드 호출
                    case 'Buy':
                        return $this->obj_Contents
                            ->Buy_Contents($request->input('category'),$request->input('detailed_value'),$request->input('method_id'));
                        break;

                    // Contents 클래스의 장바구니 메서드 호출
                    case 'Bucket':
                        return $this->obj_Contents
                            ->Buy_Contents($request->input('category'),$request->input('detailed_value'),$request->input('method_id'));
                         break;

                    // Contents 클래스의 추천 메서드 호출
                    case 'Recommend':
                        return $this->obj_Contents->Recommend_Contents(
                            $request->input('category'),$request->input('detailed_value'));
                        break;
                }   //  end switch
                break;

            case 'Friends':         // 호출할 클래스가 Friends 일때

                switch ($request->input('method_id')){

                    // 검색 메서드 호출
                    case 'Search':
                        return $this->obj_Friends
                            ->Search_Friends($request->input('friends_name'));
                        break;

                    // 친구추가 메서드 호출
                    case 'Add_Friends':
                        return $this->obj_Friends->Add_Friends(
                            $request->input('friends_no'));
                        break;

                    // 친구삭제 메서드 호출
                    case 'Delete_Friends':
                        return $this->obj_Friends->Delete_Friends(
                            $request->input('friends_no'));
                        break;
                }

                break;
        }   //  end switch
    }
}
