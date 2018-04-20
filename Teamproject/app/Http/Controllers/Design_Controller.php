<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-08
 * Time: 오후 3:07
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 새로추가

use App\Models\PentoDesign;
use Image;

class Design_Controller extends Controller
{
    public $obj;

    public function __construct()
    {
        $this->obj = new Design_Change();
    }

    public function img($parameter){
        // 이미지 생성 메서드

        $array_result = $this->obj->Change_to_array($parameter);
        // 이미지좌표 배열로 변환

        // 이미지,도안번호 반환
        if(!empty($parameter[0]->design_explain)){
            // 컬렉션 상세정보, 이미지 반환

            $array_design_explain = array();
            // 도안 번호를 저장할 배열

            $pre_index_value_design_no = 0;
            // 도안번호 저장배열의 인덱스번호를 비교할 변수

            // 도안정보를 배열에 저장
            for ( $i=0,$index=0; $i<count($parameter); $i++ ){

                foreach ($parameter[$i] as $key => $value){

                    if(($key == 'design_no' && $pre_index_value_design_no != $parameter[$i]->design_no) ||
                        $key == 'design_title' || $key == 'design_explain' || $key == 'user_nickname' || $key == 'level_of_difficultly'){

                        switch ($key){
                            case 'design_no':
                                $array_design_explain[$key] = $parameter[$i]->design_no;
                                // 새로운 배열에 디자인넘버 복사
                                break;
                            case 'design_title':
                                $array_design_explain[$key] = $parameter[$i]->design_title;
                                break;
                            case 'design_explain':
                                $array_design_explain[$key] = $parameter[$i]->design_explain;
                                break;
                            case 'user_nickname':
                                $array_design_explain[$key] = $parameter[$i]->user_nickname;
                                break;
                            case 'level_of_difficultly':
                                $array_design_explain[$key] = $parameter[$i]->level_of_difficultly;
                                break;
                        }

                        $pre_index_value_design_no = $parameter[$i]->design_no;
                        // 이전 인덱스값과 현재 값을 비교

                        $index++;
                        // 인덱스넘버 1증가시키기
                    }
                }
            }

            return $this->obj->Change_to_image($array_result,$array_design_explain);
        }
        else{

            $array_design_no = array();
            // 도안 번호를 저장할 배열

            $pre_index_value_design_no = 0;
            // 도안번호 저장배열의 인덱스번호를 비교할 변수

            // 도안번호 저장배열에 값저장
            for ( $i=0,$index=0; $i<count($parameter); $i++ ){

                foreach ($parameter[$i] as $key => $value){
                    if($key == 'design_no' && $pre_index_value_design_no != $parameter[$i]->design_no){

                        $array_design_no[$index] = $parameter[$i]->design_no;
                        // 새로운 배열에 디자인넘버 복사

                        $pre_index_value_design_no = $parameter[$i]->design_no;
                        // 이전 인덱스값과 현재 값을 비교

                        $index++;
                        // 인덱스넘버 1증가시키기
                    }
                }
            }

            // 이미지만 반환

            return $this->obj->Change_to_image($array_result,$array_design_no);

        }

    }

    public function change($design_no){
        // 좌표값 반환 메서드
        // 인자값 : 도안번호

        $array_db = PentoDesign::getPentoCoordinate($design_no);
        // DB에서 좌표값 불러오기

        // DB좌표를 변환하여 unity로 반환
        $result_array = $this->obj->Change_to_Unity($array_db);

        return $result_array;
    }

