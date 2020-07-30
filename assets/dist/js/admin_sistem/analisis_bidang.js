var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

// console.log(globalUrl);

//Menampilkan Seleksi Tahun
var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;

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

