var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
// console.log(globalUrl);

var daftarB;

$(document).ready(function () {
    daftarB = $('#daftarbidang').DataTable({
        // "bAutoWidth": false,
        ajax: {
            url: globalUrl + '/getbidang',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0,
            "width": "2%"
        },
        {
            data: "Jenis_Prestasi",
            "targets": 1,
            "width": "20%"
        },
        {
            data: "Nama_bidang",
            "targets": 2,
            "width": "65%"
        },
        {
            data: { IDPrestasi: "IDPrestasi" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idprestasi=\"" + data.IDPrestasi + "\" class=\"btn bg-blue editdata\" style=\"margin : auto;\"><i class='far fa-edit'></i></button>";
                var actButt2 = "<button idprestasi=\"" + data.IDPrestasi + "\" class=\"btn bg-red float-right deletedata\" style=\"margin : auto;\"><i class='fas fa-trash-alt'></i></button>";
                return actButt + actButt2;
            },
            "targets": 3,
            "width": "10%"
        },
        ],
        order: [0, 'asc']
    });

    // Menghapus Data
    $('#daftarbidang tbody').on('click', '.deletedata', function () {
        var IDp = $(this).attr('idprestasi');

        Swal.fire({
            title: 'Apakah Anda Yakin Menghapus Data Bidang?',
            // text: "Menambahkan Data Prestasi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: globalUrl + "/deletebidang",
                    type: "POST",
                    data: {
                        ID: IDp,
                    },
                    // console.log(result.value);
                    success: function (r) {
                        console.log(r.status);
                        daftarB.ajax.reload();
                        if (r.status) {
                            Swal.fire(
                                'Deleted!',
                                'Anda Berhasil Menghapus Data Bidang',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal',
                                'Gagal Menghapus Data Bidang',
                                'error'
                            )
                        }
                    }
                });
            }
        })
    });

    //Tambah Data
    $('#tambahdata').on('click', function () {
        $('#modal-form1').modal();
    });

    //Edit Data
    $('#daftarbidang tbody').on('click', '.editdata', function () {
        var IDp = $(this).attr('idprestasi');
        // console.log(IDp);

        Swal.fire({
            title: 'Apakah Anda Yakin Mengedit Data Bidang?',
            // text: "Menambahkan Data Prestasi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                Editdatabidang(IDp);
            }
        })
    });

});

function Editdatabidang(IDprestasi) {

    $.ajax({

        type: 'POST',
        url: globalUrl + "/getdatabidang",
        data: {
            ID: IDprestasi,
        },
        success: function (response) {

            document.getElementById('nama_bidang').value = response.data[0].Bidang;

            $('#Jalur_Pencapaian').empty();
            $('#Jalur_Pencapaian').append("<option selected value='" + response.data[0].JalurPencapaian + "'>" + response.data[0].JalurPencapaian + "</option>");

            var jenisPresasi = response.data[0].JalurPencapaian;

            if (jenisPresasi == "Kompetisi") {
                $('#Jalur_Pencapaian').append("<option value='Non Kompetisi'>Non Kompetisi</option>");
            } else {
                $('#Jalur_Pencapaian').append("<option value='Kompetisi'>Kompetisi</option>");
            }

            document.getElementById('id_modal').value = response.data[0].IDPrestasi;
            $('#modal-form2').modal();
        }
    });
}