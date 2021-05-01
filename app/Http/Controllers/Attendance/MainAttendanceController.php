<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CurlController;
use App\Http\Controllers\UserInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class MainAttendanceController extends Controller
{
	public function index(Request $request)
	{
		try {
			//출결 불러 오기
			$url_id = env('URL_ATTEND');
			$url_id = $url_id . Cookie::get('studentID');
			$curl = new CurlController();
			$response = $curl->curlGet($url_id);

			//데이터 최신순으로 반전 정렬
			$attend = array_reverse($response);

			//유저 이름 가져오기
			$user_info = new UserInfo();
			$user_info_name = $user_info->user_name();
			$title = $user_info_name . "님 출결 현황";


			$countAttendanceKinds = $this->CountAttendanceKinds($attend);

			return view('Attend.Attend', compact('attend', 'title', 'countAttendanceKinds'));
		} catch (Exception $e) {
			view('errors.ErrorPage');
		}
	}

	private function CountAttendanceKinds($attend)
	{
		$tardy = 0;
		$absent = 0;
		$earlyLeave = 0;
		foreach ($attend as $item) {
			if ($item['reason'] == '지각') $tardy++;
			if ($item['reason'] == '결석') $absent++;
			if ($item['reason'] == '조퇴') $earlyLeave++;
		}


		return array('tardy' => $tardy, 'absent' => $absent, 'earlyLeave' => $earlyLeave);
	}
}
