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
        $this->load->model('Bidang_prestasi');
        $this->load->model('prestasi_kompetisi');
        $this->load->model('prestasi_nonkompetisi');
        $this->load->model('prodi');
        $this->load->library('UserObj');

        $year = date("Y");

        //jumlah data untuk dashboard
        $this->data['jumlah'] = [

            $this->db->query("SELECT COUNT(*) AS mahasiswa FROM user WHERE Role = 'Mahasiswa'")->row(), //jumlah mahasiswa

            $this->db->query("SELECT COUNT(*) AS kompetisi FROM prestasikompetisi
            INNER JOIN user ON prestasikompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND Status = 'Diterima' AND Tahun =" . $year)->row(), //jumlah prestasi kompetisi

            $this->db->query("SELECT COUNT(*) AS nonkompetisi FROM prestasinonkompetisi
            INNER JOIN user ON prestasinonkompetisi.PeraihPrestasi = user.IDPengenal
            WHERE Role = 'Mahasiswa' AND Status = 'Diterima' AND Tahun =" . $year)->row() //jumlah prestasi non kompetisi
        ];
    }

    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"> <a href="#" class="close2" data-dismiss="alert" aria-label="close">&times;</a>' . $msg . '</div>');
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
        $this->data['fakultas'] = $this->db->get('fakultas')->result();
        $this->data['active'] = 2;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'peringkat_mahasiswa';
        $this->load->view('admin_sistem/template/template', $this->data);
    }


    //Get data peringkat mahasiswa
    public function getpringkatM()
    {
        $result = [
            'data' => $this->MapperingkatM(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    private function MapperingkatM()
    {
        $listData = [];
        $data = $this->db->query("SELECT user.Nama,user.Fakultas, user.IDPengenal, user.ProgramStudi , IFNULL(t1.Skor,0)+IFNULL(t2.Skor,0) AS Skor 
        FROM user
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasikompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t1 ON t1.PeraihPrestasi = user.IDPengenal 
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasinonkompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t2 ON user.IDPengenal=t2.PeraihPrestasi WHERE user.Role='Mahasiswa' GROUP BY user.IDPengenal ORDER BY Skor DESC")->result_array();
        $i = 1;
        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
                'NIM' => $k['IDPengenal'],
                'Nama' => $k['Nama'],
                'Fakultas' => $k['Fakultas'],
                'Prodi' => $k['ProgramStudi'],
                'Skor' => $k['Skor']
            );
            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //Filter Peringkat Mahasiswa Berdasarkan Tahun dan Fakultas
    public function FilterPeringkatM($tahun, $fakultas)
    {
        $Fakultas = str_replace("%20", " ", $fakultas);
        // print_r($Fakultas);
        // die;
        $result = [
            'data' => $this->MapFilterperingkatM($tahun, $Fakultas),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    private function MapFilterperingkatM($tahun, $Fakultas)
    {
        $listData = [];
        $data = $this->db->query("SELECT user.Nama,user.Fakultas, user.ProgramStudi, user.IDPengenal, IFNULL(t1.Skor,0)+IFNULL(t2.Skor,0) AS Skor 
        FROM user
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasikompetisi WHERE Status='Diterima' AND Tahun='" . $tahun . "' GROUP BY PeraihPrestasi)t1 ON t1.PeraihPrestasi = user.IDPengenal 
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasinonkompetisi WHERE Status='Diterima'  AND Tahun='" . $tahun . "' GROUP BY PeraihPrestasi)t2 ON user.IDPengenal=t2.PeraihPrestasi 
        WHERE user.Role='Mahasiswa'  AND user.Fakultas='" . $Fakultas . "' GROUP BY user.IDPengenal ORDER BY Skor DESC")->result_array();
        $i = 1;
        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
                'NIM' => $k['IDPengenal'],
                'Nama' => $k['Nama'],
                'Fakultas' => $k['Fakultas'],
                'Prodi' => $k['ProgramStudi'],
                'Skor' => $k['Skor']
            );
            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //Menampilkan analisis peringkat berdasarkan fakultas
    public function Analisis_PeringkatFakultas()
    {
        $this->data['fakultas'] = $this->db->get('fakultas')->result();
        $this->data['active'] = 3;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'analisis_fakultas';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    public function daftarPrestasi_Fakultas()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Admin Sistem | Daftar Prestasi Fakultas ';
        $this->data['content'] = 'daftar_prestasi';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    public function daftarPrestasi_Mahasiswa()
    {
        $this->data['active'] = 3;
        $this->data['title'] = 'Admin Sistem | Daftar Prestasi Mahasiswa ';
        $this->data['content'] = 'daftar_prestasiMahasiswa';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    //Menampilkan analisis peringkat berdasarkan bidang
    public function Analisis_PeringkatBidang()
    {
        $this->data['active'] = 4;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'analisis_bidang';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    //get data select bidang untuk fulter
    public function getdataselect()
    {
        $pilihan = $this->input->post('pilihan');

        $sql = "SELECT Bidang FROM bidangprestasi WHERE JalurPencapaian='$pilihan'";
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

    public function getdatafakultas()
    {
        $data = $this->db->get('fakultas')->result();
        $result = [
            'data' => $data,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function Prestasi_Bidang()
    {
        $this->data['active'] = 4;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'prestasi_bidang';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    // AMBIL DATA TOP MAHASISWA
    function gettopmahasiswa()
    {
        $result = [
            'data' => $this->Maptotopmahasiswa(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    function Maptotopmahasiswa()
    {
        $listData = [];
        $data = $this->db->query("SELECT user.Nama,user.Fakultas, user.ProgramStudi , IFNULL(t1.Skor,0)+IFNULL(t2.Skor,0) AS Skor FROM user LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasikompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t1 ON t1.PeraihPrestasi = user.IDPengenal 
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasinonkompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t2 ON user.IDPengenal=t2.PeraihPrestasi WHERE user.Role='Mahasiswa' AND (t1.skor IS NOT NULL OR t2.Skor IS NOT NULL) GROUP BY user.IDPengenal ORDER BY Skor DESC LIMIT 10")->result_array();
        // $data = $this->db->query("SELECT user.Nama,user.Fakultas, user.ProgramStudi , SUM(prestasikompetisi.Skor)+SUM(prestasinonkompetisi.Skor) AS Skor FROM prestasikompetisi INNER JOIN user ON
        // prestasikompetisi.PeraihPrestasi = user.IDPengenal INNER JOIN prestasinonkompetisi ON prestasikompetisi.PeraihPrestasi = prestasinonkompetisi.PeraihPrestasi WHERE Role='Mahasiswa' AND prestasinonkompetisi.Status='Diterima' AND prestasikompetisi.Status='Diterima'  GROUP BY user.Nama ORDER BY Skor DESC LIMIT 10")->result_array();
        $i = 1;
        foreach ($data as $k) {
            $obj = array(
                'no' => $i,
                'Nama' => $k['Nama'],
                'Fakultas' => $k['Fakultas'],
                'Prodi' => $k['ProgramStudi'],
                'Skor' => $k['Skor']
            );

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }
    // END OF DATA TOP MAHASISWA

    //json penyebaran prestasi berdasarkan jurusan
    public function penyebaranprestasi()
    {
        $result = [
            'data' => $this->Maptodataprestasi(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk tabel di dashboard
    public function Maptodataprestasi()
    {
        $listData = [];
        $year = date("Y");
        $data = $this->db->query("SELECT Fakultas.fakultas AS Fakultas, t1.kompetisi AS `PrestasiKompetisi` ,t2.kompetisi AS `Prestasinonkompetisi` FROM fakultas INNER JOIN
       (SELECT user.fakultas, COUNT(prestasikompetisi.Status) AS `Kompetisi`  FROM `user`
       LEFT JOIN prestasikompetisi ON user.IDPengenal=prestasikompetisi.PeraihPrestasi
       WHERE user.fakultas IS NOT NULL AND prestasikompetisi.Status='Diterima' AND Tahun=" . $year . " GROUP BY user.Fakultas) t1 ON t1.fakultas=Fakultas.fakultas
       INNER JOIN (SELECT user.fakultas, COUNT(prestasinonkompetisi.Status) AS Kompetisi  FROM user
       LEFT JOIN prestasinonkompetisi ON user.IDPengenal=prestasinonkompetisi.PeraihPrestasi
       WHERE user.fakultas IS NOT NULL AND prestasinonkompetisi.Status='Diterima' AND Tahun=" . $year . " GROUP BY user.Fakultas) t2 ON t2.fakultas=Fakultas.fakultas")->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'PrestasiKompetisi' => $k['PrestasiKompetisi'], 'Prestasinonkompetisi' => $k['Prestasinonkompetisi']);
            $listData[] =  $data;
        }
        return $listData;
    }

    //json peringkat fakultas berdasarkan prestasi
    public function peringkatfakultasprestasi()
    {
        $result = [
            'data' => $this->Maptoperingkatfakultasprestasi(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);

    }

    //data untuk peringkat berdasarkan keseluruhan fakultas berdasarkan prestasi
    public function Maptoperingkatfakultasprestasi()
    {

        $listData = [];
        $data = $this->db->query("SELECT Fakultas,SUM(t1.total) AS PrestasiKompetisi,IFNULL(SUM(t2.total),0) AS PrestasiNonKompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS Total FROM  user 
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN '2020' AND '2020' GROUP BY PeraihPrestasi)t1
        ON t1.PeraihPrestasi=user.IDPengenal
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun BETWEEN '2020' AND '2020' GROUP BY PeraihPrestasi)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' GROUP BY Fakultas ORDER BY total DESC
        ") ->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'PrestasiKompetisi' => $k['PrestasiKompetisi'], 'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'], 'Total' => $k['Total']);
            $listData[] =  $data;
        }
        return $listData;

    }

    //json peringkat fakultas berdasarkan jumlah mahasiswa
    public function peringkatfakultasmahasiswa()
    {
        $result = [
            'data' => $this->Maptoperingkatfakultasmahasiswa(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }


    //data untuk peringkat fakultas berdasarkan jumlah mahasiswa
    public function Maptoperingkatfakultasmahasiswa()
    {
        $listData = [];
        $data = $this->db->query("SELECT Fakultas,COUNT(Fakultas) AS TotalMahasiswa FROM  user 
        INNER JOIN 
        (SELECT DISTINCT(t1.PeraihPrestasi) FROM
        (SELECT PeraihPrestasi FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN '2020' AND '2020' GROUP BY PeraihPrestasi
        UNION ALL
        SELECT PeraihPrestasi FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun  BETWEEN '2020' AND '2020' GROUP BY PeraihPrestasi)t1)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' GROUP BY Fakultas
        ") ->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'TotalMahasiswa' => $k['TotalMahasiswa']);
            $listData[] =  $data;
        }
        return $listData;
    }



    //Manage User
    public function kelola_user()
    {
        $this->data['fakultas'] = $this->db->get('fakultas')->result();
        $this->data['active'] = 5;
        $this->data['title'] = 'Admin Sistem | Kelola User ';
        $this->data['content'] = 'manage_user';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    //mengambil semua data user pada table user
    public function getUser()
    {
        $result = [
            'data' => $this->Mapuser(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function Mapuser()
    {
        $cek = $this->db->where('Role !=', "Mahasiswa");
        $data = $this->user_m->get();
        $listData = [];
        $i = 1;

        foreach ($data as $k) {
            $obj = new UserObj();

            $obj->No = $i;
            $obj->NIP = $k->IDPengenal;
            $obj->Nama = $k->Nama;
            $obj->username = $k->IDPengenal;
            $obj->role = $k->Role;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //Tambah User
    public function tambahuser()
    {
        $this->data['fakultas'] = $this->db->get('fakultas')->result();
        $this->data['active'] = 5;
        $this->data['title'] = 'Admin Sistem | Tambah User ';
        $this->data['content'] = 'tambah_user';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    public function tambahdatauser()
    {
        if ($this->input->post('tambahuser')) {
            $this->form_validation->set_rules('password1', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');
            if ($this->form_validation->run() == FALSE) {
                $this->flashmsg('Password dan Password Konfirmasi Berbeda!', 'danger');
                redirect("admin_sistem/tambahuser");
            } else {
                if ($this->input->post('role') != "Administrator Sistem") {
                    $input['Nama'] = $this->input->post('namaadmin');
                    $input['IDPengenal'] = $this->input->post('NIP');
                    $input['Email'] = $this->input->post('Email');
                    $input['Role'] = $this->input->post('role');
                    $input['Fakultas'] = $this->input->post('fakultas');
                    $input['Password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                    $this->user_m->insert($input);
                    $this->flashmsg('Data User Telah Berhasil Ditambah');
                } else {
                    $input['Nama'] = $this->input->post('namaadmin');
                    $input['IDPengenal'] = $this->input->post('NIP');
                    $input['Email'] = $this->input->post('Email');
                    $input['Role'] = $this->input->post('role');
                    $input['Fakultas'] = null;
                    $input['Password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                    $this->user_m->insert($input);
                    $this->flashmsg('Data User Telah Berhasil Ditambah');
                }
            }
        }
        redirect("admin_sistem/kelola_user");
    }

    //Edit Data User
    // mengambil data User berdasarkan NIP
    public function getdataNIP()
    {
        $id = $this->input->post('ID');
        // print_r($id);
        // die;
        $dataku = $this->user_m->get(['IDPengenal' => $id]);
        $result = [
            'data' => $dataku,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //update user
    public function updateuser()
    {
        if ($this->input->post('updatedata')) {
            if ($this->input->post("password1") != "" && $this->input->post("password2") != "") {
                $this->form_validation->set_rules('password1', 'Password', 'required');
                $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');
                if ($this->form_validation->run() == FALSE) {
                    $this->flashmsg('Password Baru dan Password Konfirmasi Berbeda!', 'danger');
                } else {
                    if ($this->input->post('role') != "Administrator Sistem") {
                        $input['Nama'] = $this->input->post('namaadmin');
                        $input['IDPengenal'] = $this->input->post('NIP');
                        $input['Email'] = $this->input->post('Email');
                        $input['Role'] = $this->input->post('role');
                        $input['Fakultas'] = $this->input->post('fakultas');
                        $input['Password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                        $this->db->where('IDPengenal', $this->input->post('detector'));
                        $this->db->update('user', $input);
                        $this->flashmsg('Data User Telah Berhasil Diubah');
                    } else {
                        $input['Nama'] = $this->input->post('namaadmin');
                        $input['IDPengenal'] = $this->input->post('NIP');
                        $input['Email'] = $this->input->post('Email');
                        $input['Role'] = $this->input->post('role');
                        $input['Fakultas'] = null;
                        $input['Password'] = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                        $this->db->where('IDPengenal', $this->input->post('detector'));
                        $this->db->update('user', $input);
                        $this->flashmsg('Data User Telah Berhasil Diubah');
                    }
                }
            } else {
                if ($this->input->post('role') != "Administrator Sistem") {
                    $input['Nama'] = $this->input->post('namaadmin');
                    $input['IDPengenal'] = $this->input->post('NIP');
                    $input['Email'] = $this->input->post('Email');
                    $input['Role'] = $this->input->post('role');
                    $input['Fakultas'] = $this->input->post('fakultas');
                    $this->db->where('IDPengenal', $this->input->post('detector'));
                    $this->db->update('user', $input);
                    $this->flashmsg('Data User Telah Berhasil Diubah');
                } else {
                    $input['Nama'] = $this->input->post('namaadmin');
                    $input['IDPengenal'] = $this->input->post('NIP');
                    $input['Email'] = $this->input->post('Email');
                    $input['Role'] = $this->input->post('role');
                    $input['Fakultas'] = null;
                    $this->db->where('IDPengenal', $this->input->post('detector'));
                    $this->db->update('user', $input);
                    $this->flashmsg('Data User Telah Berhasil Diubah');
                }
            }
        }
        redirect("admin_sistem/kelola_user");
    }

    //Menghapus user
    public function deleteuser()
    {
        $id = $this->input->post('ID');
        $data['IDPengenal'] = $id;
        $userCek = $this->user_m->get_row($data);
        // print_r($test);
        if ($userCek != null) {
            // $this->db->query("DELETE FROM `user` WHERE IDPengenal='$id'");
            $this->db->where('IDPengenal', $id);
            $this->db->delete('user');
            $result['status'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
