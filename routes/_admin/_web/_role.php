<?php

use App\Http\Controllers\_Admin\_Role\_RoleList;
use App\Http\Controllers\_Admin\_Role\_RoleSet;
use App\Http\Controllers\_Admin\_Role\_RoleSetResult;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| 웹 주소: https://app.koreait.kr/admin/role/
| prefix 그룹: 'admin/role' ("/routes/_admin/_web.php" 파일의 Route::prefix('role') 참고)
| 미들웨어 그룹: 'admin' ("/app/Http/Kernel.php" 파일의 $middlewareGroups 참고)
| 컨트롤러: "/app/Http/Controllers/_Admin/_Role" 경로 참고)
|
*/

Route::match(['get', 'post'], '/list', _RoleList::class)->name('_RoleList');	// 관리자 리스트
Route::match(['get', 'post'], '/set', _RoleSet::class)->name('_RoleSet');		// 역할 설정
