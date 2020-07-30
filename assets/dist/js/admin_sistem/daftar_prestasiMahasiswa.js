var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var daftarm;

$(document).ready(function () {
    // daftarm = $('#daftarPrestasi_M').DataTable({
    //     ajax: {
    //         url: globalUrl + '/',
    //         type: 'POST',
    //         data: function (d) { }
    //     },
    //     columns: [{
    //         data: "no",
    //         "targets": 0
    //     },
    //     {
    //         data: "Nama Mahasiswa",
    //         "targets": 1
    //     },
    //     {
    //         data: "Jumlah_Prestasik",
    //         "targets": 2
    //     },
    //     {
    //         data: "Jumlah_Prestasin",
    //         "targets": 3
    //     },
    //     {
    //         data: "Total",
    //         "targets": 4
    //     },
    //     ],
    //     order: [0, 'asc']
    // });

});