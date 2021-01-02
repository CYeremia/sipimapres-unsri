<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->data['IDpengenal'] = $this->session->userdata('IDpengenal');
        $this->data['Role'] = $this->session->userdata('Role');
        if (isset($this->data['IDpengenal'], $this->data['Role'])) {
            if ($this->data['Role'] == "Administrator Sistem") {
                redirect('admin_sistem');
            } elseif ($this->data['Role'] == "Administrasi Fakultas") {
                redirect('admin_fakultas');
            } elseif ($this->data['Role'] == "Mahasiswa") {
                redirect('mahasiswa');
            }
        }
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable">' . $msg . '</div>');
    }

    public function index()
    {
        $this->load->view('login');
    }


    // public function index()
    // {
    //     // $this->form_validation->set_rules('IDpengenal', 'IDpengenal', 'required|trim');
    //     // $this->form_validation->set_rules('password', 'password', 'required|trim');

    //     // if ($this->form_validation->run() == FALSE) {
    //     $this->load->view('login');
    //     // $this->flashmsg('Data Gagal Dimasukkan, Akun dengan data yang sama sudah pernah dibuat / ada field yang kosong', 'danger');
    //     // } else {
    //     //     $this->_login();
    //     // }
    // }

    // private function _login()
    public function sign()
    {
        $this->load->model('user_m');
        $dataInput = $this->input->post();
        $inp = [];
        parse_str($dataInput['userdata'], $inp);
        $data['IDPengenal'] = $inp['IDpengenal'];
        $userCek = $this->user_m->get_row($data);

        // $IDpengenal = $this->input->post('IDpengenal');
        // $password = $this->input->post('password');

        // $user = $this->db->get_where('user', ['IDpengenal' => $IDpengenal])->row_array();
        // // var_dump($user);
        // die;
        if ($userCek) {
            //cek password
            // $cekpassword = password_verify($password, $user['Password']);
            $cekpassword = password_verify($inp['password'], $userCek->Password);
            if ($cekpassword) {
                $data = array(
                    'IDpengenal' => $userCek->IDPengenal,
                    'Role' => $userCek->Role,
                );
                // var_dump($data);
                // die;
                $this->session->set_userdata($data);
                // var_dump($data);
                // die;
                // $result['role'] = $userCek->Role;
                $result['status'] = true;
                $result['status_code'] = 200;
                $result['messages'] = 'Redirecting';

                // if ($userCek['Role'] == 'Administrator Sistem') {
                //     redirect('admin_sistem');
                // } else if ($userCek['Role'] == 'Administrasi Fakultas') {
                //     redirect('admin_fakultas');
                // } else if ($userCek['Role'] == 'Mahasiswa') {
                //     redirect('mahasiswa');
                // }
            } else {
                $result['status'] = false;
                $result['status_code'] = 404;
                $result['messages'] = 'Password salah';
            }
        } else {
            $result['status'] = false;
            $result['status_code'] = 404;
            $result['messages'] = 'Username tidak ditemukan';
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
