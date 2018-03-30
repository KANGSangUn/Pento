<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-16
 * Time: 오전 6:25
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Model_Subscribe extends Model
{
    protected $table = 'collections';

    static public function check_collection($pento_design_no,$user_no){
        $value_check = DB::table('collections')
            ->where('pento_design_no','=',$pento_design_no)
            ->where('userinfo_no','=',$user_no)
            ->get();
        return $value_check;
    }

    static public function subscribe($pento_design_no,$user_no){
        DB::table('collections')
            ->insert(['pento_design_no' => $pento_design_no, 'userinfo_no' => $user_no]);
    }

}

