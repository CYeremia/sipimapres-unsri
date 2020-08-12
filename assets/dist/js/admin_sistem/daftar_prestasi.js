var currUrl = window.location.href.split('/');

var data = currUrl[6]; //parameter
var year = data.split('-');

var start = year[0];
var end = year[1];
var fakultas = year[2];

currUrl.pop();
currUrl.pop();
var globalUrl = currUrl.join('/');

var daftarP;

$(document).ready(function () {
    daftarP = $('#daftarPrestasi').DataTable({
        ajax: {
            url: globalUrl + '/prestasifakultas/'+start+'/'+end+'/'+fakultas,
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
            data: "Tahun",
            "targets": 3
        },
        {
            data: "Penyelenggara",
            "targets": 4
        },
        {
            data: "Kategori",
            "targets": 5
        },
        {
            data: "Tingkat",
            "targets": 6
        },
        {
            data: "Pencapaian",
            "targets": 7
        },
        ],
        order: [0, 'asc']
    });

});