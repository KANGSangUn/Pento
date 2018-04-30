<?php

use Illuminate\Database\Seeder;

class ImitatedPentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 회원번호
        $userNumArray =
            [
                // 동화를 구매한 회원번호
                1, 1, 1, 2, 4, 5, 7, 8, 10, 11, 15, 15, 19, 23, 36, 40, 52, 72, 98, 99, 100,
                1, 1, 1
            ];

        $designNumArray =
            [
                // 동화 도안번호
                46, 37, 36, 37, 39,
                45, 44, 44, 36, 41,
                42, 40, 43, 36, 38,
                44, 40, 37, 45, 39,
                37, 38, 39, 40
            ]; //24

        $divisionArray =
            // 창작한 작품이면 1, 다른 사람들의 퍼즐을 풀었는 작품은 0
            [
                1, 1, 1, 1, 1,
                1, 1, 1, 1, 1,
                1, 1, 0, 0, 0,
                0, 0, 0, 0, 0,
                0, 0, 0, 0
            ];//26개

        // 블록을 놓은 횟수
        $putNumArray =
            [
                20, 18, 22, 20, 11,
                12, 13, 30, 30, 13,
                15, 16, 17, 22, 10,
                33, 19, 23, 34, 14,
                21, 15, 31, 9,
            ];

        // 클리어 시간
        $clearTimeArray =
            [
                15, 27, 32, 31, 13,
                12, 23, 16, 21, 22,
                30, 11, 8, 18, 25,
                27, 29, 31, 32, 29,
                38, 22, 23, 19
            ];

        for ($i = 0; $i < count($userNumArray); $i++) {

            $result = DB::table('pento_designs')->where('design_no', $designNumArray[$i])->get();
            $date = $result[0]->registered_date;
            $imageName = $result[0]->design_image;

            // 컬렉션 테이블에 회원번호, 도안번호 insert
            DB::table('imitated_pentos')->insert(
                [
                    'user_no' => $userNumArray[$i],
                    'design_no' => $designNumArray[$i],
                    'division_no' => $divisionArray[$i],
                    'put_number' =>$putNumArray[$i],
                    'clear_time' =>"00:".$clearTimeArray[$i].":11",
                    'imitated_image' => $imageName,
                    'registered_date' => $date
                ]
            );

        }
    }
}
