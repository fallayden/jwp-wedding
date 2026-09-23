<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Halaman Beranda / Katalog Publik
     */
    public function index()
    {
        $data = [
            'title'      => 'Beranda - JWP Wedding Organizer',
            'setting'    => $this->Setting_model->get_settings(),
            'catalogues' => $this->Catalogue_model->get_published()
        ];

        $this->load->view('public/home', $data);
    }

    /**
     * Halaman Detail Paket Pernikahan
     *
     * @param int|null $catalogue_id
     */
    public function detail($catalogue_id = null)
    {
        if (!$catalogue_id) {
            redirect('home');
        }

        $catalogue = $this->Catalogue_model->get_by_id($catalogue_id);

        if (!$catalogue || $catalogue->status_publish !== 'Y') {
            show_404();
        }

        $data = [
            'title'     => $catalogue->package_name . ' - JWP Wedding Organizer',
            'setting'   => $this->Setting_model->get_settings(),
            'catalogue' => $catalogue
        ];

        $this->load->view('public/detail', $data);
    }

    /**
     * Proses Kirim Permintaan Pemesanan (Booking)
     */
    public function pesan()
    {
        $catalogue_id = $this->input->post('catalogue_id', TRUE);

        // Rules validasi form pemesanan
        $this->form_validation->set_rules('catalogue_id', 'Paket Pernikahan', 'required|numeric');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim|max_length[120]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[256]');
        $this->form_validation->set_rules('phone_number', 'Nomor Telepon', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('wedding_date', 'Tanggal Pernikahan', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('detail-paket/' . $catalogue_id);
            return;
        }

        $order_data = [
            'catalogue_id' => $catalogue_id,
            'name'         => $this->input->post('name', TRUE),
            'email'        => $this->input->post('email', TRUE),
            'phone_number' => $this->input->post('phone_number', TRUE),
            'wedding_date' => $this->input->post('wedding_date', TRUE),
            'status'       => 'requested'
        ];

        $this->Order_model->insert($order_data);

        $this->session->set_flashdata('success', 'Permintaan pemesanan Anda berhasil dikirim! Status pesanan Anda saat ini adalah "Request". Pihak kami akan segera menghubungi Anda.');
        redirect('detail-paket/' . $catalogue_id);
    }

    /**
     * Halaman Kontak Kami
     */
    public function kontak()
    {
        $data = [
            'title'   => 'Kontak Kami - JWP Wedding Organizer',
            'setting' => $this->Setting_model->get_settings()
        ];

        $this->load->view('public/kontak', $data);
    }
}
