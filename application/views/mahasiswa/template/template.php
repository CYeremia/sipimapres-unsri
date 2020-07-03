<?php

$this->load->view('mahasiswa/template/title', $title);
$this->load->view('mahasiswa/template/navbar', $title);
$this->load->view('mahasiswa/template/sidebar', $title);
$this->load->view('mahasiswa/' . $content);
$this->load->view('mahasiswa/template/footer', $title);
