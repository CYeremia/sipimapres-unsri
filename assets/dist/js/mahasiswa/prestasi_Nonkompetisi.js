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
            data: "Tahun",
            "targets": 2,
        },
        {
            data: "Penyelenggara",
            "targets": 3
        },
        {
            data: "Tingkat",
            "targets": 4
        },
        {
            data: "Kategori",
            "targets": 5
        },
        {
            data: "Status",
            "targets": 6
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
        '<td style="width: 15%">Tahun</td>' +
        '<td>' + d.Tahun + '</td>' +
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
        '<td style="width: 15%">Tingkat</td>' +
        '<td>' + d.Kategori + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Status</td>' +
        '<td>' + d.Status + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Bukti Prestasi</td>' +
        '<td><img style="width:200px" src="' + url + d.BuktiPrestasi + '"></td>' +
        // '<td><img width="100 " src="<?php echo base_url(); ?>uploads/<?php echo' + d.BuktiPrestasi + ' ?>/"></td>' +
        // '<td <img width="" 500px height="500px" src=" <?php echo base_url(uploads/)' + d.BuktiPrestasi + '"?>"/></td>' +
        '</tr>' +
        '</table></div>';
}