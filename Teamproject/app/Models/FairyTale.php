<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class FairyTale extends Model
{
    protected $table = 'fairy_tales';

    // 동화 리스트 -> unity or web
    // 동화의 제목, 이미지, 동화번호 반환

    // 웹의 동화 목록
    static public function getStoryListWeb()
    {
        // 동화 이미지의 경로 검색
        $routeName      =   ImageRoute::getImageRoute('storyPage');

        // 웹에서 동화목록을 출력할 때 동화번호, 제목, 이미지 반환
        $webTaleList    =   DB::table('fairy_tales as ft')
                                ->leftJoin('tale_images as ti', 'ti.fairy_tale_no', '=', 'ft.fairy_tale_no')
                                ->select
                                (
                                    'ft.fairy_tale_no',
                                    'ft.tale_title',
                                    DB::raw('concat( "' . $routeName . '", ti.tale_image) as tale_image')
                                )
                                ->where('ti.tale_image', 'regexp', '_[1]$')
                                ->orderBy('ft.tale_title')
                                ->get();

        // 결과가 빈 객체일 경우
        if ($webTaleList == "[]")
        {
            return "select fail";
        }

        // 동화 목록 반환
       return $webTaleList;

    }



    // 유니티에서 동화목록을 반환
    static public function getStoryListUnity()
    {

        // 동화 이미지의 경로 검색
        $routeName           =      ImageRoute::getImageRoute('storyPage');

        // 유니티의 목록을 출력할 때 동화번호, 제목, 이미지, 설명 반환
        $unityTaleList       =      DB::table('fairy_tales as ft')
                                            ->leftJoin('tale_images as ti', 'ti.fairy_tale_no', '=', 'ft.fairy_tale_no')
                                            ->select
                                            (
                                                'ft.fairy_tale_no',
                                                'ft.tale_title',
                                                DB::raw('concat( "' . $routeName . '", ti.tale_image) as tale_image'),
                                                'ft.tale_explain'
                                            )
                                            ->where('ti.tale_image', 'regexp', '_[1]$')
                                            ->orderBy('ft.tale_title')
                                            ->get();



        if ($unityTaleList == "[]")
        {
            return "fail select!";
        }


        return $unityTaleList;
    }



    //동화 상세설명

    static public function getStoryInfo($taleNum)
    {
        // 동화 이미지 저장 경로 select 메소드 호출
        $routeName       =      ImageRoute::getImageRoute('storyPage');

        // 제목, 이미지, 가격, 상세설명 반환
        $taleInfo       =       DB::table('fairy_tales as ft')
                                    ->leftJoin('tale_images as ti', 'ti.fairy_tale_no', '=', 'ft.fairy_tale_no')
                                    ->select
                                    ('ft.fairy_tale_no',
                                        'ft.tale_title',
                                        DB::raw('concat( "' . $routeName . '", ti.tale_image) as tale_image'),
                                        'ft.tale_explain',
                                        'ft.tale_price')
                                    ->where('ti.tale_image', 'regexp', '_[12345]$')
                                    ->where('ft.fairy_tale_no', $taleNum)
                                    ->get();

        if ($taleInfo == "[]")
        {
            return "fail select!";
        }
        return $taleInfo;
    }

}


