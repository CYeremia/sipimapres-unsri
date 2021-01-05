var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
// console.log(globalUrl);

var daftaru;

$(document).ready(function () {
    daftaru = $('#daftarmahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/getdataMahasiswa',
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
            data: "Email",
            "targets": 5
        },
        {
            data: "Telephone",
            "targets": 6
        },
        {
            data: { NIM: "NIM" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenal=\"" + data.NIM + "\" class=\"btn bg-blue editdata\" style=\"margin : auto;\"><i class='fas fa-user-edit'></i></button>";
                var actButt2 = "<button idpengenald=\"" + data.NIM + "\" class=\"btn bg-red float-right deletedata\" ><i class='fas fa-trash-alt'></i></button>";
                return actButt + actButt2;
            },
            "targets": 7,
            "width": "10%"
        },
        ],
        order: [0, 'asc']
    });

    //Menghapus Data
    $('#daftarmahasiswa tbody').on('click', '.deletedata', function () {
        var IDp = $(this).attr('idpengenald');

        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Data Mahasiswa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: globalUrl + "/deletemahasiswa",
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
    $('#daftarmahasiswa tbody').on('click', '.editdata', function () {
        var IDMahasiswa = $(this).attr('idpengenal');
        window.location.href = globalUrl + "/edit_DataMahasiswa/" + IDMahasiswa;

    });

});


