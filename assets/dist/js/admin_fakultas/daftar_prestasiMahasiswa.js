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
    daftarP = $('#daftarPrestasi_M').DataTable({
        ajax: {
            url: globalUrl + '/prestasimahasiswa/'+start+'/'+end+'/'+prodi,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
        {
            data: "No",
            "targets": 0
        },
        {
            data: "Nama",
            "targets": 1
        },
        {
            data: "PrestasiKompetisi",
            "targets": 2
        },
        {
            data: "PrestasiNonKompetisi",
            "targets": 3
        },
        {
            data: "Total",
            "targets": 4
        },
        ],
        order: [0, 'asc']
    });

});