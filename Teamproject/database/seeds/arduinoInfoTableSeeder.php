<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class arduinoInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 시리얼번호 dummy data
        $serialNumbers = [
            'PFEJAF31T8UJ95', 'AHAPUF54T7BQ77', 'KGHPQB54T7OL41', 'VIPBI37R8SDQ65', 'KFCGOO88M4NB37',
            'DECJA95H8U7G33', 'AEDJAF31T8FFF5', 'FREUSE31T8UJ95', 'LOLOFE31T8UJ92', 'KFEJASO1N8UJ10',
            'GSTARN86T5GJ27', 'PIZAEF22F8DF98', 'PWOORF31T8UJ00', 'BEEVEE35A8UJ12', 'MIAUEE17T7UJ69',
            'POGIAS05T7UJ64', 'HYAEN19T5KJO94', 'YONJMN22T5UJ49'
        ];
// 시 배열 -> addHours의 매개변수로 사용하기위해 현재 시에 값만큼 더한 값
        $hourArray =
            [
                1, 2, 3, 4, 5,
                6, 7, 1, 2, 3,
                4, 5, 6, 7, 5,
                5, 5, 3];
        // $serialNumbers 배열의 길이만큼 반복
        for ($i = 0; $i < count($serialNumbers); $i++) {

            // 아두이노 정보 테이블에 시리얼번호 insert
            DB::table('arduino_info')->insert(
                [
                    'serial_num'     =>     $serialNumbers[$i],
                    'registered_date'     =>     Carbon::now()->addHour($hourArray[$i])->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
