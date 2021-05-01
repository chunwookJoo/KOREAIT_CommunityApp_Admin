@extends('layouts.BottomNavigation')
@extends('layouts.MenuTitle')
@section('content')
	<body>
		@section('menu-title')
		@endsection
		@foreach($response as $index => $item)
			<a href="{{route("JobDetail" , ['take_idx' => $item['take_idx']])}}"
				>
				<!--제목-->
				<h1>{{$item['title']}}</h1>
				<!--모집직종-->
				<h3>{{$item['incrute_kind']}}</h3>
		@endforeach
	</body>
@endsection 