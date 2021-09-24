
$(document).ready(function () {

    var currUrl = window.location.href.split('/');
    var globalUrl = currUrl.join('/');
    var start = 2000;
    var end = new Date().getFullYear();

    var Fakultas = [];
    var prestasikompetisi = [];
    var prestasinonkompetisi = [];
    var tingkat = [];
    var tingkatkompetisi = [];
    var tingkatnonkompetisi = [];
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
        "lengthChange": false, //show entries
        "ordering": false, //Mengurutkan data berdasarkan kolom
        "paging": false, //btn next and prev
        "info": false // showing information data
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
                Fakultas[i] = data.data[i].Fakultas; //get fakultas
                prestasikompetisi[i] = data.data[i].PrestasiKompetisi; //jumlah prestasi kompetisi berdasarkan fakultas
                prestasinonkompetisi[i] = data.data[i].Prestasinonkompetisi; //jumlah prestasi non kompetisi berdasarkan fakultas
            }

        }
    });


    var areaChartData = {

        labels: Fakultas,
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


    //-------------
    //- BAR CHART2 -
    //-------------
    $.ajax({
        url: globalUrl + '/peringkattingkat/' + "2018" + '/' + end,
        type: 'POST',
        async: false,
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {

            var length = data.data.length; //panjang data

            for (var i = 0; i < length; i++) {
                tingkat[i] = data.data[i].Tingkat; //get fakultas
                tingkatkompetisi[i] = data.data[i].PrestasiKompetisi; //jumlah prestasi kompetisi berdasarkan fakultas
                tingkatnonkompetisi[i] = data.data[i].PrestasiNonKompetisi; //jumlah prestasi non kompetisi berdasarkan fakultas
            }

        }
    });
    var areaChartData2 = {

        labels: tingkat,
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
                data: tingkatnonkompetisi //jumlah data
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
                data: tingkatkompetisi //jumlah data
            },
        ]
    }
    
    var barChartCanvas2 = $('#TingkatbarChart2').get(0).getContext('2d')
    var barChartData2 = jQuery.extend(true, {}, areaChartData2)
    var temp02 = areaChartData2.datasets[0]
    var temp12 = areaChartData2.datasets[1]
    barChartData2.datasets[0] = temp12
    barChartData2.datasets[1] = temp02

    var barChartOptions2 = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart2 = new Chart(barChartCanvas2, {
        type: 'bar',
        data: barChartData2,
        options: barChartOptions2
    })

    console.log(tingkat);
    console.log(tingkatkompetisi);
    console.log(tingkatnonkompetisi);
    console.log(barChartData2.datasets[0]);
    console.log(barChartData2.datasets[1]);
});