<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Halaman Profil Admin & Pengaturan Website
     */
    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $data = [
            'title'   => 'Profil & Pengaturan Website - Panel Admin',
            'admin'   => $this->User_model->get_by_id($user_id),
            'setting' => $this->Setting_model->get_settings()
        ];

        $this->load->view('admin/pengaturan/index', $data);
    }

    /**
     * Update Data Profil & Kata Sandi Admin
     */
    public function update_profil()
    {
        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim|max_length[80]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[80]');

        // Jika password diisi, validasi panjang minimal
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Kata Sandi Baru', 'trim|min_length[5]');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/pengaturan');
            return;
        }

        $update_data = [
            'name'     => $this->input->post('name', TRUE),
            'username' => $this->input->post('username', TRUE)
        ];

        if ($this->input->post('password')) {
            $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->User_model->update($user_id, $update_data);

        // Perbarui data nama dan username di session
        $this->session->set_userdata([
            'name'     => $update_data['name'],
            'username' => $update_data['username']
        ]);

        $this->session->set_flashdata('success', 'Profil admin berhasil diperbarui.');
        redirect('admin/pengaturan');
    }

    /**
     * Update Informasi Website (Identitas, Kontak, Medsos, Jam Kerja, Logo)
     */
    public function update_website()
    {
        $this->form_validation->set_rules('website_name', 'Nama Website', 'required|trim|max_length[256]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/pengaturan');
            return;
        }

        $setting = $this->Setting_model->get_settings();
        $logo_name = $setting ? $setting->logo : '';

        // Proses unggah logo baru jika ada
        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path']   = './uploads/logo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'logo_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                // Hapus logo lama jika ada
                if ($logo_name && file_exists('./uploads/logo/' . $logo_name)) {
                    unlink('./uploads/logo/' . $logo_name);
                }
                $upload_data = $this->upload->data();
                $logo_name   = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/pengaturan');
                return;
            }
        }

        $data_setting = [
            'website_name'         => $this->input->post('website_name', TRUE),
            'phone_number1'        => $this->input->post('phone_number1', TRUE),
            'phone_number2'        => $this->input->post('phone_number2', TRUE),
            'email1'               => $this->input->post('email1', TRUE),
            'email2'               => $this->input->post('email2', TRUE),
            'address'              => $this->input->post('address', TRUE),
            'maps'                 => $this->input->post('maps', TRUE),
            'logo'                 => $logo_name,
            'facebook_url'         => $this->input->post('facebook_url', TRUE),
            'instagram_url'        => $this->input->post('instagram_url', TRUE),
            'youtube_url'          => $this->input->post('youtube_url', TRUE),
            'header_business_hour' => $this->input->post('header_business_hour', TRUE),
            'time_business_hour'   => $this->input->post('time_business_hour', TRUE)
        ];

        $this->Setting_model->update_settings($data_setting);
        $this->session->set_flashdata('success', 'Pengaturan website berhasil diperbarui.');
        redirect('admin/pengaturan');
    }
}
