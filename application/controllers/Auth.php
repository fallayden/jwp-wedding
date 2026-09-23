<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Halaman Login Admin & Proses Autentikasi
     */
    public function login()
    {
        // Jika sudah login, langsung alihkan ke Dashboard Admin
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }

        // Rules validasi login
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username wajib diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|trim', [
            'required' => 'Kata sandi wajib diisi.'
        ]);

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'   => 'Login Admin - JWP Wedding Organizer',
                'setting' => $this->Setting_model->get_settings()
            ];
            $this->load->view('auth/login', $data);
            return;
        }

        // Proses autentikasi credential
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->User_model->get_by_username($username);

        if (!$user) {
            $this->session->set_flashdata('error', 'Username atau kata sandi tidak ditemukan.');
            redirect('login');
            return;
        }

        // Cek kecocokan password (mendukung password_hash & fallback md5)
        $password_match = FALSE;
        if (password_verify($password, $user->password)) {
            $password_match = TRUE;
        } elseif ($user->password === md5($password)) {
            $password_match = TRUE;
            // Upgrade hash secara otomatis ke password_hash
            $this->User_model->update($user->user_id, [
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        }

        if (!$password_match) {
            $this->session->set_flashdata('error', 'Kata sandi salah.');
            redirect('login');
            return;
        }

        // Set session admin
        $session_data = [
            'user_id'   => $user->user_id,
            'name'      => $user->name,
            'username'  => $user->username,
            'logged_in' => TRUE
        ];
        $this->session->set_userdata($session_data);

        $this->session->set_flashdata('success', 'Selamat datang kembali, ' . $user->name . '!');
        redirect('admin/dashboard');
    }

    /**
     * Alias default method
     */
    public function index()
    {
        $this->login();
    }

    /**
     * Proses Keluar (Logout)
     */
    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'name', 'username', 'logged_in']);
        $this->session->sess_destroy();

        // Buat session baru hanya untuk pesan flashdata
        session_start();
        $_SESSION['success'] = 'Anda telah berhasil logout.';

        redirect('login');
    }
}
