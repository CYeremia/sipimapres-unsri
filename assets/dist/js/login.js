var currUrl = window.location.href.split('/');
console.log(currUrl);
var globalUrl = currUrl.join('/');

$('#btnSubmit').click(function (e) {
	e.preventDefault();
	$('#sign_in').submit();
});

// $('#sign_in').submit(function (e) {
// 	e.preventDefault();
// 	// console.log($('#sign_in').serialize());

// 	if (currUrl[4] == "") {
// 		var loginurl = globalUrl + 'login/signin'
// 	}
// 	else if (currUrl[4] == "login") {
// 		var loginurl = globalUrl + '/signin'
// 	}

// 	$.ajax({
// 		type: "POST",
// 		url: loginurl,
// 		data: { userdata: $('#sign_in').serialize() },
// 		success: function (r) {
// 			if (r.status) {
// 				window.location.reload();
// 			} else {
// 				swal({
// 					title: "Gagal Masuk",
// 					text: r.messages,
// 					type: "error",
// 					showConfirmButton: false,
// 					showConfirmButton: true,
// 					allowEscapeKey: false,
// 					allowOutsideClick: false,
// 					allowEnterKey: false
// 				});
// 			}
// 		}
// 	});
// });