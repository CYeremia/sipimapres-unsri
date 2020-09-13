var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

$(document).ready(function () {
    bsCustomFileInput.init();

    //Pemilihan Bidang
    $('#Bidang').on('change', function () {
        var selectedvalue = $(this).val();

        $.ajax({
            type: "POST",
            url: globalUrl + "/checkbidang",
            data: {
                selectbidang: selectedvalue,
            },
            datatype: 'json',
            success: function (b) {
                //jika memilih role seperti variable diatas maka input field peran akan di hide
                if (b.status) {
                    $("#peran").hide();
                    $("#jabatan").show();
                    opsitingkat = "";
                    opsitingkat += "<option selected disabled>Pilih Tingkat</option>";
                    opsitingkat += "<option >Internasional</option>";
                    opsitingkat += "<option >Regional</option>";
                    opsitingkat += "<option >Nasional</option>";
                    opsitingkat += "<option >Wilayah</option>";
                    opsitingkat += "<option >PT/Provinsi</option>";
                    opsitingkat += "<option >Fakultas/Prodi</option>";
                    document.getElementById("Tingkat").innerHTML = opsitingkat;
                    document.getElementById("Peran").value = "";
                } else { //jika tidak memilih role seperti variable diatas maka input field akan di tampilkan
                    $("#jabatan").hide();
                    $("#peran").show();
                    opsitingkat = "";
                    opsitingkat += "<option selected disabled>Pilih Tingkat</option>";
                    opsitingkat += "<option >Internasional</option>";
                    opsitingkat += "<option >Regional</option>";
                    opsitingkat += "<option >Nasional</option>";
                    opsitingkat += "<option >PT/Provinsi</option>";
                    document.getElementById("Tingkat").innerHTML = opsitingkat;
                }
            }
        });

        // var organisasi = "Organisasi kemahasiswaan/lembaga kemahasiswaan: Badan Eksekutif Mahasiswa, Senat Mahasiswa, Dewan Perwakilan Mahasiswa, Majelis Permusyawaratan Mahasiswa, Himpunan Mahasiswa";
        // var unit = "Unit Kegiatan Mahasiswa";
        // var Otonom = "Badan Semi Otonom";
        // var profesi = "Organisasi profesi mahasiswa";
        // var sosial = "Organisasi sosial kemasyarakatan";
        // var opsitingkat = "";
        // //jika memilih role seperti variable diatas maka input field peran akan di hide
        // if (selectedvalue == organisasi || selectedvalue == unit || selectedvalue == Otonom || selectedvalue == profesi || selectedvalue == sosial) {
        //     $("#peran").hide();
        //     $("#jabatan").show();
        //     opsitingkat = "";
        //     opsitingkat += "<option selected disabled>Pilih Tingkat</option>";
        //     opsitingkat += "<option >Internasional</option>";
        //     opsitingkat += "<option >Regional</option>";
        //     opsitingkat += "<option >Nasional</option>";
        //     opsitingkat += "<option >Wilayah</option>";
        //     opsitingkat += "<option >PT/Provinsi</option>";
        //     opsitingkat += "<option >Fakultas/Prodi</option>";
        //     document.getElementById("Tingkat").innerHTML = opsitingkat;
        // } else { //jika tidak memilih role seperti variable diatas maka input field akan di tampilkan
        //     $("#peran").show();
        //     $("#jabatan").hide();
        //     opsitingkat = "";
        //     opsitingkat += "<option selected disabled>Pilih Tingkat</option>";
        //     opsitingkat += "<option >Internasional</option>";
        //     opsitingkat += "<option >Regional</option>";
        //     opsitingkat += "<option >Nasional</option>";
        //     opsitingkat += "<option >PT/Provinsi</option>";
        //     document.getElementById("Tingkat").innerHTML = opsitingkat;
        // }
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

