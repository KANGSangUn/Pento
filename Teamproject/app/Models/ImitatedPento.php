<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImitatedPento extends Model
{
    protected $table = 'imitated_pentos';



    // 추천수가 많은 순서대로 작품 리스트 반환
    static public function prtImitatedPentoList($designNum)
    {
        // 펜토미노 이미지가 저장된 경로 select 메서드 호출
        $routeName           =    ImageRoute::getImageRoute('pentoImg');

        // 작품번호, 작품제목, 작성자 닉네임, 추천수 반환
        $imitatedResult      =    DB::table('imitated_pentos as ip')
                                    ->join('pento_designs as pd', 'pd.design_no', '=', 'ip.design_no')
                                    ->leftJoin('recommends as rm', 'rm.imitated_no', '=', 'ip.imitated_no')
                                    ->join('user_profiles as up','ip.user_no', '=', 'up.user_no')
                                    ->select
                                    (
                                        'ip.imitated_no',
                                        'pd.design_title',
                                        'up.user_nickname',
                                        DB::raw('concat ("' . $routeName .'", ip.imitated_photo) as imitated_photo'),
                                        DB::raw('count(rm.imitated_no) as reNum')
                                    )
                                    ->where('ip.design_no', $designNum)
                                    ->groupBy('ip.imitated_no')
                                    ->get();

        return $imitatedResult;
    }


}