    public function Save($category,$value_result){
        // 도안 저장 메서드

        // 좌표값 중복검사를 위한 배열로 변환
        $check_duplication = $this->obj->Change_to_duplication($value_result['design_location']);


        // 중복검사후 중복값이 없으면 저장
        if(empty($check_result)){

            switch ($category){

                case 'step':
                    // 단계별모드

                    $array_to_db =  $this->obj->Change_to_DB($value_result['design_no'],$value_result['design_location']);
                    // 저장할 Unity 값을 DB배열로 변환

                    return ;
                    // 도안이미지 생성, DB에 저장

                    break;

                case 'free':
                    // 자유모드

                    $array_to_db =  $this->obj->Change_to_DB($value_result['design_no'],$value_result['design_location']);
                    // 저장할 Unity 값을 DB배열로 변환

                    return ;
                    // 도안이미지 생성, DB에 저장

                    break;

                case 'collection':
                    // 컬렉션 모드

                    $array_to_db =  $this->obj->Change_to_DB($value_result['design_no'],$value_result['design_location']);
                    // 저장할 Unity 값을 DB배열로 변환

                    return ;
                    // 도안이미지 생성, DB에 저장

                    break;

            }
        }
    }
}

////////////////////////////////////////////////////////////////////////
///
class Design_Change {

    public $image = array();
    // 반환할 이미지 배열

