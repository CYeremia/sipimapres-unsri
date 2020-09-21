var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;
document.getElementById("tahun2").innerHTML = options;

document.getElementById("tahun").value = "Tahun";
document.getElementById("tahun2").value = "Tahun";
document.getElementById("fakultas").value = "Pilih Fakultas";


var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
var daftarP;

//tabel default
function tabel(start, end) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/peringkatfakultasprestasi/' + start + '/' + end,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            // {
            //     data: "No",
            //     "target": 0
            // },
            {
                data: "Fakultas",
                "targets": 0
            },
            {
                data: "PrestasiKompetisi",
                "targets": 1
            },
            {
                data: "PrestasiNonKompetisi",
                "targets": 2
            },
            {
                data: { Total: "Total", Fakultas: "Fakultas" },
                "render": function (data, type, full, meta) {

                    var fakultas = data.Fakultas;

                    //mengubah special character agar bisa lewat url
                    var length = (fakultas.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        fakultas = fakultas.replace("(", "{");
                    }

                    length = (fakultas.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        fakultas = fakultas.replace(")", "}");
                    }

                    length = (fakultas.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        fakultas = fakultas.replace(",", "`");
                    }

                    length = (fakultas.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        fakultas = fakultas.replace("/", "~");
                    }

                    // if (type === 'display') {
                    // }
                    data = '<a href="daftarPrestasi_Fakultas/' + start + '-' + end + '-' + fakultas + '">' + data.Total + '</a>';
                    return data;
                },
                // "orderable": false,
                // width: '10',
                "targets": 3
            },
        ],
        order: [3, 'Dsc']
    });

    //tabel peringkat fakultas berdasarkan jumlah mahasiswa
    daftarP = $('#perestasikompetisimahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/peringkatfakultasmahasiswa/' + start + '/' + end,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "Fakultas",
                "targets": 0
            },
            {
                data: { TotalMahasiswa: "TotalMahasiswa", Fakultas: "Fakultas" },
                "render": function (data, type, full, meta) {


                    var fakultas = data.Fakultas;

                    //mengubah special character agar bisa lewat url
                    var length = (fakultas.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        fakultas = fakultas.replace("(", "{");
                    }

                    length = (fakultas.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        fakultas = fakultas.replace(")", "}");
                    }

                    length = (fakultas.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        fakultas = fakultas.replace(",", "`");
                    }

                    length = (fakultas.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        fakultas = fakultas.replace("/", "~");
                    }

                    // if (type === 'display') {
                    // }
                    data = '<a href="daftarPrestasi_Mahasiswa/' + start + '-' + end + '-' + fakultas + '">' + data.TotalMahasiswa + '</a>';
                    return data;
                },
                // "orderable": false,
                "targets": 1
            },
        ],
        order: [1, 'Dsc']
    });
}

//tabel peringkat fakultas berdasarkan prestasi (hanya satu fakultas)
function satuperingkatfakultasprestasi(start, end, fakultas) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/satuperingkatfakultasprestasi/' + start + '/' + end + '/' + fakultas,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "Fakultas",
                "targets": 0
            },
            {
                data: "PrestasiKompetisi",
                "targets": 1
            },
            {
                data: "PrestasiNonKompetisi",
                "targets": 2
            },
            {
                data: { Total: "Total", Fakultas: "Fakultas" },
                "render": function (data, type, full, meta) {

                    var fakultas = data.Fakultas;

                    //mengubah special character agar bisa lewat url
                    var length = (fakultas.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        fakultas = fakultas.replace("(", "{");
                    }

                    length = (fakultas.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        fakultas = fakultas.replace(")", "}");
                    }

                    length = (fakultas.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        fakultas = fakultas.replace(",", "`");
                    }

                    length = (fakultas.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        fakultas = fakultas.replace("/", "~");
                    }

                    // if (type === 'display') {
                    // }
                    data = '<a href="daftarPrestasi_Fakultas/' + start + '-' + end + '-' + fakultas + '">' + data.Total + '</a>';
                    return data;
                },
                // "orderable": false,
                "targets": 3
            },
        ],
        order: [3, 'Dsc']
    });

    //tabel peringkat fakultas berdasarkan jumlah mahasiswa
    daftarP = $('#perestasikompetisimahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/satuperingkatfakultasmahasiswa/' + start + '/' + end + '/' + fakultas,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "Fakultas",
                "targets": 1
            },
            {
                data: { TotalMahasiswa: "TotalMahasiswa", Fakultas: "Fakultas" },
                "render": function (data, type, full, meta) {

                    var fakultas = data.Fakultas;

                    //mengubah special character agar bisa lewat url
                    var length = (fakultas.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        fakultas = fakultas.replace("(", "{");
                    }

                    length = (fakultas.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        fakultas = fakultas.replace(")", "}");
                    }

                    length = (fakultas.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        fakultas = fakultas.replace(",", "`");
                    }

                    length = (fakultas.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        fakultas = fakultas.replace("/", "~");
                    }

                    // if (type === 'display') {
                    // }

                    data = '<a href="daftarPrestasi_Mahasiswa/' + start + '-' + end + '-' + fakultas + '">' + data.TotalMahasiswa + '</a>';
                    return data;
                },
                // "orderable": false,
                "targets": 2
            },
        ],
        order: [2, 'Dsc']
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

    console.log(start + " " + end);

    var fakultasindex = document.getElementById("fakultas"); //select ID Fakultas
    var fakultas = fakultasindex.options[fakultasindex.selectedIndex].value; //get value berdasarkan index yang dipilih

    if (fakultasindex.selectedIndex == 0) //tidak memilih fakultas apapun
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        $('#perestasikompetisimahasiswa').dataTable().fnDestroy();
        tabel(start, end); //panggil tabel
    }
    else //ketika memilih fakultas
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        $('#perestasikompetisimahasiswa').dataTable().fnDestroy();
        satuperingkatfakultasprestasi(start, end, fakultas); //panggil tabel
    }

});

//on click reset filter
$('#resetfilter').click(function (e) {

    $('#perestasikompetisi').dataTable().fnDestroy();
    $('#perestasikompetisimahasiswa').dataTable().fnDestroy();

    document.getElementById("tahun").value = "Tahun";
    document.getElementById("tahun2").value = "Tahun";
    document.getElementById("fakultas").value = "Pilih Fakultas";

    tabel(end, end);
});

