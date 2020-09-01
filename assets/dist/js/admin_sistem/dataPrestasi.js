var currUrl = window.location.href.split('/');
//Menghapus path dataPrestasi/09021181621099/2020
currUrl.pop();
currUrl.pop();
currUrl.pop();
var globalUrl = currUrl.join('/');

var tahun = new Date().getFullYear();
var IDuser = location.pathname.split('/')[4];
var tahun = location.pathname.split('/')[5];

var tes = globalUrl + '/getDataPrestasi/' + IDuser + "/" + tahun;
console.log(tes);

var DataP;

$(document).ready(function () {
    // tabeld(tahun); //menjalankan table default saat pertama kali menu dipilih
    DataP = $('#DataPrestasi').DataTable({
        ajax: {
            url: globalUrl + '/getDataPrestasi/' + IDuser + "/" + tahun,
            type: 'POST',
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "Bidang",
            "targets": 1
        },
        {
            data: "Pencapaian",
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
            data: "JumlahPeserta",
            "targets": 7
        },
        {
            data: "JumlahPenghargaan",
            "targets": 8
        },
        {
            data: "Skor",
            "targets": 9
        },
        ],
        order: [0, 'asc']
    });
});

//Table Default berdasarkan tahun saat ini dan seluruh fakultas
// function tabeld(tahun) {

//     DataP = $('#DataPrestasi').DataTable({
//         ajax: {
//             url: globalUrl + '/getDataPrestasi/' + tahun,
//             type: 'POST',
//             data: function (d) { }
//         },
//         columns: [{
//             data: "no",
//             "targets": 0
//         },
//         {
//             data: "NIM",
//             "targets": 1
//         },
//         {
//             data: "Nama",
//             "targets": 2
//         },
//         {
//             data: "Fakultas",
//             "targets": 3
//         },
//         {
//             data: "Prodi",
//             "targets": 4
//         },
//         {
//             data: "Skor",
//             "targets": 5
//         },
//         {
//             data: "Skor",
//             "targets": 6
//         },
//         {
//             data: "Skor",
//             "targets": 7
//         },
//         {
//             data: "Skor",
//             "targets": 8
//         },
//         {
//             data: "Skor",
//             "targets": 9
//         },
//         ],
//         order: [0, 'asc']
//     });
// }