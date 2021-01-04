<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_fakultas  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['IDpengenal'] = $this->session->userdata('IDpengenal');
        $this->data['Role'] = $this->session->userdata('Role');
        // $this->db->select('Photo');
        // $this->db->where('UserName', $this->data['username']);
        // $this->data['Photo'] = $this->db->get('user');
        if (isset($this->data['IDpengenal'], $this->data['Role'])) {
            if ($this->data['Role'] != "Administrasi Fakultas") {
                redirect('logout');
            }
        } else {
            redirect('logout');
        }

        // date_default_timezone_set("Asia/Bangkok"); // set timezone
        // $this->data['IDPengenal'] = $this->session->userdata('IDpegenal');
        // $this->data['Role'] = $this->session->userdata('Role');
        // $this->db->select('Photo');
        // $this->db->where('UserName', $this->data['username']);
        // $this->data['Photo'] = $this->db->get('user');

        // if (isset($this->data['username'], $this->data['id_role'])) {
        //     if ($this->data['id_role'] != 1) {
        //         redirect('logout');
        //         exit;
        //     }
        // } else {
        //     redirect('logout');
        //     exit;
        // }   
        //     $this->data['IDpengenal'] = $this->session->userdata('IDpengenal');
        //     $this->data['id_role'] = $this->session->userdata('id_role');
        //     if (isset($this->data['IDpengenal'], $this->data['id_role'])) {
        //         if ($this->data['id_role'] != 1) {
        //             redirect('logout');
        //             exit;
        //         }
        //     } else {
        //         redirect('logout');
        //         exit;
        //     }

        $this->data['userdata'] = $this->db->query("SELECT `user`.`IDPengenal`, `user`.`Nama`, `user`.`Fakultas`, `user`.`ProgramStudi`, `user`.`Email`, `user`.`IPK`, `user`.`Telephone`, `role`.`Role` FROM `user` INNER JOIN `role` ON `user`.`Role` = `role`.`Role` WHERE `user`.`IDPengenal` = '" . $this->data['IDpengenal'] . "'")->row();
        // $this->data['user'] = $this->db->get_where('user', ['IDPengenal' => $this->session->userdata('IDPengenal')])->row_array();
        $this->load->model('user_m');
        $this->load->model('prestasi_kompetisi');
        $this->load->model('prestasi_nonkompetisi');
        $this->load->model('prodi');
        $this->load->library('UserObj');

        $year = date("Y");

        //jumlah data untuk dashboard
        $this->data['jumlah'] = [

            $this->db->query("SELECT COUNT(*) AS `mahasiswa` FROM `user` WHERE `Role` = 'Mahasiswa' AND `Fakultas` ='" . $this->data['userdata']->Fakultas . "'")->row(), //jumlah mahasiswa

            $this->db->query("SELECT COUNT(*) AS `kompetisi` FROM `prestasikompetisi`
            INNER JOIN user ON prestasikompetisi.PeraihPrestasi = user.IDPengenal
            WHERE `Role` = 'Mahasiswa' AND `Fakultas` = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima' AND (YEAR(TanggalMulai) =".$year." OR YEAR(TanggalAkhir) =".$year.")")->row(), //jumlah prestasi kompetisi

            $this->db->query("SELECT COUNT(*) AS `nonkompetisi` FROM `prestasinonkompetisi`
            INNER JOIN user ON prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE `Role` = 'Mahasiswa' AND `Fakultas` = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima' AND (YEAR(TanggalMulai) =".$year." OR YEAR(TanggalAkhir) =".$year.")")->row() //jumlah prestasi non kompetisi
        ];
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"> <a href="#" class="close2" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>');
    }

    public function index()
    {
        $this->data['active'] = 1;
        $this->data['title'] = 'Admin Fakultas | Dashboard ';
        $this->data['content'] = 'main';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //menambahkan data prestasi mahasiswa
    public function input_Prestasi()
    {
        $this->data['active'] = 2;
        $this->data['title'] = 'Admin Fakultas | Input Prestasi ';
        $this->data['content'] = 'input_prestasi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //Menampilkan Analisis Peringkat Berdasarkan Prodi
    public function Analisis_Peringkatprodi()
    {
        $data = $this->db->query("SELECT * FROM `prodi` WHERE `Fakultas` ='" . $this->data['userdata']->Fakultas . "'")->result();
        $this->data['prodi'] = $data;
        $this->data['active'] = 3;
        $this->data['title'] = 'Admin Sistem | Analisis Peringkat Prodi';
        $this->data['content'] = 'analisis_Prodi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    public function daftarPrestasi_Prodi($parameters = null)
    {
        if ($parameters == null) {
            redirect('admin_fakultas/Analisis_Peringkatprodi');
        } else {
            $this->data['active'] = 3;
            $this->data['title'] = 'Admin Sistem | Daftar Prestasi Prodi ';
            $this->data['content'] = 'daftar_prestasi';
            $this->load->view('admin_fakultas/template/template', $this->data);
        }
    }

    public function daftarPrestasi_Mahasiswa($parameters = null)
    {
        if ($parameters == null) {
            redirect('admin_fakultas/Analisis_Peringkatprodi');
        } else {
            $this->data['active'] = 3;
            $this->data['title'] = 'Admin Sistem | Daftar Prestasi Mahasiswa ';
            $this->data['content'] = 'daftar_prestasiMahasiswa';
            $this->load->view('admin_fakultas/template/template', $this->data);
        }
    }

    //Menampilkan analisis peringkat berdasarkan bidang
    public function Analisis_PeringkatBidang()
    {
        $this->data['active'] = 4;
        $this->data['title'] = 'Admin Sistem | Analisis Peringkat Bidang ';
        $this->data['content'] = 'analisis_bidang';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //get data select bidang untuk fulter
    public function getdataselect()
    {
        $pilihan = $this->input->post('pilihan');

        $sql = "SELECT Bidang FROM bidangprestasi WHERE JalurPencapaian='$pilihan'";
        $data = $this->db->query($sql)->result();
        // print_r($data);
        // die;
        $result = [
            'data' => $data,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function Prestasi_Bidang($parameters = null)
    {

        if ($parameters == null) {
            redirect('admin_fakultas/Analisis_PeringkatBidang');
        } else {
            $this->data['active'] = 4;
            $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
            $this->data['content'] = 'prestasi_bidang';
            $this->load->view('admin_fakultas/template/template', $this->data);
        }
    }

    //Menampilkan Semua data Prestasi Kompetisi Mahasiswa Berdasarkan Fakultas
    public function prestasi_kompetisi()
    {
        $this->data['active'] = 5;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Kompetisi ';
        $this->data['content'] = 'Verifikasi_kompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //Menampilkan Detail Prestasi Kompetisi Mahasiswa
    public function Verifikasi_statuskompetisi($ID)
    {
        $data['IDprestasi'] = $ID;
        $ID = $this->prestasi_kompetisi->get_row($data);
        $IDPengenal = $ID->PeraihPrestasi;

        $sql = "SELECT `Nama` FROM user WHERE IDPengenal='$IDPengenal'";
        $Nama = $this->db->query($sql)->row();

        $this->data['NamaM'] = $Nama;
        $this->data['IDM'] = $ID;
        $this->data['active'] = 5;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Non Kompetisi ';
        $this->data['content'] = 'Verifikasi_statusKompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //Insert Status Kedatabase berdasarkan ID Prestasi Mahasiswa Prestasi Kompetisi
    public function Verifikasi_status_kompetisi()
    {
        if ($this->input->post('submit')) {
            $input['Status'] = $this->input->post('status');
            $nama['namamahasiswa'] = $this->input->post('Nama');
            if ($input['Status'] == '') {
                $this->flashmsg('Anda Belum Melakukan Perubahan Status Prestasi Kompetisi', 'danger');
                redirect('admin_fakultas/prestasi_kompetisi');
            } else {
                $this->db->where('IDPrestasi', $this->input->post('IDPrestasiM'));
                $this->db->update('prestasikompetisi', $input);
                $this->flashmsg('Anda Telah Berhasil Melakukan Perubahan Status Prestasi Kompetisi', 'success');
                redirect('admin_fakultas/prestasi_kompetisi');
            }
        }
    }

    //Menampilkan Semua data Prestasi Non Kompetisi Mahasiswa Berdasarkan Fakultas
    public function prestasi_Nonkompetisi()
    {
        $this->data['active'] = 6;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Non Kompetisi ';
        $this->data['content'] = 'Verifikasi_Nonkompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    public function Verifikasi_statusNonkompetisi($ID)
    {
        $data['IDprestasi'] = $ID;
        $ID = $this->prestasi_nonkompetisi->get_row($data);
        $IDPengenal = $ID->PeraihPrestasi;

        $sql = "SELECT `Nama` FROM user WHERE IDPengenal='$IDPengenal'";
        $Nama = $this->db->query($sql)->row();

        $this->data['NamaM'] = $Nama;
        $this->data['IDM'] = $ID;
        $this->data['active'] = 6;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Non Kompetisi ';
        $this->data['content'] = 'Verifikasi_statusNonKompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    public function Verifikasi_status_Nonkompetisi()
    {
        if ($this->input->post('submit')) {
            $input['Status'] = $this->input->post('status');
            $nama['namamahasiswa'] = $this->input->post('Nama');
            if ($input['Status'] == '') {
                $this->flashmsg('Anda Belum Melakukan Perubahan Status Prestasi Kompetisi', 'danger');
                redirect('admin_fakultas/prestasi_Nonkompetisi');
            } else {
                $this->db->where('IDPrestasi', $this->input->post('IDPrestasiM'));
                $this->db->update('prestasinonkompetisi', $input);
                $this->flashmsg('Anda Telah Berhasil Melakukan Perubahan Status Prestasi Kompetisi', 'success');
                redirect('admin_fakultas/prestasi_Nonkompetisi');
            }
        }
    }

    public function profile()
    {
        $this->data['active'] = 7;
        $this->data['title'] = 'Admin Fakultas | Profile ';
        $this->data['content'] = 'profile';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //Menampilkan semua data mahasiswa berdasarkan fakultas
    public function data_mahasiswa()
    {
        $result = [
            'data' => $this->MapToObject(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //Seleksi data pada database di table user
    private function MapToObject()
    {
        $listData = [];
        $fakultas = $this->data['userdata']->Fakultas;
        $sql = "SELECT * FROM user WHERE Role='Mahasiswa' AND Fakultas='$fakultas'";
        $data = $this->db->query($sql)->result();
        $i = 1;
        foreach ($data  as $k) {
            $obj = new UserObj();
            $obj->no = $i;
            $obj->Nama = $k->Nama;
            $obj->IDPengenal = $k->IDPengenal;
            $obj->ProgramStudi = $k->ProgramStudi;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    // mengambil data mahasiswa berdasarkan IDpengenal/NIM
    public function getdataIDp()
    {
        $id = $this->input->post('ID');
        // print_r($id);
        // die;
        // $id = str_replace(" ", "", $id);
        $dataku = $this->user_m->get(['IDPengenal' => $id]);
        $result = [
            'data' => $dataku,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function mapdata($id)
    {
        $listData = [];
        // $fakultas = $this->data['userdata']->Fakultas;
        $sql = "SELECT * FROM user WHERE Role='$id'";
        $data = $this->db->query($sql)->result();
        $i = 1;
        foreach ($data  as $k) {
            $obj = new UserObj();
            // $obj->no = $i;
            $obj->IDPrestasi = $k->IDPrestasi;
            // $obj->IDPengenal = $k->IDPengenal;
            // $obj->ProgramStudi = $k->ProgramStudi;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //Seleksi Prestasi Mahasiswa
    public function seleksipage()
    {
        if ($_POST['prestasi'] == 'Kompetisi') {
            $this->data['ID'] = $_POST['Nimmahasiswa'];
            $this->data['Nama'] = $_POST['namamahasiswa'];

            $sql = "SELECT Bidang FROM bidangprestasi WHERE JalurPencapaian='Kompetisi'";
            $databidang = $this->db->query($sql)->result();
            $this->data['databidang'] = $databidang;
            $this->data['active'] = 2;
            $this->data['title'] = 'Admin Fakultas | Tambah Data Kompetisi';
            $this->data['content'] = 'data_kompetisi';
            $this->load->view('admin_fakultas/template/template', $this->data);
        } else if ($_POST['prestasi'] == 'Non Kompetisi') {
            $this->data['ID'] = $_POST['Nimmahasiswa'];
            $this->data['Nama'] = $_POST['namamahasiswa'];

            $sql = "SELECT Bidang FROM bidangprestasi WHERE JalurPencapaian='Non Kompetisi'";
            $databidang = $this->db->query($sql)->result();
            $this->data['databidang'] = $databidang;
            $this->data['active'] = 2;
            $this->data['title'] = 'Admin Fakultas | Tambah Data Non Kompetisi';
            $this->data['content'] = 'data_nonkompetisi';
            $this->load->view('admin_fakultas/template/template', $this->data);
        } else if ($_POST['prestasi'] == '') {
            redirect('admin_fakultas/input_Prestasi');
        }
        // print_r($_POST['Nimmahasiswa']);
    }

    //menambahkan data prestasi kompetisi mahasiswa
    public function Data_Kompetisi()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('JudulLomba', 'JudulLomba', 'required|trim');
            $this->form_validation->set_rules('Penyelenggara', 'Penyelenggara', 'required|trim');
            $this->form_validation->set_rules('Kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('Pencapaian', 'Pencapaian', 'required');

            $this->form_validation->set_rules('Bidang', 'Bidang', 'required');
            $this->form_validation->set_rules('tahun', 'tahun', 'required');
            $this->form_validation->set_rules('Tingkat', 'Tingkat', 'required');
            $this->form_validation->set_rules('berita', 'berita', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->flashmsg('Terdapat Data yang Belum diisi', 'danger');
            } else {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1024;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                // $config['encrypt_name']			= TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('buktiprestasi')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->flashmsg("Failed Insert Data, The image you are attempting to upload doesn't fit into the allowed dimensions.", 'danger');
                    redirect('admin_fakultas/input_Prestasi');
                    // $this->load->view('admin_fakultas/Data_Kompetisi', $error);
                } else {
                    $data['PeraihPrestasi'] = $this->input->post('NIM');
                    $data['Bidang']        = $this->input->post('Bidang');
                    $data['Perlombaan']       = $this->input->post('JudulLomba');
                    $data['Tahun']       = $this->input->post('tahun');
                    $data['Penyelenggara']       = $this->input->post('Penyelenggara');
                    $data['Kategori']       = $this->input->post('Kategori');
                    $data['Tingkat']       = $this->input->post('Tingkat');
                    $data['Pencapaian']       = $this->input->post('Pencapaian');
                    $data['Status']       = "Diterima";
                    $data['LinkBerita']       = $this->input->post('berita');
                    $data['JumlahPeserta']       = $this->input->post('JumlahPeserta');
                    $data['JumlahPenghargaan']       = $this->input->post('JumlahPenghargaan');
                    $data['BuktiPrestasi'] = $this->upload->data("file_name");
                    // Hitung Score
                    $ParamTingkat = $this->input->post('Tingkat');        //Internasional/nasional/regional/provinsi
                    $ParamPencapaian = $this->input->post('Pencapaian');  //juara1/2/3/umum
                    $ParamKategori = $this->input->post('Kategori');      //individu/kelompok
                    //Sementara untuk juara 1/2/3, juara umum menunggu konfirmasi
                    $sql = "SELECT Nilai FROM penilaian WHERE penilaian.Jenis='Kompetisi' AND penilaian.Tingkat='$ParamTingkat' AND penilaian.Pencapaian='$ParamPencapaian' AND Kategori='$ParamKategori'";
                    $data['Skor'] = $this->db->query($sql)->row('Nilai');
                    $this->db->insert('prestasikompetisi', $data);
                    $this->flashmsg("Data Berhasil Ditambahkan", 'success');
                    redirect('admin_fakultas/input_Prestasi');
                }
            }
        }
        $this->data['active'] = 2;
        $this->data['title'] = 'Admin Fakultas | Tambah Data Kompetisi';
        $this->data['content'] = 'data_kompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //Seleksi Bidang Non kompetisi
    public function checkbidang()
    {
        $cek = $this->input->post("selectbidang");
        $cekbidang = str_replace("%20", " ", $cek);

        $data = $this->db->query("SELECT JenisPenilaian  FROM `bidangprestasi` WHERE Bidang = '$cekbidang'")->result();

        if ($data[0]->JenisPenilaian == "Organisasi") {
            $result['status'] = true;
        } else {
            $result['status'] = false;
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //menambahkan data prestasi Non kompetisi mahasiswa
    public function Data_NonKompetisi()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('JudulLomba', 'JudulLomba', 'required|trim');
            $this->form_validation->set_rules('Penyelenggara', 'Penyelenggara', 'required|trim');
            $this->form_validation->set_rules('Kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('Peran', 'Peran', 'trim');

            $this->form_validation->set_rules('tahun', 'tahun', 'required');
            $this->form_validation->set_rules('Tingkat', 'Tingkat', 'required');
            $this->form_validation->set_rules('berita', 'berita', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->flashmsg('Terdapat Data yang Belum diisi', 'danger');
            } else {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1024;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                // $config['encrypt_name']			= TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('buktiprestasi')) {
                    $error = array('error' => $this->upload->display_errors());
                    // $this->load->view('mahasiswa/Data_Kompetisi', $error);
                    $this->flashmsg("Failed Insert Data, The image you are attempting to upload doesn't fit into the allowed dimensions.", 'danger');
                    redirect('admin_fakultas/input_Prestasi');
                } else {
                    $peran = $this->input->post('Peran');
                    $data['PeraihPrestasi'] = $this->input->post('NIM');
                    $data['Bidang']        = $this->input->post('Bidang');
                    $data['Kegiatan']       = $this->input->post('JudulLomba');
                    $data['Tahun']       = $this->input->post('tahun');
                    if ($peran != null) {
                        $data['Peran']       = $this->input->post('Peran');
                    } else {
                        $data['Peran']       = $this->input->post('peran_organisasi');
                    }
                    $data['Penyelenggara']       = $this->input->post('Penyelenggara');
                    $data['Kategori']       = $this->input->post('Kategori');
                    $data['Tingkat']       = $this->input->post('Tingkat');
                    $data['JumlahPeserta']       = $this->input->post('JumlahPeserta');
                    $data['JumlahPenghargaan']       = $this->input->post('JumlahPenghargaan');
                    $data['Status']       = "Diterima";
                    $data['BuktiPrestasi'] = $this->upload->data("file_name");
                    $data['LinkBerita']       = $this->input->post('berita');
                    // Hitung Score
                    $ParamPeran = $data['Peran'];
                    $ParamBidang = $data['Bidang'];
                    $ParamTingkat = $this->input->post('Tingkat');        //Internasional/nasional/regional/provinsi
                    $ParamKategori = $this->input->post('Kategori');      //individu/kelompok
                    $organisasi = "Organisasi kemahasiswaan/lembaga kemahasiswaan: Badan Eksekutif Mahasiswa, Senat Mahasiswa, Dewan Perwakilan Mahasiswa, Majelis Permusyawaratan Mahasiswa, Himpunan Mahasiswa";
                    $unit = "Unit Kegiatan Mahasiswa";
                    $Otonom = "Badan Semi Otonom";
                    $profesi = "Organisasi profesi mahasiswa";
                    $sosial = "Organisasi sosial kemasyarakatan";
                    if ($ParamBidang == $Otonom) {
                        $sql = "SELECT Nilai FROM penilaian WHERE Tingkat='$ParamTingkat' AND Kategori='Golongan 2' AND Pencapaian='$ParamPeran'";
                    } else if ($ParamBidang == $organisasi || $ParamBidang == $unit || $ParamBidang == $profesi || $ParamBidang == $sosial) {
                        $sql = "SELECT Nilai FROM penilaian WHERE Tingkat='$ParamTingkat' AND Kategori='Golongan 1' AND Pencapaian='$ParamPeran'";
                    } else {
                        $sql = "SELECT Nilai FROM penilaian WHERE Jenis='Penghargaan/Pengakuan' AND Tingkat='$ParamTingkat' AND Kategori='$ParamKategori'";
                    }
                    $data['Skor'] = $this->db->query($sql)->row('Nilai');
                    $this->db->insert('prestasinonkompetisi', $data);
                    $this->flashmsg("Data Berhasil Ditambahkan", 'success');
                    redirect('admin_fakultas/input_Prestasi');
                }
            }
        }
        $this->data['active'] = 5;
        $this->data['title'] = 'Mahasiswa | Tambah Data Non Kompetisi';
        $this->data['content'] = 'data_nonkompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //Mengubah Password Admin
    public function editPassword()
    {
        if ($this->input->post('ubahpassword')) {
            $this->form_validation->set_rules('password1', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');
            if ($this->form_validation->run() == FALSE) {
                $this->flashmsg('Password Gagal Diubah, Password Baru dan Password Konfirmasi Berbeda', 'danger');
            } else {
                $input['Password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $this->db->where('IDPengenal', $this->input->post('detector'));
                $this->db->update('user', $input);
                $this->flashmsg('Password Telah Berhasil Diubah');
            }
        }
        redirect('admin_fakultas/profile');
    }


    //json penyebaran prestasi berdasarkan jurusan
    public function penyebaranprestasi()
    {
        $result = [
            'data' => $this->Maptodataprestasi(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk tabel di dashboard
    public function Maptodataprestasi()
    {
        $listData = [];
        $year = date("Y");
        $data = $this->prodi->get(['Fakultas' => $this->data['userdata']->Fakultas]);
        foreach ($data as $k) {
            $prodi = $k->Prodi;
            $queryprestasikompetisi = $this->db->query("SELECT COUNT(*) AS Kompetisi FROM prestasikompetisi
                INNER JOIN user ON
                prestasikompetisi.PeraihPrestasi = user.IDPengenal
                WHERE Role = 'Mahasiswa' AND YEAR(TanggalMulai) =".$year." AND YEAR(TanggalAkhir) =".$year." AND ProgramStudi = '" . $prodi . "' AND Status='Diterima';")->row_array();
            $prestasikompetisi = $queryprestasikompetisi['Kompetisi'];

            $queryprestasinonkompetisi = $this->db->query("SELECT COUNT(*) AS NonKompetisi FROM prestasinonkompetisi
            INNER JOIN user ON
            prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND YEAR(TanggalMulai) =".$year." AND YEAR(TanggalAkhir) =".$year." AND ProgramStudi = '" . $prodi . "' AND Status='Diterima';")->row_array();

            $prestasinonkompetisi = $queryprestasinonkompetisi['NonKompetisi'];

            $data = array('Prodi' => $k->Prodi, 'Kompetisi' => $prestasikompetisi, 'NonKompetisi' => $prestasinonkompetisi);
            $listData[] =  $data;
        }
        return $listData;
    }

    //data top mahasiswa dalam format json
    public function gettopmahasiswa()
    {
        $result = [
            'data' => $this->Maptotopmahasiswa(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //method untuk memasukkan data top mahasiswa ke dalam array
    public function Maptotopmahasiswa()
    {
        $listData = [];
        $data = $this->db->query("SELECT user.Nama, user.ProgramStudi , IFNULL(t1.Skor,0)+IFNULL(t2.Skor,0) AS Skor 
        FROM user
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasikompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t1 ON t1.PeraihPrestasi = user.IDPengenal 
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasinonkompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t2 ON user.IDPengenal=t2.PeraihPrestasi WHERE user.Role='Mahasiswa' AND user.Fakultas ='" . $this->data['userdata']->Fakultas . "' AND (t1.skor IS NOT NULL OR t2.Skor IS NOT NULL) GROUP BY user.IDPengenal ORDER BY Skor DESC LIMIT 10")->result_array();
        // $data = $this->db->query("SELECT user.Nama, user.ProgramStudi , SUM(prestasikompetisi.Skor) AS Skor FROM prestasikompetisi INNER JOIN user ON
        // prestasikompetisi.PeraihPrestasi = user.IDPengenal WHERE Role='Mahasiswa' AND Status='Diterima' AND Fakultas = '" . $this->data['userdata']->Fakultas . "' GROUP BY user.Nama ORDER BY Skor DESC LIMIT 10")->result_array();
        $i = 1;
        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
                'Nama' => $k['Nama'],
                'Prodi' => $k['ProgramStudi'],
                'Skor' => $k['Skor']
            );

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //data prestasi kompetisi dalam format json
    public function getdataprestasikompetisi()
    {
        $result = [
            'data' => $this->Maptodataprestasikompetisi(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //method untuk memasukkan data prestasi kompetisi ke dalam array
    public function Maptodataprestasikompetisi()
    {
        $listData = [];
        $data = $this->db->query("SELECT `IDPrestasi` AS `ID`, `PeraihPrestasi` AS `NIM` ,user.Nama AS `Nama`, user.ProgramStudi AS `Prodi`, `Perlombaan` AS `Judul lomba`, `Penyelenggara`, `Status` FROM `prestasikompetisi` INNER JOIN `user` ON 
        prestasikompetisi.PeraihPrestasi = user.IDPengenal WHERE user.Role = 'Mahasiswa' AND user.Fakultas ='" . $this->data['userdata']->Fakultas . "' ORDER BY Status DESC")->result_array();
        $i = 1;

        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
                'ID' => $k['ID'],
                'NIM' => $k['NIM'],
                'Nama' => $k['Nama'],
                'Prodi' => $k['Prodi'],
                'Judul lomba' => $k['Judul lomba'],
                'Penyelenggara' => $k['Penyelenggara'],
                'Status' => $k['Status']
            );

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //data prestasi non kompetisi dalam format json
    public function getdataprestasinonkompetisi()
    {
        $result = [
            'data' => $this->Maptodataprestasinonkompetisi(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //method untuk memasukkan data prestasi non kompetisi ke dalam array
    public function Maptodataprestasinonkompetisi()
    {
        $listData = [];
        $data = $this->db->query("SELECT `IDPrestasi` AS `ID`, `PeraihPrestasi` AS `NIM` ,user.Nama AS `Nama`, user.ProgramStudi AS `Prodi`, `Kegiatan` , `Penyelenggara`, `Status` FROM `prestasinonkompetisi` INNER JOIN `user` ON 
        prestasinonkompetisi.PeraihPrestasi = user.IDPengenal WHERE user.Role = 'Mahasiswa' AND user.Fakultas ='" . $this->data['userdata']->Fakultas . "' ORDER BY Status DESC")->result_array();
        $i = 1;

        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
                'ID' => $k['ID'],
                'NIM' => $k['NIM'],
                'Nama' => $k['Nama'],
                'Prodi' => $k['Prodi'],
                'Kegiatan' => $k['Kegiatan'],
                'Penyelenggara' => $k['Penyelenggara'],
                'Status' => $k['Status']
            );

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //json peringkat prodi berdasarkan prestasi
    public function peringkatprodiprestasi($start, $end)
    {
        $result = [
            'data' => $this->Maptoperingkatprodiprestasi($start, $end),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk peringkat berdasarkan keseluruhan prodi berdasarkan prestasi
    public function Maptoperingkatprodiprestasi($start, $end)
    {

        $listData = [];

        // $data = $this->db->query("SELECT prodi.Prodi AS ProgramStudi, IFNULL(t3.prestasikompetisi,0) AS PrestasiKompetisi ,IFNULL(t3.prestasinonkompetisi,0) AS PrestasiNonKompetisi ,IFNULL(t3.total,0) AS Total FROM prodi
        //  LEFT JOIN
        //  (SELECT ProgramStudi,IFNULL(SUM(t1.total),0) AS prestasikompetisi,IFNULL(SUM(t2.total),0) AS prestasinonkompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS total FROM  user 
        //  LEFT JOIN 
        //  (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." OR YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t1
        //  ON t1.PeraihPrestasi=user.IDPengenal
        //  LEFT JOIN 
        //  (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." OR YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t2
        //  ON t2.PeraihPrestasi=user.IDPengenal
        //  WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "' GROUP BY ProgramStudi )t3
        //  ON t3.ProgramStudi=prodi.Prodi 
        //  WHERE prodi.Fakultas='" . $this->data['userdata']->Fakultas . "' ORDER BY total DESC")->result_array();

        $data = $this->db->query("SELECT prodi.Prodi AS ProgramStudi, IFNULL(t3.prestasikompetisi,0) AS PrestasiKompetisi, IFNULL(t3.prestasinonkompetisi,0) AS PrestasiNonKompetisi, IFNULL(t3.total,0) AS Total FROM Prodi
        LEFT JOIN
        (SELECT ProgramStudi,IFNULL(SUM(t1.total),0) AS prestasikompetisi,IFNULL(SUM(t2.total),0) AS prestasinonkompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS total FROM  user 
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t1
        ON t1.PeraihPrestasi=user.IDPengenal
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "' GROUP BY ProgramStudi)t3
        ON t3.ProgramStudi=prodi.Prodi
        WHERE prodi.Fakultas='" . $this->data['userdata']->Fakultas . "' ORDER BY total DESC")->result_array();

        foreach ($data as $k) {
            $data = array(
                'ProgramStudi' => $k['ProgramStudi'],
                'PrestasiKompetisi' => $k['PrestasiKompetisi'],
                'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
        }
        return $listData;
    }


    //json peringkat program studi berdasarkan prestasi
    public function satuperingkatprodiprestasi($start, $end, $prodi)
    {
        $result = [
            'data' => $this->Maptosatuperingkatprodiprestasi($start, $end, $prodi),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }


    //data untuk peringkat satu program studi berdasarkan prestasi
    public function Maptosatuperingkatprodiprestasi($start, $end, $prodi)
    {

        $prodi = str_replace("%20", " ", $prodi);
        $prodi = str_replace("%60", ",", $prodi);
        $prodi = str_replace("%7B", "(", $prodi);
        $prodi = str_replace("%7D", ")", $prodi);
        $prodi = str_replace("~", "/", $prodi);

        $listData = [];

        $data = $this->db->query("SELECT prodi.Prodi AS ProgramStudi, IFNULL(t3.prestasikompetisi,0) AS PrestasiKompetisi, IFNULL(t3.prestasinonkompetisi,0) AS PrestasiNonKompetisi, IFNULL(t3.total,0) AS Total FROM Prodi
          LEFT JOIN
          (SELECT ProgramStudi,IFNULL(SUM(t1.total),0) AS prestasikompetisi,IFNULL(SUM(t2.total),0) AS prestasinonkompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS total FROM  user 
          LEFT JOIN 
          (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t1
          ON t1.PeraihPrestasi=user.IDPengenal
          LEFT JOIN 
          (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t2
          ON t2.PeraihPrestasi=user.IDPengenal
          WHERE user.Role='Mahasiswa' AND Fakultas='" . $this->data['userdata']->Fakultas . "' AND ProgramStudi='" . $prodi . "' GROUP BY Fakultas)t3
          ON t3.ProgramStudi=prodi.Prodi
          WHERE prodi.Prodi='" . $prodi . "'")->result_array();

        foreach ($data as $k) {
            $data = array(
                'ProgramStudi' => $k['ProgramStudi'],
                'PrestasiKompetisi' => $k['PrestasiKompetisi'],
                'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan prodi
    public function prestasiprodi($start, $end, $prodi)
    {
        $result = [
            'data' => $this->Maptoprestasiprodi($start, $end, $prodi),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //untuk menampilkan data prestasi mahasiswa berdasarkan fakultas
    public function Maptoprestasiprodi($start, $end, $prodi)
    {
        $prodi = str_replace("%20", " ", $prodi);
        $prodi = str_replace("%60", ",", $prodi);
        $prodi = str_replace("%7B", "(", $prodi);
        $prodi = str_replace("%7D", ")", $prodi);
        $prodi = str_replace("~", "/", $prodi);
        $listData = [];

        $data = $this->db->query("SELECT t1.PeraihPrestasi,t1.Bidang,t1.Perlombaan,t1.TanggalMulai,t1.TanggalAkhir,t1.Penyelenggara,t1.Kategori,t1.Tingkat,t1.Pencapaian FROM  user
         INNER JOIN 
         (SELECT PeraihPrestasi,Bidang,Perlombaan,TanggalMulai,TanggalAkhir,Penyelenggara,Kategori,Tingkat,Pencapaian FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end."
         UNION ALL
         SELECT PeraihPrestasi,Bidang, Kegiatan AS Perlombaan,TanggalMulai,TanggalAkhir,Penyelenggara,Kategori,Tingkat, '-' AS Pencapaian FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end."
         )t1
         ON t1.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "' AND ProgramStudi='" . $prodi . "' ORDER BY t1.Pencapaian DESC")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Perlombaan' => $k['Perlombaan'],
                'TanggalMulai' => date_format(date_create($k['TanggalMulai']), "d F Y"),
                'TanggalAkhir' => date_format(date_create($k['TanggalAkhir']), "d F Y"),
                'Penyelenggara' => $k['Penyelenggara'],
                'Kategori' => $k['Kategori'],
                'Tingkat' => $k['Tingkat'],
                'Pencapaian' => $k['Pencapaian']
            );
            $listData[] =  $data;

            $i += 1;
        }
        return $listData;
    }

    //json peringkat prodi berdasarkan jumlah mahasiswa
    public function peringkatprodimahasiswa($start, $end)
    {
        $result = [
            'data' => $this->Maptoperingkatprodimahasiswa($start, $end),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk peringkat prodi berdasarkan jumlah mahasiswa
    public function Maptoperingkatprodimahasiswa($start, $end)
    {
        $listData = [];

        $data = $this->db->query("SELECT prodi.Prodi AS ProgramStudi, IFNULL(t3.TotalMahasiswa,0) AS TotalMahasiswa FROM prodi
         LEFT JOIN
         (SELECT ProgramStudi,COUNT(Fakultas) AS TotalMahasiswa FROM  user 
         INNER JOIN 
         (SELECT DISTINCT(t1.PeraihPrestasi) FROM
         (SELECT PeraihPrestasi FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi
         UNION ALL
         SELECT PeraihPrestasi FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t1)t2
         ON t2.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND Fakultas='" . $this->data['userdata']->Fakultas . "' GROUP BY ProgramStudi)t3
         ON t3.ProgramStudi=prodi.Prodi WHERE prodi.Fakultas='" . $this->data['userdata']->Fakultas . "' ORDER BY TotalMahasiswa DESC ")->result_array();

        foreach ($data as $k) {
            $data = array('ProgramStudi' => $k['ProgramStudi'], 'TotalMahasiswa' => $k['TotalMahasiswa']);
            $listData[] =  $data;
        }
        return $listData;
    }


    //json peringkat satu fakultas berdasarkan jumlah mahasiswa
    public function satuperingkatprodimahasiswa($start, $end, $prodi)
    {
        $result = [
            'data' => $this->Maptosatuperingkatprodimahasiswa($start, $end, $prodi),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk peringkat fakultas berdasarkan jumlah mahasiswa (hanya satu fakultas)
    public function Maptosatuperingkatprodimahasiswa($start, $end, $prodi)
    {
        $prodi = str_replace("%20", " ", $prodi);
        $prodi = str_replace("%60", ",", $prodi);
        $prodi = str_replace("%7B", "(", $prodi);
        $prodi = str_replace("%7D", ")", $prodi);
        $prodi = str_replace("~", "/", $prodi);
        $listData = [];

        $data = $this->db->query("SELECT prodi.Prodi AS ProgramStudi, IFNULL(t3.TotalMahasiswa,0) AS TotalMahasiswa FROM prodi
         LEFT JOIN
         (SELECT ProgramStudi,COUNT(Fakultas) AS TotalMahasiswa FROM  user 
         INNER JOIN 
         (SELECT DISTINCT(t1.PeraihPrestasi) FROM
         (SELECT PeraihPrestasi FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi
         UNION ALL
         SELECT PeraihPrestasi FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t1)t2
         ON t2.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "' AND ProgramStudi='" . $prodi . "')t3
         ON t3.ProgramStudi=prodi.Prodi WHERE prodi.Prodi='" . $prodi . "'ORDER BY TotalMahasiswa DESC")->result_array();

        foreach ($data as $k) {
            $data = array('ProgramStudi' => $k['ProgramStudi'], 'TotalMahasiswa' => $k['TotalMahasiswa']);
            $listData[] =  $data;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan tahun dan prodi
    public function prestasimahasiswa($start, $end, $prodi)
    {
        $result = [
            'data' => $this->Maptoprestasimahasiswa($start, $end, $prodi),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }


    //data untuk prestasi mahasiswa berdasarkan tahun dan prodi
    public function Maptoprestasimahasiswa($start, $end, $prodi)
    {
        $prodi = str_replace("%20", " ", $prodi);
        $prodi = str_replace("%60", ",", $prodi);
        $prodi = str_replace("%7B", "(", $prodi);
        $prodi = str_replace("%7D", ")", $prodi);
        $prodi = str_replace("~", "/", $prodi);
        $listData = [];

        $data = $this->db->query("SELECT Nama, IFNULL(SUM(t1.total),0) AS PrestasiKompetisi,IFNULL(SUM(t2.total),0) AS PrestasiNonKompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS Total FROM  user 
         LEFT JOIN 
         (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t1
         ON t1.PeraihPrestasi=user.IDPengenal
         LEFT JOIN 
         (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." GROUP BY PeraihPrestasi)t2
         ON t2.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND Fakultas='" . $this->data['userdata']->Fakultas . "' AND ProgramStudi='" . $prodi . "' AND (t1.total!=0 OR t2.total!=0 ) GROUP BY user.Nama ORDER BY total DESC")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Nama' => $k['Nama'],
                'PrestasiKompetisi' => $k['PrestasiKompetisi'],
                'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan tahun dan fakultas
    public function peringkatbidang($start, $end)
    {
        $result = [
            'data' => $this->Maptoperingkatbidang($start, $end),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data analisis peringkat bidang
    public function Maptoperingkatbidang($start, $end)
    {
        $listData = [];

        $data = $this->db->query("SELECT bidangprestasi.Bidang,IFNULL(t2.Total,0) AS Total FROM bidangprestasi
         LEFT JOIN
         (SELECT t1.Bidang, COUNT(t1.Bidang) AS Total FROM user
         INNER JOIN
         (SELECT PeraihPrestasi,Bidang FROM prestasikompetisi WHERE Status='Diterima' AND YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end."
         UNION ALL
         SELECT PeraihPrestasi,Bidang FROM prestasinonkompetisi WHERE Status='Diterima' AND  YEAR(TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end.")t1
         ON user.IDPengenal=t1.PeraihPrestasi 
         WHERE user.Fakultas='" . $this->data['userdata']->Fakultas . "'
         GROUP BY t1.Bidang)t2
         ON t2.Bidang=bidangprestasi.Bidang ORDER BY Total DESC")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan tahun dan fakultas
    public function prestasibidang($start, $end, $bidang)
    {

        $result = [
            'data' => $this->Maptoprestasibidang($start, $end, $bidang),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    // data prestasi bidang mahasiswa
    public function Maptoprestasibidang($start, $end, $bidang)
    {
        $bidang = str_replace("%60", ",", $bidang);
        $bidang = str_replace("%20", " ", $bidang);
        $bidang = str_replace("~", "/", $bidang);
        $bidang = str_replace("%7B", "(", $bidang);
        $bidang = str_replace("%7D", ")", $bidang);

        $listData = [];
        //  $data;

        $jenisbidang = $this->db->query("SELECT bidangprestasi.JalurPencapaian FROM bidangprestasi WHERE Bidang='" . $bidang . "'")->result_array();
        foreach ($jenisbidang as $k) {
            $jenisbidang = $k['JalurPencapaian'];
        }

        if ($jenisbidang == 'Kompetisi') {
            $data = $this->db->query("SELECT Nama,prestasikompetisi.PeraihPrestasi AS NIM,Fakultas,ProgramStudi,prestasikompetisi.Perlombaan,prestasikompetisi.TanggalMulai,prestasikompetisi.TanggalAkhir,prestasikompetisi.Penyelenggara,prestasikompetisi.Kategori,prestasikompetisi.Tingkat,prestasikompetisi.Pencapaian FROM  user
         INNER JOIN 
         prestasikompetisi
         ON prestasikompetisi.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "' AND prestasikompetisi.Bidang='" . $bidang . "' AND prestasikompetisi.Status='Diterima' AND YEAR(TanggalMulai) = ".$start." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end." ORDER BY prestasikompetisi.Pencapaian DESC")->result_array();
        } else if ($jenisbidang == 'Non Kompetisi') {
            $data = $this->db->query("SELECT 
         Nama,prestasinonkompetisi.PeraihPrestasi AS NIM,Fakultas,ProgramStudi,prestasinonkompetisi.Kegiatan AS Perlombaan,prestasinonkompetisi.TanggalMulai,prestasinonkompetisi.TanggalAkhir,prestasinonkompetisi.Penyelenggara,prestasinonkompetisi.Kategori,prestasinonkompetisi.Tingkat,'-' AS Pencapaian FROM  user
         INNER JOIN 
         prestasinonkompetisi
         ON prestasinonkompetisi.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "' AND prestasinonkompetisi.Status='Diterima' AND prestasinonkompetisi.Bidang='" . $bidang . "' AND YEAR(TanggalMulai) = ".$start." AND YEAR(TanggalAkhir) BETWEEN ".$start." AND ".$end)->result_array();
        }

        $i = 1;

        foreach ($data as $k) {

            $data = array(
                'No' => $i,
                'Nama' => $k['Nama'],
                'NIM' => $k['NIM'],
                'Fakultas' => $k['Fakultas'],
                'ProgramStudi' => $k['ProgramStudi'],
                'Perlombaan' => $k['Perlombaan'],
                'TanggalMulai' => date_format(date_create($k['TanggalMulai']), "d F Y"),
                'TanggalAkhir' => date_format(date_create($k['TanggalAkhir']), "d F Y"),
                'Penyelenggara' => $k['Penyelenggara'],
                'Kategori' => $k['Kategori'],
                'Tingkat' => $k['Tingkat'],
                'Pencapaian' => $k['Pencapaian']
            );
            $listData[] =  $data;
            $i += 1;
        }
        return $listData;
    }

    //json prestasi bidang berdasarkan jenis prestasi (kompetisi / non kompetisi)
    public function prestasibidangjenisprestasi($start, $end, $jenisprestasi)
    {
        $result = [
            'data' => $this->Maptoprestasibidangjenisprestasi($start, $end, $jenisprestasi),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data prestasi bidang berdasarkan jenis prestasi (kompetisi / non kompetisi)
    public function Maptoprestasibidangjenisprestasi($start, $end, $jenisprestasi)
    {
        $jenisprestasi = str_replace("%60", ",", $jenisprestasi);
        $jenisprestasi = str_replace("%20", " ", $jenisprestasi);
        $jenisprestasi = str_replace("~", "/", $jenisprestasi);
        $jenisprestasi = str_replace("%7B", "(", $jenisprestasi);
        $jenisprestasi = str_replace("%7D", ")", $jenisprestasi);
        $listData = [];
        // $data;

        if ($jenisprestasi == 'Kompetisi') {
            $data = $this->db->query("SELECT bidangprestasi.Bidang,COUNT(t2.Bidang) AS Total FROM bidangprestasi
             LEFT JOIN
             (SELECT user.IDPengenal,t1.Bidang FROM user
             INNER JOIN
             (SELECT prestasikompetisi.PeraihPrestasi,prestasikompetisi.Bidang AS Bidang FROM prestasikompetisi 
                 WHERE prestasikompetisi.Status='Diterima' AND YEAR(prestasikompetisi.TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(prestasikompetisi.TanggalAkhir) BETWEEN ".$start." AND ".$end."
             )t1
                 ON t1.PeraihPrestasi=user.IDPengenal
                 WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "')t2
             ON t2.Bidang=bidangprestasi.Bidang WHERE bidangprestasi.JalurPencapaian='Kompetisi'
             GROUP BY bidangprestasi.Bidang ORDER BY Total DESC")->result_array();
        } else if ($jenisprestasi == 'Non Kompetisi') {
            $data = $this->db->query("SELECT bidangprestasi.Bidang,COUNT(t2.Bidang) AS Total FROM bidangprestasi
             LEFT JOIN
             (SELECT user.IDPengenal,t1.Bidang FROM user
             INNER JOIN
             (SELECT prestasinonkompetisi.PeraihPrestasi,prestasinonkompetisi.Bidang AS Bidang FROM prestasinonkompetisi 
                 WHERE prestasinonkompetisi.Status='Diterima' AND YEAR(prestasinonkompetisi.TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(prestasinonkompetisi.TanggalAkhir) BETWEEN ".$start." AND ".$end.")t1
                 ON t1.PeraihPrestasi=user.IDPengenal
                 WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "')t2
             ON t2.Bidang=bidangprestasi.Bidang WHERE bidangprestasi.JalurPencapaian='Non Kompetisi'
             GROUP BY bidangprestasi.Bidang ORDER BY Total DESC")->result_array();
        }

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }

        return $listData;
    }

    //json prestasi bidang berdasarkan bidang
    public function prestasibidangjenisbidang($start, $end, $jenisbidang)
    {
        $result = [
            'data' => $this->Maptoprestasibidangjenisbidang($start, $end, $jenisbidang),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data prestasi bidang berdasarkan jenis prestasi (kompetisi / non kompetisi)
    public function Maptoprestasibidangjenisbidang($start, $end, $jenisbidang)
    {
        $jenisbidang = str_replace("%60", ",", $jenisbidang);
        $jenisbidang = str_replace("%20", " ", $jenisbidang);
        $jenisbidang = str_replace("~", "/", $jenisbidang);
        $jenisbidang = str_replace("%7B", "(", $jenisbidang);
        $jenisbidang = str_replace("%7D", ")", $jenisbidang);

        $listData = [];
        $data = $this->db->query("SELECT bidangprestasi.Bidang,COUNT(t2.Bidang) AS Total FROM bidangprestasi
         LEFT JOIN
         (SELECT user.IDPengenal,t1.Bidang FROM user
         INNER JOIN
         (SELECT prestasikompetisi.PeraihPrestasi,prestasikompetisi.Bidang AS Bidang FROM prestasikompetisi 
             WHERE prestasikompetisi.Status='Diterima' AND YEAR(prestasikompetisi.TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(prestasikompetisi.TanggalAkhir) BETWEEN ".$start." AND ".$end."
         UNION ALL
         SELECT prestasinonkompetisi.PeraihPrestasi,prestasinonkompetisi.Bidang AS Bidang FROM prestasinonkompetisi 
             WHERE prestasinonkompetisi.Status='Diterima' AND YEAR(prestasinonkompetisi.TanggalMulai) BETWEEN ".$start." AND ".$end." AND YEAR(prestasinonkompetisi.TanggalAkhir) BETWEEN ".$start." AND ".$end.")t1
             ON t1.PeraihPrestasi=user.IDPengenal
             WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $this->data['userdata']->Fakultas . "')t2
         ON t2.Bidang=bidangprestasi.Bidang  WHERE bidangprestasi.Bidang='" . $jenisbidang . "'
         GROUP BY bidangprestasi.Bidang")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }

        return $listData;
    }
}
