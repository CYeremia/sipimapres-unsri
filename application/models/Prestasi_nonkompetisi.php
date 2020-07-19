<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_nonkompetisi extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'prestasinonkompetisi';
        $this->data['primary_key'] = 'IDPrestasi';
    }
}
