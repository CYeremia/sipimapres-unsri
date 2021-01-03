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
            data: "Kegiatan",
            "targets": 1
        },
        {
            data: "TanggalMulai",
            "targets": 2
        },
        {
            data: "TanggalAkhir",
            "targets": 3
        },
        {
            data: "Penyelenggara",
            "targets": 4
        },
        {
            data: "Tingkat",
            "targets": 5
        },
        {
            data: "Kategori",
            "targets": 6
        },
        {
            data: "Status",
            "targets": 7
        },
        {
            "className": 'details-control',
            "data": null,
            "orderable": false,
            "defaultContent": '',
            "targets": 9,
            "width": "5%"
        }
        ],
        order: [0, 'asc'],
    });

    //Get data detail
    $('#perestasinonkompetisi tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = prestasi_nonkompetisi.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row (the format() function would return the data to be shown)
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });


});

//Row Child
function format(d) {
    return '<div class="slider">' +
        '<table class="table table-striped">' +
        '<tr>' +
        '<td style="width: 10%" colspan="3">' +
        '<h4 style="display: inline-block; top: 10px;"><b>Detail Data</b></h4>' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Nama Mahasiswa</td>' +
        '<td>' + d.Nama + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">NIM</td>' +
        '<td>' + d.PeraihPrestasi + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Bidang</td>' +
        '<td>' + d.Bidang + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tanggal Mulai</td>' +
        '<td>' + d.TanggalMulai + '</td>' +
        '</tr>' +
        
        '<tr>' +
        '<td style="width: 15%">Tanggal Akhir</td>' +
        '<td>' + d.TanggalAkhir + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Penyelenggara</td>' +
        '<td>' + d.Penyelenggara + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tingkat</td>' +
        '<td>' + d.Tingkat + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Peran</td>' +
        '<td>' + d.Peran + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Kategori</td>' +
        '<td>' + d.Kategori + '</td>' +
        '</tr>' +
        '<td style="width: 15%">Jumlah Peserta</td>' +
        '<td>' + d.JumlahPeserta + '</td>' +
        '</tr>' +
        '<td style="width: 15%">Jumlah Penghargaan</td>' +
        '<td>' + d.JumlahPenghargaan + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Status</td>' +
        '<td>' + d.Status + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Bukti Prestasi</td>' +
        '<td><img onclick="BuktiPrestasi(\'' + d.BuktiPrestasi + '\')" style="width:200px" src="' + url + d.BuktiPrestasi + '"></td>' +
        // '<td><img style="width:200px" src="' + url + d.BuktiPrestasi + '"></td>' +
        // '<td><img width="100 " src="<?php echo base_url(); ?>uploads/<?php echo' + d.BuktiPrestasi + ' ?>/"></td>' +
        // '<td <img width="" 500px height="500px" src=" <?php echo base_url(uploads/)' + d.BuktiPrestasi + '"?>"/></td>' +
        '</tr>' +
        '</table></div>';
}

function BuktiPrestasi(gambar) {
    var modal = document.getElementById("Modal-Img");
    var modalImg = document.getElementById("img");

    modal.style.display = "block";
    modalImg.src = this.src = url + gambar;
    $('#Modal-Img').modal('show');
}

$('#closemodal').click(function (e) {
    var modal = document.getElementById("Modal-Img");
    modal.style.display = "none";
});