<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class ColorInfo extends Model
{
    // color_info 테이블 사용
    protected $table = 'color_info';

    // 색상이름, RGB 가져오기
    static public function getColorRGB()
    {
       // $colorResult = '';

        try
        {
            $colorResult = ColorInfo::select()->get();
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1064)
            {
                return "SQL syntax error";
            }
            else
            {
                return $errorCode;
            }
        }
        return $colorResult;
    }
}
