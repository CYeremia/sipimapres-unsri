var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

$(document).ready(function () {
    bsCustomFileInput.init();
    $('#tanggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#tanggal2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
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
                    $("#ShowTingkat").hide();
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
                    $("#ShowTingkat").hide();
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
    });

    $('#Tingkat').on('change', function () {
        var selected = $(this).val();
        $("#ShowTingkat").show();

        if (selected == 'Regional') {
            document.getElementById("jumlahTingkat").placeholder = "Jumlah Perguruan Tinggi (optional)";
            document.getElementById("jumlahTingkat").value = "";
        } else if (selected == 'PT/Provinsi') {
            document.getElementById("jumlahTingkat").placeholder = "Jumlah Perguruan Tinggi (optional)";
            document.getElementById("jumlahTingkat").value = "";
        } else if (selected == 'Nasional') {
            document.getElementById("jumlahTingkat").placeholder = "Jumlah Provinsi (optional)";
            document.getElementById("jumlahTingkat").value = "";
        } else if (selected == 'Internasional') {
            document.getElementById("jumlahTingkat").value = "";
            document.getElementById("jumlahTingkat").placeholder = "Jumlah Negara (optional)";
        } else if (selected == 'Wilayah') {
            document.getElementById("jumlahTingkat").value = "";
            document.getElementById("jumlahTingkat").placeholder = "Jumlah Wilayah (optional)";
        } else if (selected == 'Fakultas/Prodi') {
            document.getElementById("jumlahTingkat").value = "";
            document.getElementById("jumlahTingkat").placeholder = "Jumlah Fakultas/Prodi (optional)";
        }
    });

});

// //Menampilkan Tahun
// var start = 2000;
// var end = new Date().getFullYear();
// var options = "";

// options += "<option selected disabled>Tahun</option>";
// for (var year = end; year >= start; year--) {
//     options += "<option>" + year + "</option>";
// }
// document.getElementById("tahun").innerHTML = options;

