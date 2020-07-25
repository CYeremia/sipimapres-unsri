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
            WHERE Role = 'Mahasiswa' AND Fakultas = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima' AND Tahun =" . $year)->row(), //jumlah prestasi kompetisi

            $this->db->query("SELECT COUNT(*) AS `nonkompetisi` FROM `prestasinonkompetisi`
            INNER JOIN user ON prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND Fakultas = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima' AND Tahun =" . $year)->row() //jumlah prestasi non kompetisi
        ];
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>');
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
    public function prestasi_kompetisi()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Kompetisi ';
        $this->data['content'] = 'Verifikasi_kompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }
    public function prestasi_Nonkompetisi()
    {
        $this->data['active'] = 4;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Non Kompetisi ';
        $this->data['content'] = 'Verifikasi_Nonkompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }
    public function tambah_dataprestasi()
    {
        $this->data['active'] = 2;
        $this->data['title'] = 'Admin Fakultas | Verifikasi Prestasi Non Kompetisi ';
        $this->data['content'] = 'Verifikasi_Nonkompetisi';
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
    public function MapToObject()
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
    public function getdataMahasiswa()
    {
        $id = $this->input->post('ID');
        // print_r($id);
        // die;
        $id = str_replace(" ", "", $id);
        $dataku = $this->user_m->get(['IDPengenal' => $id]);
        $result = [
            'data' => $dataku,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //Seleksi Prestasi Mahasiswa
    public function seleksipage()
    {
        if ($_POST['prestasi'] == 'Prestasi Kompetisi') {
            $this->data['ID'] = $_POST['Nimmahasiswa'];
            $this->data['Nama'] = $_POST['namamahasiswa'];
            $this->data['active'] = 2;
            $this->data['title'] = 'Admin Fakultas | Tambah Data Kompetisi';
            $this->data['content'] = 'data_kompetisi';
            $this->load->view('admin_fakultas/template/template', $this->data);
        } else if ($_POST['prestasi'] == 'Prestasi Non Kompetisi') {
            $this->data['ID'] = $_POST['Nimmahasiswa'];
            $this->data['Nama'] = $_POST['namamahasiswa'];
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
                    $this->load->view('mahasiswa/Data_Kompetisi', $error);
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
                    $data['BuktiPrestasi'] = $this->upload->data("file_name");
                    $this->db->insert('prestasikompetisi', $data);
                    redirect('admin_fakultas/input_Prestasi');
                }
            }
        }
        $this->data['active'] = 2;
        $this->data['title'] = 'Admin Fakultas | Tambah Data Kompetisi';
        $this->data['content'] = 'data_kompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

    //menambahkan data prestasi Non kompetisi mahasiswa
    public function Data_NonKompetisi()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('JudulLomba', 'JudulLomba', 'required|trim');
            $this->form_validation->set_rules('Penyelenggara', 'Penyelenggara', 'required|trim');
            $this->form_validation->set_rules('Kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('Peran', 'Peran', 'required|trim');

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
                    $this->load->view('mahasiswa/Data_Kompetisi', $error);
                } else {
                    $data['PeraihPrestasi'] = $this->input->post('NIM');
                    $data['Kegiatan']       = $this->input->post('JudulLomba');
                    $data['Tahun']       = $this->input->post('tahun');
                    $data['Penyelenggara']       = $this->input->post('Penyelenggara');
                    $data['Kategori']       = $this->input->post('Kategori');
                    $data['Tingkat']       = $this->input->post('Tingkat');
                    $data['Status']       = "Diterima";
                    $data['BuktiPrestasi'] = $this->upload->data("file_name");
                    $data['LinkBerita']       = $this->input->post('berita');
                    $this->db->insert('prestasinonkompetisi', $data);
                    redirect('admin_fakultas/input_Prestasi');
                }
            }
        }

        $this->data['active'] = 5;
        $this->data['title'] = 'Mahasiswa | Tambah Data Non Kompetisi';
        $this->data['content'] = 'data_nonkompetisi';
        $this->load->view('admin_fakultas/template/template', $this->data);
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
                WHERE Role = 'Mahasiswa' AND Tahun=" . $year . " AND ProgramStudi = '" . $prodi . "' AND Status='Diterima';")->row_array();
            $prestasikompetisi = $queryprestasikompetisi['Kompetisi'];

            $queryprestasinonkompetisi = $this->db->query("SELECT COUNT(*) AS NonKompetisi FROM prestasinonkompetisi
            INNER JOIN user ON
            prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND Tahun=" . $year . " AND ProgramStudi = '" . $prodi . "' AND Status='Diterima';")->row_array();

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
        $data = $this->db->query("SELECT user.Nama, user.ProgramStudi , SUM(prestasikompetisi.Skor) AS Skor FROM prestasikompetisi INNER JOIN user ON
        prestasikompetisi.PeraihPrestasi = user.IDPengenal WHERE Role='Mahasiswa' AND Status='Diterima' AND Fakultas = '" . $this->data['userdata']->Fakultas . "' GROUP BY user.Nama ORDER BY Skor DESC LIMIT 10")->result_array();
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
        $data = $this->db->query("SELECT `PeraihPrestasi` AS `NIM` ,user.Nama AS `Nama`, user.ProgramStudi AS `Prodi`, `Perlombaan` AS `Judul lomba`, `Penyelenggara`, `Status` FROM `prestasikompetisi` INNER JOIN `user` ON 
        prestasikompetisi.PeraihPrestasi = user.IDPengenal WHERE user.Role = 'Mahasiswa' AND user.Fakultas ='".$this->data['userdata']->Fakultas."' ORDER BY Status DESC") ->result_array();
        $i = 1;

        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
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
        $data = $this->db->query("SELECT `PeraihPrestasi` AS `NIM` ,user.Nama AS `Nama`, user.ProgramStudi AS `Prodi`, `Kegiatan` , `Penyelenggara`, `Status` FROM `prestasinonkompetisi` INNER JOIN `user` ON 
        prestasinonkompetisi.PeraihPrestasi = user.IDPengenal WHERE user.Role = 'Mahasiswa' AND user.Fakultas ='".$this->data['userdata']->Fakultas."' ORDER BY Status DESC") ->result_array();
        $i = 1;

        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
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



}
