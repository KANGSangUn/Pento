<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // 회원 아이디 dummy data
        $userIDs =
            [
                'horenso', 'kim', 'lee', 'park', 'choi', 'jung', 'kang', 'joo', 'song', 'yoon',
                'nam', 'sung', 'cha', 'no', 'woo', 'Ace', 'Adela', 'Aggie', 'Aida',
                'Angelica', 'Calla', 'Chloe', 'Elisha', 'Eva', 'Gloria', 'Helia', 'Jane', 'Zeus', 'Zeki',
                'Winston', 'Wily', 'William', 'Walter', 'Vito', 'Thomas', 'Sylvester', 'Simon', 'Sam', 'Romeo',
                'Rocky', 'Robert', 'Rex', 'Pluto', 'Patrick', 'Mighty', 'Lonnie', 'Leo', 'Joy', 'Karis',
                'Tyler', 'Isaac', 'Ehan ', 'SEHYUK_LEE ', 'MINSU_KIM ', 'YEONGMOON_KIM', 'BYUNGOK_PARK ', 'HYEONGSEOK_SEONG ', 'SOL_SONG', 'SEWON_JANG',
                'JUNSU_JANG ', 'SANGWON_JEON', 'HYEONWOO_JUNG', 'MINSUK_CHOI', 'BYEONGCHAN_CHOI ', 'JAEHYEONG_HA ', 'SANGUN_KANG', 'BEOMSU_KWON', 'SEONGJUN_KIM', 'SEUNGMOK_KIM',
                'HOHYUNG_RYU', 'JOOYONG_PARK', 'JUNSANG_PARK', 'HYODONG_PARK', 'JINHO_SON ', 'JUNWHI_AHN', 'SEHWAN_YEOM', 'SEUNGMIN_LEE', 'JUNYOUNG_LEE', 'SUNGKYU_JIN',
                'YOHAN_CHOE', 'SUNGEUN_KANG', 'DAHUI_GWAK ', 'GYEONGIM_SUNG', 'KIHYEOK_SEONG', 'YOULIM_SIM ', 'YUNJEONG_OH', 'JINJU_YOON', 'SEONGMIN_LEE ', 'AREUM_LEE',
                'JIYOON_LEE', 'HAYEON_LEE', 'HYEMI_LEE', 'HYOJIN_LEE', 'DAYOEN_JANG', 'JIMIN_JUNG', 'SUJIN_CHO ', 'YOUNGHO_JOO', 'SEONJU_CHOI', 'JUNGYU_CHOI',
                'GEUMBI_HWANG'
            ];

        // 회원 비밀번호 dummy data
        $userPWs =
            [
                'horenso', 'kim', 'lee', 'park', 'choi', 'jung', 'kang', 'joo', 'song', 'yoon',
                'nam', 'sung', 'cha', 'no', 'woo', 'Ace', 'Adela', 'Aggie', 'Aida',
                'Angelica', 'Calla', 'Chloe', 'Elisha', 'Eva', 'Gloria', 'Helia', 'Jane', 'Zeus', 'Zeki',
                'Winston', 'Wily', 'William', 'Walter', 'Vito', 'Thomas', 'Sylvester', 'Simon', 'Sam', 'Romeo',
                'Rocky', 'Robert', 'Rex', 'Pluto', 'Patrick', 'Mighty', 'Lonnie', 'Leo', 'Joy', 'Karis',
                'Tyler', 'Isaac', 'Ehan ', 'SEHYUK_LEE ', 'MINSU_KIM ', 'YEONGMOON_KIM', 'BYUNGOK_PARK ', 'HYEONGSEOK_SEONG ', 'SOL_SONG', 'SEWON_JANG',
                'JUNSU_JANG ', 'SANGWON_JEON', 'HYEONWOO_JUNG', 'MINSUK_CHOI', 'BYEONGCHAN_CHOI ', 'JAEHYEONG_HA ', 'SANGUN_KANG', 'BEOMSU_KWON', 'SEONGJUN_KIM', 'SEUNGMOK_KIM',
                'HOHYUNG_RYU', 'JOOYONG_PARK', 'JUNSANG_PARK', 'HYODONG_PARK', 'JINHO_SON ', 'JUNWHI_AHN', 'SEHWAN_YEOM', 'SEUNGMIN_LEE', 'JUNYOUNG_LEE', 'SUNGKYU_JIN',
                'YOHAN_CHOE', 'SUNGEUN_KANG', 'DAHUI_GWAK ', 'GYEONGIM_SUNG', 'KIHYEOK_SEONG', 'YOULIM_SIM ', 'YUNJEONG_OH', 'JINJU_YOON', 'SEONGMIN_LEE ', 'AREUM_LEE',
                'JIYOON_LEE', 'HAYEON_LEE', 'HYEMI_LEE', 'HYOJIN_LEE', 'DAYOEN_JANG', 'JIMIN_JUNG', 'SUJIN_CHO ', 'YOUNGHO_JOO', 'SEONJU_CHOI', 'JUNGYU_CHOI',
                'GEUMBI_HWANG'
            ];


        // $userIDs 배열의 길이만큼 반복
        for ($i = 0; $i < count($userIDs); $i++) {

            // 회원 테이블에 회원아이디, 비밀번호 insert
            DB::table('user_info')->insert(
                [
                    'user_id'           => $userIDs[$i],
                    'user_pw'           => bcrypt($userPWs[$i]), // 암호화 188자 길이를 가짐
                    'registered_date'   => Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                    'updated_date'      => Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
