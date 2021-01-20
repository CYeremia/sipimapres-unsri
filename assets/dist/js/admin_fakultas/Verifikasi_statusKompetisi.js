var currUrl = window.location.href.split('/');
var data = currUrl[6]; //parameter
currUrl.pop();
var globalUrl = currUrl.join('/');


var img = document.getElementById("bukti");
var modal = document.getElementById("Modal-Img");
var modalImg = document.getElementById("img");

$(document).ready(function () {

    $.ajax({
        url: globalUrl + '/getdataTable/' + data,
        type: 'POST',
        data: function (d) { },
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $("#Nama_Mahasiswa").html("status changed");
            // $('#Nama_Mahasiswa').text("Hai");

        }
    });

    // document.getElementById('Nama_Mahasiswa').value = test;
    // img.onclick = function () {
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    //     $('#Modal-Img').modal('show');
    // }
    // $('#closemodal').click(function (e) {
    //     var modal = document.getElementById("Modal-Img");
    //     modal.style.display = "none";
    // });
});

