var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
// console.log(globalUrl);


$(document).ready(function () {

    $.ajax({
        type: 'POST',
        url: globalUrl + '/getdataProdi',
        dataType: 'json',
        success: function (response) {
            // console.log(response.data);

            // Empty the target field
            $('#prodi').empty();
            $('#prodi').append("<option disabled='disabled' SELECTED>Pilih Program Studi</option>");
            for (i = 0; i < response.data.length; i++) {
                $('#prodi').append("<option value='" + response.data[i].Prodi + "'>" + response.data[i].Prodi + "</option>");
            }
        }
    });
});

