<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class FollowListTableSeeder extends Seeder
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
                8, 2, 3, 4, 52,
                11, 15, 19, 7, 5,
                10, 40, 23, 100, 99,
                19, 36, 68
            ];
        $user_no =
            [
                1, 1, 1, 2, 3,
                4, 5, 77, 32, 92,
                1, 1, 2, 4, 10,
                99, 42, 23];


        // $userArray 의 배열 길이만큼 반복
        for ($i = 0; $i < count($userArray); $i++) {

            // 친구 테이블에 회원번호, 친구 회원 번호 insert
            DB::table('followlists')->insert(
                [
                    // 1번 회원의 친구번호 insert
                    'follow_user_no' => $user_no[$i],
                    'follower_user_no' => $userArray[$i],
                    'registered_date' => Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                ]
            );

        }
    }
}
