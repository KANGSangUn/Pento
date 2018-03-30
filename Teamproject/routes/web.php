<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function (){
//    $obj =new \App\Http\Controllers\Main_Controller();
//    $obj->Load_Controller('page/Storylist');
    return view('pentoindex');
});

//Route::post('/con_router','Main_Controller@asd');
/*동화 페이지*/
Route::post('/conrouter','MainController@Load_Controller');//storypage 동화목록 불러오기
Route::post('/buystory','MainController@Load_Controller');//동화 구매하기
/*내 정보*/

/*랭킹*/

/*친구추가*/
?>