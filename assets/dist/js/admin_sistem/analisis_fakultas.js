var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;
document.getElementById("tahun2").innerHTML = options;

var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');


//tabel default
function tabel()
{
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/peringkatfakultasprestasi',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "Fakultas",
            "targets": 0
        },
        {
            data: "PrestasiKompetisi",
            "targets": 1
        },
        {
            data: "PrestasiNonKompetisi",
            "targets": 2
        },
        {
            data: "Total",
            "targets": 3
        },
        ],
        order: [0, 'asc']
    });

    //tabel peringkat fakultas berdasarkan jumlah mahasiswa
    daftarP = $('#perestasikompetisimahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/peringkatfakultasmahasiswa',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "Fakultas",
            "targets": 0
        },
        {
            data: "TotalMahasiswa",
            "targets": 1
        },
        ],
        order: [0, 'asc']
    });
}


$(document).ready(function () {

    tabel();

});


$('#filter').click(function (e) {

    var startindex = document.getElementById("tahun");
    var start = startindex.options[startindex.selectedIndex].value;
    var endindex = document.getElementById("tahun2");
    var end = endindex.options[endindex.selectedIndex].value;

    var fakultas = document.getElementById("fakultas"); //select ID Fakultas
    var selectfakultas = fakultas.options[fakultas.selectedIndex].value; //get value berdasarkan index yang dipilih

    console.log(start+end+selectfakultas);
    

});

$('#resetfilter').click(function (e) {

    // $('#perestasikompetisi').dataTable().fnDestroy();
    // $('#perestasikompetisimahasiswa').dataTable().fnDestroy();

    tabel();


});

