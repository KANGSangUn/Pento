<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-04-14
 * Time: 오후 1:42
 */

namespace App\Http\Controllers;

use App\Models\FairyTale;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\LevelReward;
use App\Models\RegisterInfo;

// Unity 와 DB의 통신모듈
class Load_Unity
{
    private $obj_Design_Controller;

/* 데이터 가져오기 부분 */
    public function __construct()
    {
        $this->obj_Design_Controller = new Design_Controller();
    }

    // 유저 번호 가져오기
    public function GetUserNum(Request $request){

        $result_value_unity =  RegisterInfo::getUserNum($request->input('serial_no'));

        return $result_value_unity;
    }

    // 좌표 가져오기
    public function GetCoordinate(Request $request){

        $result_value_unity = $this->obj_Design_Controller->change($request->get('design_no'));

        return $result_value_unity;
    }

    // 동화 리스트 가져오기
    public function GetStoryInfo(Request $request){
        if($request->has('user_no')){
            $result_value_unity = FairyTale::getStoryListUnity($request->get('user_no'));
        }
	else{
	    $result_value_unity = FairyTale::getStoryListWeb();		
	}

        return $result_value_unity;
    }

    // 컬렉션 리스트 가져오기
    public function GetCollectionInfo(Request $request){

        $value_Info = Collection::collectionListUnity_Info($request->get('user_no'));

        $strResult = '';

        $value_Coordinate = Collection::collectionListUnity_Coordinate($request->get('user_no'));

        $value_img = $this->obj_Design_Controller->img($value_Coordinate);

        //return var_dump($value_img);
        foreach ($value_Info as $key1=>$value1)
        {
            foreach ($value1 as $key2=>$value2)
            {
                if ($key2 == "design_no"){
                    $strResult .= $value2.',';

                    foreach ($value_img as $key3 => $value3){
                        if($value3["design_no"] == $value2){
                            $strResult .= $value3["file_name"] .',';
                        }
                    }
                }
                else if($key2 == "design_title"){
                    $strResult .= $value2.',';
                }
                else if($key2 == "user_nickname"){
                    $strResult .= $value2;
                }

            }
                $strResult .= '*';
        }

        return substr($strResult,0,-1);
    }

    // 단계별 리스트 가져오기
    public function GetLevelInfo(Request $request){

        $value_Info = LevelReward::getLevelDesign_Info($request->get('level'));

        $strResult = '';

        $value_Coordinate = LevelReward::getLevelDesign_Coordinate($request->get('level'));

        $value_img = $this->obj_Design_Controller->img($value_Coordinate);

        //return var_dump($value_img);
        foreach ($value_Info as $key1=>$value1)
        {
            foreach ($value1 as $key2=>$value2)
            {
                if ($key2 == "design_no"){
                    $strResult .= $value2.',';

                    foreach ($value_img as $key3 => $value3){
                        if($value3["design_no"] == $value2){
                            $strResult .= $value3["file_name"] .',';
                        }
                    }
                }
                else if($key2 == "design_title"){
                    $strResult .= $value2;
                }
            }
            $strResult .= '*';
        }

        return substr($strResult,0,-1);
    }

    // 유저 레벨 가져오기
    public function GetUserLevel(Request $request){

        $result_value_unity =  LevelReward::getUserLevel($request->get('user_no'));

        $result_value_unity = $result_value_unity[0]->user_grade;

        return $result_value_unity;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////
/* DB 저장 부분 */

}
