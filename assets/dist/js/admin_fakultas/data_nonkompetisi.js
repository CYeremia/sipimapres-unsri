$(document).ready(function () {
    bsCustomFileInput.init();

    //Pemilihan Bidang
    $('#Bidang').on('change', function () {
        var selectedvalue = $(this).val();

        var organisasi = "Organisasi kemahasiswaan/lembaga kemahasiswaan: Badan Eksekutif Mahasiswa, Senat Mahasiswa, Dewan Perwakilan Mahasiswa, Majelis Permusyawaratan Mahasiswa, Himpunan Mahasiswa";
        var unit = "Unit Kegiatan Mahasiswa";
        var ketua = "Ketua/Koordinator Kepanitiaan";

        //jika memilih role seperti variable diatas maka input field peran akan di hide
        if (selectedvalue == organisasi || selectedvalue == unit || selectedvalue == ketua) {
            $("#peran").hide();
            $("#jabatan").show();
        } else { //jika tidak memilih role seperti variable diatas maka input field akan di tampilkan
            $("#peran").show();
            $("#jabatan").hide();
        }
    });
});


//Menampilkan Tahun
var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;

