var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

// console.log(globalUrl);

//Menampilkan Seleksi Tahun
var start = 2000;
var end = new Date().getFullYear();
var options = "";
var daftarP;

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;

document.getElementById("tahun2").innerHTML = options;

//Show pilih bidang berdasarkan jenis bidang
$('#jenisprestasi').on('change', function () {
    // Set selected option as variable
    var selectValue = $(this).val();
    // console.log(selectValue);

    var bidangselect;
    $.ajax({
        type: 'POST',
        url: globalUrl + '/getdataselect',
        data: {
            pilihan: selectValue,
        },
        dataType: 'json',
        success: function (response) {
            // console.log(response.data[0].Bidang);

            // Empty the target field
            $('#pilihan_bidang').empty();
            // <option selected disabled>Pilih Jenis Prestasi</option>
            $('#pilihan_bidang').append("<option selected disabled'>Pilih Jenis Prestasi</option>");
            for (i = 0; i < response.data.length; i++) {
                // Output choice in the target field
                $('#pilihan_bidang').append("<option value='" + response.data[i].Bidang + "'>" + response.data[i].Bidang + "</option>");
            }

        }
    });

});

//tabel default
function tabel(start,end)
{
//tabel peringkat fakultas berdasarkan prestasi
daftarP = $('#perestasikompetisi').DataTable({
    ajax: {
        url: globalUrl + '/peringkatbidang/'+start+'/'+end,
        type: 'POST',
        data: function (d) { }
    },
    columns: [{
        data: "No",
        "targets": 0
    },
    {
        data: "Bidang",
        "targets": 1
    },
    {
        data: {Total : "Total", Bidang : "Bidang"},
        "render": function(data, type, full, meta){
            if(type === 'display'){
                data = '<a href="daftarPrestasi_Fakultas/' + start + '-'+end+'-'+data.Bidang+'">' + data.Total + '</a>';
            }

            return data;
         },
        "targets": 2
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

    var jenisprestasiindex = document.getElementById("jenisprestasi"); //select ID jenis prestasi
    var jenisprestasi = jenisprestasiindex.options[jenisprestasiindex.selectedIndex].value; //get value berdasarkan index yang dipilih

    console.log(jenisprestasi);

    if(jenisprestasiindex.selectedIndex == 0) //tidak memilih jenis prestasi
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        tabel(start,end); //panggil tabel
    }
    else //ketika memilih jenis prestasi
    {   
        $('#perestasikompetisi').dataTable().fnDestroy();
        satuperingkatfakultasprestasi(start,end,fakultas); //panggil tabel
    }

});

//on click reset filter
$('#resetfilter').click(function (e) {

    $('#perestasikompetisi').dataTable().fnDestroy();


    document.getElementById("tahun").value="Tahun";
    document.getElementById("tahun2").value="Tahun";
    document.getElementById("fakultas").value="Pilih Fakultas";

    tabel(end,end);
});