<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class buyListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  fairy_tale_no, user_no


        // 회원번호 dummy data
        $userNumArray = [
                12, 2, 3, 4, 52,
                11, 15, 19, 7, 5,
                10, 100, 23, 72, 99,
                15, 36, 98, 40, 8
        ];

        // 동화 dummy data
        $taleNumArray = [
                1, 2, 3, 4, 5,
                6, 7, 8, 9, 10,
                1, 2, 1, 2, 4,
                5, 3, 10, 9, 9
        ];

        // 시 배열 -> addHours의 매개변수로 사용하기위해 현재 시에 값만큼 더한 값
        $hourArray =
            [
                1, 2, 3, 4, 5,
                6, 7, 1, 2, 3,
                4, 5, 6, 7, 5,
                5, 5, 3, -3, -7];
        // 분 배열 -> addMinutes 매개변수로 사용하기위해 현재 분에 값만큼 더한 값
        $minuteArray =
            [
                8, 5, 3,-3, -7,
                46, 57, 16, 27, 38,
                58, 50, 46, 17, 25,
                15, 27, 32, 41, 53

            ];

        // $userNumArray 배열의 길이만큼 반복
        for ($i = 0; $i < count($userNumArray); $i++) {

            // 구매목록 테이블에 동화번호와 회원번호 insert
            DB::table('buyLists')->insert(
                [
                    'user_no'             =>    $userNumArray[$i],
                    'fairy_tale_no'       =>    $taleNumArray[$i],
                    'registered_date'          =>    Carbon::now()->addHours($hourArray[$i])->addMinutes($minuteArray[$i])->format('Y-m-d H:i:s'),
                ]
            );

        }
    }
}
