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
    public function getpringkatM($tahun)
    {
        $result = [
            'data' => $this->MapperingkatM($tahun),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    private function MapperingkatM($tahun)
    {
        $listData = [];
        $data = $this->db->query("SELECT user.Nama,user.Fakultas, user.ProgramStudi, user.IDPengenal, IFNULL(t1.Skor,0)+IFNULL(t2.Skor,0) AS Skor 
        FROM user
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasikompetisi WHERE Status='Diterima' AND Tahun='" . $tahun . "' GROUP BY PeraihPrestasi)t1 ON t1.PeraihPrestasi = user.IDPengenal 
        LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasinonkompetisi WHERE Status='Diterima'  AND Tahun='" . $tahun . "' GROUP BY PeraihPrestasi)t2 ON user.IDPengenal=t2.PeraihPrestasi 
        WHERE user.Role='Mahasiswa' GROUP BY user.IDPengenal ORDER BY Skor DESC")->result_array();
        // $data = $this->db->query("SELECT user.Nama,user.Fakultas, user.IDPengenal, user.ProgramStudi , IFNULL(t1.Skor,0)+IFNULL(t2.Skor,0) AS Skor 
        // FROM user
        // LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasikompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t1 ON t1.PeraihPrestasi = user.IDPengenal 
        // LEFT JOIN (SELECT PeraihPrestasi,SUM(Skor) AS Skor FROM prestasinonkompetisi WHERE Status='Diterima'  GROUP BY PeraihPrestasi)t2 ON user.IDPengenal=t2.PeraihPrestasi WHERE user.Role='Mahasiswa' GROUP BY user.IDPengenal ORDER BY Skor DESC")->result_array();
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
        $this->data['title'] = 'Admin Sistem | Analisis Peringkat Fakultas';
        $this->data['content'] = 'analisis_fakultas';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    public function daftarPrestasi_Fakultas($parameters = null)
    {
        if ($parameters == null) {
            redirect('Admin_sistem/Analisis_PeringkatFakultas');
        } else {
            $this->data['active'] = 3;
            $this->data['title'] = 'Admin Sistem | Daftar Prestasi Fakultas ';
            $this->data['content'] = 'daftar_prestasi';
            $this->load->view('admin_sistem/template/template', $this->data);
        }
    }

    public function daftarPrestasi_Mahasiswa($parameters = null)
    {

        if ($parameters == null) {
            redirect('Admin_sistem/Analisis_PeringkatFakultas');
        } else {
            $this->data['active'] = 3;
            $this->data['title'] = 'Admin Sistem | Daftar Prestasi Mahasiswa ';
            $this->data['content'] = 'daftar_prestasiMahasiswa';
            $this->load->view('admin_sistem/template/template', $this->data);
        }
    }

    //Menampilkan analisis peringkat berdasarkan bidang
    public function Analisis_PeringkatBidang()
    {
        $this->data['active'] = 4;
        $this->data['title'] = 'Admin Sistem | Analisis Peringkat Bidang ';
        $this->data['content'] = 'analisis_bidang';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    //menampilkan prestasi bidang mahasiswa
    public function Prestasi_Bidang($parameters = null)
    {
        if ($parameters == null) {
            redirect('Admin_sistem/Analisis_PeringkatBidang');
        } else {
            $this->data['active'] = 4;
            $this->data['title'] = 'Admin Sistem | Peringkat Mahasiswa ';
            $this->data['content'] = 'prestasi_bidang';
            $this->load->view('admin_sistem/template/template', $this->data);
        }
    }

    //get data select bidang untuk filter
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
        $data = $this->db->query("SELECT fakultas.fakultas AS Fakultas, IFNULL(t1.kompetisi,0) AS PrestasiKompetisi , IFNULL(t2.kompetisi,0) AS Prestasinonkompetisi FROM fakultas 
        LEFT JOIN
        (SELECT user.fakultas, COUNT(prestasikompetisi.Status) AS Kompetisi  FROM user
        LEFT JOIN prestasikompetisi ON user.IDPengenal=prestasikompetisi.PeraihPrestasi
        WHERE user.fakultas IS NOT NULL AND prestasikompetisi.Status='Diterima' AND Tahun=" . $year . " GROUP BY user.Fakultas) t1 
        ON t1.fakultas=fakultas.fakultas
        LEFT JOIN (SELECT user.fakultas, COUNT(prestasinonkompetisi.Status) AS Kompetisi  FROM user
        LEFT JOIN prestasinonkompetisi ON user.IDPengenal=prestasinonkompetisi.PeraihPrestasi
        WHERE user.fakultas IS NOT NULL AND prestasinonkompetisi.Status='Diterima' AND Tahun=" . $year . " GROUP BY user.Fakultas) t2 
        ON t2.fakultas=fakultas.fakultas")->result_array();
        //     $data = $this->db->query("SELECT fakultas.fakultas AS Fakultas, t1.kompetisi AS `PrestasiKompetisi` ,t2.kompetisi AS `Prestasinonkompetisi` FROM fakultas INNER JOIN
        //    (SELECT user.fakultas, COUNT(prestasikompetisi.Status) AS `Kompetisi`  FROM `user`
        //    LEFT JOIN prestasikompetisi ON user.IDPengenal=prestasikompetisi.PeraihPrestasi
        //    WHERE user.fakultas IS NOT NULL AND prestasikompetisi.Status='Diterima' AND Tahun=" . $year . " GROUP BY user.Fakultas) t1 ON t1.fakultas=fakultas.fakultas
        //    INNER JOIN (SELECT user.fakultas, COUNT(prestasinonkompetisi.Status) AS Kompetisi  FROM user
        //    LEFT JOIN prestasinonkompetisi ON user.IDPengenal=prestasinonkompetisi.PeraihPrestasi
        //    WHERE user.fakultas IS NOT NULL AND prestasinonkompetisi.Status='Diterima' AND Tahun=" . $year . " GROUP BY user.Fakultas) t2 ON t2.fakultas=fakultas.fakultas")->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'PrestasiKompetisi' => $k['PrestasiKompetisi'], 'Prestasinonkompetisi' => $k['Prestasinonkompetisi']);
            $listData[] =  $data;
        }
        return $listData;
    }

    //json peringkat fakultas berdasarkan prestasi
    public function peringkatfakultasprestasi($start, $end)
    {
        $result = [
            'data' => $this->Maptoperingkatfakultasprestasi($start, $end),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk peringkat berdasarkan keseluruhan fakultas berdasarkan prestasi
    public function Maptoperingkatfakultasprestasi($start, $end)
    {

        $listData = [];

        $data = $this->db->query("SELECT fakultas.Fakultas,IFNULL(t3.prestasikompetisi,0) AS PrestasiKompetisi ,IFNULL(t3.prestasinonkompetisi,0)  AS PrestasiNonKompetisi, IFNULL(t3.Total,0)AS Total From fakultas
        LEFT JOIN
        (SELECT Fakultas,IFNULL(SUM(t1.total),0) AS prestasikompetisi,IFNULL(SUM(t2.total),0) AS prestasinonkompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS total FROM  user 
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t1
        ON t1.PeraihPrestasi=user.IDPengenal
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' GROUP BY Fakultas )t3
        ON fakultas.Fakultas=t3.fakultas ORDER BY total DESC")->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'PrestasiKompetisi' => $k['PrestasiKompetisi'], 'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'], 'Total' => $k['Total']);
            $listData[] =  $data;
        }
        return $listData;
    }


    //json peringkat fakultas berdasarkan prestasi
    public function satuperingkatfakultasprestasi($start, $end, $fakultas)
    {
        $result = [
            'data' => $this->Maptosatuperingkatfakultasprestasi($start, $end, $fakultas),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }


    //data untuk peringkat satu fakultas berdasarkan prestasi
    public function Maptosatuperingkatfakultasprestasi($start, $end, $fakultas)
    {

        $fakultas = str_replace("%20", " ", $fakultas);
        $fakultas = str_replace("%60", ",", $fakultas);
        $fakultas = str_replace("%7B", "(", $fakultas);
        $fakultas = str_replace("%7D", ")", $fakultas);
        $fakultas = str_replace("~", "/", $fakultas);
        $listData = [];

        $data = $this->db->query("SELECT fakultas.Fakultas, IFNULL(t3.prestasikompetisi,0) AS PrestasiKompetisi,IFNULL(t3.prestasinonkompetisi,0) AS PrestasiNonKompetisi, IFNULL(t3.total,0) AS Total FROM fakultas
         LEFT JOIN
         (SELECT Fakultas,IFNULL(SUM(t1.total),0) AS prestasikompetisi,IFNULL(SUM(t2.total),0) AS prestasinonkompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS total FROM  user 
         LEFT JOIN 
         (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t1
         ON t1.PeraihPrestasi=user.IDPengenal
         LEFT JOIN 
         (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t2
         ON t2.PeraihPrestasi=user.IDPengenal
         WHERE user.Role='Mahasiswa' AND Fakultas='$fakultas' GROUP BY Fakultas)t3
         ON fakultas.Fakultas=t3.Fakultas
         WHERE fakultas.Fakultas='" . $fakultas . "'")->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'PrestasiKompetisi' => $k['PrestasiKompetisi'], 'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'], 'Total' => $k['Total']);
            $listData[] =  $data;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan fakultas
    public function prestasifakultas($start, $end, $fakultas)
    {
        $result = [
            'data' => $this->Maptoprestasifakultas($start, $end, $fakultas),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }



    //untuk menampilkan data prestasi mahasiswa berdasarkan fakultas
    public function Maptoprestasifakultas($start, $end, $fakultas)
    {
        $fakultas = str_replace("%20", " ", $fakultas);
        $fakultas = str_replace("%60", ",", $fakultas);
        $fakultas = str_replace("%7B", "(", $fakultas);
        $fakultas = str_replace("%7D", ")", $fakultas);
        $fakultas = str_replace("~", "/", $fakultas);
        $listData = [];

        $data = $this->db->query("SELECT t1.PeraihPrestasi,t1.Bidang,t1.Perlombaan,t1.Tahun,t1.Penyelenggara,t1.Kategori,t1.Tingkat,t1.Pencapaian FROM  user
        INNER JOIN 
        (SELECT PeraihPrestasi,Bidang,Perlombaan,Tahun,Penyelenggara,Kategori,Tingkat,Pencapaian FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . "
        UNION ALL
        SELECT PeraihPrestasi,Bidang, Kegiatan AS Perlombaan,Tahun,Penyelenggara,Kategori,Tingkat, '-' AS Pencapaian FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . "
        )t1
        ON t1.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $fakultas . "' ORDER BY t1.Pencapaian DESC")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Perlombaan' => $k['Perlombaan'],
                'Tahun' => $k['Tahun'],
                'Penyelenggara' => $k['Penyelenggara'],
                'Kategori' => $k['Kategori'],
                'Tingkat' => $k['Tingkat'],
                'Pencapaian' => $k['Pencapaian']
            );
            $listData[] =  $data;

            $i += 1;
        }
        return $listData;
    }

    //json peringkat fakultas berdasarkan jumlah mahasiswa
    public function peringkatfakultasmahasiswa($start, $end)
    {
        $result = [
            'data' => $this->Maptoperingkatfakultasmahasiswa($start, $end),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk peringkat fakultas berdasarkan jumlah mahasiswa
    public function Maptoperingkatfakultasmahasiswa($start, $end)
    {
        $listData = [];

        $data = $this->db->query("SELECT fakultas.Fakultas,IFNULL(t3.TotalMahasiswa,0) AS TotalMahasiswa FROM fakultas
        LEFT JOIN
        (
        SELECT Fakultas,COUNT(t2.PeraihPrestasi) AS TotalMahasiswa FROM  user 
        LEFT JOIN 
        (SELECT DISTINCT(t1.PeraihPrestasi) FROM
        (SELECT PeraihPrestasi FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi
        UNION ALL
        SELECT PeraihPrestasi FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun  BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t1)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' GROUP BY Fakultas)t3
        ON t3.Fakultas=fakultas.Fakultas")->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'TotalMahasiswa' => $k['TotalMahasiswa']);
            $listData[] =  $data;
        }
        return $listData;
    }


    //json peringkat satu fakultas berdasarkan jumlah mahasiswa
    public function satuperingkatfakultasmahasiswa($start, $end, $fakultas)
    {
        $result = [
            'data' => $this->Maptosatuperingkatfakultasmahasiswa($start, $end, $fakultas),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data untuk peringkat fakultas berdasarkan jumlah mahasiswa (hanya satu fakultas)
    public function Maptosatuperingkatfakultasmahasiswa($start, $end, $fakultas)
    {
        $fakultas = str_replace("%20", " ", $fakultas);
        $fakultas = str_replace("%60", ",", $fakultas);
        $fakultas = str_replace("%7B", "(", $fakultas);
        $fakultas = str_replace("%7D", ")", $fakultas);
        $fakultas = str_replace("~", "/", $fakultas);
        $listData = [];

        $data = $this->db->query("SELECT fakultas.Fakultas,IFNULL(t3.TotalMahasiswa,0) AS TotalMahasiswa FROM fakultas
        LEFT JOIN
        (SELECT Fakultas,COUNT(t2.PeraihPrestasi) AS TotalMahasiswa FROM  user 
        LEFT JOIN 
        (SELECT DISTINCT(t1.PeraihPrestasi) FROM
        (SELECT PeraihPrestasi FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi
        UNION ALL
        SELECT PeraihPrestasi FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun  BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t1)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' AND user.Fakultas='" . $fakultas . "')t3
        ON t3.Fakultas=fakultas.Fakultas WHERE fakultas.Fakultas='" . $fakultas . "'")->result_array();

        foreach ($data as $k) {
            $data = array('Fakultas' => $k['Fakultas'], 'TotalMahasiswa' => $k['TotalMahasiswa']);
            $listData[] =  $data;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan tahun dan fakultas
    public function prestasimahasiswa($start, $end, $fakultas)
    {
        $result = [
            'data' => $this->Maptoprestasimahasiswa($start, $end, $fakultas),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }


    //data untuk prestasi mahasiswa berdasarkan tahun dan fakultas
    public function Maptoprestasimahasiswa($start, $end, $fakultas)
    {
        $fakultas = str_replace("%20", " ", $fakultas);
        $fakultas = str_replace("%60", ",", $fakultas);
        $fakultas = str_replace("%7B", "(", $fakultas);
        $fakultas = str_replace("%7D", ")", $fakultas);
        $fakultas = str_replace("~", "/", $fakultas);
        $listData = [];

        $data = $this->db->query("SELECT Nama, IFNULL(SUM(t1.total),0) AS PrestasiKompetisi,IFNULL(SUM(t2.total),0) AS PrestasiNonKompetisi, SUM(IFNULL(t1.total,0)+IFNULL(t2.total,0)) AS Total FROM  user 
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t1
        ON t1.PeraihPrestasi=user.IDPengenal
        LEFT JOIN 
        (SELECT PeraihPrestasi, COUNT(Status) AS total  FROM prestasinonkompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " GROUP BY PeraihPrestasi)t2
        ON t2.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' AND Fakultas='" . $fakultas . "' AND (t1.total!=0 OR t2.total!=0 ) GROUP BY user.Nama ORDER BY total DESC")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Nama' => $k['Nama'],
                'PrestasiKompetisi' => $k['PrestasiKompetisi'],
                'PrestasiNonKompetisi' => $k['PrestasiNonKompetisi'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan tahun dan fakultas
    public function peringkatbidang($start, $end)
    {
        $result = [
            'data' => $this->Maptoperingkatbidang($start, $end),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }



    //data analisis peringkat bidang
    public function Maptoperingkatbidang($start, $end)
    {
        $listData = [];

        $data = $this->db->query("SELECT bidangprestasi.Bidang,IFNULL(t2.Total,0) AS Total FROM bidangprestasi
        LEFT JOIN
        (SELECT t1.Bidang, COUNT(t1.Bidang) AS Total FROM user
        INNER JOIN
        (SELECT PeraihPrestasi,Bidang FROM prestasikompetisi WHERE Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . "
        UNION ALL
        SELECT PeraihPrestasi,Bidang FROM prestasinonkompetisi WHERE Status='Diterima' AND  Tahun BETWEEN " . $start . " AND " . $end . ")t1
        ON user.IDPengenal=t1.PeraihPrestasi 
        GROUP BY t1.Bidang)t2
        ON t2.Bidang=bidangprestasi.Bidang ORDER BY Total DESC")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }
        return $listData;
    }


    //json prestasi mahasiswa berdasarkan tahun dan fakultas
    public function prestasibidang($start, $end, $bidang)
    {

        $result = [
            'data' => $this->Maptoprestasibidang($start, $end, $bidang),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    // data prestasi bidang mahasiswa
    public function Maptoprestasibidang($start, $end, $bidang)
    {
        $bidang = str_replace("%60", ",", $bidang);
        $bidang = str_replace("%20", " ", $bidang);
        $bidang = str_replace("~", "/", $bidang);
        $bidang = str_replace("%7B", "(", $bidang);
        $bidang = str_replace("%7D", ")", $bidang);

        $listData = [];
        // $data;

        $jenisbidang = $this->db->query("SELECT bidangprestasi.JalurPencapaian FROM bidangprestasi WHERE Bidang='" . $bidang . "'")->result_array();
        foreach ($jenisbidang as $k) {
            $jenisbidang = $k['JalurPencapaian'];
        }

        if ($jenisbidang == 'Kompetisi') {
            $data = $this->db->query("SELECT Nama,prestasikompetisi.PeraihPrestasi AS NIM,Fakultas,ProgramStudi,prestasikompetisi.Perlombaan,prestasikompetisi.Tahun,prestasikompetisi.Penyelenggara,prestasikompetisi.Kategori,prestasikompetisi.Tingkat,prestasikompetisi.Pencapaian FROM  user
        INNER JOIN 
        prestasikompetisi
        ON prestasikompetisi.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' AND prestasikompetisi.Bidang='" . $bidang . "' AND prestasikompetisi.Status='Diterima' AND Tahun BETWEEN " . $start . " AND " . $end . " ORDER BY prestasikompetisi.Pencapaian DESC")->result_array();
        } else if ($jenisbidang == 'Non Kompetisi') {
            $data = $this->db->query("SELECT 
        Nama,prestasinonkompetisi.PeraihPrestasi AS NIM,Fakultas,ProgramStudi,prestasinonkompetisi.Kegiatan AS Perlombaan,prestasinonkompetisi.Tahun,prestasinonkompetisi.Penyelenggara,prestasinonkompetisi.Kategori,prestasinonkompetisi.Tingkat,'-' AS Pencapaian FROM  user
        INNER JOIN 
        prestasinonkompetisi
        ON prestasinonkompetisi.PeraihPrestasi=user.IDPengenal
        WHERE user.Role='Mahasiswa' AND prestasinonkompetisi.Status='Diterima' AND prestasinonkompetisi.Bidang='" . $bidang . "' AND Tahun BETWEEN " . $start . " AND " . $end)->result_array();
        }

        $i = 1;

        foreach ($data as $k) {

            // if($k['Perlombaan'] == null)
            // {
            //     $k['Perlombaan'] == 'kosong';
            // }

            $data = array(
                'No' => $i,
                'Nama' => $k['Nama'],
                'NIM' => $k['NIM'],
                'Fakultas' => $k['Fakultas'],
                'ProgramStudi' => $k['ProgramStudi'],
                'Perlombaan' => $k['Perlombaan'],
                'Tahun' => $k['Tahun'],
                'Penyelenggara' => $k['Penyelenggara'],
                'Kategori' => $k['Kategori'],
                'Tingkat' => $k['Tingkat'],
                'Pencapaian' => $k['Pencapaian']
            );
            $listData[] =  $data;
            $i += 1;
        }
        return $listData;
    }

    //json prestasi bidang berdasarkan jenis prestasi (kompetisi / non kompetisi)
    public function prestasibidangjenisprestasi($start, $end, $jenisprestasi)
    {
        $result = [
            'data' => $this->Maptoprestasibidangjenisprestasi($start, $end, $jenisprestasi),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data prestasi bidang berdasarkan jenis prestasi (kompetisi / non kompetisi)
    public function Maptoprestasibidangjenisprestasi($start, $end, $jenisprestasi)
    {
        $jenisprestasi = str_replace("%60", ",", $jenisprestasi);
        $jenisprestasi = str_replace("%20", " ", $jenisprestasi);
        $jenisprestasi = str_replace("~", "/", $jenisprestasi);
        $jenisprestasi = str_replace("%7B", "(", $jenisprestasi);
        $jenisprestasi = str_replace("%7D", ")", $jenisprestasi);
        $listData = [];
        // $data;

        if ($jenisprestasi == 'Kompetisi') {
            $data = $this->db->query("SELECT bidangprestasi.Bidang, IFNULL(t2.Total,0) AS Total FROM bidangprestasi
            LEFT JOIN
            (SELECT prestasikompetisi.Bidang AS Bidang, COUNT(Status) AS Total FROM prestasikompetisi 
             WHERE prestasikompetisi.Status='Diterima' AND prestasikompetisi.Tahun BETWEEN " . $start . " AND " . $end . "
             GROUP BY Bidang
            )t2
            ON bidangprestasi.Bidang=t2.Bidang
            WHERE bidangprestasi.JalurPencapaian='Kompetisi'")->result_array();
        } else if ($jenisprestasi == 'Non Kompetisi') {
            $data = $this->db->query("SELECT bidangprestasi.Bidang, IFNULL(t2.Total,0) AS Total FROM bidangprestasi
            LEFT JOIN
            (SELECT prestasinonkompetisi.Bidang AS Bidang, COUNT(Status) AS Total FROM prestasinonkompetisi 
            WHERE prestasinonkompetisi.Status='Diterima' AND prestasinonkompetisi.Tahun BETWEEN " . $start . " AND " . $end . "
            GROUP BY Bidang) t2
            ON bidangprestasi.Bidang=t2.Bidang
            WHERE bidangprestasi.JalurPencapaian='Non Kompetisi'")->result_array();
        }

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
        }

        return $listData;
    }

    //json prestasi bidang berdasarkan bidang
    public function prestasibidangjenisbidang($start, $end, $jenisbidang)
    {
        $result = [
            'data' => $this->Maptoprestasibidangjenisbidang($start, $end, $jenisbidang),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //data prestasi bidang berdasarkan jenis prestasi (kompetisi / non kompetisi)
    public function Maptoprestasibidangjenisbidang($start, $end, $jenisbidang)
    {
        $jenisbidang = str_replace("%60", ",", $jenisbidang);
        $jenisbidang = str_replace("%20", " ", $jenisbidang);
        $jenisbidang = str_replace("~", "/", $jenisbidang);
        $jenisbidang = str_replace("%7B", "(", $jenisbidang);
        $jenisbidang = str_replace("%7D", ")", $jenisbidang);

        $listData = [];
        $data = $this->db->query("SELECT bidangprestasi.Bidang, IFNULL(t2.Total,0) AS Total FROM bidangprestasi
        LEFT JOIN
        (SELECT prestasikompetisi.Bidang AS Bidang, COUNT(Status) AS Total FROM prestasikompetisi 
         WHERE prestasikompetisi.Status='Diterima' AND prestasikompetisi.Tahun BETWEEN " . $start . " AND " . $end . "
         GROUP BY Bidang 
        UNION ALL
         SELECT prestasinonkompetisi.Bidang AS Bidang, COUNT(Status) AS Total FROM prestasinonkompetisi 
        WHERE prestasinonkompetisi.Status='Diterima' AND prestasinonkompetisi.Tahun BETWEEN " . $start . " AND " . $end . "
        GROUP BY Bidang
        )t2
        ON bidangprestasi.Bidang=t2.Bidang
        WHERE bidangprestasi.Bidang='" . $jenisbidang . "'")->result_array();

        $i = 1;

        foreach ($data as $k) {
            $data = array(
                'No' => $i,
                'Bidang' => $k['Bidang'],
                'Total' => $k['Total']
            );
            $listData[] =  $data;
            $i += 1;
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

    //Kelola Bidang
    public function kelola_bidang()
    {
        $this->data['active'] = 6;
        $this->data['title'] = 'Admin Sistem | Kelola Bidang ';
        $this->data['content'] = 'manage_bidang';
        $this->load->view('admin_sistem/template/template', $this->data);
    }

    //mengambil semua data bidang pada table user
    public function getbidang()
    {
        $result = [
            'data' => $this->Mapbidang(),
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function Mapbidang()
    {
        // $cek = $this->db->where('Role !=', "Mahasiswa");

        $data = $this->Bidang_prestasi->get();
        $listData = [];
        $i = 1;

        $data = $this->db->query("SELECT * FROM `bidangprestasi` ORDER BY `bidangprestasi`.`JalurPencapaian` ASC")->result();
        foreach ($data as $k) {
            $obj = new UserObj();

            $obj->No = $i;
            $obj->IDPrestasi = $k->IDPrestasi;
            $obj->Jenis_Prestasi = $k->JalurPencapaian;
            $obj->Nama_bidang = $k->Bidang;

            $listData[] = $obj;
            $i = $i + 1;
        }
        return $listData;
    }

    //Tambah Data Bidang
    public function tambahbidang()
    {
        if ($this->input->post('tambahdata')) {
            $input['JalurPencapaian'] = $this->input->post('jalurPencapaian');
            $input['Bidang'] = $this->input->post('namabidang');
            $this->Bidang_prestasi->insert($input);
            $this->flashmsg('Data Bidang Telah Berhasil Ditambah');
        }
        redirect("admin_sistem/kelola_bidang");
    }

    //Edit Data Bidang
    // mengambil data Bidang berdasarkan IDPrestasi
    public function getdatabidang()
    {
        $id = $this->input->post('ID');
        $dataku = $this->Bidang_prestasi->get(['IDPrestasi' => $id]);
        $result = [
            'data' => $dataku,
            'status' => true,
            'status_code' => 200
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    //update user
    public function updatebidang()
    {
        if ($this->input->post('updatedata')) {
            $input['JalurPencapaian'] = $this->input->post('Jalur_Pencapaian');
            $input['Bidang'] = $this->input->post('nama_bidang');
            $this->db->where('IDPrestasi', $this->input->post('detector'));
            $this->db->update('bidangprestasi', $input);
            $this->flashmsg('Data Bidang Telah Berhasil Diubah');
        }
        redirect("admin_sistem/kelola_bidang");
    }

    //Menghapus Bidang
    public function deletebidang()
    {
        $id = $this->input->post('ID');
        $data['IDPrestasi'] = $id;
        $BidangCek = $this->Bidang_prestasi->get_row($data);
        // print_r($test);
        if ($BidangCek != null) {
            $this->db->where('IDPrestasi', $id);
            $this->db->delete('bidangprestasi');
            $result['status'] = true;
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
