<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArduinoInfo extends Model
{
    protected $table     = 'arduino_info';

    static public function getArduinoNum($serialNum)
    {

        // 해당 시리얼번호의 아두이노 번호 찾기
        $arduinoResult   =        ArduinoInfo::select('arduino_no')
                                             ->where('serial_num', $serialNum)
                                             ->get();

        // 존재하지 않는 시리얼번호일 경우
        if ($arduinoResult == "[]")
        {
            return "not exist serial number";
        }

        // 아두이노 번호 반환
        return $arduinoResult[0]->arduino_no;
    }
}
