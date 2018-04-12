<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class RegisterInfo extends Model
{
    protected $table = 'register_info';
    public $timestamps = false;

    // 존재하지만 등록테이블에서 시리얼번호를 다른 회원이 등록하고 있는 경우 등록 실패
    // 존재하면서 등록이 안되있을 경우 등록 성공
    // 존재하지 않으면 등록실패

    // 시리얼번호 등록 확인, 회원번호 가져오기(유니티)
    static public function insertSerialNum($userNum, $serialNum)
    {
        // 기기번호를 받아오는 메서드 호출
        // 해당 시리얼 번호의 아두이노 번호
        $arduinoNum = ArduinoInfo::getArduinoNum($serialNum);


        // 기기정보 테이블에 존재하는 시리얼번호인지 확인
        // 성공적으로 아두이노 번호가 반환되었을 경우 정수형으로 반환
        // 반환값이 정수형일 경우 실행
       if (is_int($arduinoNum))
                {

                    // 시리얼 번호가 등록되어 있는 사용자 확인
                    if ($arduinoNum !== "[]") {

                        // 등록 테이블에 해당 시리얼번호를 등록한 사용자가 없을 경우 실행
                        // 아두이노 번호, 회원번호, 등록날짜, 최종 수정날짜 등록
                        try
                        {
                            RegisterInfo::insert
                            (
                                [
                                          'arduino_no'      =>  $arduinoNum,
                                          'user_no'         =>  $userNum,
                                          'registered_date' => Carbon::now()->format('Y-m-d H:i:s'),
                                          'updated_date'    => Carbon::now()->format('Y-m-d H:i:s'),
                                ]
                            );

                        }
                        // 시리얼번호 존재할 경우 실행
                        catch (QueryException $e)
                        {
                            $errorCode = $e->errorInfo[1];

                            // 이미 해당 시리얼번호를 등록했을 경우
                            if ($errorCode == 1062)
                            {
                                // 문자열 반환
                                return 'Duplicate Serial Number';
                            }
                        }
                    }
                }
                // 아두이노 번호가 없을 때 문자열 반환
                else return $arduinoNum;

       // 등록 성공
       return true;
            }


      // 유니티에서 시리얼번호를 받아와 회원번호를 전달
    static public function getUserNum($serialNum)
    {
        // 아두이노 테이블에서 아두이노 번호 찾기
        $arduinoNum     =   ArduinoInfo::getArduinoNum($serialNum);

        if (is_int($arduinoNum))
        {
            // 아두이노 번호를 통해 등록테이블의 회원번호를 찾아 전달
            $userNum    =   RegisterInfo::select('user_no')
                                          ->where('arduino_no', $arduinoNum)
                                          ->get();

            // 회원번호 반환
            return $userNum[0]->user_no;

        }
        // 문자열일 경우 문자열 반환
        else
        {
            return $arduinoNum;
        }
    }
}






