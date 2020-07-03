<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    // public function __construct()
    // {

    //     parent::__construct();
    //     // echo $this->session->userdata('IDpengenal');
    //     // echo $this->session->userdata('id_role');

    //     $this->data['IDpengenal'] = $this->session->userdata('IDpengenal');
    //     $this->data['id_role'] = $this->session->userdata('id_role');
    //     if (isset($this->data['IDpengenal'], $this->data['id_role'])) {
    //         switch ($this->data['id_role']) {
    //             case 1:
    //                 redirect('mahasiswa');
    //                 break;

    //                 // case 2:
    //                 //     redirect('mahasiswa');
    //                 //     break;

    //                 // case 3:
    //                 //     redirect('monitoring');
    //                 //     break;

    //                 // case 4:
    //                 //     redirect('LeaderRegional');
    //                 //     break;
    //         }
    //         exit;
    //     }
    // }


    public function index()
    {
        $this->form_validation->set_rules('IDpengenal', 'IDpengenal', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
            // $this->flashmsg('Data Gagal Dimasukkan, Akun dengan data yang sama sudah pernah dibuat / ada field yang kosong', 'danger');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $IDpengenal = $this->input->post('IDpengenal');
        $password = $this->input->post('password');



        $user = $this->db->get_where('user', ['IDpengenal' => $IDpengenal])->row_array();
        // var_dump($user);
        // die;
        if ($user) {
            //cek password
            if (password_verify($password, $user['Password'])) {
                $data = [
                    'IDPengenal' => $user['IDPengenal'],
                    'Role' => $user['Role']
                ];
                // var_dump($data);
                // die;
                $this->session->set_userdata($data);

                if ($user['Role'] == 'Administrasi Sistem') {
                    redirect('login');
                } else if ($user['Role'] == 'Administrasi Fakultas') {
                    redirect('login');
                } else if ($user['Role'] == 'Mahasiswa') {
                    redirect('mahasiswa');
                }
            }
        } else {
            redirect('login');
        }
    }

    // public function signin()
    // {
    //     $this->load->model('user_m');
    //     $dataInput = $this->input->post();
    //     $inp = [];
    //     parse_str($dataInput['userdata'], $inp);
    //     $data['IDPengenal'] = $inp['IDpengenal'];
    //     $userCek = $this->user_m->get_row($data);

    //     if ($userCek != null) {

    //         $cek = password_verify($inp['password'], $userCek->Password);

    //         if ($cek) {
    //             $array = array(
    //                 'IDpengenal' => $userCek->IDPengenal,
    //                 'id_role' => $userCek->Role,
    //             );
    //             $this->session->set_userdata($array);

    //             $result['status'] = true;
    //             $result['status_code'] = 200;
    //             $result['messages'] = 'Redirecting';
    //         } else {
    //             $result['status'] = false;
    //             $result['status_code'] = 404;
    //             $result['messages'] = 'Password salah';
    //         }
    //     } else {
    //         $result['status'] = false;
    //         $result['status_code'] = 404;
    //         $result['messages'] = 'Username tidak ditemukan';
    //     }

    //     header('Content-Type: application/json');
    //     echo json_encode($result);
    // }
}
