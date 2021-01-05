var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');

var DataAnggota;
var lasttableindex = 1;
var NIM = document.getElementById("sidebarNim").textContent;
NIM = NIM.replace("(", "");
NIM = NIM.replace(")", "");
var Nama = document.getElementById("sidebarNama").textContent;
$(document).ready(function () {
    bsCustomFileInput.init();

    $('#tanggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#tanggal2').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    //Pemilihan Kategori Lomba
    $('#Kategori').on('change', function () {
        var selected = $(this).val();

        if (selected == 'Kelompok') {
            $("#dataanggota").show();
            // set nama dan nim ketua
            document.getElementById("NamaKetua").value = Nama;
            document.getElementById("NimKetua").value = NIM;
        } else {
            $("#dataanggota").hide();
            // hapus isi tabel
            if (lasttableindex > 1) {
                for (var i = 1; i < lasttableindex; i++) {
                    document.getElementById("anggotaKelompok").deleteRow(1);
                }
                lasttableindex = 1;
            }
        }
    });

    // munculkan modal dan isi value
    $('#TambahData').on('click', function (e) {
        var nimanggota = document.getElementById("NimAnggota").value;
        $.ajax({
            url: globalUrl + '/getdataanggota/' + nimanggota,
            type: 'POST',
            data: function (d) { },
            dataType: 'json',
            success: function (response) {
                document.getElementById("namamahasiswa").value = response.Nama;
                document.getElementById("Nimmahasiswa").value = response.IDpengenal;
                document.getElementById("prodi").value = response.ProgramStudi;
                document.getElementById("fakultas").value = response.Fakultas;
            }
        });
        $('#modal-form2').modal();
    });

    // close modal and add to table
    $('#tambahtotabel').on('click', function (e) {
        var table = document.getElementById("anggotaKelompok");
        var row = table.insertRow(lasttableindex);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = document.getElementById("Nimmahasiswa").value;
        cell2.innerHTML = document.getElementById("namamahasiswa").value;

        document.getElementById("namamahasiswa").value = null;
        document.getElementById("Nimmahasiswa").value = null;
        document.getElementById("prodi").value = null;
        document.getElementById("fakultas").value = null;
        document.getElementById("NimAnggota").value = null;
        lasttableindex++;
        $('#modal-form2').hide();
    });

    // submit form

    $('#submitform').on('click', function (e) {
        // cek kelengkapan data
        if (document.getElementById("JudulLomba").value == "" || document.getElementById("Penyelenggara").value == "" || document.getElementById("tanggalawal").value == "" || document.getElementById("tanggalakhir").value == "" || document.getElementById("Bidang").value == "Pilih Bidang" || document.getElementById("Kategori").value == "Pilih Kategori" || document.getElementById("Tingkat").value == "Tingkat" || document.getElementById("JumlahPeserta").value == "" || document.getElementById("Pencapaian").value == "Pencapaian" || document.getElementById("JumlahPenghargaan").value == "") {
            // swall bermasalah
            // swal("test","Test");
        }


        // tampung data
        var namafile = document.getElementById("JudulLomba").value + NIM + document.getElementById("tanggalawal").value
        var formdata = new FormData();
        var statuskategori = "";
        var daftaranggota = "";
        var imgwidth = 0;
        var imgheight = 0;

        if (document.getElementById("Kategori").value == "Kelompok") {
            statuskategori = "Kelompok";
            //append semua NIM anggota
            daftaranggota = document.getElementById("anggotaKelompok").rows[1].cells[0].innerHTML;
            if (lasttableindex > 2) {
                for (var i = 2; i < lasttableindex; i++) {
                    daftaranggota += "#" + document.getElementById("anggotaKelompok").rows[i].cells[0].innerHTML;
                }
            }
        } else {
            statuskategori = "Individual";
        }
        var img = new Image();
        if (document.getElementById("buktiprestasi").files[0] != null) {
            var _URL = window.URL || window.webkitURL;  //untuk baca URL file
            var photo = document.getElementById("buktiprestasi").files[0];
            img.onload = function () {
                imgwidth = this.width;
                imgheight = this.height;
                alert(this.width + " " + this.height);
            }
            img.src = _URL.createObjectURL(document.getElementById("buktiprestasi").files[0]);

            formdata.append("buktiprestasi", photo);
        }
        // console.log(imgheight);
        // console.log(imgwidth);
        // console.dir(photo);

        // panggil ajax
        $.ajax({
            url: globalUrl + '/input_data_kompetisi',
            type: 'POST',
            data: formdata,
            dataType: 'json',
            headers: {
                'NimPelapor': NIM,
                'JudulLomba': document.getElementById("JudulLomba").value,
                'Penyelenggara': document.getElementById("Penyelenggara").value,
                'tanggalawal': document.getElementById("tanggalawal").value,
                'tanggalakhir': document.getElementById("tanggalakhir").value,
                'Bidang': document.getElementById("Bidang").value,
                'Kategori': document.getElementById("Kategori").value,
                'statuskategori': statuskategori,
                'Tingkat': document.getElementById("Tingkat").value,
                'JumlahPeserta': document.getElementById("JumlahPeserta").value,
                'Pencapaian': document.getElementById("Pencapaian").value,
                'JumlahPenghargaan': document.getElementById("JumlahPenghargaan").value,
                'Berita': document.getElementById("berita").value,
                'Daftaranggota': daftaranggota
            },
            contentType: false,
            processData: false,
            success: function (result) {
                console.dir(result);
            }
        });
    });

});


