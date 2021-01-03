var start = 2000;
var end = new Date().getFullYear();
var options = "";

options += "<option selected disabled>Tahun</option>";
for (var year = end; year >= start; year--) {
    options += "<option>" + year + "</option>";
}
document.getElementById("tahun").innerHTML = options;
document.getElementById("tahun2").innerHTML = options;

var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
var daftarP;

//tabel default
function tabel(start, end) {
    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/peringkatprodiprestasi/' + start + '/' + end,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "ProgramStudi",
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
                data: { Total: "Total", ProgramStudi: "ProgramStudi" },
                "render": function (data, type, full, meta) {

                    var prodi = data.ProgramStudi;

                    //mengubah special character agar bisa lewat url
                    var length = (prodi.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        prodi = prodi.replace("(", "{");
                    }

                    length = (prodi.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        prodi = prodi.replace(")", "}");
                    }

                    length = (prodi.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        prodi = prodi.replace(",", "`");
                    }

                    length = (prodi.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        prodi = prodi.replace("/", "~");
                    }

                    // if (type === 'display') {
                    // }
                    data = '<a href="daftarPrestasi_Prodi/' + start + '-' + end + '-' + prodi + '">' + data.Total + '</a>';
                    return data;
                },
                "orderable": false,
                "targets": 3
            },
        ],
        order: [3, 'dsc']
    });

    //tabel peringkat fakultas berdasarkan jumlah mahasiswa
    daftarP = $('#perestasikompetisimahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/peringkatprodimahasiswa/' + start + '/' + end,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "ProgramStudi",
                "targets": 0
            },
            {
                data: { TotalMahasiswa: "TotalMahasiswa", ProgramStudi: "ProgramStudi" },
                "render": function (data, type, full, meta) {
                    if (type === 'display') {

                        var prodi = data.ProgramStudi;

                        //mengubah special character agar bisa lewat url
                        var length = (prodi.split('(').length - 1);

                        for (var i = 0; i < length; i++) // replace ( menjadi {
                        {
                            prodi = prodi.replace("(", "{");
                        }

                        length = (prodi.split(')').length - 1);

                        for (var i = 0; i < length; i++) //replace ) menjadi }
                        {
                            prodi = prodi.replace(")", "}");
                        }

                        length = (prodi.split(',').length - 1);

                        for (var i = 0; i < length; i++) //replace , menjadi `
                        {
                            prodi = prodi.replace(",", "`");
                        }

                        length = (prodi.split('/').length - 1);

                        for (var i = 0; i < length; i++) //replace / menjadi ~
                        {
                            prodi = prodi.replace("/", "~");
                        }

                        data = '<a href="daftarPrestasi_Mahasiswa/' + start + '-' + end + '-' + prodi + '">' + data.TotalMahasiswa + '</a>';
                    }

                    return data;
                },
                "orderable": false,
                "targets": 1
            },
        ],
        order: [1, 'dsc']
    });
}

//tabel peringkat prodi berdasarkan prestasi (hanya satu prodi)
function satuperingkatprodiprestasi(start, end, prodi) {
    //mengubah special character agar bisa lewat url
    var length = (prodi.split('(').length - 1);

    for (var i = 0; i < length; i++) // replace ( menjadi {
    {
        prodi = prodi.replace("(", "{");
    }

    length = (prodi.split(')').length - 1);

    for (var i = 0; i < length; i++) //replace ) menjadi }
    {
        prodi = prodi.replace(")", "}");
    }

    length = (prodi.split(',').length - 1);

    for (var i = 0; i < length; i++) //replace , menjadi `
    {
        prodi = prodi.replace(",", "`");
    }

    length = (prodi.split('/').length - 1);

    for (var i = 0; i < length; i++) //replace / menjadi ~
    {
        prodi = prodi.replace("/", "~");
    }

    //tabel peringkat fakultas berdasarkan prestasi
    daftarP = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/satuperingkatprodiprestasi/' + start + '/' + end + '/' + prodi,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "ProgramStudi",
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
                data: { Total: "Total", ProgramStudi: "ProgramStudi" },
                "render": function (data, type, full, meta) {

                    var prodi = data.ProgramStudi;

                    //mengubah special character agar bisa lewat url
                    var length = (prodi.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        prodi = prodi.replace("(", "{");
                    }

                    length = (prodi.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        prodi = prodi.replace(")", "}");
                    }

                    length = (prodi.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        prodi = prodi.replace(",", "`");
                    }

                    length = (prodi.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        prodi = prodi.replace("/", "~");
                    }

                    // if (type === 'display') {
                    // }

                    data = '<a href="daftarPrestasi_Prodi/' + start + '-' + end + '-' + prodi + '">' + data.Total + '</a>';
                    return data;
                },
                "orderable": false,
                "targets": 3
            },
        ],
        order: [3, 'dsc']
    });

    //tabel peringkat fakultas berdasarkan jumlah mahasiswa
    daftarP = $('#perestasikompetisimahasiswa').DataTable({
        ajax: {
            url: globalUrl + '/satuperingkatprodimahasiswa/' + start + '/' + end + '/' + prodi,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "ProgramStudi",
                "targets": 0
            },
            {
                data: { TotalMahasiswa: "TotalMahasiswa", ProgramStudi: "ProgramStudi" },
                "render": function (data, type, full, meta) {

                    var prodi = data.ProgramStudi;

                    //mengubah special character agar bisa lewat url
                    var length = (prodi.split('(').length - 1);

                    for (var i = 0; i < length; i++) // replace ( menjadi {
                    {
                        prodi = prodi.replace("(", "{");
                    }

                    length = (prodi.split(')').length - 1);

                    for (var i = 0; i < length; i++) //replace ) menjadi }
                    {
                        prodi = prodi.replace(")", "}");
                    }

                    length = (prodi.split(',').length - 1);

                    for (var i = 0; i < length; i++) //replace , menjadi `
                    {
                        prodi = prodi.replace(",", "`");
                    }

                    length = (prodi.split('/').length - 1);

                    for (var i = 0; i < length; i++) //replace / menjadi ~
                    {
                        prodi = prodi.replace("/", "~");
                    }

                    if (type === 'display') {
                        data = '<a href="daftarPrestasi_Mahasiswa/' + start + '-' + end + '-' + prodi + '">' + data.TotalMahasiswa + '</a>';
                    }

                    return data;
                },
                "orderable": false,
                "targets": 1
            },
        ],
        order: [1, 'dsc']
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

    var prodiindex = document.getElementById("prodi"); //select ID Prodi
    var prodi = prodiindex.options[prodiindex.selectedIndex].value; //get value berdasarkan index yang dipilih

    if (prodiindex.selectedIndex == 0) //tidak memilih prodi apapun
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        $('#perestasikompetisimahasiswa').dataTable().fnDestroy();
        tabel(start, end); //panggil tabel
    }
    else //ketika memilih prodi
    {
        $('#perestasikompetisi').dataTable().fnDestroy();
        $('#perestasikompetisimahasiswa').dataTable().fnDestroy();
        satuperingkatprodiprestasi(start, end, prodi); //panggil tabel
    }

});

//on click reset filter
$('#resetfilter').click(function (e) {

    $('#perestasikompetisi').dataTable().fnDestroy();
    $('#perestasikompetisimahasiswa').dataTable().fnDestroy();

    document.getElementById("tahun").value = "Tahun";
    document.getElementById("tahun2").value = "Tahun";
    document.getElementById("prodi").value = "Pilih Prodi";

    tabel(end, end);
});

