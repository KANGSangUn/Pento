<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageRoute extends Model
{
    protected $table = 'image_routes';

    static public function getImageRoute($where)
    {
        // 인자값에 따라 배열로 경로번호를 저장
        $whereArray = array
        (
            'storyPage'     =>  1,
            'userPage'      =>  2,
            'imitatedPento' =>  3,
            'everyPento'    =>  4
        );

        // 경로번호로 경로명 찾아 반환
        $result             =   ImageRoute::select('route_name')
                                           ->where('route_no',$whereArray[$where])
                                           ->get();

        if($result == "[]")
        {
            echo "Invalid where";
        }
        // 이미지 경로 반환
        return $result[0]->route_name;

    }
    //
}
