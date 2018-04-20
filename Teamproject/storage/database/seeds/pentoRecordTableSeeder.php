<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class pentoRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 현재시간 가져오는 함수
        $dt = Carbon::now();

        // 회원번호 dummy data
        $userNumArray = [1, 1, 3, 4, 1, 11, 15, 19, 7, 5, 1, 1, 23, 50, 99, 1, 46, 1, 1, 2];
        // 도안번호 dummy data
        $designNumArray = [1, 3, 4, 2, 1, 3, 5, 4, 4, 5, 1, 2, 2, 3, 5, 1, 2, 1, 3, 1];

        // 시 배열 -> addHours의 매개변수로 사용하기위해 현재 시에 값만큼 더한 값
        $hourArray = [1, 2, 3, 4, 5, 6, 7, 1, 2, 3, 4, 5, 6, 7, 5, 5, 5, 3, 2,1];
        // 분 배열 -> addMinutes 매개변수로 사용하기위해 현재 분에 값만큼 더한 값
        $minuteArray = [15, 27, 32, 31, 13, 12, 27, 16, 27, 18, 28, 10, 26, 17, 25, 8, 5, 3, 3, 11];

        // $userNumArray 배열의 길이만큼 반복
        for ($i = 0; $i < count($userNumArray); $i++) {

            // 기록테이블에 회원번호, 도안번호, 클리어시간 insert
            DB::table('pento_records')->insert(
                [
                    'user_no' => $userNumArray[$i],
                    'design_no' => $designNumArray[$i],
                    'cleartime' => "00:".$minuteArray[$i].":11",
                    'register_date' => Carbon::now()->addHour(-($hourArray[$i]))->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
