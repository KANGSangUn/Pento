<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class taleImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 동화 타입 dummy data / 1: unity, 2 : web
        $taleTypeArray = [1, 1, 1, 1, 1, 2];
        // 동화 테이블의 전체 레코드 가져오기
        $fairyTaleArray = DB::table('fairy_tales')->get();

        // $fairyTaleArray 배열의 길이만큼 반복
        for ($i = 0; $i < count($fairyTaleArray); $i++) {

            // 동화 번호, 제목의 i번째 값 가져오기
            $taleNum = $fairyTaleArray[$i]->fairy_tale_no;
            $talName = $fairyTaleArray[$i]->tale_title;

            // 한 동화 당 총 6개의 이미지가 필요하기 때문에 6번 반복
            for ($j = 0; $j < 6; $j++) {

                // 동화이미지 테이블에 동화번호, 이미지 파일명, 타입번호 insert
                DB::table('tale_images')->insert(
                    [
                        'fairy_tale_no'         =>   $taleNum,
                        'type_no'               =>   $taleTypeArray[$j],
                        'tale_image'            =>   $talName . "_" . ($j + 1),
                        'registered_date'            =>   Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                    ]
                );
            }
        }
    }
}
