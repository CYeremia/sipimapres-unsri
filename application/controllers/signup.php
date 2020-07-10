<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_m');
    }

    public function index()
    {
        $this->load->view('signup');
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>');
    }

    public function newUser()
    {
        if ($this->input->post('signup')) {


            $this->form_validation->set_rules('fullname', 'fullname', 'required|trim');
            $this->form_validation->set_rules('IDpengenal', 'IDpengenal', 'required|trim');

            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required|trim');
            $this->form_validation->set_rules('telp', 'telp', 'required|trim');
            $this->form_validation->set_rules('IPK', 'IPK', 'required|trim');

            $this->form_validation->set_rules('role', 'role', 'required');
            $this->form_validation->set_rules('fakultas', 'fakultas', 'required');
            $this->form_validation->set_rules('jurusan', 'jurusan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->flashmsg('Data Gagal Dimasukkan, Akun dengan data yang sama sudah pernah dibuat / ada field yang kosong', 'danger');
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


                $input['Nama']     = $this->input->post('fullname');
                $input['IDPengenal']   = $this->input->post('IDpengenal');
                $input['Email']        = $this->input->post('email');
                $input['Password']     = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                $input['Telephone']       = $this->input->post('telp');
                $input['IPK']       = $this->input->post('IPK');
                $input['Role']      = $this->input->post('role');
                $input['Fakultas']  = $this->input->post('fakultas');
                $input['ProgramStudi']   = $this->input->post('jurusan');

                // $input['Photo']    = file_get_contents($foto);
                $this->user_m->insert($input);
                $this->flashmsg('Data Berhasil Dibuat');
                redirect('login');
            }
        }
        $this->db->where('RoleID !=', 0);
        $this->data['role'] = $this->db->get('role')->result();
        $this->data['active'] = 1;
        $this->data['title'] = 'Sign Up';
        $this->data['content'] = 'signup';
        $this->load->view('signup');
    }
}
