<?php
defined('BASEPATH') or exit('No direct script access allowed');

class signup_berhasil extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();

    //     $this->load->model('user_m');
    //     $this->load->model('Mahasiswa_regis');
    // }

    public function index()
    {
        $this->load->view('signup_berhasil');
    }
}
