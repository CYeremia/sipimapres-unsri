

$(document).ready(function () {

    var currUrl = window.location.href.split('/');
    var globalUrl = currUrl.join('/');

    var prodi = []; //prodi berdasarkan jurusan
    var prestasikompetisi = [];
    var prestasinonkompetisi = [];

    $('#perestasikompetisi').DataTable({
        ajax: {
            url: globalUrl + '/gettopmahasiswa',
            type: 'POST',
            data: function (d) { }
        },
        columns: [{
            data: "no",
            "targets": 0
        },
        {
            data: "Nama",
            "targets": 1
        },
        {
            data: "Fakultas",
            "targets": 2
        },
        {
            data: "Prodi",
            "targets": 3,
        },
        {
            data: "Skor",
            "targets": 4
        }
        ],
        order: [[0, 'asc']],
    });

    $.ajax({
        url: globalUrl + '/penyebaranprestasi',
        type: 'POST',
        async: false,
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {

            var length = data.data.length; //panjang data

            for (var i = 0; i < length; i++) {
                prodi[i] = data.data[i].Prodi; //get prodi
                prestasikompetisi[i] = data.data[i].Kompetisi; //jumlah prestasi kompetisi berdasarkan prodi
                prestasinonkompetisi[i] = data.data[i].NonKompetisi; //jumlah prestasi non kompetisi berdasarkan prodi
            }

        }
    });



    var areaChartData = {

        labels: prodi,
        datasets: [
            {
                label: 'Prestasi Non Kompetisi',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: prestasinonkompetisi //jumlah data
            },
            {
                label: 'Prestasi Kompetisi ',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: prestasikompetisi //jumlah data
            },
        ]
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
});