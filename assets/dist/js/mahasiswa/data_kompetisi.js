var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var DataAnggota;

$(document).ready(function () {
    bsCustomFileInput.init();

    $('#tanggal').datetimepicker({
        format: 'MM-DD-YYYY'
    });
    $('#tanggal2').datetimepicker({
        format: 'MM-DD-YYYY'
    });

    //Pemilihan Kategori Lomba
    $('#Kategori').on('change', function () {
        var selected = $(this).val();

        if (selected == 'Kelompok') {
            $("#dataanggota").show();
        } else {
            $("#dataanggota").hide();
        }
    });

    $('#TambahData').on('click', function (e) {
        $('#modal-form2').modal();
    });

    //Table Anggota
    DataAnggota = $('#anggotaKelompok').DataTable({
        "lengthChange": false,
        "searching": false,
        ajax: {
            url: globalUrl + '/',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "Nim",
            "orderable": false,
            "targets": 0
        },
        {
            data: "Nama",
            "orderable": false,
            "targets": 1
        },
        {
            data: { NIM: "nim" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenald=\"" + data.NIM + "\" class=\"btn bg-red float-right deletedata\" ><i class='fas fa-trash-alt'></i></button>";
                return actButt;
            },
            "targets": 2,
            "width": "10%"
        },
        ],
        order: [[0, 'asc']],
    });

});


// var start = 2000;
// var end = new Date().getFullYear();
// var options = "";

// options += "<option selected disabled>Tahun</option>";
// for (var year = end; year >= start; year--) {
//     options += "<option>" + year + "</option>";
// }
// document.getElementById("tahun").innerHTML = options;



