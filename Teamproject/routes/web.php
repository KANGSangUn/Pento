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
Route::post('/storypagereq','Main_Controller@Load_Controller_Web');//storypage 동화목록 불러오기
Route::post('/userlogin','Main_Controller@Load_Controller_Web');
Route::post('/storyinfo','Main_Controller@Load_Controller_Web');
Route::post('/buystory','Main_Controller@Load_Controller_Web');
Route::post('/pentomyuser','Main_Controller@Load_Controller_Web');
Route::post('/pentomyfrd','Main_Controller@Load_Controller_Web');
Route::post('/frd_search','Main_Controller@Load_Controller_Web');
Route::post('/user_story','Main_Controller@Load_Controller_Web');
Route::post('/Rank_list','Main_Controller@Load_Controller_Web');
Route::post('/select_game_rank','Main_Controller@Load_Controller_Web');
/*내 정보*/

/*랭킹*/

/*친구추가*/
?>