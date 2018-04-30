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

    return view('pentoindex');
});

//Route::post('/con_router','Main_Controller@asd');
/*로그인*/
Route::post('/Login','Web_Functions@Login');
// 동화리스트 초기값
Route::post('/StoryList','Web_DefaultValue@StoryList');

// 동화 상세설명
Route::post('/StoryValue','Web_DetailValue@StoryValue');

// 나만의 컬렉션 초기값
Route::post('/MyCollection','Web_DefaultValue@MyCollection');

// 모두의 컬렉션 초기값
Route::post('/EveryCollection','Web_DefaultValue@EveryCollection');

// 컬렉션 구독하기
Route::post('/Buy','Web_Functions@Buy');

//장바구니 구매
Route::post('/Buylists','Web_Functions@MyBasket');
// 컬렉션 추천하기
Route::post('/Recommend','Web_Functions@Recommend');

// 도안 상세정보 불러오기
Route::post('/CollectionValue','Web_DetailValue@CollectionValue');

// 마이페이지 초기값
Route::post('/MyPage','Web_DefaultValue@MyPage');

// 친구페이지 초기값
Route::post('/Friends','Web_DefaultValue@Friends');

// 친구 검색
Route::post('/SearchValue','Web_Functions@SearchValue');

// 친구 추가
Route::post('/AddFriend','Web_Functions@AddFriend');

// 친구 삭제
Route::post('/DeleteFriend','Web_Functions@DeleteFriend');

// 랭크페이지 초기값
Route::post('/Rank','Web_DefaultValue@Rank');

// 랭크페이지 검색값
Route::post('/RankSearchValue','Web_DetailValue@RankSearchValue');

// 랭크페이지 기록반환
Route::post('/RankRecordValue','Web_DetailValue@RankRecordValue');


/*내 정보*/

/*랭킹*/

/*친구추가*/
?>