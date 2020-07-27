<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_sistem  extends CI_Controller
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
            if ($this->data['Role'] != "Administrator Sistem") {
                redirect('logout');
            }
        } else {
            redirect('logout');
        }

        $this->data['userdata'] = $this->db->query("SELECT `user`.`IDPengenal`, `user`.`Nama`, `user`.`Fakultas`, `user`.`ProgramStudi`, `user`.`Email`, `user`.`IPK`, `user`.`Telephone`, `role`.`Role` FROM `user` INNER JOIN `role` ON `user`.`Role` = `role`.`Role` WHERE `user`.`IDPengenal` = '" . $this->data['IDpengenal'] . "'")->row();
        // $this->data['user'] = $this->db->get_where('user', ['IDPengenal' => $this->session->userdata('IDPengenal')])->row_array();
        // var_dump($this->data['user']);
        // die;
        $this->load->model('user_m');
        $this->load->model('prestasi_kompetisi');
        $this->load->model('prestasi_nonkompetisi');
        $this->load->model('prodi');
        $this->load->library('UserObj');

        $year = date("Y");

        //jumlah data untuk dashboard
        $this->data['jumlah'] = [

            $this->db->query("SELECT COUNT(*) AS `mahasiswa` FROM `user` WHERE `Role` = 'Mahasiswa' AND `Fakultas` ='" . $this->data['userdata']->Fakultas . "'")->row(), //jumlah mahasiswa

            $this->db->query("SELECT COUNT(*) AS `kompetisi` FROM `prestasikompetisi`
            INNER JOIN user ON prestasikompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND Fakultas = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima' AND Tahun =" . $year)->row(), //jumlah prestasi kompetisi

            $this->db->query("SELECT COUNT(*) AS `nonkompetisi` FROM `prestasinonkompetisi`
            INNER JOIN user ON prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND Fakultas = '" . $this->data['userdata']->Fakultas . "' AND `Status` = 'Diterima' AND Tahun =" . $year)->row() //jumlah prestasi non kompetisi
        ];
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>');
    }

    public function index()
    {
        $this->data['active'] = 1;
        $this->data['title'] = 'Admin Sistem | Dashboard ';
        $this->data['content'] = 'main';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    public function Peringkat_Mahasiswa()
    {
        // 09021381621094
        $this->data['active'] = 2;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'peringkat_mahasiswa';
        $this->load->view('admin_sistem/template/template', $this->data);
    }
}
