<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-09
 * Time: 오후 3:35
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Model_Buy extends Model
{
    protected $table = 'buylist';

    static public function check_buylist($fairy_tale_no,$user_no){
        $value_check = DB::table('buylist')
            ->where('fairy_tale_no','=',$fairy_tale_no)
            ->where('user_no','=',$user_no)
            ->get();
        return $value_check;
    }

    static public function buyStory($fairy_tale_no,$user_no){
        DB::table('buylist')
            ->insert(['fairy_tale_no' => $fairy_tale_no, 'user_no' => $user_no]);
    }

}

