<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-09
 * Time: 오후 3:34
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_Fairytale extends Model
{
    public static function prtAll(){
        $value_story = DB::table('fairy_tale')->get();
        return $value_story;
    }

    public static function prtStoryInfo($id_story){

        //$content_body = Post::where('id','=',$id)->get();
        $value_story = DB::table('fairy_tale')->where('fairy_tale_no','=',$id_story)->get();

        return $value_story;
    }
}