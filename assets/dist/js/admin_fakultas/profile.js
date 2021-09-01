var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

$(document).ready(function () {

    $('#profile tbody').on('click', '.editPassword', function () {
        var IDp = $(this).attr('id');

        Swal.fire({
            title: 'Apakah Anda Yakin Mengganti Password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya Yakin!'
        }).then((result) => {
            if (result.value) {
                EditPassword(IDp)

            }
        })
    });

    function EditPassword(IDp) {
        console.log(IDp);

        $.ajax({

            type: 'POST',
            url: globalUrl + "/getdataIDp",
            data: {
                ID: IDp,
            },
            success: function (response) {
                //console.log(response.data);
                //swal.close();
                // console.log(response.data.nik);
                document.getElementById('id_modal2').value = response.data[0].IDPengenal;

                $('#modal-form3').modal();


            }
        });
    }
});