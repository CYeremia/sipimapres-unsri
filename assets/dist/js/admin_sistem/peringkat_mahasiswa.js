var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

//Menampilkan Seleksi Tahun
var start = 2000;
var end = new Date().getFullYear();
var options = "";
var sel = "selected";

options += "<option selected='selected' disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;

var prestasiM;

$(document).ready(function () {
    tabeld(end); //menjalankan table default saat pertama kali menu dipilih
});

//Table Default berdasarkan tahun saat ini dan seluruh fakultas
function tabeld(tahun) {

    prestasiM = $('#peringkatM').DataTable({
        ajax: {
            url: globalUrl + '/getpringkatM/' + tahun,
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "NIM",
            "targets": 1
        },
        {
            data: "Nama",
            "targets": 2
        },
        {
            data: "Fakultas",
            "targets": 3
        },
        {
            data: "Prodi",
            "targets": 4
        },
        {
            data: "Skor",
            "targets": 5
        },
        ],
        order: [0, 'asc']
    });
}

//menampilkan filter data pada table berdasarkan tahun dan fakultas yang dipilih
function selectedtahun_fakultas(selecttahun, selectfakultas) {
    // console.log(end, selectfakultas);
    prestasiM = $('#peringkatM').DataTable({
        ajax: {
            url: globalUrl + '/FilterPeringkatM/' + selecttahun + '/' + selectfakultas,
            type: 'POST',
            data: {
                tahun: selecttahun,
                fakultas: selectfakultas,
            }
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "NIM",
            "targets": 1
        },
        {
            data: "Nama",
            "targets": 2
        },
        {
            data: "Fakultas",
            "targets": 3
        },
        {
            data: "Prodi",
            "targets": 4
        },
        {
            data: "Skor",
            "targets": 5
        },
        ],
        order: [0, 'asc']
    });
}


//Filter Prestasi
$('#filterperingkat').click(function (e) {

    var tahun = document.getElementById("tahun");   //select ID Tahun
    var selecttahun = tahun.options[tahun.selectedIndex].value;  //get value berdasarkan index yang dipilih
    // console.log(selecttahun);

    var fakultas = document.getElementById("fakultas"); //select ID Fakultas
    var selectfakultas = fakultas.options[fakultas.selectedIndex].value; //get value berdasarkan index yang dipilih
    // console.log(selectfakultas);
    console.log(globalUrl + '/FilterPeringkatM/' + end + "/" + selectfakultas);

    if (fakultas.selectedIndex == 0) { //tidak memilih fakultas
        $('#peringkatM').dataTable().fnDestroy();
        tabeld(selecttahun); //panggil tabel
    } else {
        $('#peringkatM').dataTable().fnDestroy();
        if (selecttahun == "Tahun") {
            selecttahun = new Date().getFullYear();
            selectedtahun_fakultas(selecttahun, selectfakultas); //panggil tabel seleksi tahun dan fakultas
        } else {
            selectedtahun_fakultas(selecttahun, selectfakultas); //panggil tabel seleksi tahun dan fakultas
        }

    }
});

//Reset Data Table Peringkat Mahasiswa
$('#resetperingkat').click(function (e) {

    //Reset tahun pada selected option
    $('#tahun option').prop('selected', function () {
        return this.defaultSelected;
    });

    //Reset fakultas pada selected option
    $('#fakultas option').prop('selected', function () {
        return this.defaultSelected;
    });

    $('#peringkatM').dataTable().fnDestroy();
    tabeld(end);
});
