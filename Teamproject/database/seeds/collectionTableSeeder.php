<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 회원테이블 전체 레코드값 가져오기

        $userNumArray =
            [
                // 동화를 구매한 회원번호
                1, 1, 1, 2, 4, 5, 7, 8, 10, 11, 15, 15, 19, 23, 36, 40, 52, 72, 98, 99, 100,
                1, 1, 1
            ];

        $designNumArray =
            [

                // 동화 도안번호
                46, 37, 36, 37, 39, 45, 44, 44, 36, 41, 42, 40, 43, 36, 38, 44, 40, 37, 45, 39, 37,
                38, 39, 40
            ];


        for ($i = 0; $i < count($userNumArray); $i++) {

            $result = DB::table('pento_designs')->where('design_no', $designNumArray[$i])->get();
            $date = $result[0]->registered_date;

            // 컬렉션 테이블에 회원번호, 도안번호 insert
            DB::table('collections')->insert(
                [
                    'user_no' => $userNumArray[$i],
                    'design_no' => $designNumArray[$i],
                    'registered_date' => $date
                ]
            );

        }
    }
}
