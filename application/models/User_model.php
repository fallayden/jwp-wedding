<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'tb_users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil data user berdasarkan username
     *
     * @param string $username
     * @return object|null
     */
    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    /**
     * Ambil data user berdasarkan user_id
     *
     * @param int $user_id
     * @return object|null
     */
    public function get_by_id($user_id)
    {
        return $this->db->get_where($this->table, ['user_id' => $user_id])->row();
    }

    /**
     * Tambah user baru
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
     * Update data user
     *
     * @param int $user_id
     * @param array $data
     * @return bool
     */
    public function update($user_id, $data)
    {
        return $this->db->where('user_id', $user_id)->update($this->table, $data);
    }

    /**
     * Hapus user
     *
     * @param int $user_id
     * @return bool
     */
    public function delete($user_id)
    {
        return $this->db->where('user_id', $user_id)->delete($this->table);
    }

    /**
     * Hitung total user
     *
     * @return int
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
}
