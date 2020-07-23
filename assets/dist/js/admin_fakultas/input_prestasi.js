var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var inputPrestasi;

$(document).ready(function () {

    inputPrestasi = $('#inputPrestasi').DataTable({
        ajax: {
            url: globalUrl + '/data_mahasiswa',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "no",
            "targets": 0,
            "width": "5%"
        },
        {
            data: "NIM",
            "targets": 1,
            "width": "5%"
        },
        {
            data: "Nama",
            "targets": 2,
            "width": "5%"
        },
        {
            data: "Program_Studi",
            "targets": 3,
            "width": "5%"
        },
        {
            data: { NIM: "NIM" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenal=\" " + data.NIM + "\" class=\"btn bg-blue detaildata\" style=\"margin : auto;\">Input Data</button>";
                return actButt;
            },
            "targets": 4,
            "width": "5%"
        },
        ],
        order: [[0, 'asc']],
    });

    //Get data detail
    $('#inputPrestasi tbody').on('click', 'detaildata', function () {
        var IDp = $(this).attr('idpengenal');

        swal({
            title: "Anda Yakin Akan melakukan Input Data?",
            // text: "Data akan di Edit?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#18a15f",
            confirmButtonText: "Ya, saya yakin",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                detaildataM(IDp)
            }
        });
    });

});

function detaildataM(IDp) {

    $.ajax({

        type: 'POST',
        url: globalUrl + "/getdataMahasiswa",
        data: {
            ID: IDp,
        },
        success: function (response) {
            console.log(response);
            swal.close();
            document.getElementById('Symtomp').value = response.data[0].Symptom;
            document.getElementById('bobot').value = response.data[0].Point;

            document.getElementById('id_modal').value = response.data[0].BotButtonID;
            $('#modal-form2').modal();


        }
    });
}

//Row Child
function format(d) {
    return '<div class="slider">' +
        '<table class="table table-striped">' +
        '<tr>' +
        '<td style="width: 10%" colspan="3">' +
        '<h4 style="display: inline-block; top: 10px;"><b>Detail Tiket</b></h4>' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Nama Mahasiswa</td>' +
        '<td>' + d.Nama + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">NIM</td>' +
        '<td>' + d.PeraihPrestasi + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Bidang</td>' +
        '<td>' + d.Bidang + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Perlombaan</td>' +
        '<td>' + d.Perlombaan + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tahun</td>' +
        '<td>' + d.Tahun + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Penyelenggara</td>' +
        '<td>' + d.Penyelenggara + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Kategori</td>' +
        '<td>' + d.Kategori + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tingkat</td>' +
        '<td>' + d.Tingkat + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Pencapaian</td>' +
        '<td>' + d.Pencapaian + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Status</td>' +
        '<td>' + d.Status + '</td>' +
        '</tr>' +
        '<td style="width: 15%">Bukti Prestasi</td>' +
        '<td><img onclick="BuktiPrestasi(\'' + d.BuktiPrestasi + '\')" style="width:200px" src="' + url + d.BuktiPrestasi + '"></td>' +
        '</tr>' +
        // '<tr>' +
        // '<td style="width: 15%">Status</td>' +
        // '<td>' + d.Status + '</td>' +
        // '</tr>' +
        '</table></div>';
}



