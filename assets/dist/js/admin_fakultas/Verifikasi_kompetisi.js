var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

// console.log(globalUrl);

var verifikasi_kompetisi;

$(document).ready(function () {

    verifikasi_kompetisi = $('#verifikasiKompetisi').DataTable({
        ajax: {
            url: globalUrl + '/getdataprestasikompetisi',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "NIM",
            "targets": 1
        },
        {
            data: "Nama",
            "targets": 2,
        },
        {
            data: "Prodi",
            "targets": 3
        },
        {
            data: "Judul lomba",
            "targets": 4
        },
        {
            data: "Penyelenggara",
            "targets": 5
        },
        {
            data: "Status",
            "targets": 6
        },
        {
            data: { ID: "ID" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idprestasi=\"" + data.ID + "\" class=\"btn bg-blue detaildata\" style=\"margin : auto;\">Ubah Status</button>";
                return actButt;
            },
            "targets": 7,
            "width": "10%"
        },
        ],
        order: [[0, 'asc']],
    });

    //Get data detail
    $('#verifikasiKompetisi tbody').on('click', '.detaildata', function () {
        var IDp = $(this).attr('idprestasi');

        Swal.fire({
            title: 'Apakah Anda Yakin Mengubah Status Prestasi?',
            // text: "Menambahkan Data Prestasi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(globalUrl + "/Verifikasi_statuskompetisi/" + IDp);
            }
        })
    });
});




