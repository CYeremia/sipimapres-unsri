<?php

$this->load->view('admin_sistem/template/title', $title);
$this->load->view('admin_sistem/template/navbar', $title);
$this->load->view('admin_sistem/template/sidebar', $title);
$this->load->view('admin_sistem/' . $content);
$this->load->view('admin_sistem/template/footer', $title);
