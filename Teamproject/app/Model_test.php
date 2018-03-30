<?php
/**
 * Created by PhpStorm.
 * User: Moon
 * Date: 2018-03-22
 * Time: 오전 4:40
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Model_test extends Model
{
    public static function Search_design($search_design_no){

        //$content_body = Post::where('id','=',$id)->get();
        $value = DB::table('test')->where('design_no','=',$search_design_no)->get();

        return $value;
    }

    public static function All_design(){

        //$content_body = Post::where('id','=',$id)->get();
        $value = DB::table('test')->get();

        return $value;
    }

}