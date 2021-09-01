var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var base_url = window.location.origin; //get default url name

var pathArray = window.location.pathname.split('/'); //get child url

var url = base_url + "/" + pathArray[1] + "/uploads/"; // append child url and uploads

var prestasi_nonkompetisi;

$(document).ready(function () {

    prestasi_nonkompetisi = $('#perestasinonkompetisi').DataTable({
        ajax: {
            url: globalUrl + '/data_prestasiNon',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "Bidang",
            "targets": 1
        },
        {
            data: "Kegiatan",
            "targets": 2
        },
        {
            data: "TanggalMulai",
            "targets": 3
        },
        {
            data: "TanggalAkhir",
            "targets": 4
        },
        {
            data: "Penyelenggara",
            "targets": 5
        },
        {
            data: "Tingkat",
            "targets": 6
        },
        {
            data: "Kategori",
            "targets": 7
        },
        {
            data: "Status",
            "targets": 8
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, full, meta) {
                var actButt = "<center><a href=\"javascript:void(0);\" id='ikon' style='color:#3399ff'; class=\"font-bold col-red detailExpand\"><i class='fas fa-plus-circle fa-lg'></i></a>";
                return actButt;
            },
            "targets": 9,
            "width": "5%"
        }
        ],
        order: [0, 'asc'],
    });

    //Get data detail
    $('#perestasinonkompetisi tbody').on('click', '.detailExpand', function () {
        var tr = $(this).closest('tr');
        var row = prestasi_nonkompetisi.row(tr);
        var ikoncolor = document.getElementById('ikon');

        if (row.child.isShown()) {
            $(this).children('i').toggleClass('fas fa-times-circle fa-lg fas fa-plus-circle fa-lg');
            ikoncolor.style.color = '#3399ff';
            row.child.hide();
            tr.removeClass('shown');
        } else {
            $(this).children('i').toggleClass('fas fa-plus-circle fa-lg fas fa-times-circle fa-lg');
            ikoncolor.style.color = '#ff3300';
            //Jika ingin menampilkan 1 row child saja pakai code dibawah ini
            if (prestasi_nonkompetisi.row('.shown').length) {
                $('.detailExpand', prestasi_nonkompetisi.row('.shown').node()).click();
            }
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
});

//Row Child
function format(d) {
    console.log(d);
    var output = '';
    output = '<div class="slider">' +
        '<table class="table table-striped">' +
        '<tr>' +
        '<td style="width: 10%" colspan="3">' +
        '<h4 style="display: inline-block; top: 10px;"><b>Detail Data Prestasi</b></h4>' +
        '</td>' +
        '</tr>';

    var body = '';
    body = '<tr>' +
        '<td style="width: 15%">NIM</td>' +
        '<td>' + d.PeraihPrestasi + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Nama Mahasiswa</td>' +
        '<td>' + d.Nama + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Judul Kegiatan</td>' +
        '<td>' + d.Kegiatan + '</td>' +
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
        '<td>' + d.JumlahPeserta + ' Orang</td>' +
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
        '<td style="width: 15%">Bukti Prestasi</td>' +
        '<td> <a href=' + globalUrl + '/downloadfileBuktiPrestasi/' + d.BuktiPrestasi + '>Download <i class="fas fa-download"></i></a></td>' +
        '</tr>';

    output = output + body;
    if (d.Note != null) {
        body = '<tr>' +
            '<td style="width: 15%">Alasan Penolakan</td>' +
            '<td>' + d.Note + '</td>' +
            '</tr>';
        output = output + body;
    }
    body = '<tr>' +
        '<td style="width: 15%">Status</td>' +
        '<td>' + d.Status + '</td>' +
        '</tr>';
    output = output + body;
    var footer = '</table></div > ';
    output = output + footer;
    return output;
}

// function BuktiPrestasi(gambar) {
//     var modal = document.getElementById("Modal-Img");
//     var modalImg = document.getElementById("img");

//     modal.style.display = "block";
//     modalImg.src = this.src = url + gambar;
//     $('#Modal-Img').modal('show');
// }

// $('#closemodal').click(function (e) {
//     var modal = document.getElementById("Modal-Img");
//     modal.style.display = "none";
// });