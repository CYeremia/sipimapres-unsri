var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
console.log(globalUrl);

var daftarMahasiswa;

$(document).ready(function () {
    daftarMahasiswa = $('#daftarregistrasimahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/getdataRegistrasi',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0,
            "width": "2%"
        },
        {
            data: "NIM",
            "targets": 1
        },
        {
            data: "Nama",
            "targets": 2
        },
        {
            data: "Program_studi",
            "targets": 3
        },
        {
            data: "IPK",
            "targets": 4
        },
        {
            data: "Status",
            "targets": 5
        },
        {
            data: { NIM: "NIM" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenal=\"" + data.NIM + "\" class=\"btn bg-blue modalform\" style=\"margin : auto;\"><i class='fas fa-check-circle'></i></button>";
                var actButt2 = "<button idpengenal=\"" + data.NIM + "\" class=\"btn bg-red float-right tolak\" style=\"margin : auto;\"><i class='fas fa-times-circle'></i></button>";
                return actButt + actButt2;
                // return actButt2;
            },
            "targets": 6,
            "width": "10%"
        },
        ],
        order: [0, 'asc']
    });

    //Edit Data
    $('#daftarregistrasimahasiswa tbody').on('click', '.modalform', function () {
        var IDMahasiswa = $(this).attr('idpengenal');

        Swal.fire({
            title: 'Verifikasi Data!',
            icon: 'warning',
            text: 'Apakah Anda Yakin Memeverifikasi Data Mahasiswa ini?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: globalUrl + "/getdetailRegistrasiMahasiswa",
                    data: {
                        ID: IDMahasiswa,
                    },
                    datatype: 'json',
                    success: function (d) {
                        console.log(d.data);
                        document.getElementById('namamahasiswa').value = d.data.Nama;
                        document.getElementById('NIM').value = d.data.IDPengenal;
                        document.getElementById('Email').value = d.data.Email;
                        document.getElementById('tlp').value = d.data.Telephone;
                        document.getElementById('prodi').value = d.data.ProgramStudi;
                        document.getElementById('IPK').value = d.data.IPK;
                    }
                });
                $('#modal-form2').modal();
            }
        });
    });

    //Tolak Data
    //Menghapus Data
    $('#daftarregistrasimahasiswa tbody').on('click', '.tolak', function () {
        var IDp = $(this).attr('idpengenal');

        Swal.fire({
            title: 'Hapus Data!',
            icon: 'warning',
            text: 'Apakah Anda Yakin Menghapus Data Registrasi Mahasiswa?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: globalUrl + "/deleteRegistrasimahasiswa",
                    type: "POST",
                    data: {
                        ID: IDp,
                    },
                    success: function (r) {
                        // console.log(r.status);
                        daftarMahasiswa.ajax.reload();
                        if (r.status) {
                            Swal.fire(
                                'Deleted!',
                                'Anda Berhasil Menghapus Data Registrasi Mahasiswa',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal',
                                'Gagal Menghapus Data Registrasi Mahasiswa',
                                'error'
                            )
                        }
                    }
                });
            }
        })
    });

});


