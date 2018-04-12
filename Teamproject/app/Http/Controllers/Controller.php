<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $return_value;

    // 검색 메서드
    public function Search($value_kinds){

        switch ($value_kinds){

            case 'friends':                  // 친구 검색
                $this->return_value = Post::all();
                break;

            case 'collection_default':      // 도안 검색
                $this->return_value = Post::all();
                break;

            case 'collection_custom':       // 작품 검색
                $this->return_value = Post::all();
                break;
        }

        return $this->return_value;
    }

    // 좌표값 캔버스화 메서드
    public function Change_img(){

    }
}
