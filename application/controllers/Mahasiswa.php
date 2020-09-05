<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
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
            if ($this->data['Role'] != "Mahasiswa") {
                redirect('logout');
            }
        } else {
            redirect('logout');
        }

        $this->load->model('user_m');
        $this->load->model('prestasi_kompetisi');
        $this->load->model('prestasi_nonkompetisi');
        $this->load->library('UserObj');

        $this->data['userdata'] = $this->db->query("SELECT `user`.`IDPengenal`, `user`.`Nama`, `user`.`Fakultas`, `user`.`ProgramStudi`, `user`.`Email`, `user`.`IPK`, `user`.`Telephone`, `role`.`Role` FROM `user` INNER JOIN `role` ON `user`.`Role` = `role`.`Role` WHERE `user`.`IDPengenal` = '" . $this->data['IDpengenal'] . "'")->row();
        $this->data['jumlah'] =
            [
                $this->db->query("SELECT COUNT(*) AS `kompetisi` FROM `prestasikompetisi` WHERE `PeraihPrestasi` = '" . $this->data['userdata']->IDPengenal . "' AND `Status` = 'Diterima'")->row(),
                $this->db->query("SELECT COUNT(*) AS `nonkompetisi` FROM `prestasinonkompetisi` WHERE `PeraihPrestasi` = '" . $this->data['userdata']->IDPengenal . "' AND `Status` = 'Diterima'")->row()
            ];





        //     $this->data['jumlah'] = [
        //         "mantul" => $this->prestasi_kompetisi->get_num_row(['PeraihPrestasi' => $this->data['userdata']->IDPengenal , 'Status' => 'Diterima']), // Jumlah Prestasi Kompetisi
        //         $this->prestasi_nonkompetisi->get_num_row(['PeraihPrestasi' => $this->data['userdata']->IDPengenal , 'Status' => 'Diterima']) // Jumlah Prestasi Non Kompetisi
        // ]; 

        // print '
        // <script type="text/javascript">
        //      var carnr;        
        //      carnr = "'.$this->data['jumlah']->kompetisi.'"
        //      console.log(carnr);
        // </script>';   


        // $this->data['user'] = $this->db->get_where('user', ['IDPengenal' => $this->session->userdata('IDpengenal')])->row_array();
        // var_dump($this->data['user']);
        // die;
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"> <a href="#" class="close2" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>');
    }

    public function index()
    // $Userdata['user'] = $this->db->get_where('user', ['IDpengenal' => $this->session->userdata('IDpengenal')])->row_array();
    {
        $this->data['active'] = 1;
        $this->data['title'] = 'Mahasiswa | Dashboard ';
        $this->data['content'] = 'main';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    public function Prestasi_Kompetisi()
    {
        $this->data['active'] = 2;
        $this->data['title'] = 'Mahasiswa | Prestasi Kompetisi';
        $this->data['content'] = 'prestasi_kompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    //get data select bidang untuk filter
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

    public function Data_Kompetisi()
    {
        $sql = "SELECT Bidang FROM bidangprestasi WHERE JalurPencapaian='Kompetisi'";
        $databidang = $this->db->query($sql)->result();
        $this->data['databidang'] = $databidang;
        $this->data['active'] = 2;
        $this->data['title'] = 'Mahasiswa | Tambah Data Kompetisi';
        $this->data['content'] = 'data_kompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    public function Prestasi_NonKompetisi()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Mahasiswa | Prestasi Non Kompetisi';
        $this->data['content'] = 'prestasi_Nonkompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    public function Data_NonKompetisi()
    {
        $sql = "SELECT Bidang FROM bidangprestasi WHERE JalurPencapaian='Non Kompetisi'";
        $databidang = $this->db->query($sql)->result();
        $this->data['databidang'] = $databidang;
        $this->data['active'] = 3;
        $this->data['title'] = 'Mahasiswa | Tambah Data Non Kompetisi';
        $this->data['content'] = 'data_nonkompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    public function inputData_Kompetisi()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('JudulLomba', 'JudulLomba', 'required|trim');
            $this->form_validation->set_rules('Penyelenggara', 'Penyelenggara', 'required|trim');
            $this->form_validation->set_rules('Kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('Pencapaian', 'Pencapaian', 'required');

            $this->form_validation->set_rules('Bidang', 'Bidang', 'required');
            $this->form_validation->set_rules('tahun', 'tahun', 'required');
            $this->form_validation->set_rules('Tingkat', 'Tingkat', 'required');
            $this->form_validation->set_rules('berita', 'berita', 'required|trim');

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
                    $this->flashmsg("The image you are attempting to upload doesn't fit into the allowed dimensions.", 'danger');
                    redirect('mahasiswa/Data_Kompetisi');
                    // $this->load->view('mahasiswa/Data_Kompetisi', $error);
                } else {
                    $data['PeraihPrestasi'] = $this->data['IDpengenal'];
                    $data['Bidang']        = $this->input->post('Bidang');
                    $data['Perlombaan']       = $this->input->post('JudulLomba');
                    $data['Tahun']       = $this->input->post('tahun');
                    $data['Penyelenggara']       = $this->input->post('Penyelenggara');
                    $data['Kategori']       = $this->input->post('Kategori');
                    $data['Tingkat']       = $this->input->post('Tingkat');
                    $data['Pencapaian']       = $this->input->post('Pencapaian');
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
                    redirect('mahasiswa/prestasi_kompetisi');
                }
            }
        }
    }

    public function data_prestasi()
    {
        $result = [
            'data' => $this->MapToObject(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function MapToObject()
    {
        $listData = [];
        $data = $this->prestasi_kompetisi->get(['PeraihPrestasi' => $this->data['IDpengenal']]);
        $i = 1;
        foreach ($data as $k) {
            $obj = new UserObj();
            $obj->no = $i;
            $Name = $this->db->query("SELECT `Nama` as nama From `user` WHERE IDPengenal = '$k->PeraihPrestasi' ")->row();
            $obj->Nama = $Name->nama;
            $obj->PeraihPrestasi = $k->PeraihPrestasi;
            $obj->Bidang = $k->Bidang;
            $obj->Perlombaan = $k->Perlombaan;
            $obj->Tahun = $k->Tahun;
            $obj->Penyelenggara = $k->Penyelenggara;
            $obj->Kategori = $k->Kategori;
            $obj->Tingkat = $k->Tingkat;
            $obj->Pencapaian = $k->Pencapaian;
            $obj->BuktiPrestasi = $k->BuktiPrestasi;
            $obj->JumlahPeserta = $k->JumlahPeserta;
            $obj->JumlahPenghargaan = $k->JumlahPenghargaan;
            $obj->Status = $k->Status;
            $obj->LinkBerita = $k->LinkBerita;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    public function inputData_NonKompetisi()
    {
        if ($this->input->post('submit')) {
            // print_r($this->input->post('Peran'));
            // die;
            $this->form_validation->set_rules('JudulLomba', 'JudulLomba', 'required|trim');
            $this->form_validation->set_rules('Penyelenggara', 'Penyelenggara', 'required|trim');
            $this->form_validation->set_rules('Kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('Peran', 'Peran', 'trim');

            $this->form_validation->set_rules('tahun', 'tahun', 'required');
            $this->form_validation->set_rules('Tingkat', 'Tingkat', 'required');
            $this->form_validation->set_rules('berita', 'berita', 'required|trim');

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
                    $this->flashmsg("The image you are attempting to upload doesn't fit into the allowed dimensions.", 'danger');
                    redirect('mahasiswa/Data_NonKompetisi');
                    // $this->load->view('mahasiswa/Data_NonKompetisi', $error);
                } else {
                    $peran = $this->input->post('Peran');
                    $data['PeraihPrestasi'] = $this->data['IDpengenal'];
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
                    redirect('mahasiswa/prestasi_nonkompetisi');
                }
            }
        }
    }

    public function data_prestasiNon()
    {
        $result = [
            'data' => $this->MapToNon(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function MapToNon()
    {
        $listData = [];
        $data = $this->prestasi_nonkompetisi->get(['PeraihPrestasi' => $this->data['IDpengenal']]);
        $i = 1;
        foreach ($data as $k) {
            $obj = new UserObj();
            $obj->no = $i;
            $Name = $this->db->query("SELECT `Nama` as nama From `user` WHERE IDPengenal = '$k->PeraihPrestasi' ")->row();
            $obj->Nama = $Name->nama;
            $obj->PeraihPrestasi = $k->PeraihPrestasi;
            $obj->Bidang = $k->Bidang;
            $obj->Kegiatan = $k->Kegiatan;
            $obj->Tahun = $k->Tahun;
            $obj->Penyelenggara = $k->Penyelenggara;
            $obj->Kategori = $k->Kategori;
            $obj->Tingkat = $k->Tingkat;
            $obj->JumlahPeserta = $k->JumlahPeserta;
            $obj->JumlahPenghargaan = $k->JumlahPenghargaan;
            $obj->BuktiPrestasi = $k->BuktiPrestasi;
            $obj->Status = $k->Status;
            $obj->LinkBerita = $k->LinkBerita;
            $obj->Peran = $k->Peran;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }
}
