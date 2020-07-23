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
        $this->load->library('UserObj');
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

        // $listData = [];
        // $data = $this->prestasi_kompetisi->get(['PeraihPrestasi' => $this->data['IDpengenal']]);
        // $i = 1;
        // foreach ($data as $k) {
        //     $obj = new UserObj();
        //     $obj->no = $i;
        //     $Name = $this->db->query("SELECT `Nama` as nama From `user` WHERE IDPengenal = '$k->PeraihPrestasi' ")->row();
        //     $obj->Nama = $Name->nama;
        //     $obj->PeraihPrestasi = $k->PeraihPrestasi;
        //     $obj->Bidang = $k->Bidang;
        //     $obj->Perlombaan = $k->Perlombaan;
        //     $obj->Tahun = $k->Tahun;
        //     $obj->Penyelenggara = $k->Penyelenggara;
        //     $obj->Kategori = $k->Kategori;
        //     $obj->Tingkat = $k->Tingkat;
        //     $obj->Pencapaian = $k->Pencapaian;
        //     $obj->BuktiPrestasi = $k->BuktiPrestasi;
        //     $obj->Status = $k->Status;
        //     $obj->LinkBerita = $k->LinkBerita;

        //     $listData[] = $obj;
        //     $i = $i + 1;
        // }
        // return $listData;
    }
}
