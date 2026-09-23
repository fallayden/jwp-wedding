<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Halaman Utama Dashboard Admin
     */
    public function index()
    {
        $data = [
            'title'            => 'Dashboard Admin - JWP Wedding Organizer',
            'setting'          => $this->Setting_model->get_settings(),
            'admin_name'       => $this->session->userdata('name'),
            'count_catalogues' => $this->Catalogue_model->count_all(),
            'count_published'  => $this->Catalogue_model->count_published(),
            'count_requested'  => $this->Order_model->count_by_status('requested'),
            'count_approved'   => $this->Order_model->count_by_status('approved'),
            'recent_orders'    => $this->Order_model->get_recent(5)
        ];

        $this->load->view('admin/dashboard', $data);
    }
}
