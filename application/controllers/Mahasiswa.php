<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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


        // $this->data['user'] = $this->db->query("SELECT `user`.`Nama`, `user`.`Role`, `user`.`IDPengenal`, `role`.`Role` FROM `user` INNER JOIN `role` ON `user`.`Role` = `role`.`RoleID` WHERE `user`.`IDPengenal` = '" . $this->data['IDpengenal'] . "'")->row();
        $this->data['user'] = $this->db->get_where('user', ['IDPengenal' => $this->session->userdata('IDpengenal')])->row_array();
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

    public function prestasi()
    {
        $this->data['active'] = 2;
        $this->data['title'] = 'Mahasiswa | Prestasi ';
        $this->data['content'] = 'prestasi';
        $this->load->view('mahasiswa/template/template', $this->data);
    }
}
