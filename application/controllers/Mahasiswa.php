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
        // if (isset($this->data['IDpengenal'], $this->data['Role'])) {
        //     if ($this->data['Role'] != "Mahasiswa") {
        //         redirect('logout');
        //     }
        // } else {
        //     redirect('logout');
        // }

        $this->data['userdata'] = $this->db->query("SELECT `user`.`IDPengenal`, `user`.`Nama`, `user`.`Fakultas`, `user`.`ProgramStudi`, `user`.`Email`, `user`.`IPK`, `user`.`Telephone`, `role`.`Role` FROM `user` INNER JOIN `role` ON `user`.`Role` = `role`.`Role` WHERE `user`.`IDPengenal` = '" . $this->data['IDpengenal'] . "'")->row();
        // $this->data['user'] = $this->db->get_where('user', ['IDPengenal' => $this->session->userdata('IDpengenal')])->row_array();
        // var_dump($this->data['user']);
        // die;
        $this->load->model('user_m');
        $this->load->library('UserObj');
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

    public function Prestasi_NonKompetisi()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Mahasiswa | Prestasi Non Kompetisi';
        $this->data['content'] = 'prestasi_Nonkompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    public function Data_Kompetisi()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Mahasiswa | Tambah Data Kompetisi';
        $this->data['content'] = 'data_kompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }

    public function Data_NonKompetisi()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Mahasiswa | Tambah Data Non Kompetisi';
        $this->data['content'] = 'data_nonkompetisi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }
}
