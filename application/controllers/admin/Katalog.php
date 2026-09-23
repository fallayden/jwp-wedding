<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Daftar Semua Paket Katalog
     */
    public function index()
    {
        $data = [
            'title'      => 'Manajemen Katalog Paket - Panel Admin',
            'setting'    => $this->Setting_model->get_settings(),
            'catalogues' => $this->Catalogue_model->get_all()
        ];

        $this->load->view('admin/katalog/index', $data);
    }

    /**
     * Tambah Paket Katalog Baru
     */
    public function tambah()
    {
        $this->form_validation->set_rules('package_name', 'Nama Paket', 'required|trim|max_length[256]');
        $this->form_validation->set_rules('price', 'Harga Paket', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('description', 'Deskripsi Paket', 'required');
        $this->form_validation->set_rules('status_publish', 'Status Publikasi', 'required|in_list[Y,N]');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'   => 'Tambah Paket Katalog - Panel Admin',
                'setting' => $this->Setting_model->get_settings()
            ];
            $this->load->view('admin/katalog/tambah', $data);
            return;
        }

        // Proses unggah gambar paket
        $image_name = '';
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './uploads/catalogues/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 5120; // 5MB
            $config['file_name']     = 'pkg_' . time() . '_' . uniqid();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $image_name  = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/katalog/tambah');
                return;
            }
        }

        $insert_data = [
            'image'          => $image_name,
            'package_name'   => $this->input->post('package_name', TRUE),
            'description'    => $this->input->post('description'),
            'price'          => $this->input->post('price', TRUE),
            'status_publish' => $this->input->post('status_publish', TRUE),
            'user_id'        => $this->session->userdata('user_id')
        ];

        $this->Catalogue_model->insert($insert_data);
        $this->session->set_flashdata('success', 'Paket katalog berhasil ditambahkan.');
        redirect('admin/katalog');
    }

    /**
     * Ubah Paket Katalog
     *
     * @param int|null $catalogue_id
     */
    public function ubah($catalogue_id = null)
    {
        if (!$catalogue_id) {
            redirect('admin/katalog');
        }

        $catalogue = $this->Catalogue_model->get_by_id($catalogue_id);
        if (!$catalogue) {
            show_404();
        }

        $this->form_validation->set_rules('package_name', 'Nama Paket', 'required|trim|max_length[256]');
        $this->form_validation->set_rules('price', 'Harga Paket', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('description', 'Deskripsi Paket', 'required');
        $this->form_validation->set_rules('status_publish', 'Status Publikasi', 'required|in_list[Y,N]');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'     => 'Ubah Paket Katalog - Panel Admin',
                'setting'   => $this->Setting_model->get_settings(),
                'catalogue' => $catalogue
            ];
            $this->load->view('admin/katalog/ubah', $data);
            return;
        }

        $image_name = $catalogue->image;
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './uploads/catalogues/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size']      = 5120; // 5MB
            $config['file_name']     = 'pkg_' . time() . '_' . uniqid();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                // Hapus gambar lama jika ada
                if ($catalogue->image && file_exists('./uploads/catalogues/' . $catalogue->image)) {
                    unlink('./uploads/catalogues/' . $catalogue->image);
                }
                $upload_data = $this->upload->data();
                $image_name  = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('admin/katalog/ubah/' . $catalogue_id);
                return;
            }
        }

        $update_data = [
            'image'          => $image_name,
            'package_name'   => $this->input->post('package_name', TRUE),
            'description'    => $this->input->post('description'),
            'price'          => $this->input->post('price', TRUE),
            'status_publish' => $this->input->post('status_publish', TRUE)
        ];

        $this->Catalogue_model->update($catalogue_id, $update_data);
        $this->session->set_flashdata('success', 'Paket katalog berhasil diperbarui.');
        redirect('admin/katalog');
    }

    /**
     * Hapus Paket Katalog
     *
     * @param int|null $catalogue_id
     */
    public function hapus($catalogue_id = null)
    {
        if (!$catalogue_id) {
            redirect('admin/katalog');
        }

        $catalogue = $this->Catalogue_model->get_by_id($catalogue_id);
        if ($catalogue) {
            if ($catalogue->image && file_exists('./uploads/catalogues/' . $catalogue->image)) {
                unlink('./uploads/catalogues/' . $catalogue->image);
            }
            $this->Catalogue_model->delete($catalogue_id);
            $this->session->set_flashdata('success', 'Paket katalog berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data katalog tidak ditemukan.');
        }

        redirect('admin/katalog');
    }
}
