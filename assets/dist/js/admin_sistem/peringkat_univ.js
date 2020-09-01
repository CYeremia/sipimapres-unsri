var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;
// document.getElementById("tahun2").innerHTML = options;


var peringkatU;

$(document).ready(function () {
    tabeld(end); //menjalankan table default saat pertama kali menu dipilih
});

//Table Default berdasarkan tahun saat ini
function tabeld(end) {

    peringkatU = $('#peringkatUn').DataTable({
        ajax: {
            url: globalUrl + '/getpringkatU/' + end,
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
        {
            data: { NIM: "NIM" },

            "render": function (data, type, full, meta) {
                var actButt = "<center><a class='btn bg-blue' href='dataPrestasi/" + data.NIM + "/" + end + "'><i class='fas fa-search'></i></a>"//"<button idpengenal=\"" + data.NIM + "\" class=\"btn bg-blue editdata\" style=\"margin : auto;\"><i class='fas fa-user-edit'></i></button>";
                return actButt;
            },
            "targets": 5,
            "width": "5%"
        },
        ],
        order: [0, 'asc']
    });
}

//menampilkan filter data pada table berdasarkan tahun
// function selectedtahun(start) {
//     // console.log(end, selectfakultas);
//     peringkatU = $('#peringkatUn').DataTable({
//         ajax: {
//             url: globalUrl + '/getpringkatU/' + start,
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
//             data: { NIM: "NIM" },

//             "render": function (data, type, full, meta) {
//                 var actButt = "<center><a class='btn bg-blue' href='dataPrestasi/" + data.NIM + "/" + start + "'><i class='fas fa-search'></i></a>"//"<button idpengenal=\"" + data.NIM + "\" class=\"btn bg-blue editdata\" style=\"margin : auto;\"><i class='fas fa-user-edit'></i></button>";
//                 return actButt;
//             },
//             "targets": 5,
//             "width": "5%"
//         },
//         ],
//         order: [0, 'asc']
//     });
// }


//Filter Prestasi
$('#filterperingkat').click(function (e) {

    var tahun = document.getElementById("tahun");   //select ID Tahun
    var selecttahun = tahun.options[tahun.selectedIndex].value;  //get value berdasarkan index yang dipilih
    // console.log(selecttahun);

    if (tahun.selectedIndex == 0) { //tidak memilih Tahun
        $('#peringkatUn').dataTable().fnDestroy();
        selecttahun = new Date().getFullYear();
        tabeld(selecttahun); //panggil tabel
    } else {
        $('#peringkatUn').dataTable().fnDestroy();
        tabeld(selecttahun); //panggil tabel seleksi tahun
    }
});

//Reset Data Table Peringkat Mahasiswa
$('#resetperingkat').click(function (e) {

    //Reset tahun pada selected option
    $('#tahun option').prop('selected', function () {
        return this.defaultSelected;
    });

    $('#peringkatUn').dataTable().fnDestroy();
    tabeld(end);
});