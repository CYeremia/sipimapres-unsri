<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_m');
        $this->load->model('Mahasiswa_regis');
    }

    public function index()
    {
        $this->load->view('signup');
    }

    //get data fakultas
    public function getdataFakultas()
    {
        $sql = "SELECT * FROM fakultas";
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

    //get data Prodi
    public function getdataProdi()
    {
        $pilihan = $this->input->post('pilihan');

        $sql = "SELECT Prodi FROM prodi WHERE Fakultas='$pilihan'";
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

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable">' . $msg . '</div>');
    }

    // public function newUser()
    // {
    //     $Nama     = $this->input->post('namauser');
    //     $IDPengenal   = $this->input->post('IDuser');
    //     $Email        = $this->input->post('emailuser');
    //     $Password     = password_hash($this->input->post('passworduser'), PASSWORD_DEFAULT);

    //     $Telephone       = $this->input->post('telpuser');
    //     $IPK       = $this->input->post('IPKuser');
    //     $Role     = 'Mahasiswa';
    //     $Fakultas  = $this->input->post('fakultasuser');
    //     $ProgramStudi   = $this->input->post('jurusanuser');

    //     $sql = "INSERT INTO user(Nama,Role,IDPengenal,Fakultas,ProgramStudi,Email,IPK,Telephone,Password) VALUE ('$Nama','$IDPengenal','$Role','$IDPengenal','$Fakultas','$ProgramStudi','$Email','$IPK','$Telephone','$Password')";
    //     $this->db->query($sql);
    //     if ($this->db->affected_rows() == 1) {
    //         $result = [
    //             'status' => true,
    //             'status_code' => 200
    //         ];
    //         header('Content-Type: application/json');
    //         echo json_encode($result);
    //     } else {
    //         $result = [
    //             'status' => true,
    //             'status_code' => 200
    //         ];
    //         header('Content-Type: application/json');
    //         echo json_encode($result);
    //     }
    // }

    public function newUser()
    {
        if ($this->input->post('datauser')) {
            $this->form_validation->set_rules('namauser', 'namauser', 'required|trim');
            $this->form_validation->set_rules('IDpengenal', 'IDpengenal', 'required|trim');

            $this->form_validation->set_rules('email', 'email', 'required|trim');
            $this->form_validation->set_rules('password', 'password', 'required|trim');
            $this->form_validation->set_rules('telp', 'telp', 'required|trim');
            $this->form_validation->set_rules('IPK', 'IPK', 'required|trim');

            // $this->form_validation->set_rules('role', 'role', 'required');
            $this->form_validation->set_rules('fakultas', 'fakultas', 'required');
            $this->form_validation->set_rules('jurusan', 'jurusan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->flashmsg('Terdapat field yang kosong', 'danger');
                redirect('signup');
            } else {
                // echo $this->input->post();
                // die();
                // echo "data berhasil";
                // if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
                //     $config['upload_path'] = './upload_dir/';
                //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //     $this->upload->initialize($config);
                //     if ($this->upload->do_upload('photo')) {
                //         $img_data = $this->upload->data();
                //         $foto = $img_data['full_path'];
                //     } else {
                //         $this->flashmsg('Data Gagal Diedit, Harap periksa kembali foto anda. Atau gunakan foto yang lain', 'danger');
                //         redirect('Admin/master-pengguna');
                //     }
                // } else {
                //     $foto = "upload_dir/Helpdesk.jpg";
                // }

                // $dataTele['TelegramAccount'] = $this->input->post('userTele');
                // $this->db->insert('telegramaccount', $dataTele);

                $input['Nama']     = $this->input->post('namauser');
                $input['IDPengenal']   = $this->input->post('IDpengenal');
                $input['Email']        = $this->input->post('email');
                $input['Password']     = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                $input['Telephone']       = $this->input->post('telp');
                $input['IPK']       = $this->input->post('IPK');
                $input['Role']      = 'Mahasiswa';
                $input['Fakultas']  = $this->input->post('fakultas');
                $input['ProgramStudi']   = $this->input->post('jurusan');

                //untuk menampung hasil check id pengenal apakah sudah terdaftar atau belum
                $checkIDPengenal = $this->db->query("SELECT COUNT(IDPengenal) AS `NIM` FROM user WHERE `IDPengenal` ='".$input['IDPengenal']."'")->row();
                $checkIDPengenalRegistrasi = $this->db->query("SELECT COUNT(IDPengenal) AS `NIM` FROM registrasi WHERE `IDPengenal` ='".$input['IDPengenal']."'")->row();

                if($checkIDPengenal->NIM > 0 || $checkIDPengenalRegistrasi->NIM > 0) // jika sudah terdaftar oleh admin / mahasiswa
                {
                    $this->flashmsg('NIM sudah terdaftar, Mohon gunakan NIM lain !', 'danger');
                    redirect('signup');
                }
                else // jika belum terdaftar
                {
                    $input['IPK'] = str_replace(',', '.', $input['IPK']); //replace apabila format ipk yang dimasukkan tidak sesuai

                        $checknumeric = is_numeric($input['IPK']);    
                        
                        if($checknumeric == true) // jika format IPK adalah angka
                        {
                        
                            if($input['IPK'] > 4 || $input['IPK'] < 0  )
                            {
                                $this->flashmsg('Format IPK tidak sesuai !', 'danger');
                                redirect('signup');
                            }
                            else //jika format IPK benar
                            {
                                if($this->Mahasiswa_regis->insert($input))
                                {
                                    $this->flashmsg('Anda Berhasil Mendaftar', 'success');
                                    redirect('login');
                                }
                            }

                         }

                         else //jika bukan format numerik
                         {
                            $this->flashmsg('Format IPK tidak sesuai !', 'danger');
                            redirect('signup');
                         }

                }

            }
        }
    }
}
