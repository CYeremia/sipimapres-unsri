<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userverifikasi_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'registrasi';
        $this->data['primary_key'] = 'UserID';
    }
}
