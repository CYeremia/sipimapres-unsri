$(document).ready(function () {
    bsCustomFileInput.init();
});

var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = start; year <= end; year++) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;

