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
    prestasiM = $('#peringkatM').DataTable({
        ajax: {
            url: globalUrl + '/getpringkatM',
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


    //Filter Prestasi
    $('#filterperingkat').click(function (e) {

        var tahun = document.getElementById("tahun");   //select ID Tahun
        var selecttahun = tahun.options[tahun.selectedIndex].value;  //get value berdasarkan index yang dipilih
        // console.log(selecttahun);

        var fakultas = document.getElementById("fakultas"); //select ID Fakultas
        var selectfakultas = fakultas.options[fakultas.selectedIndex].value; //get value berdasarkan index yang dipilih
        // console.log(selectfakultas);

        $('#peringkatM').dataTable().fnDestroy();
        prestasiM = $('#peringkatM').DataTable({
            ajax: {
                url: globalUrl + '/FilterPeringkatM/' + selecttahun + "/" + selectfakultas,
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
        prestasiM = $('#peringkatM').DataTable({
            ajax: {
                url: globalUrl + '/getpringkatM',
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
    });
});