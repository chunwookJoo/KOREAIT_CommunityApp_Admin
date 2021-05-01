var jumin3 = document.getElementById('jumin3');
var jumin4 = document.getElementById('jumin4');
var studentName = document.getElementById('search-student-number-input-name');
var searchStudentNumBtn = document.getElementById('search-student-number-submit-btn');

searchStudentNumBtn.addEventListener('click',()=>{
	var socialNum = jumin3.value+jumin4.value;
	fetch('/rest/api/search/student/number',{
		method: "POST",
		headers:{
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		body: JSON.stringify({
			studentName: studentName.value,
			socialNum: socialNum
		})
	}).then(response => response.json())
	.then(json =>{
		if(json.RESULT == 100){
			$("#modal-dialog").append(`
				<h1>S</h1>
			`);
		}else{
			$("#modal-dialog").append(`
				<h1>f</h1>
			`);
		}
	})
});

