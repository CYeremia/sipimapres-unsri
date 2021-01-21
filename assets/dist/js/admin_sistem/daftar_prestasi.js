var currUrl = window.location.href.split('/');

var data = currUrl[6]; //parameter
var year = data.split('-');

var start = year[0];
var end = year[1];
var fakultas = year[2];

currUrl.pop();
currUrl.pop();
var globalUrl = currUrl.join('/');

var daftarP;

$(document).ready(function () {

    //replace fakultas
    var length = (fakultas.split('%20').length - 1);

    for (var i = 0; i < length; i++) {
        fakultas = fakultas.replace("%20", " ");
    }

    var length = (fakultas.split('%60').length - 1);

    for (var i = 0; i < length; i++) {
        fakultas = fakultas.replace("%60", " ");
    }

    length = (fakultas.split('%7B').length - 1);

    for (var i = 0; i < length; i++) // replace ( menjadi {
    {
        fakultas = fakultas.replace("%7B", " ");
    }

    length = (fakultas.split('%7D').length - 1);

    for (var i = 0; i < length; i++) //replace ) menjadi }
    {
        fakultas = fakultas.replace("%7D", " ");
    }

    length = (fakultas.split('~').length - 1);

    for (var i = 0; i < length; i++) //replace ) menjadi }
    {
        fakultas = fakultas.replace("~", " ");
    }

    document.getElementById('fakultas').innerHTML = 'Prestasi ' + fakultas

    daftarP = $('#daftarPrestasi').DataTable({
        ajax: {
            url: globalUrl + '/prestasifakultas/' + start + '/' + end + '/' + fakultas,
            type: 'POST',
            data: function (d) { }
        },
        columns: [
            {
                data: "No",
                "targets": 0
            },
            {
                data: "NIM",
                "targets": 1
            },
            {
                data: "Nama",
                "targets": 2
            },
            {
                data: "Perlombaan",
                "targets": 3
            },
            {
                data: "JenisPrestasi",
                "targets": 4
            },
            {
                data: "TanggalMulai",
                "targets": 5
            },
            {
                data: "TanggalAkhir",
                "targets": 6
            },
            {
                data: { BuktiPrestasi: "BuktiPrestasi" },

                "render": function (data, type, full, meta) {
                    var actButt = '<a href="' + globalUrl + '/downloadfileBuktiPrestasi/' + data.BuktiPrestasi + '">Download</a >';
                    return actButt;
                },
                "targets": 7
            },
            {
                data: { BuktiDokumentasi: "BuktiDokumentasi" },
                "render": function (data, type, full, meta) {
                    if (data.BuktiDokumentasi == null) {
                        data: "BuktiDokumentasi"
                        var actButt = '<label>-------------</label>';
                        return actButt;
                    } else {
                        var actButt = '<a href="' + globalUrl + '/downloadfileBuktiPrestasi/' + data.BuktiDokumentasi + '">Download</a >';
                        return actButt;
                    }
                },
                "targets": 8
            },
            {
                "data": null,
                "orderable": false,
                "render": function (data, type, full, meta) {
                    var actButt = "<center><a href=\"javascript:void(0);\" class=\"font-bold col-red detailExpand\"><i class='fas fa-plus-circle fa-lg'></i></a>";
                    return actButt;
                },
                "targets": 9,
                "width": "5%"
            },
        ],
        order: [0, 'asc']
    });

    //Get data detail
    $('#daftarPrestasi tbody').on('click', '.detailExpand', function () {
        var tr = $(this).closest('tr');
        var row = daftarP.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            //Jika ingin menampilkan 1 row child saja pakai code dibawah ini
            '<i class="fas fa-times-circle"></i>'
            // if (daftarP.row('.shown').length) {
            //     $('.detailExpand', daftarP.row('.shown').node()).click();
            // }
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

});

function format(d) {
    var output = '';
    // header
    console.log(d);
    output = '<div class="slider">' +
        '<table class="table table-striped">' +
        '<tr>' +
        '<td style="width: 10%" colspan="3">' +
        '<h4 style="display: inline-block; top: 10px;"><b>Detail Data Mahasiswa</b></h4>' +
        '</td>' +
        '</tr>';

    var body = '';
    if (d.JenisPrestasi == 'Kompetisi') {
        body = '<tr>' +
            '<td style="width: 15%">NIM</td>' +
            '<td>' + d.NIM + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Nama Mahasiswa</td>' +
            '<td>' + d.Nama + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Jenis Prestasi</td>' +
            '<td>' + d.JenisPrestasi + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Judul Perlombaan</td>' +
            '<td>' + d.Perlombaan + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Bidang</td>' +
            '<td>' + d.Bidang + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Penyelenggara</td>' +
            '<td>' + d.Penyelenggara + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Tanggal Mulai</td>' +
            '<td>' + d.TanggalMulai + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Tanggal Selesai</td>' +
            '<td>' + d.TanggalAkhir + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Kategori</td>' +
            '<td>' + d.Kategori + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Status Kategori</td>' +
            '<td>' + d.StatusKategori + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Tingkat</td>' +
            '<td>' + d.Tingkat + '</td>' +
            '</tr>';
        output = output + body;
        body = '';

        if (d.Tingkat == "Regional") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Perguruan Tinggi Negeri</td>' +
                '</tr>' +
                '<tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Provinsi") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Perguruan Tinggi Negeri</td>' +
                '</tr>' +
                '<tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Nasional") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Provinsi</td>' +
                '</tr>' +
                '<tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Internasional") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Negara</td>' +
                '</tr>' +
                '<tr>';
            output = output + body;
            body = '';
        }

        body = '<td style="width: 15%">Pencapaian</td>' +
            '<td>' + d.Pencapaian + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Jumlah Peserta</td>' +
            '<td>' + d.JumlahPeserta + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Jumlah Penghargaan</td>' +
            '<td>' + d.JumlahPenghargaan + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Link Berita</td>' +
            '<td>' + d.LinkBerita + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Skor</td>' +
            '<td>' + d.Skor + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Status</td>' +
            '<td>' + d.Status + '</td>' +
            '</tr>';
        output = output + body;
        body = '';
    } else {
        body = '<tr>' +
            '<td style="width: 15%">NIM</td>' +
            '<td>' + d.NIM + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Nama Mahasiswa</td>' +
            '<td>' + d.Nama + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Jenis Prestasi</td>' +
            '<td>' + d.JenisPrestasi + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Judul Perlombaan</td>' +
            '<td>' + d.Perlombaan + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Bidang</td>' +
            '<td>' + d.Bidang + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Penyelenggara</td>' +
            '<td>' + d.Penyelenggara + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Tanggal Mulai</td>' +
            '<td>' + d.TanggalMulai + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Tanggal Selesai</td>' +
            '<td>' + d.TanggalAkhir + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Kategori</td>' +
            '<td>' + d.Kategori + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Status Kategori</td>' +
            '<td>' + d.StatusKategori + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Tingkat</td>' +
            '<td>' + d.Tingkat + '</td>' +
            '</tr>';
        output = output + body;
        body = '';

        if (d.Tingkat == "Regional") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Perguruan Tinggi Negeri</td>' +
                '</tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "PT/Provinsi") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Perguruan Tinggi Negeri</td>' +
                '</tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Nasional") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Provinsi</td>' +
                '</tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Internasional") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Negara</td>' +
                '</tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Wilayah") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Wilayah</td>' +
                '</tr>';
            output = output + body;
            body = '';
        } else if (d.Tingkat == "Fakultas/Prodi") {
            body = '<tr>' +
                '<td style="width: 15%">Jumlah Perwakilan</td>' +
                '<td>' + d.JumlahPerwakilan + ' Fakultas/Prodi</td>' +
                '</tr>';
            output = output + body;
            body = '';
        }

        body = '<tr>' +
            '<td style="width: 15%">Jumlah Peserta</td>' +
            '<td>' + d.JumlahPeserta + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Jumlah Penghargaan</td>' +
            '<td>' + d.JumlahPenghargaan + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Link Berita</td>' +
            '<td>' + d.LinkBerita + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Skor</td>' +
            '<td>' + d.Skor + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td style="width: 15%">Status</td>' +
            '<td>' + d.Status + '</td>' +
            '</tr>';
        output = output + body;
    }

    var footer = '</table></div > ';
    output = output + footer;
    return output;
}