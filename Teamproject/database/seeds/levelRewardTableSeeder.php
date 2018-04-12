<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class levelRewardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 시 배열 -> addHours의 매개변수로 사용하기위해 현재 시에 값만큼 더한 값
        $hourArray =
            [
                4, 5, 6, 7, 5,
                6, 7, 1, 2, 3,
                5, 5, 3,
                1, 2, 3, 4, 5];


        // $designArray 배열 길이만큼 반복
        for ($i = 0; $i < 5; $i++) {


            // 레벨별 보상 테이블에 도안번호, 단계, 보상 포인트 insert
            DB::table('level_rewards')->insert(
                [
                    'design_no' => $i + 1,
                    'level_of_difficultly' => $i + 1,
                    'reward_point' => ($i + 1) * 1000,
                    'registered_date' => Carbon::now()->addHour($hourArray[$i])->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