    public function Change_to_array($array_db){
        // DB 좌표 -> img 좌표

        $array_result = array();

        $array_count = count($array_db);

        $pre_index = 0;

        for($i=0,$index=0; $i<$array_count; $i++,$index++){

            foreach ($array_db[$i] as $key => $value){

                if($array_db[$i]->design_no != $pre_index){
                    $index = 0;
                }

                if($key != 'coordinate_no' && $key != 'registered_date'){

                    switch ($key){

                        case 'board_X':
                            $array_result[$array_db[$i]->design_no][$key][$index] = $value;
                            break;

                        case 'board_Y':
                            $array_result[$array_db[$i]->design_no][$key][$index] = $value;
                            break;

                        case 'design_title':
                            $array_result[$array_db[$i]->design_no][$key][$index] = $value;
                            break;

                        case 'user_id':
                            $array_result[$array_db[$i]->design_no][$key][$index] = $value;
                            break;
                    }

                }
            }

            $pre_index = $array_db[$i]->design_no;    // 이전값을 저장
        }

        return $array_result;
    }

//////////////////////////////////////////////////////////////////////
///
    public function Change_to_image($array_result,$array_design_explain){
        // 도안생성 메서드

        for($i=0; $i<count($array_result); $i++){

            $this->image[$i] = imagecreatetruecolor(300,300);
            $background = imagecolorallocate($this->image[$i],254,251,239);
            imagefill($this->image[$i],0,0,$background);

            for($j=10*2; $j<=300; $j+=20){
                $white = imagecolorallocate($this->image[$i],255,255,255);
                imageline($this->image[$i],$j,0,$j,300,$white);
                imageline($this->image[$i],0,$j,300,$j,$white);
            }
        }

        // 랜덤으로 부여할 블록 색상 지정
        $color_ran = array(
            0 => [254,115,114],
            1 => [254,200,85],
            2 => [71,183,223],
            3 => [115,214,24],
            4 => [253,199,200]  );


        if(!empty($array_design_explain['design_explain']) || !empty($array_design_explain['user_no'])
            || count($array_result) == 1){

            if( !empty($array_design_explain['design_no'])){
                $key_value = $array_design_explain['design_no'];
            }
            else{
                $key_value = $array_design_explain[0];
            }

            $first_key_value = key($array_result);

        }
        else{

            $key_value = 1;

            $first_key_value = 1;
        }

        // 도안번호 저장
        // 첫번째 배열의 키값 불러오기
        $image_num = 0;
        // 이미지 인덱스값

        while( $key_value == $first_key_value || $key_value <= count($array_result) ){

            for( $x=0,$count=0; $x<15; $x++ ){

                for( $y=0; $y<15; $y++ ){
                    if( $y == $array_result[$key_value]['board_Y'][$count] && $x == $array_result[$key_value]['board_X'][$count]){


                        $random = rand(0,count($color_ran)-1);

                        $color_cube = imagecolorallocate(
                            $this->image[$image_num],$color_ran[$random][0],$color_ran[$random][1],$color_ran[$random][2]);

                        imagefilledrectangle($this->image[$image_num],
                            $x*20, $y*20,
                            ($x*20)+20, ($y*20)+20,
                            $color_cube
                        );

                        if($count < count($array_result[$key_value]['board_Y'])-1){
                            $count++;
                        }
                    }
                }
            } //색 삽입 반복문

            $image_num++;
            $key_value++;
        }
////////////////////////////////////////////////////////////

        Header('Content-type: image/png');

        $array_image = array();     // 파일이름 저장할 변수

        for($i=0; $i<count($this->image); $i++){

            // 이미지를 파일로 저장
            if(!empty($array_design_explain['design_explain'])){
                // 특정 이미지 하나만 저장
                foreach ($array_design_explain as $key => $value){
                    $array_image[$i][$key] = $array_design_explain[$key];
                }
            }
            else{
                // 모든 이미지 저장
                    $array_image[$i]['design_no'] = $array_design_explain[$i];
            }
	
            if(count($this->image) != 1 ){

                imagepng($this->image[($array_image[$i]['design_no']-1)],$_SERVER['DOCUMENT_ROOT'] . "/images/collection/pentoimg".($array_image[$i]['design_no']-1).".png");

                    $array_image[($array_image[$i]['design_no']-1)]['file_name'] = "http://localhost:8000" . "/images/collection/pentoimg".($array_image[$i]['design_no']-1).".png";
            }
            else{
               imagepng($this->image[$i],$_SERVER['DOCUMENT_ROOT'] . "/images/collection/pentoimg".$i.".png");

                    $array_image[$i]['file_name'] = "http://localhost:8000" . "/images/collection/pentoimg".($array_image[$i]['design_no']-1).".png";
            }

            // 파일이름을 배열에 저장
        }

        return $array_image;
    }

//////////////////////////////////////////////////////////////////
///
    public function Change_to_Unity($array_db){
        // DB 좌표 -> Unity 좌표

        $array_result = array();    // 변환된 좌표를 저장할 배열

        $index = 0; // array_db 의 인덱스를 사용하기위한 함수

        for($x=0; $x<15; $x++){
            // Unity, Y좌표

            for($y=0; $y<15; $y++){
                // Unity, X좌표

                if($array_db[$index]->board_Y == $y && $array_db[$index]->board_X == $x){

                    $array_result[$x][$y] = 1;

                    if($index < count($array_db)-1){
                        $index++;
                    }
                }
                else{
                    $array_result[$x][$y] = 0;
                }
            }
        }

        return $this->Change_to_duplication($array_result);
        // Unity로 배열 반환
    }
//////////////////////////////////////////////////////////////////////
///
    public function Change_to_DB($design_no,$array_unity){
        // Unity 좌표 -> DB 좌표

        $array_result = array();    // 변환된 좌표를 저장할 배열

        $index = 0; // array_db 의 인덱스를 사용하기위한 함수

        for($y=0; $y<15; $y++){
            // Unity, Y좌표

            for($x=0; $x<15; $x++){
                // Unity, X좌표

                if($array_unity[$y][$x] == 1){
                    $array_result[$index]['design_no']    = $design_no;
                    $array_result[$index]['board_X']    = $x;
                    $array_result[$index]['board_Y']    = $y;
                    $index++;
                }
            }

        }

        return $array_result;
    }
///////////////////////////////////////////////////////////////////////
///
    public function Change_to_duplication($array_unity){
        // 중복값 검사 메서드

        $array_result = '';    // 변환된 좌표를 저장할 배열

        for($x=0; $x<15; $x++){
            // Unity, Y좌표

            for($y=0; $y<15; $y++){
                // Unity, X좌표

                $array_result .= $array_unity[$y][$x];
                // Unity 배열 -> 중복검사 문자열

            }
        }
        return $array_result;
    }

}
