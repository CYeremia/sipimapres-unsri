var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

// console.log(globalUrl);

var IDPrestasi = location.pathname.split('/')[4];

var base_url = window.location.origin; //get default url name

var pathArray = window.location.pathname.split('/'); //get child url

var url = base_url + "/" + pathArray[1] + "/uploads/"; // append child url and uploads

function BuktiPrestasi(myvalue) {
    alert(myvalue);
    // var modal = document.getElementById("Modal-Img");
    // var modalImg = document.getElementById("img");

    // modal.style.display = "block";
    // modalImg.src = this.src = url + gambar;
    // $('#Modal-Img').modal('show');
}

// $('#closemodal').click(function (e) {
//     var modal = document.getElementById("Modal-Img");
//     modal.style.display = "none";
// });



// $(document).ready(function () {


// });

