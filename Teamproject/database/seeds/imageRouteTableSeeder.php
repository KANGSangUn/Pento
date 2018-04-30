<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ImageRouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 이미지 루트 dummy data
        $routeArray = ['/images/storyPage/', '/images/userPage/', '/images/imitatedPento/', '/images/everyPento/'];

        // $routeArray 배열 길이만큼 반복
        for ($i = 0; $i < count($routeArray); $i++) {

            // 이미지 경로 테이블에 루트명 insert
            DB::table('image_routes')->insert(
                [
                    'route_name'        =>  $routeArray[$i],
                    'registered_date'        =>  Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
