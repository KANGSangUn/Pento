<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaleDesign extends Model
{
    protected $table = 'tale_designs';


    // 동화의 도안번호 가져오기
    static public function getStoryDesignNum($taleNum)
    {

        // 동화 도안번호를 담을 배열
        $taleNumResult          =    array();


        $taleNumObject          =    TaleDesign::select('design_no')
                                    ->where('fairy_tale_no', $taleNum)
                                    ->get();

        // 빈 객체일 경우 select fail -> 해당 동화의 도안번호가 없음
        if($taleNumObject == "[]")
        {
            return "select fail!";
        }

        for($i = 0 ; $i < count($taleNumObject) ; $i++)
        {
            $taleNumResult[$i]  =   $taleNumObject[$i]->design_no;

        }

        // 동화의 도안번호 반환
        return $taleNumResult;

    }

}
