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
            data: "JumlahPeserta",
            "targets": 8
        },
        {
            data: "JumlahPenghargaan",
            "targets": 9
        },
        {
            data: "Skor",
            "targets": 10
        },
        ],
        order: [0, 'asc']
    });
});
