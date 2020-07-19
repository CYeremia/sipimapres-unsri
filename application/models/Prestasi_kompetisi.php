<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_kompetisi extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'prestasikompetisi';
        $this->data['primary_key'] = 'IDPrestasi';
    }
}
