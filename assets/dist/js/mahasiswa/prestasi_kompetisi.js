var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var base_url = window.location.origin; //get default url name

var pathArray = window.location.pathname.split( '/' ); //get child url

var url = base_url+"/"+pathArray[1]+"/uploads/"; // append child url and uploads

var prestasi_kompetisi;

$(document).ready(function () {

    prestasi_kompetisi = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/data_prestasi',
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
            data: "Perlombaan",
            "targets": 2,
        },
        {
            data: "Tahun",
            "targets": 3
        },
        {
            data: "Penyelenggara",
            "targets": 4
        },
        {
            data: "Kategori",
            "targets": 5
        },
        {
            data: "Tingkat",
            "targets": 6
        },
        {
            data: "Pencapaian",
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
                var actButt = "<center><a href=\"javascript:void(0);\" class=\"font-bold col-blue detailExpand\"><i class=\"material-icons\">show detail</i></a>";
                return actButt;
            },
            "targets": 9,
            "width": "5%"
        }
        ],
        order: [0, 'asc'],

        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    //Get data detail
    $('#perestasikompetisi tbody').on('click', '.detailExpand', function () {
        var tr = $(this).closest('tr');
        var row = prestasi_kompetisi.row(tr);

        if (row.child.isShown()) {
            $(this).removeClass('col-red');
            $(this).addClass('col-blue');
            $(this).children().text('show detail');
            $('div.slider', row.child()).slideUp(function () {
                row.child.hide();
                tr.removeClass('shown');
            });
        } else {
            $(this).removeClass('col-blue');
            $(this).addClass('col-red');
            $(this).children().text('cancel');
            row.child(format(row.data())).show();
            tr.addClass('shown');
            $('div.slider', row.child()).slideDown();
        }
    });

});

//Row Child
function format(d) {
    return '<div class="slider">' +
        '<table class="table table-striped">' +
        '<tr>' +
        '<td style="width: 10%">' +
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
        '<td style="width: 15%">Perlombaan</td>' +
        '<td>' + d.Perlombaan + '</td>' +
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
        '<td style="width: 15%">Kategori</td>' +
        '<td>' + d.Kategori + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Tingkat</td>' +
        '<td>' + d.Tingkat + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Pencapaian</td>' +
        '<td>' + d.Pencapaian + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td style="width: 15%">Status</td>' +
        '<td>' + d.Status + '</td>' +
        '</tr>' +
        '<td style="width: 15%">Bukti Prestasi</td>' +
        '<td><img style="width:200px" src="'+url+d.BuktiPrestasi+'"></td>' +
        '</tr>' +
        // '<tr>' +
        // '<td style="width: 15%">Status</td>' +
        // '<td>' + d.Status + '</td>' +
        // '</tr>' +
        '</table></div>';
}