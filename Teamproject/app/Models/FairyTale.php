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
                                ->where('ti.type_no', 1)
                                ->where('ti.tale_image', 'regexp', '_[1]$')
                                ->orderBy('ft.tale_title')
                                ->get();

        if ($webTaleList == "[]")
        {
            return "select fail";
        }
       return $webTaleList;

    }

    // unity 에서 호출할 때

    static public function getStoryListUnity($user_no)
    {

        // 동화 이미지의 경로 검색
        $routeName           =      ImageRoute::getImageRoute('story');

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
                                            ->where('ti.type_no', 2)
                                            ->where('ti.tale_image', 'regexp', '_[6]$')
                                            ->orderBy('ft.tale_title')
                                            ->get();

        $buyNumResult = BuyStory::select('fairy_tale_no')
                                ->where('user_no', $user_no)
                                ->get();

        if ($unityTaleList == "[]" || $buyNumResult == "[]")
        {
            return "fail select!";
        }

        $total =
            [
            'fairy_info' => $unityTaleList,
            'buy_info' => $buyNumResult
            ];


        return $total;
        /*// 유니티의 목록을 출력할 때 동화번호, 제목, 이미지, 설명 반환
        $taleArray = array();

        // 동화번호와 동화제목 검색
        $taleResult = FairyTale::select('fairy_tale_no', 'tale_title', 'tale_explain')->get();

        // 동화의 개수만큼 반복
        for ($i = 0; $i < count($taleResult); $i++) {

            // $taleArray[레코드번호][키값]
            $taleArray[$i]['taleNum'] = $taleResult[$i]->fairy_tale_no;
            $taleArray[$i]['taleTitle'] = $taleResult[$i]->tale_title;


            $taleImageResult = TaleImage::getTaleImage('mainImage', $taleArray[$i]['taleNum']);
            $taleArray[$i]['taleImage'] = $routeName . $taleImageResult;
            $taleArray[$i]['taleExplain'] = $taleResult[$i]->tale_explain;

        }
        // 배열값 리턴
        return $taleArray;*/

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
                                    ->orderBy('ft.tale_title')
                                    ->get();

        if ($taleInfo == "[]")
        {
            return "fail select!";
        }
        return $taleInfo;
        /*$taleArray = array();

        // 동화번호와 동화제목 검색
        $taleResult = FairyTale::select('tale_title', 'tale_explain', 'tale_price')->where('fairy_tale_no', $taleNum)->get();

        if ($taleResult == "[]") {
            return "해당 동화가 없습니다. Invalid taleNum";
        } else {

            // 동화 이미지의 경로 검색
            $routeName = ImageRoute::getImageRoute('storyPage');

            // 동화의 개수만큼 반복

            // $taleArray[레코드번호][키값]
            $taleArray['taleTitle'] = $taleResult[0]->tale_title;


            $taleImageResult = TaleImage::getTaleImage('subImage', $taleNum);


            for ($i = 0; $i < count($taleImageResult); $i++) {
                $taleArray[$i]['taleImage'] = $routeName . $taleImageResult[$i];
            }
            $taleArray['tale_price'] = $taleResult[0]->tale_price;
            $taleArray['taleExplain'] = $taleResult[0]->tale_explain;


            // 배열값 리턴
            return $taleArray;
        }*/
    }

}


