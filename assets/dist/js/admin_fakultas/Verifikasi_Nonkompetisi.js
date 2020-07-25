var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var verifikasi_Nonkompetisi;

$(document).ready(function () {

    verifikasi_Nonkompetisi = $('#verifikasinon_kompetisi').DataTable({
        ajax: {
            url: globalUrl + '/getdataprestasinonkompetisi',
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
            data: "Kegiatan",
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
            data: { NIM: "NIM" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenal=\" " + data.NIM + "\" class=\"btn bg-blue detaildata\" style=\"margin : auto;\">Ubah Status</button>";
                return actButt;
            },
            "targets": 7,
            "width": "10%"
        },

        // {
        //     "className": 'details-control',
        //     "data": null,
        //     "orderable": false,
        //     "defaultContent": '',
        //     "targets": 9,
        //     "width": "5%"
        // },
        ],
        order: [[0, 'asc']],
    });

    //Get data detail
    $('#verifikasinon_kompetisi tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = verifikasi_Nonkompetisi.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row (the format() function would return the data to be shown)
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

});

//Row Child
function format(d) {
    return '<div class="slider">' +
        '<table class="table table-striped">' +
        '<tr>' +
        '<td style="width: 10%" colspan="3">' +
        '<h4 style="display: inline-block; top: 10px;"><b>Detail Tiket</b></h4>' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Nama Mahasiswa</td>' +
        '<td>' + d.Nama + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">NIM</td>' +
        '<td>' + d.PeraihPrestasi + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Bidang</td>' +
        '<td>' + d.Bidang + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Perlombaan</td>' +
        '<td>' + d.Perlombaan + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tahun</td>' +
        '<td>' + d.Tahun + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Penyelenggara</td>' +
        '<td>' + d.Penyelenggara + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Kategori</td>' +
        '<td>' + d.Kategori + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tingkat</td>' +
        '<td>' + d.Tingkat + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Pencapaian</td>' +
        '<td>' + d.Pencapaian + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Status</td>' +
        '<td>' + d.Status + '</td>' +
        '</tr>' +
        '<td style="width: 15%">Bukti Prestasi</td>' +
        '<td><img onclick="BuktiPrestasi(\'' + d.BuktiPrestasi + '\')" style="width:200px" src="' + url + d.BuktiPrestasi + '"></td>' +
        '</tr>' +
        // '<tr>' +
        // '<td style="width: 15%">Status</td>' +
        // '<td>' + d.Status + '</td>' +
        // '</tr>' +
        '</table></div>';
}



