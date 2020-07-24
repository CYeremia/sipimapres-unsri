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

        //jumlah data untuk dashboard
        $this->data['jumlah'] = [

            $this->db->query("SELECT COUNT(*) AS `mahasiswa` FROM `user` WHERE `Role` = 'Mahasiswa' AND `Fakultas` ='" . $this->data['userdata']->Fakultas . "'")->row(), //jumlah mahasiswa

            $this->db->query("SELECT COUNT(*) AS `kompetisi` FROM `prestasikompetisi`
            INNER JOIN user ON prestasikompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Fakultas = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima'")->row(), //jumlah prestasi kompetisi

            $this->db->query("SELECT COUNT(*) AS `nonkompetisi` FROM `prestasinonkompetisi`
            INNER JOIN user ON prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Fakultas = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima'")->row() //jumlah prestasi non kompetisi
        ];
    }

    public function index()
    {
        $this->data['active'] = 1;
        $this->data['title'] = 'Admin Fakultas | Dashboard ';
        $this->data['content'] = 'main';
        $this->load->view('admin_fakultas/template/template', $this->data);
    }

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

    public function MapToObject()
    {
        $listData = [];
        $data = $this->user_m->get(['Role' => 'Mahasiswa']);
        $i = 1;
        foreach ($data as $k) {
            $obj = new UserObj();
            $obj->no = $i;
            // $Name = $this->db->query("SELECT `Nama` as nama From `user` WHERE IDPengenal = '$k->PeraihPrestasi' ")->row();
            // $obj->Nama = $Name->nama;
            $obj->Nama = $k->Nama;
            $obj->IDPengenal = $k->IDPengenal;
            $obj->ProgramStudi = $k->ProgramStudi;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }


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
                WHERE Tahun=".$year." AND ProgramStudi = '".$prodi."' AND Status='Diterima';")->row_array();
            $prestasikompetisi = $queryprestasikompetisi['Kompetisi'];

            $queryprestasinonkompetisi = $this->db->query("SELECT COUNT(*) AS NonKompetisi FROM prestasinonkompetisi
            INNER JOIN user ON
            prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Tahun=".$year." AND ProgramStudi = '".$prodi."' AND Status='Diterima';") ->row_array();

            $prestasinonkompetisi = $queryprestasinonkompetisi['NonKompetisi'];

                $data = array('Prodi' => $k->Prodi , 'Kompetisi' => $prestasikompetisi , 'NonKompetisi' => $prestasinonkompetisi);
                $listData[] =  $data;
            

//             SELECT * FROM prestasikompetisi
// INNER JOIN user ON
// prestasikompetisi.PeraihPrestasi = user.IDPengenal
// WHERE Tahun=2016 AND ProgramStudi = 'Teknik Informatika (S1)' AND Status='Diterima';

        }
        return $listData;
    }

    public function prestasikompetisi()
    {   

        return $year;
    }

    public function prestasinonkompetisi()
    {
    }


    // mengambil data mahasiswa berdasarkan IDpengenal/NIM
    public function getdataMahasiswa()
    {
        $id = $this->input->post('ID');
        // print_r($id);
        // die;
        // $this->db->where('IDPengenal', $id);
        // $dataku = $this->db->query("SELECT `user`.`IDPengenal`, `user`.`Nama`, `user`.`Fakultas`, `user`.`ProgramStudi`, `user`.`Email`, `user`.`IPK`, `user`.`Telephone`, `role`.`Role` FROM `user` INNER JOIN `role` ON `user`.`Role` = `role`.`Role` WHERE `user`.`IDPengenal` = '" . $id . "'")->result();
        $dataku = $this->user_m->get(['IDPengenal' => $id]);
        // $dataku = $this->db->get('user')->result();
        $result = [
            'data' => $dataku,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
