<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-08
 * Time: 오후 3:07
 */

namespace App\Http\Controllers;

use App\Model_test;

use Image;

//use Intervention\Image\Image;

class Controller_Collection extends Controller
{

    public function img(){

        $design_date = Model_test::All_design();

        $obj = new Change();

        return $obj->index($design_date);
    }
}

class Change {      // 좌표값을 canvas로 변경하는 클래스

    public $image = array();

    public function index($design_date){
        //  좌표값 -> Canvas

////////////////////////////////////////////////////////////////
///     DB에서 불러온 좌표값을 배열에 다시저장
        $array_result = array();

        $array_count = count($design_date);

        $pre_index = 0;

        for($i=0,$index=0; $i<$array_count; $i++,$index++){

            foreach ($design_date[$i] as $key => $value){

                if($design_date[$i]->design_no != $pre_index){
                    $index = 0;
                }

                if($key != 'coordinater_no'){

                    switch ($key){

                        case 'board_X':
                            $array_result[$design_date[$i]->design_no][$key][$index] = $value;
                            break;

                        case 'board_Y':
                            $array_result[$design_date[$i]->design_no][$key][$index] = $value;
                            break;
                    }

                }
            }
            $pre_index = $design_date[$i]->design_no;    // 이전값을 저장
        }

//////////////////////////////////////////////////////////
///     저장된 배열로 도안생성.

        for($i=0; $i<count($array_result); $i++){
            $this->image[$i] = imagecreatetruecolor(150,150);
            $pink = imagecolorallocate($this->image[$i],255,192,203);
        }

        $key_value = 1;
        $image_num = 0;

        while( $key_value <= count($array_result) ){

            for( $y=0,$count=0; $y<15; $y++ ){

                for( $x=0; $x<15; $x++ ){

                    if( $x == $array_result[$key_value]['board_X'][$count] && $y == $array_result[$key_value]['board_Y'][$count]){

                        imagefilledrectangle($this->image[$image_num],
                            $x*10, $y*10,
                            ($x*10)+10, ($y*10)+10,
                            $pink);

                        if($count < count($array_result[$key_value]['board_X'])-1){
                            $count++;
                        }
                    }
                }
            }

            $image_num++;
            $key_value++;
        }

////////////////////////////////////////////////////////////

        Header('Content-type: image/png');

        $array_file_name = array();     // 파일이름 저장할 변수

        for($i=0; $i<count($this->image); $i++){

            imagejpeg($this->image[$i],$_SERVER['DOCUMENT_ROOT'] . "/photos/fuck".$i.".jpeg");
            // 이미지를 파일로 저장

            $array_file_name[$i] = $_SERVER['DOCUMENT_ROOT'] . "/photos/fuck".$i.".jpeg";
            // 파일이름을 배열에 저장
        }

        return json_encode($array_file_name);
    }
}

