<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Expectation;

class SchoolNoticePage extends Controller
{
	public function index(Request $request)
	{
		try {
			//상세 공지사항 주소
			$url_id = env("URL_NEWS_VIEW", false) . $request['id'];
			$curl = new CurlController();
			$response = $curl->curlGet($url_id);

			$data = $response[0];
			$content = $this->xmlentity_decode($data['content']);
			$content = str_replace("src=\"", "src=\"https://koreait.ac.kr/", $content);
			$title = "공지 사항";
			return view('Notice.SchoolNotice', compact('data', 'content', 'title'));
		} catch (Expectation $e) {
			return view('errors.ErrorPage');
		}
	}

	function xmlentity_decode($input)
	{
		$match = array('/&amp;/', '/&gt;/', '/&lt;/', '/&apos;/', '/&quot;/', '/&nbsp;/');
		$replace = array('&', '>', '<', '\'', '"', ' ');
		return preg_replace($match, $replace, $input);
	}
}
