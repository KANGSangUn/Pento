<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class recommendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 회원번호 dummy data
        $userArray =
            [
                90, 2, 3, 4, 52,
                11, 15, 19, 7, 5,
                10, 88, 23, 37, 99,
                76, 36, 98
            ];

        $imitatedNumArray =
            [
                1, 1, 1, 1, 2,
                2, 3, 4, 5, 1,
                3, 4, 4, 3, 2,
                1, 5, 3, 2, 1
            ];
        // 시 배열 -> addHours의 매개변수로 사용하기위해 현재 시에 값만큼 더한 값
        $hourArray =
            [
                1, 2, 3, 4, 5,
                6, 7, 1, 2, 3,
                4, 5, 6, 7, 5,
                5, 5, 3];
        // 분 배열 -> addMinutes 매개변수로 사용하기위해 현재 분에 값만큼 더한 값
        $minuteArray =
            [
                8, 5, 3,
                46, 57, 16, 27, 38,
                58, 50, 46, 17, 25,
                15, 27, 32, 41, 53

            ];


        // $userArray 배열의 길이만큼 반복
        for ($i = 0; $i < count($userArray); $i++) {
            // 추천테이블에 회원번호, 카테고리번호, 게시글 번호 insert

             DB::table('recommends')->insert(
                 [
                     'user_no'               =>  $userArray[$i],
                     'imitated_no'           =>  $imitatedNumArray[$i],
                     'registered_date'            =>  Carbon::now()->addHour($hourArray[$i])->addMinute($minuteArray[$i])->format('Y-m-d H:i:s'),
                 ]

             );
        }

    }
}
