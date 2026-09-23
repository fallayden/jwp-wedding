<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue_model extends CI_Model {

    protected $table = 'tb_catalogues';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua paket katalog (untuk manajemen admin)
     *
     * @return array
     */
    public function get_all()
    {
        $this->db->select('tb_catalogues.*, tb_users.name as creator_name');
        $this->db->from($this->table);
        $this->db->join('tb_users', 'tb_users.user_id = tb_catalogues.user_id', 'left');
        $this->db->order_by('tb_catalogues.catalogue_id', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Ambil paket katalog yang dipublikasikan (untuk pengunjung / landing page)
     *
     * @return array
     */
    public function get_published()
    {
        $this->db->where('status_publish', 'Y');
        $this->db->order_by('catalogue_id', 'DESC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Ambil 1 data katalog berdasarkan catalogue_id
     *
     * @param int $catalogue_id
     * @return object|null
     */
    public function get_by_id($catalogue_id)
    {
        return $this->db->get_where($this->table, ['catalogue_id' => $catalogue_id])->row();
    }

    /**
     * Tambah paket katalog baru
     *
     * @param array $data
     * @return int
     */
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update data paket katalog
     *
     * @param int $catalogue_id
     * @param array $data
     * @return bool
     */
    public function update($catalogue_id, $data)
    {
        return $this->db->where('catalogue_id', $catalogue_id)->update($this->table, $data);
    }

    /**
     * Hapus paket katalog
     *
     * @param int $catalogue_id
     * @return bool
     */
    public function delete($catalogue_id)
    {
        return $this->db->where('catalogue_id', $catalogue_id)->delete($this->table);
    }

    /**
     * Hitung total semua paket
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Hitung total paket yang dipublikasikan
     *
     * @return int
     */
    public function count_published()
    {
        return $this->db->where('status_publish', 'Y')->from($this->table)->count_all_results();
    }
}
