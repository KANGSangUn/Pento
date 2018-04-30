<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ColorInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colorNameArray = ['White', 'Black', 'Red', 'Green', 'Blue', 'Skyblue', 'Purple', 'Orange', 'Brown'];
        $R_Array = [255, 0, 255, 93, 51, 153, 224, 255, 255];
        $G_Array = [255, 0, 102, 213, 102, 221, 102, 166, 140];
        $B_Array = [255, 0, 102, 93, 255, 255, 255, 77, 83];

        for($i = 0 ; $i < count($colorNameArray) ; $i++){
            DB::table('color_info')->insert
            (
                [
                    'color_name' => $colorNameArray[$i],
                    'R'=> $R_Array[$i],
                    'G' => $G_Array[$i],
                    'B' => $B_Array[$i],
                    'registered_date' =>  Carbon::now()->addHour(9)->format('Y-m-d H:i:s')
                ]
            );
        }
    }
}
