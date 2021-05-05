<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="/admin/notify.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/element.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/theme.default.css">

	<script src="{{asset('admin/js/AdminPage/jquery-1.2.6.min.js')}}"></script>
    <script src="{{asset('admin/js/AdminPage/jquery.tablesorter.min.js')}}"></script>
    <script src="{{asset('admin/js/AdminPage/jquery.tablesorter.widgets.min.js')}}"></script>

	<title>알림 전송</title>
	<script>
		var msg = '{{ Session::get('alert') }}';
		var exist = '{{ Session::has('alert') }}';
		if (exist) {
			alert(msg);
		}
	</script>
</head>
<body>
	<h2>
		<span>
			알림 전송
		</span>
	</h2>
	<section>
		<form class="select-form" action="" method="get">
			<span>
				<label for="college">계열</label>
				<select name="college" id="college">
					<option value="">전체</option>
					@foreach ($result_college as $college)
					<option id="depart-{{ $college['sosokCode'] }}" class="board-college"
						value="{{ rtrim($college['sosokName'], "스쿨") }}" @if ($request->college ==
						rtrim($college['sosokName'], "스쿨")) selected @elseif ($result_user->college ==
						rtrim($college['sosokName'], "스쿨")) @elseif ($result_user->role_id <= 500) @else hidden @endif>
							{{ rtrim($college['sosokName'], "스쿨") }}
					</option>
					@endforeach
				</select>
			</span>
			<span>
				<label for="depart">학과</label>
				<select name="depart" id="depart">
					<option value="">전체</option>
					@foreach ($result_depart as $college)
					@foreach ($college['minor'] as $depart)
					<option class="board-depart depart-{{ $college['sosokCode'] }}"
						value="{{ array_slice(explode(' ', $depart['sosokName']), -1)[0] }}" @if ($request->depart ==
						array_slice(explode(' ', $depart['sosokName']), -1)[0])
						selected
						@endif>
						{{ array_slice(explode(' ', $depart['sosokName']), -1)[0] }}
					</option>
					@endforeach
					@endforeach
				</select>
			</span>
			<span>
				<label for="year">학년</label>
				<select name="year" id="year">
					<option value="">전체</option>
					<option value="1" @if ($request->year==1) selected @endif>1</option>
					<option value="2" @if ($request->year==2) selected @endif>2</option>
					<option value="3" @if ($request->year==3) selected @endif>3</option>
				</select>
			</span>
			<input type="submit" class="submit" value="조회">
		</form>
		<hr>
		<form action="" method="post">
			@csrf
			<div class="flex-row">
				<div class="flex-col flex-al-end flex-ju-between">
					<table class="tablesorter">
						<thead>
						  <tr>
							<th>학번</th>
							<th>이름</th>
							<th>앱 설치 유/무</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>20070001</td>
							<td>김길동</td>
							<td>유</td>
						  </tr>
						  <tr>
							<td>20070002</td>
							<td>홍길동</td>
							<td>유</td>
						  </tr>
						  <tr>
							<td>20070003</td>
							<td>박길동</td>
							<td>무</td>
						  </tr>
						  <tr>
							<td>20070004</td>
							<td>이길동</td>
							<td>무</td>
						  </tr>
						</tbody>
					  </table>
					{{-- <select name="notification[]" id="notification[]" class="notification w-300 h-400" multiple>
						@if ($result_firebase)
						@foreach ($result_firebase as $item)

						<option class="keys" id="n_{{ $item->user_id }}" value="{{ $item->firebase_key }}">
							{{ $item->user_id }} | {{ $item->user_name }}
						</option>
						@endforeach
						@endif
					</select> --}}
					<div class="flex-row">
						<div class="h-5"></div>
						<div id="counts"></div>
						<div class="h-5"></div>
						<div>
							<input id="remove_selected" name="remove_selected" type="button" value="선택 제거">
							&nbsp;
							<input id="select_all" name="select_all" type="button" value="전체 선택">
						</div>
					</div>
				</div>
				&nbsp;
				<div class="flex-col flex-al-end flex-ju-between">
					<input type="text" name="title" id="title" class="w-300" placeholder="제목" minlength="1" maxlength="30"
						required>
					<div class="h-5"></div>
					<textarea id="body" name="body" class="w-300 h-400" placeholder="내용" minlength="1" maxlength="500"
						rows="23" required></textarea>
					<div class="h-5"></div>
					<input type="submit" id="submit" value="전송">
				</div>
			</div>
		</form>
	</section>
	<div class="h-10"></div>
	{{-- tablesort 코드 --}}
	<script>
		$(function () {
		  $(".tablesorter").tablesorter({
			widgets: ["zebra", "columns"],
			usNumberFormat: false,
			sortReset: true,
			sortRestart: true,
		  });
		});
	  </script>

	{{-- ※ Ctrl 키를 누르고 클릭하여 복수 선택/취소 가능 --}}
	<script>
		document.querySelector('#college').onchange = () => {
			var colleges = document.getElementsByClassName('board-college');
			var departs = document.getElementsByClassName('board-depart');
			var depart = document.getElementById('depart');
			var college = null;

			for (let element of colleges) {
				if (element.value == document.getElementById('college').value)
				college = element;
			}

			for (let element of departs) {
				element.hidden = true;
			}

			if (college != null) {
				var departs_selected = document.getElementsByClassName(college.id);

				for (let element of departs_selected) {
					element.hidden = false;
				}
			}
		};

		document.querySelector('#remove_selected').onclick = () => {
			var keys = document.getElementsByClassName('keys');

			for (let element of keys) {
				if (element.selected == true)
				{
					element.remove();
				}
			}
		};

		document.querySelector('#select_all').onclick = () => {
			var keys = document.getElementsByClassName('keys');
			var counts = 0;

			for (let element of keys) {
				element.selected = true;
				counts++;
			}

			document.querySelector("#counts").innerHTML = "총 " + counts + "명 선택됨";
		};

		document.querySelector('.notification').onchange = () => {
			var keys = document.getElementsByClassName('keys');
			var counts = 0;

			for (let element of keys) {
				if (element.selected == true)
				{
					counts++;
				}
			}

			document.querySelector("#counts").innerHTML = "총 " + counts + "명 선택됨";
		};

		document.querySelector('#college').onchange();
		document.querySelector('#select_all').onclick();
	</script>

</body>

</html>
