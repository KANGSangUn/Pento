<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 회원 테이블의 전체 레코드 가져오기
        $userArray = DB::table('user_info')->get();


        // $userArray 배열의 길이만큼 반복
        for ($i = 0; $i < count($userArray); $i++) {

            // 회원번호
            $userNo = $userArray[$i]->user_no;
            $userID = $userArray[$i]->user_id;

            // 회원프로필 테이블에 회원번호, 사진파일명, 소개글, 적립금, 레벨, 닉네임 insert
            DB::table('user_profiles')->insert(
                [
                    'user_no'               => $userNo,
                    'user_photo'            => $userID . "_1",
                    'user_intro'            => $userID . "'s introduce",
                    'user_point'            => ((random_int(0, 5)) * 500),
                    'user_grade'            => random_int(1, 5),
                    'user_nickname'         => $userID,
                ]
            );
        }

    }
}
