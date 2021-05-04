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

    public function index()
    {
        $this->load->view('login');
    }

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

                // update IPK setiap admin fakultas||administrator login
                // if ($userCek->Role == 'Administrasi Fakultas' || $userCek->Role == 'Administrator Sistem') {
                //     $mahasiswa = $this->db->query("SELECT IDPengenal, ProgramStudi,IPK FROM user WHERE Role='Mahasiswa'");
                //     foreach ($mahasiswa->result() as $row) {
                //         $APIFakultasParam = "";
                //         switch ($this->input->post('fakultas')) {
                //             case 'Fakultas Ekonomi':
                //                 $APIFakultasParam = 'ekonomi';
                //                 break;
                //             case 'Fakultas Hukum':
                //                 $APIFakultasParam = 'hukum';
                //                 break;
                //             case 'Fakultas Ilmu Komputer':
                //                 $APIFakultasParam = 'fasilkom';
                //                 break;
                //             case 'Fakultas Ilmu sosial dan Ilmu Politik':
                //                 $APIFakultasParam = 'fisip';
                //                 break;
                //             case 'Fakultas Kedokteran':
                //                 $APIFakultasParam = 'kedokteran';
                //                 break;
                //             case 'Fakultas keguruan dan Ilmu Pendidikan':
                //                 $APIFakultasParam = 'fkip';
                //                 break;
                //             case 'Fakultas Kesehatan Masyarakat':
                //                 $APIFakultasParam = 'fkm';
                //                 break;
                //             case 'Fakultas Matematika dan Ilmu Pengetahuan Alam':
                //                 $APIFakultasParam = 'fmipa';
                //                 break;
                //             case 'Fakultas pertanian':
                //                 $APIFakultasParam = 'pertanian';
                //                 break;
                //             case 'Fakultas Teknik':
                //                 $APIFakultasParam = 'Teknik';
                //                 break;
                //             case 'Program Pasca Sarjana':
                //                 $APIFakultasParam = 'pps';
                //                 break;
                //         }
                //         $APIresponse = file_get_contents('http://apiunsri.ridwanzal.com/api/simak/mahasiswa?nim='.$row->IDPengenal.'&fakultas='.$APIFakultasParam.'');
                //         $APIresponse = json_decode($APIresponse);
                //         if(is_null($APIresponse->data)!=1 &&($APIresponse->data->IPK!=$row->IPK)){
                //             $this->db->query("UPDATE user SET IPK=.$APIresponse->data->IPK. WHERE IDPengenal='$row->IDPengenal'");
                //         }
                //     }
                // }


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
                $result['messages'] = 'Password salah, hubungi admin untuk reset password bila diperlukan';
            }
        } else {
            $this->load->model('userverifikasi_m');
            $userCek = $this->userverifikasi_m->get_row($data);
            if ($userCek) {
                $result['status'] = false;
                $result['status_code'] = 403;
                $result['messages'] = 'Username belum diverifikasi harap hubungi admin fakultas';
            } else {
                $result['status'] = false;
                $result['status_code'] = 404;
                $result['messages'] = 'Username tidak ditemukan harap melakukan pendaftaran';
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
