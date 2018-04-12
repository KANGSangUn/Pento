<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller_Collection;
use Illuminate\Support\Facades\Session;

class Main_Controller extends BaseController
{
    // 각 컨트롤러 객체 저장
    public $obj_Design_Controller;
    public $obj_Load_value;         // Load_value 클래스 객체
    public $obj_Contents;           // Contents 클래스 객체
    public $obj_Friends;            // Friends 클래스 객체

    //  각 컨트롤러 객체생성 및 세션저장
    public function __construct()
    {
       $this->obj_Design_Controller = new Design_Controller();
       $this->obj_Load_value = new Load_value();
       $this->obj_Contents = new Contents();
       $this->obj_Friends = new Friends();
    }

    //  인자값에 해당하는 컨트롤러 호출
    public function Load_Controller_Web(Request $request){

        switch ($request->input('kinds')){

            case 'Login':
                // 사용자가 입력한 id,pw가 유효한지 체크
                $login_value = UserInfo::loginCheck($request->input('user_id'),$request->input('user_pw'));

                if($login_value == 'Invalid id' || $login_value == 'Invalid password'){
                    // id가 없을경우
                    $return_value = 'false';
                }
                else{
                    // 모든조건 충족시 회원정보 세션에 저장
                    foreach ($login_value[0] as $key => $value){
                        $request->session()->put('user_grade',$login_value[0]->user_grade);
                        $request->session()->put('user_nickname',$login_value[0]->user_nickname);
                        $request->session()->put('user_no',$login_value[0]->user_no);
                        $request->session()->put('image',$login_value[0]->image);
                        $request->session()->put('user_point',$login_value[0]->user_point);
                    }
                    $return_value =session()->all();
                }
                    return $return_value;
                break;

            case 'Logout':
                // 로그아웃

                Session::flush();   // 세션의 모든값 삭제

                return redirect('/');   // 메인페이지로 이동
                break;

            case 'Page':            // 호출할 클래스가 Page 일때

                // Page 클래스의 상세설명을 호출
                if($request->has('detailed_value')){
                    $return_value = $this->obj_Load_value->Detailed_Value(
                        $request->input('category'),
                        $request->input('detailed_value'));
                }
                else{
                    // Page 클래스의 기본값 호출
                    $return_value = $this->obj_Load_value->Default_Value(
                        $request->input('page_name'));
                }

                break;

            case 'Contents':        // 호출할 클래스가 Contents 일때

                switch ($request->input('method_id')){

                    // Contents 클래스의 검색 메서드 호출
                    case 'Search':
                        $return_value = $this->obj_Contents
                            ->Search_colletion($request->input('collection_name'));
                        break;

                    // Contents 클래스의 구독하기(도안,작품) 메서드 호출
                    case 'Subscribe':
                        $return_value = $this->obj_Contents
                            ->Buy_Contents($request->input('category'),
                                $request->input('detailed_value'),
                                $request->input('method_id'));
                        break;

                    // Contents 클래스의 구매하기(동화) 메서드 호출
                    case 'Buy':
                        $return_value = $this->obj_Contents
                            ->Buy_Contents(
                                $request->input('category'),
                                $request->input('detailed_value'),
                                $request->input('method_id'));
                        break;

                    // Contents 클래스의 추천 메서드 호출
                    case 'Recommend':
                        $return_value = $this->obj_Contents->Recommend_Contents(
                            $request->input('detailed_value'));
                        break;
                }   //  end switch

                break;

            case 'Friends':         // 호출할 클래스가 Friends 일때

                switch ($request->input('method_id')){

                    // 검색 메서드 호출
                    case 'Search':
                        $return_value = $this->obj_Friends
                            ->Search_Friends($request->input('friends_name'));
                        break;

                    // 친구추가 메서드 호출
                    case 'Add_Friends':
                        $return_value = $this->obj_Friends->Add_Friends(
                            $request->input('friends_no'));
                        break;

                    // 친구삭제 메서드 호출
                    case 'Delete_Friends':
                        $return_value = $this->obj_Friends->Delete_Friends(
                            $request->input('friends_no'));
                        break;
                }

                break;
        }   //  end switch
        return $return_value;
    }

    public function Load_Controller_Unity(Request $request){
        // Unity 컨트롤러

        switch ($request->input('unity_method_id')){

            case 'Load_value':
                // 단계별,컬렉션,동화 데이터 가져오기

                $value_kinds = array('category' => $request->input('category'),
                    'unity_value' => $request->input('unity_value'));

                // 넘어온 키값중 도안번호가 있을때
                if($request->has('design_no')){
                    $value_kinds = array_add(
                        $value_kinds, 'design_no',
                        $request->input('design_no'));
                }

                return $this->obj_Load_value->Load_Unity_Value($value_kinds);

                break;

            case 'Save':
                // 저장하기

                $value_result = array('design_no' => $request->input('design_no'),
                    'clear_time' => $request->input('clear_time'),
                    'user_no' => session('user_no')
                    ,'design_location' => $request->input('design_location')
                );

                // 넘어온 키값중 도안제목이 있을때
                if($request->has('design_title') && $request->has('design_explanation')){
                    $value_result = array_add(
                        $value_result,
                        'design_title',
                        $request->input('design_title'));
                    $value_result = array_add(
                        $value_result,
                        'design_explanation',
                        $request->input('design_explanation'));
                }

                return $this->obj_Design_Controller->Save($request->input('category'),$value_result);

                break;
        }
    }

}
