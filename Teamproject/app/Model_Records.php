<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-17
 * Time: 오후 3:38
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Model_Records extends Model
{
    public static function findPento($user_no,$collection_name){

        $value_story = DB::table('userinfo')->where('user_id','=',$collection_name)->get();

        return $value_story;
    }
}