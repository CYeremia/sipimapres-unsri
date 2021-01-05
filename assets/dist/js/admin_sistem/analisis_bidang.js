var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

// console.log(globalUrl);

//Menampilkan Seleksi Tahun
var start = 2000;
var end = new Date().getFullYear();
var options = "";
var daftarP;

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;

document.getElementById("tahun2").innerHTML = options;

//Show pilih bidang berdasarkan jenis bidang
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
            $('#pilihan_bidang').append("<option disabled='disabled' SELECTED>Pilih Bidang</option>");
            for (i = 0; i < response.data.length; i++) {
                // Output choice in the target field
                $('#pilihan_bidang').append("<option value='" + response.data[i].Bidang + "'>" + response.data[i].Bidang + "</option>");
            }

        }
    });

});

//tabel default
function tabel(start, end) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/peringkatbidang/' + start + '/' + end,
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0
        },
        {
            data: "Bidang",
            "targets": 1
        },
        {
            data: { Total: "Total", Bidang: "Bidang" },
            "render": function (data, type, full, meta) {
                if (type === 'display') {

                    var bidang = data.Bidang;

                    //mengubah special character agar bisa lewat url
                    var length = (bidang.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        bidang = bidang.replace("(", "{");
                    }

                    length = (bidang.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        bidang = bidang.replace(")", "}");
                    }

                    var length = (bidang.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        bidang = bidang.replace("/", "~");
                    }

                    length = (bidang.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        bidang = bidang.replace(",", "`");
                    }

                    data = '<a href="Prestasi_Bidang/' + start + '-' + end + '-' + bidang + '">' + data.Total + '</a>';
                }

                return data;
            },
            "orderable": false,
            "targets": 2
        },
        ],
        order: [0, 'asc']
    });
}

//tabel berdasarkan jenis prestasi
function tabeljenisprestasi(start, end, jenisprestasi) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/prestasibidangjenisprestasi/' + start + '/' + end + '/' + jenisprestasi,
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0
        },
        {
            data: "Bidang",
            "targets": 1
        },
        {
            data: { Total: "Total", Bidang: "Bidang" },
            "render": function (data, type, full, meta) {
                if (type === 'display') {

                    var bidang = data.Bidang;

                    //mengubah special character agar bisa lewat url
                    var length = (bidang.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        bidang = bidang.replace("(", "{");
                    }

                    length = (bidang.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        bidang = bidang.replace(")", "}");
                    }

                    var length = (bidang.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        bidang = bidang.replace("/", "~");
                    }

                    length = (bidang.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        bidang = bidang.replace(",", "`");
                    }

                    data = '<a href="Prestasi_Bidang/' + start + '-' + end + '-' + bidang + '">' + data.Total + '</a>';
                }

                return data;
            },
            "orderable" : false,
            "targets": 2
        },
        ],
        order: [0, 'asc']
    });
}


function tabeljenisbidang(start, end, jenisbidang) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/prestasibidangjenisbidang/' + start + '/' + end + '/' + jenisbidang,
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "No",
            "targets": 0
        },
        {
            data: "Bidang",
            "targets": 1
        },
        {
            data: { Total: "Total", Bidang: "Bidang" },
            "render": function (data, type, full, meta) {
                if (type === 'display') {

                    var bidang = data.Bidang;

                    //mengubah special character agar bisa lewat url
                    var length = (bidang.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        bidang = bidang.replace("(", "{");
                    }

                    length = (bidang.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        bidang = bidang.replace(")", "}");
                    }

                    var length = (bidang.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        bidang = bidang.replace("/", "~");
                    }

                    length = (bidang.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        bidang = bidang.replace(",", "`");
                    }

                    data = '<a href="Prestasi_Bidang/' + start + '-' + end + '-' + bidang + '">' + data.Total + '</a>';
                }

                return data;
            },
            "orderable" : false,
            "targets": 2
        },
        ],
        order: [0, 'asc']
    });
}


$(document).ready(function () {

    tabel(end, end);

});


//on click apply filter
$('#filter').click(function (e) {

    var startindex = document.getElementById("tahun");
    var start = startindex.options[startindex.selectedIndex].value;
    var endindex = document.getElementById("tahun2");
    var end = endindex.options[endindex.selectedIndex].value;

    if (start == "Tahun") //jika tidak memilih tahun
    {
        start = new Date().getFullYear();
    }

    if (end == "Tahun") //jika tidak memilih tahun
    {
        end = new Date().getFullYear();
    }

    var jenisprestasiindex = document.getElementById("jenisprestasi"); //select ID jenis prestasi
    var jenisprestasi = jenisprestasiindex.options[jenisprestasiindex.selectedIndex].value; //get value berdasarkan index yang dipilih

    if (jenisprestasiindex.selectedIndex == 0) //tidak memilih jenis prestasi
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        tabel(start, end); //panggil tabel
    }
    else //ketika memilih jenis prestasi
    {
        var jenisbidangindex = document.getElementById("pilihan_bidang"); //Select ID Jenisbidang

        if (jenisbidangindex.selectedIndex == 0) //ketika jenis bidang tidak dipilih
        {
            $('#perestasikompetisi').dataTable().fnDestroy();
            tabeljenisprestasi(start, end, jenisprestasi);
        }

        else if (jenisbidangindex.selectedIndex != 0) //ketika jenis bidang dipilih
        {
            var jenisbidang = jenisbidangindex.options[jenisbidangindex.selectedIndex].value; //get value berdasarkan index yang dipilih

            var length = (jenisbidang.split('/').length - 1);

            for (var i = 0; i < length; i++) {
                jenisbidang = jenisbidang.replace("/", "~");
            }

            var length = (jenisbidang.split(',').length - 1);

            for (var i = 0; i < length; i++) {
                jenisbidang = jenisbidang.replace(",", "`");
            }

            length = (jenisbidang.split('(').length - 1);

            for (var i = 0; i < length; i++) // replace ( menjadi {
            {
                jenisbidang = jenisbidang.replace("(", "{");
            }

            length = (jenisbidang.split(')').length - 1);

            for (var i = 0; i < length; i++) //replace ) menjadi }
            {
                jenisbidang = jenisbidang.replace(")", "}");
            }

            //panggil tabel

            $('#perestasikompetisi').dataTable().fnDestroy();
            tabeljenisbidang(start, end, jenisbidang);
        }
    }
});

//on click reset filter
$('#resetfilter').click(function (e) {

    $('#perestasikompetisi').dataTable().fnDestroy();

    document.getElementById("tahun").value = "Tahun";
    document.getElementById("tahun2").value = "Tahun";
    document.getElementById("jenisprestasi").value = "Pilih Jenis Prestasi";
    document.getElementById("pilihan_bidang").value = "Pilih Bidang";

    tabel(end, end);
});