var currUrl = window.location.href.split('/');
var globalUrl = currUrl.join('/');
// console.log(globalUrl);

$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: globalUrl + '/getdataFakultas',
        // dataType: 'json',
        success: function (response) {
            // console.log(response.data);

            // Empty the target field
            $('#fakultas').empty();
            $('#fakultas').append("<option disabled='disabled' SELECTED>Pilih Fakultas</option>");
            for (i = 0; i < response.data.length; i++) {
                // Output choice in the target field
                $('#fakultas').append("<option value='" + response.data[i].Fakultas + "'>" + response.data[i].Fakultas + "</option>");
            }

        }
    });

    //Show pilih program studi berdasarkan Fakultas
    $('#fakultas').on('change', function () {
        // Set selected option as variable
        var selectValue = $(this).val();

        var bidangselect;
        $.ajax({
            type: 'POST',
            url: globalUrl + '/getdataProdi',
            data: {
                pilihan: selectValue,
            },
            dataType: 'json',
            success: function (response) {
                // console.log(response.data);

                // Empty the target field
                $('#jurusan').empty();
                $('#jurusan').append("<option disabled='disabled' SELECTED>Pilih Program Studi</option>");
                for (i = 0; i < response.data.length; i++) {
                    // Output choice in the target field
                    $('#jurusan').append("<option value='" + response.data[i].Prodi + "'>" + response.data[i].Prodi + "</option>");
                }

            }
        });

    });

    // Get data form
    // $('#datauser').click(function (e) {
    //     var fullname = document.getElementById("namaLengkap").value;
    //     var IDPengenal = document.getElementById("IDpengenal").value;
    //     var password = document.getElementById("password").value;
    //     var email = document.getElementById("email").value;
    //     var IPK = document.getElementById("IPK").value;
    //     var telp = document.getElementById("telp").value;

    //     var fakultasindex = document.getElementById("fakultas");
    //     var fakultas = fakultasindex.value;

    //     var jurusanindex = document.getElementById("jurusan");
    //     var jurusan = jurusanindex.value;

    //     $.ajax({
    //         url: globalUrl + "/newUser",
    //         type: "POST",
    //         data: {
    //             namauser: fullname,
    //             IDuser: IDPengenal,
    //             passworduser: password,
    //             emailuser: email,
    //             IPKuser: IPK,
    //             telpuser: telp,
    //             fakultasuser: fakultas,
    //             jurusanuser: jurusan
    //         },
    //         success: function (response) {
    //             if (response.status == true) {
    //                 swal({
    //                     title: "Success",
    //                     text: "Anda Berhasil Mendaftar",
    //                     type: "success",
    //                     timer: 2000,
    //                     showConfirmButton: false
    //                 }, function () {
    //                     window.location.href = globalUrl + "/login";
    //                 });
    //             } else {
    //                 swal({
    //                     title: "Gagal",
    //                     text: "Anda Tidak Berhasil Mendaftar! Data Anda Telah Ada",
    //                     type: "warning",
    //                     // timer: 2000,
    //                     showConfirmButton: true
    //                 });
    //             }
    //         }
    //     });
    // });

});


