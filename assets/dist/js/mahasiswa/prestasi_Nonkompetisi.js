var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

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
    $('#perestasinonkompetisi tbody').on('click', '.detailExpand', function () {
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