<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class collectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 회원테이블 전체 레코드값 가져오기

        $designNumArray =
            [
                1, 2, 3, 4, 5,
                1, 2, 1, 2, 3,
                4, 5, 1, 2, 3
                , 4, 5, 1, 2, 1
            ];
        $userNumArray =
            [
                1, 1, 1, 1, 1,
                2, 2, 3, 4, 2,
                10, 10, 10, 10, 10,
                11, 8, 90, 52, 30
            ];

        for ($i = 0; $i < 20; $i++) {

            /*  $randValue[$i] = random_int(1, 5);

              // 랜덤값이 중복일 때 다시 랜덤
              for ($j = 0; $j < $i; $j++) {
                  if ($randValue[$i] == $randValue[$j]) {
                      $randValue[$i] = random_int(1, 5);
                  }
              }*/
            // 컬렉션 테이블에 회원번호, 도안번호 insert
            DB::table('collections')->insert(
                [
                    'user_no' => $userNumArray[$i],
                    'design_no' => $designNumArray[$i],
                    'registered_date' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );

        }
    }
}
