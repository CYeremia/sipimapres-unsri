var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
// console.log(globalUrl);

var daftaru;

$(document).ready(function () {
    daftaru = $('#daftaruser').DataTable({
        ajax: {
            url: globalUrl + '/getUser',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0,
            "width": "2%"
        },
        {
            data: "NIP",
            "targets": 1
        },
        {
            data: "Nama",
            "targets": 2
        },
        {
            data: "username",
            "targets": 3

        },
        {
            data: "role",
            "targets": 4
        },
        {
            data: { NIP: "NIP" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenal=\"" + data.NIP + "\" class=\"btn bg-blue editdata\" style=\"margin : auto;\"><i class='fas fa-user-edit'></i></button>";
                var actButt2 = "<button idpengenald=\"" + data.NIP + "\" class=\"btn bg-red float-right deletedata\" ><i class='fas fa-trash-alt'></i></button>";
                return actButt + actButt2;
            },
            "targets": 5,
            "width": "10%"
        },
        ],
        order: [0, 'asc']
    });

    //Menghapus Data
    $('#daftaruser tbody').on('click', '.deletedata', function () {
        var IDp = $(this).attr('idpengenald');

        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Data User?',
            // text: "Menambahkan Data Prestasi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: globalUrl + "/deleteuser",
                    type: "POST",
                    data: {
                        ID: IDp,
                    },
                    // console.log(result.value);
                    success: function (r) {
                        console.log(r.status);
                        daftaru.ajax.reload();
                        if (r.status) {
                            Swal.fire(
                                'Deleted!',
                                'Anda Berhasil Menghapus User',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal',
                                'Gagal Menghapus User',
                                'error'
                            )
                        }
                    }
                });
            }
        })
    });

    //Edit Data
    $('#daftaruser tbody').on('click', '.editdata', function () {
        var IDp = $(this).attr('idpengenal');
        // console.log(IDp);

        Swal.fire({
            title: 'Apakah Anda Yakin Mengedit Data User?',
            // text: "Menambahkan Data Prestasi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                EditdataUser(IDp);
            }
        })
    });

});

function EditdataUser(NIP) {

    $.ajax({

        type: 'POST',
        url: globalUrl + "/getdataNIP",
        data: {
            ID: NIP,
        },
        success: function (response) {

            // document.getElementById('username').value = response.data[0].Nama;
            document.getElementById('namaadmin').value = response.data[0].Nama;
            document.getElementById('NIP').value = response.data[0].IDPengenal;
            document.getElementById('Email').value = response.data[0].Email;

            $('#role').empty();
            $('#role').append("<option selected value='" + response.data[0].Role + "'>" + response.data[0].Role + "</option>");

            var roles = response.data[0].Role;
            if (roles == "Administrator Sistem") {
                $("#fakultas_select").hide();
                $('#role').append("<option value='Administrasi Fakultas'>Administrasi Fakultas</option>");
            } else {
                $("#fakultas_select").show();
                $('#role').append("<option value='Administrator Sistem'>Administrator Sistem</option>");

                $('#fakultas').empty();
                $('#fakultas').append("<option selected disabled value='" + response.data[0].Fakultas + "'>" + response.data[0].Fakultas + "</option>");
                $.ajax({
                    type: 'POST',
                    url: globalUrl + '/getdatafakultas',
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response.data);
                        for (i = 0; i < response.data.length; i++) {
                            // Output choice in the target field
                            $('#fakultas').append("<option value='" + response.data[i].Fakultas + "'>" + response.data[i].Fakultas + "</option>");
                        }

                    }
                });
            }

            document.getElementById('id_modal').value = response.data[0].IDPengenal;
            $('#modal-form2').modal();
        }
    });
}

//Pemilihan Role
$('#role').on('change', function () {
    // Set selected option as variable
    var selectValue = $(this).val();
    // console.log(selectValue);

    //Jika memilih role Administrator Sistem maka selecte option fakultas akan hide
    if (selectValue == "Administrator Sistem") {
        $("#fakultas_select").hide();
    }
    else {
        //Jika memilih role Administrator Sistem maka selecte option fakultas akan show
        $("#fakultas_select").show();

        //Menampilkan Pilihan Fakultas berdasarkan table db
        $('#fakultas').empty();
        $('#fakultas').append("<option selected disabled>Pilih Fakultas</option>");
        $.ajax({
            type: 'POST',
            url: globalUrl + '/getdatafakultas',
            dataType: 'json',
            success: function (response) {
                // console.log(response.data);
                for (i = 0; i < response.data.length; i++) {
                    // Output choice in the target field
                    $('#fakultas').append("<option value='" + response.data[i].Fakultas + "'>" + response.data[i].Fakultas + "</option>");
                }

            }
        });
    }

});