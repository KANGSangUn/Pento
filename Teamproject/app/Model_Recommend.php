<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Model_Recommend extends Model
{
    protected $table = 'recommend';

    static public function check_recommend($category,$contents_id,$user_no){

        $value_check = DB::table('recommend')
            ->where('category','=',$category)
            ->where('board_id','=',$contents_id)
            ->where('user_no','=',$user_no)
            ->get();
        return $value_check;
    }

    static public function add_recommend($category,$contents_id,$user_no){

        DB::table('recommend')
            ->insert(['user_no' => $user_no, 'category' => $category, 'board_id'=>$contents_id]);
    }

    static public function delete_recommend($category,$contents_id,$user_no){

        DB::table('recommend')
            ->where('user_no', '=', $user_no)
            ->where('category','=',$category)
            ->where('board_id','=',$contents_id)
            ->delete();
    }

}
