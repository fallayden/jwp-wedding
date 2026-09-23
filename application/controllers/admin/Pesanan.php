<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Daftar Semua Pesanan Masuk
     */
    public function index()
    {
        $data = [
            'title'   => 'Daftar Pesanan Masuk - Panel Admin',
            'setting' => $this->Setting_model->get_settings(),
            'orders'  => $this->Order_model->get_all()
        ];

        $this->load->view('admin/pesanan/index', $data);
    }

    /**
     * Detail Pesanan
     *
     * @param int|null $order_id
     */
    public function detail($order_id = null)
    {
        if (!$order_id) {
            redirect('admin/pesanan');
        }

        $order = $this->Order_model->get_by_id($order_id);
        if (!$order) {
            show_404();
        }

        $data = [
            'title'   => 'Detail Pesanan #' . $order->order_id . ' - Panel Admin',
            'setting' => $this->Setting_model->get_settings(),
            'order'   => $order
        ];

        $this->load->view('admin/pesanan/detail', $data);
    }

    /**
     * Setujui Pesanan (Ubah status dari 'requested' menjadi 'approved')
     *
     * @param int|null $order_id
     */
    public function approve($order_id = null)
    {
        if (!$order_id) {
            redirect('admin/pesanan');
        }

        $order = $this->Order_model->get_by_id($order_id);
        if ($order) {
            $user_id = $this->session->userdata('user_id');
            $this->Order_model->update_status($order_id, 'approved', $user_id);
            $this->session->set_flashdata('success', 'Pesanan #' . $order_id . ' atas nama ' . $order->name . ' berhasil disetujui (Approved).');
        } else {
            $this->session->set_flashdata('error', 'Pesanan tidak ditemukan.');
        }

        redirect('admin/pesanan/detail/' . $order_id);
    }
}
