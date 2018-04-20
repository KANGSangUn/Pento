<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class fairyTaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 동화 제목 dummy data
        $taleTitleArray =
            [
                'cinderella', 'jack_and_tree', 'foo_head', 'rapunzel', 'thumb',
                'little_mermaid', 'spongebab', 'frozen', 'baby_pig', 'snow_white'
            ];

        // $taleTitleArray 의 배열 개수만큼 반복
        for ($i = 0; $i < count($taleTitleArray); $i++) {

            // 동화 테이블에 동화 제목, 동화설명, 동화가격 insert
            DB::table('fairy_tales')->insert(
                [
                    'tale_title'        =>  $taleTitleArray[$i],
                    'tale_explain'      =>  "동화에 직접 아이가 참여해 스토리를 진행할 수 있는 " . $taleTitleArray[$i] . "!",
                    'tale_price'        =>  random_int(1000, 2000), // 1000 ~ 1000 사이의 정수 랜덤
                    'registered_date'        =>  Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
