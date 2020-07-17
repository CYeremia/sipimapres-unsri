var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var prestasi_kompetisi;

$(document).ready(function () {

    prestasi_kompetisi = $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '',
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
            data: "Symptom",
            "targets": 4
        },
        {
            data: "Penyelenggaraan",
            "targets": 5
        },
        {
            data: "Kategori",
            "targets": 6
        },
        {
            data: "Tingkat",
            "targets": 7
        },
        {
            data: "Pencapaian",
            "targets": 8
        },
        {
            data: "Status",
            "targets": 9
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, full, meta) {
                var actButt = "<center><a href=\"javascript:void(0);\" class=\"font-bold col-blue detailExpand\"><i class=\"material-icons\">add_circle</i></a>";
                return actButt;
            },
            "targets": 6,
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
        var row = myTicketData.row(tr);

        if (row.child.isShown()) {
            $(this).removeClass('col-red');
            $(this).addClass('col-blue');
            $(this).children().text('add_circle');
            $('div.slider', row.child()).slideUp(function () {
                row.child.hide();
                tr.removeClass('shown');
            });
        } else {
            $(this).removeClass('col-blue');
            $(this).addClass('col-red');
            $(this).children().text('cancel');
            row.child(format(row.data(), 'getdata')).show();
            tr.addClass('shown');
            $('div.slider', row.child()).slideDown();
        }
    });


});