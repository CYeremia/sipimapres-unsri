<?php

$this->load->view('admin_fakultas/template/title', $title);
$this->load->view('admin_fakultas/template/navbar', $title);
$this->load->view('admin_fakultas/template/sidebar', $title);
$this->load->view('admin_fakultas/' . $content);
$this->load->view('admin_fakultas/template/footer', $title);
