var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var daftarP;

$(document).ready(function () {
    // daftarP = $('#daftarPrestasi').DataTable({
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
    //         data: "Bidang",
    //         "targets": 1
    //     },
    //     {
    //         data: "Perlombaan",
    //         "targets": 2
    //     },
    //     {
    //         data: "Tahun",
    //         "targets": 3
    //     },
    //     {
    //         data: "Penyelenggara",
    //         "targets": 4
    //     },
    //     {
    //         data: "Kategori",
    //         "targets": 5
    //     },
    //     {
    //         data: "Tingkat",
    //         "targets": 6
    //     },
    //     {
    //         data: "Pencapaian",
    //         "targets": 7
    //     },
    //     ],
    //     order: [0, 'asc']
    // });

});