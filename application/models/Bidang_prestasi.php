<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang_prestasi extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'bidangprestasi';
        $this->data['primary_key'] = 'IDPrestasi';
    }
}
