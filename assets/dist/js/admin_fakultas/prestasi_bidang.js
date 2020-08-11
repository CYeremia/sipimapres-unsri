var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var daftarB;

$(document).ready(function () {
    // daftarB = $('#daftarBidang').DataTable({
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
    //         data: "Nama",
    //         "targets": 1
    //     },
    //     {
    //         data: "NIM",
    //         "targets": 2
    //     },
    //     {
    //         data: "Fakultas",
    //         "targets": 3
    //     },
    //     {
    //         data: "Prodi",
    //         "targets": 4
    //     },
    //     {
    //         data: "Tahun",
    //         "targets": 5
    //     },
    //     {
    //         data: "Penyelenggara",
    //         "targets": 6
    //     },
    //     {
    //         data: "Kategori",
    //         "targets": 7
    //     },
    //     {
    //         data: "Tingkat",
    //         "targets": 8
    //     },
    //     {
    //         data: "Pencapaian",
    //         "targets": 9
    //     },
    //     ],
    //     order: [0, 'asc']
    // });

});