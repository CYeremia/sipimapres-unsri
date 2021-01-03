var currUrl = window.location.href.split('/');

var start,end,bidang;

var data = currUrl[6]; //parameter
var split = data.split('-');

start = split[0];
end = split[1];
bidang = split[2];

console.log(bidang);

currUrl.pop();
currUrl.pop();
var globalUrl = currUrl.join('/');
var daftarB;

$(document).ready(function () {

    tabel(start,end,bidang);

});


function tabel(start,end,bidang)
{
    daftarB = $('#daftarBidang').DataTable({
        ajax: {
            url: globalUrl + '/prestasibidang/'+start+'/'+end+'/'+bidang,
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0
        },
        {
            data: "Nama",
            "targets": 1
        },
        {
            data: "NIM",
            "targets": 2
        },
        {
            data: "Fakultas",
            "targets": 3
        },
        {
            data: "ProgramStudi",
            "targets": 4
        },
        {
            data: "Perlombaan",
            "targets": 5
        },
        {
            data: "TanggalMulai",
            "targets": 6
        },
        {
            data: "TanggalAkhir",
            "targets": 7
        },
        {
            data: "Penyelenggara",
            "targets": 8
        },
        {
            data: "Kategori",
            "targets": 9
        },
        {
            data: "Tingkat",
            "targets": 10
        },
        {
            data: "Pencapaian",
            "targets": 11
        },
        ],
        order: [0, 'asc']
    });
}