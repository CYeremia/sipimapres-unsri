var currUrl = window.location.href.split('/');

var data = currUrl[6]; //parameter
var year = data.split('-');

var start = year[0];
var end = year[1];
var prodi = year[2];

currUrl.pop();
currUrl.pop();
var globalUrl = currUrl.join('/');

var daftarP;

$(document).ready(function () {
    daftarP = $('#daftarPrestasi').DataTable({
        ajax: {
            url: globalUrl + '/prestasiprodi/'+start+'/'+end+'/'+prodi,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
        {
            data: "No",
            "targets": 0
        },
        {
            data: "Bidang",
            "targets": 1
        },
        {
            data: "Perlombaan",
            "targets": 2
        },
        {
            data: "TanggalMulai",
            "targets": 3
        },
        {
            data: "TanggalAkhir",
            "targets": 4
        },
        {
            data: "Penyelenggara",
            "targets": 5
        },
        {
            data: "Kategori",
            "targets": 6
        },
        {
            data: "Tingkat",
            "targets": 7
        },
        {
            data: "Pencapaian",
            "targets": 8
        },
        ],
        order: [0, 'asc']
    });

});