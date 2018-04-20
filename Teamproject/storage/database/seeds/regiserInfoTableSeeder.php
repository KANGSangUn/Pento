<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class regiserInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $userArray = [1, 2, 3, 4, 52, 11, 15, 19, 7, 5, 10, 88, 23, 37, 99, 76, 71, 98];
        $arduinoArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];

        // 시 배열 -> addHours의 매개변수로 사용하기위해 현재 시에 값만큼 더한 값
        $hourArray =
            [
                1, 2, 3, 4, 5,
                6, 7, 1, 2, 3,
                4, 5, 6, 7, 5,
                5, 5, 3];

        //$randValue = array();

        /*
                for ($i = 0; $i < count($arduinoArray); $i++) {

                   $randValue[$i] = random_int(1, count($arduinoArray));

                    // 중복값 제거
                    for ($j = 0; $j < $i; $j++) {
                        if ($randValue[$i] == $randValue[$j]) {
                            $i--;
                            break;
                        }
                    }

                }*/

        for ($i = 0; $i < count($arduinoArray); $i++) {
            DB::table('register_info')->insert([
                'arduino_no' => $arduinoArray[$i],
                'user_no' => $userArray[$i],
                'registered_date' => Carbon::now()->addHour($hourArray[$i])->format('Y-m-d H:i:s'),
                'updated_date' => Carbon::now()->addHour(9)->format('Y-m-d H:i:s'),

            ]);
        }

    }
}
