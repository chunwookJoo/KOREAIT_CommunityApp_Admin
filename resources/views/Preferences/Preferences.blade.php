{{-- 더보기 --}}
@extends('layouts.BottomNavigation') @extends('layouts.MenuTitle')
@section('content')
<link href="{{ asset('/css/Preferences/Preferences.css') }}" rel="stylesheet" />
<body>
	@section('menu-title') @endsection
	<section>
		<div class="preferences-container">
			<a href="{{ route('MyProFile') }}"
				><div>
					<i class="fas fa-user" style="font-size: 3rem"
						><br /><small>내 정보</small></i
					>
				</div></a
			>
			<a href="{{ route('MyBoardListGET') }}"
				><div><i class="fas fa-paste" style="font-size: 3rem"
						><br /><small>내 게시글</small></i
					>
				</div></a
			>
			<a href="{{ route('Alarm') }}"
				><div>
					<i class="fas fa-bell" style="font-size: 3rem">
						<br /><small>알림설정</small></i
					>
				</div></a
			>
			<a href="{{ route('AppVerSion') }}"
				><div>
					<i class="fas fa-mobile-alt" style="font-size: 3rem"
						><br /><small>앱 버전</small></i
					>
				</div></a
			>
		</div>
	</section>
</body>
@endsection
