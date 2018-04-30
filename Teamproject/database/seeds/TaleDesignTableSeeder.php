<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaleDesignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $taleDesignNum      =   [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

        // 동화 등록날짜
        $dateResult         =   DB::table('fairy_tales')
                                ->get();

        $designNumArray     =   [36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46];


        for ($i = 0; $i < count($taleDesignNum); $i++) {
            DB::table('tale_designs')->insert
            (
                [
                    'fairy_tale_no'     =>  $taleDesignNum[$i],
                    'design_no'         =>  $designNumArray[$i],
                    'registered_date'   =>  $dateResult[$i]->registered_date
                ]
            );
        }
    }
}
