<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class imageTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 이미지 타입 dummy data
        $typeArray = ['web', 'unity'];

        // $typeArray 배열 길이만큼 반복
        for ($i = 0; $i < count($typeArray); $i++) {

            // 이미지 타입 테이블에 타입 저장
            DB::table('image_types')->insert(
                [
                    'check_type'    =>  $typeArray[$i],
                    'registered_date'    =>  Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
