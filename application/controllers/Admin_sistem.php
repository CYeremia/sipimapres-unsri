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


    public function Analisis_PeringkatFakultas()
    {
        $this->data['fakultas'] = $this->db->get('fakultas')->result();
        $this->data['active'] = 3;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'analisis_fakultas';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    public function Analisis_PeringkatBidang()
    {
        $this->data['active'] = 4;
        $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
        $this->data['content'] = 'analisis_bidang';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    //get data select bidang
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
}
