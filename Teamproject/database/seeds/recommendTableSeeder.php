<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RecommendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userNumArray =
            [
                1, 1, 1, 2, 4,
                5, 10, 11, 30, 12,
                42, 90, 10, 52, 36,
                42, 55, 52, 53, 52,
                11, 12, 36, 40, 32,
                11, 11, 12, 12, 15,
                72, 88, 89, 70, 69,
                30, 42, 40, 32, 31,
                22, 23, 24, 25, 26,
                41, 44, 49, 71, 62,
                53, 63, 38, 51, 50
            ];
        $imitatedNumArray =
            [
                1, 2, 20, 11, 1,
                1, 2, 20, 20, 10,
                12, 13, 14, 15, 24,
                1, 13, 19, 9, 20,
                6, 4, 4, 5, 1,
                11, 1, 12, 15, 17,
                6, 7, 8, 9, 10,
                22, 23, 1, 11, 1,
                7, 7, 2, 2, 1,
                3, 4, 5, 6, 7,
                1, 2, 1, 2, 1

            ];

        for ($i = 0; $i < count($userNumArray); $i++)
        {
            DB::table('recommends')->insert
            (
                [
                    'user_no' => $userNumArray[$i],
                    'imitated_no' => $imitatedNumArray[$i],
                    'registered_date' => Carbon::now()
                ]
            );
        }
    }
}
