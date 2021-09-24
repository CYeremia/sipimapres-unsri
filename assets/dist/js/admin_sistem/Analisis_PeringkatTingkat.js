var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;
document.getElementById("tahun2").innerHTML = options;

document.getElementById("tahun").value = "Tahun";
document.getElementById("tahun2").value = "Tahun";
// document.getElementById("fakultas").value = "Pilih Fakultas";


var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
var daftarP;
var daftarPM;

//tabel default
function tabel(start, end) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/peringkattingkat/' + start + '/' + end,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            // {
            //     data: "No",
            //     "target": 0
            // },
            {
                data: "Tingkat",
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
        order: [3, 'Dsc']
    });

    
}



$(document).ready(function () {

    tabel(end, end);
});


//on click apply filter
$('#filter').click(function (e) {

    var startindex = document.getElementById("tahun");
    var start = startindex.options[startindex.selectedIndex].value;
    var endindex = document.getElementById("tahun2");
    var end = endindex.options[endindex.selectedIndex].value;

    if (start == "Tahun") //jika tidak memilih tahun
    {
        start = new Date().getFullYear();
    }

    if (end == "Tahun") //jika tidak memilih tahun
    {
        end = new Date().getFullYear();
    }
    $('#perestasikompetisi').dataTable().fnDestroy();
    tabel(start, end);
});

//on click reset filter
$('#resetfilter').click(function (e) {

    $('#perestasikompetisi').dataTable().fnDestroy();
    // $('#perestasikompetisimahasiswa').dataTable().fnDestroy();

    document.getElementById("tahun").value = "Tahun";
    document.getElementById("tahun2").value = "Tahun";
    // document.getElementById("fakultas").value = "Pilih Fakultas";

    tabel(end, end);
});

