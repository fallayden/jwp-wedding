<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    protected $table = 'tb_order';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Simpan permintaan pemesanan baru dari pengunjung
     *
     * @param array $data
     * @return int
     */
    public function insert($data)
    {
        if (!isset($data['status'])) {
            $data['status'] = 'requested';
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Ambil semua data pesanan lengkap dengan nama paket dan nama admin
     *
     * @return array
     */
    public function get_all()
    {
        $this->db->select('tb_order.*, tb_catalogues.package_name, tb_catalogues.price, tb_users.name as approved_by_name');
        $this->db->from($this->table);
        $this->db->join('tb_catalogues', 'tb_catalogues.catalogue_id = tb_order.catalogue_id', 'left');
        $this->db->join('tb_users', 'tb_users.user_id = tb_order.user_id', 'left');
        $this->db->order_by('tb_order.order_id', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Ambil detail pesanan berdasarkan order_id
     *
     * @param int $order_id
     * @return object|null
     */
    public function get_by_id($order_id)
    {
        $this->db->select('tb_order.*, tb_catalogues.package_name, tb_catalogues.price, tb_catalogues.image as catalogue_image, tb_users.name as approved_by_name');
        $this->db->from($this->table);
        $this->db->join('tb_catalogues', 'tb_catalogues.catalogue_id = tb_order.catalogue_id', 'left');
        $this->db->join('tb_users', 'tb_users.user_id = tb_order.user_id', 'left');
        $this->db->where('tb_order.order_id', $order_id);
        return $this->db->get()->row();
    }

    /**
     * Ambil sejumlah pesanan terbaru untuk dashboard
     *
     * @param int $limit
     * @return array
     */
    public function get_recent($limit = 5)
    {
        $this->db->select('tb_order.*, tb_catalogues.package_name, tb_catalogues.price');
        $this->db->from($this->table);
        $this->db->join('tb_catalogues', 'tb_catalogues.catalogue_id = tb_order.catalogue_id', 'left');
        $this->db->order_by('tb_order.order_id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    /**
     * Update status pesanan (contoh: dari 'requested' menjadi 'approved')
     *
     * @param int $order_id
     * @param string $status
     * @param int|null $user_id
     * @return bool
     */
    public function update_status($order_id, $status, $user_id = null)
    {
        $data = ['status' => $status];
        if ($user_id !== null) {
            $data['user_id'] = $user_id;
        }
        return $this->db->where('order_id', $order_id)->update($this->table, $data);
    }

    /**
     * Hitung total semua pesanan
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Hitung pesanan berdasarkan status ('requested' / 'approved')
     *
     * @param string $status
     * @return int
     */
    public function count_by_status($status)
    {
        return $this->db->where('status', $status)->from($this->table)->count_all_results();
    }

    /**
     * Rekap laporan pesanan per paket katalog
     *
     * @return array
     */
    public function get_report_per_package()
    {
        $this->db->select('
            tb_catalogues.catalogue_id,
            tb_catalogues.package_name,
            tb_catalogues.price,
            COUNT(tb_order.order_id) as total_order,
            COUNT(CASE WHEN tb_order.status = "approved" THEN 1 END) as total_approved,
            COUNT(CASE WHEN tb_order.status = "requested" THEN 1 END) as total_requested
        ', FALSE);
        $this->db->from('tb_catalogues');
        $this->db->join($this->table, 'tb_order.catalogue_id = tb_catalogues.catalogue_id', 'left');
        $this->db->group_by(['tb_catalogues.catalogue_id', 'tb_catalogues.package_name', 'tb_catalogues.price']);
        $this->db->order_by('total_order', 'DESC');
        return $this->db->get()->result();
    }
}
