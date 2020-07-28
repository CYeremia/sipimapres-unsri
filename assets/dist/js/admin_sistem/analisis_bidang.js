var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;