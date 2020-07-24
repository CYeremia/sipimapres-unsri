var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var input_prestasi;

$(document).ready(function () {


    input_prestasi = $('#inputPrestasi').DataTable({
        ajax: {
            url: globalUrl + '/data_mahasiswa',
            type: 'POST',
            data: function (d) { 
            }
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "IDPengenal",
            "targets": 1
        },
        {
            data: "Nama",
            "targets": 2
        },
        {
            data: "ProgramStudi",
            "targets": 3
        },
        {
            data: { IDPengenal: "IDPengenal" },

            "render": function (data, type, full, meta) {
                var actButt = "<button idpengenal=\" " + data.IDPengenal + "\" class=\"btn bg-blue detaildata\" style=\"margin : auto;\">Input Data</button>";
                return actButt;
            },
            "targets": 4,
            "width": "20%"
        }

        ],
        order: [[0, 'asc']],
    });

    //Get data detail
    $('#inputPrestasi tbody').on('click', '.detaildata', function () {
        var IDp = $(this).attr('idpengenal');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                detaildataM(IDp)

            }
        })
    });

});

function detaildataM(IDp) {
    // alert(IDp);
    $.ajax({
        type: 'POST',
        url: globalUrl + "/getdataMahasiswa",
        data: {
            ID: IDp,
        },
        success: function (response) {
            console.log(response);
            swal.close();
            document.getElementById('namamahasiswa').value = response.data[0].Nama;
            document.getElementById('Nimmahasiswa').value = response.data[0].IDPengenal;
            document.getElementById('prodi').value = response.data[0].ProgramStudi;
            document.getElementById('fakultas').value = response.data[0].Fakultas;
            document.getElementById('Email').value = response.data[0].Email;
            document.getElementById('IPK').value = response.data[0].IPK;
            document.getElementById('Notlp').value = response.data[0].Telephone;


            document.getElementById('id_modal').value = response.data[0].IDPengenal;
            $('#modal-form2').modal();


        }
    });
}





