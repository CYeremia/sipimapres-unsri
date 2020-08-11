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
var daftarP;

//tabel default
function tabel(start,end)
{
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/peringkatfakultasprestasi/'+start+'/'+end,
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
            url: globalUrl + '/peringkatfakultasmahasiswa/'+start+'/'+end,
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

    tabel(end,end);

});


//on click apply filter
$('#filter').click(function (e) {

    var startindex = document.getElementById("tahun");
    var start = startindex.options[startindex.selectedIndex].value;
    var endindex = document.getElementById("tahun2");
    var end = endindex.options[endindex.selectedIndex].value;

    var fakultasindex = document.getElementById("fakultas"); //select ID Fakultas
    var fakultas = fakultasindex.options[fakultasindex.selectedIndex].value; //get value berdasarkan index yang dipilih

    if(fakultasindex.selectedIndex == 0) //tidak memilih fakultas apapun
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        $('#perestasikompetisimahasiswa').dataTable().fnDestroy();
        tabel(start,end);
    }
    else //ketika memilih fakultas
    {

    }



    console.log(start+end+fakultas);
    

});

//on click reset filter
$('#resetfilter').click(function (e) {

    $('#perestasikompetisi').dataTable().fnDestroy();
    $('#perestasikompetisimahasiswa').dataTable().fnDestroy();

    tabel(end,end);
});

