<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class imitatedPentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userNumArray = [1, 1, 3, 4, 1, 11, 15, 19, 7, 5, 1, 1, 23, 50, 99, 1, 46, 1, 1, 2];
        // 도안번호 dummy data
        $designNumArray = [1, 3, 4, 2, 1, 3, 5, 4, 4, 5, 1, 2, 2, 3, 5, 1, 2, 1, 3,1];




        // $designArray 배열 길이만큼 반복
        for ($i = 0; $i < 20; $i++) {



            // 회원프로필 테이블에서 랜덤한 회원번호의 닉네임값 가져오기
            $userNickname = DB::table('user_profiles')->where('user_no', $userNumArray[$i])->value('user_nickname');




            // 작품테이블에 도안번호, 회원번호, 작품사진, 작성날짜 insert
            DB::table('imitated_pentos')->insert(
                [
                    'design_no'          =>     $designNumArray[$i],
                    'user_no'            =>     $userNumArray[$i],
                    'imitated_photo'     =>     $userNickname . "_" .  $i,
                    'registered_date'         =>     Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );

        }
    }
}
