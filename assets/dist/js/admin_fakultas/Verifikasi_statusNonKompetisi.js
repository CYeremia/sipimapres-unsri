$(document).ready(function () {


    //tampil textarea when status ditolak
    $('#status').on('change', function () {
        // console.log("1");
        var selected = $(this).val();

        if (selected == 'Diterima') {
            // document.getElementById("")
            $("#catatanpenolakan").val("");
            $("#rowcatatan").hide();
        } else if (selected == 'Ditolak') {
            $("#rowcatatan").show();
        }
    });

});



// var currUrl = window.location.href.split('/');
// currUrl.pop();
// var globalUrl = currUrl.join('/');

// var img = document.getElementById("bukti");
// var modal = document.getElementById("Modal-Img");
// var modalImg = document.getElementById("img");

// img.onclick = function () {
//     modal.style.display = "block";
//     modalImg.src = this.src;
//     $('#Modal-Img').modal('show');
// }
// $('#closemodal').click(function (e) {
//     var modal = document.getElementById("Modal-Img");
//     modal.style.display = "none";
// });
