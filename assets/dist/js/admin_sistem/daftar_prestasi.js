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
                data: "Bidang",
                "targets": 1
            },
            {
                data: "Perlombaan",
                "targets": 2
            },
            {
                data: "Perlombaan",
                "targets": 3
            },
            {
                data: "Pencapaian",
                "targets": 4
            },
            {
                data: "Penyelenggara",
                "targets": 5
            },
            {
                data: "TanggalMulai",
                "targets": 6
            },
            {
                data: "TanggalAkhir",
                "targets": 7
            },
            {
                "data": null,
                "orderable": false,
                "render": function (data, type, full, meta) {
                    var actButt = "<center><a href=\"javascript:void(0);\" class=\"font-bold col-blue detailExpand\"><i class='fas fa-plus-circle fa-lg'></i></a>";
                    return actButt;
                },
                "targets": 5,
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

            //Jika ingin menampilkan 1 row child saja pakai code dibawah ini
            if (daftarP.row('.shown').length) {
                $('.detailExpand', daftarP.row('.shown').node()).click();
            }
            row.child(format(row.data(), 'getdata')).show();
            tr.addClass('shown');
        }
    });

});