<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
}

/**
 * Base Controller untuk semua modul Admin
 * Memastikan proteksi sesi login sebelum controller dijalankan
 */
class Admin_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        // Cek apakah admin sudah login
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
            redirect('login');
        }
    }
}
