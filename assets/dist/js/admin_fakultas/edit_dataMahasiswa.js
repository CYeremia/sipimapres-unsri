var currUrl = window.location.href.split('/');
var data = currUrl[6]; //parameter
currUrl.pop();
currUrl.pop();
var globalUrl = currUrl.join('/');

$(document).ready(function () {

    $.ajax({
        url: globalUrl + "/getdataProdi",
        type: 'POST',
        success: function (d) {
            // console.log(d.data.length);
            // lengthdata = d.data.length;
            for (var i = 0; i < d.data.length; i++) {
                $('#prodi').append("<option value='" + d.data[i].Prodi + "'>" + d.data[i].Prodi + "</option>");
            }
        }
    });

    $.ajax({
        type: "POST",
        url: globalUrl + "/getdetailMahasiswa",
        data: {
            ID: data,
        },
        datatype: 'json',
        success: function (d) {
            // console.log(d.data);
            document.getElementById('namaMahasiswa').value = d.data.Nama;
            document.getElementById('NIM').value = d.data.IDPengenal;
            document.getElementById('Email').value = d.data.Email;
            document.getElementById('IPK').value = d.data.IPK;
            document.getElementById('tlp').value = d.data.Telephone;
            document.getElementById('IDL').value = d.data.IDPengenal;
            $('#prodi').val(d.data.ProgramStudi);
        }
    });

});