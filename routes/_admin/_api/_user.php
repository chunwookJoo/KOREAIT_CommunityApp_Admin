<?php

use App\Http\Controllers\_Api\_User\_ApiUserGetFirebase;
use App\Http\Controllers\_Api\_User\_ApiUserGetFirebaseGroup;
use App\Http\Controllers\_Api\_User\_ApiUserGetInfo;
use App\Http\Controllers\_Api\_User\_ApiUserSetFirebase;
use App\Http\Controllers\_Api\_User\_ApiUserSetInfo;
use App\Http\Controllers\_Api\_User\_ApiUserSetNickname;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| API 주소: https://app.koreait.kr/article/user/
| prefix 그룹: 'article/user' ("/routes/_admin/_api.php" 파일의 Route::prefix('user') 참고)
| 미들웨어 그룹: 'api' ("/app/Http/Kernel.php" 파일의 $middlewareGroups 참고)
| 컨트롤러: "/app/Http/Controllers/_Api/_User" 경로 참고)
|
*/

Route::post('/set/info', _ApiUserSetInfo::class);			// 사용자 정보 입력/수정
Route::post('/get/info', _ApiUserGetInfo::class);			// 사용자 정보 조회
Route::post('/set/firebase', _ApiUserSetFirebase::class);	// 사용자 Firebase 키 입력
Route::post('/get/firebase', _ApiUserGetFirebase::class);	// 사용자 Firebase 키 조회
Route::post('/get/firebase/group', _ApiUserGetFirebaseGroup::class);	// 그룹 Firebase 키 조회
Route::post('/set/nickname', _ApiUserSetNickname::class);	// 사용자 별명 입력
