<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Halaman Laporan Jumlah Pesanan per Paket
     */
    public function index()
    {
        $data = [
            'title'           => 'Laporan Pesanan per Paket - Panel Admin',
            'setting'         => $this->Setting_model->get_settings(),
            'total_orders'    => $this->Order_model->count_all(),
            'total_approved'  => $this->Order_model->count_by_status('approved'),
            'total_requested' => $this->Order_model->count_by_status('requested'),
            'reports'         => $this->Order_model->get_report_per_package()
        ];

        $this->load->view('admin/laporan/index', $data);
    }
}
