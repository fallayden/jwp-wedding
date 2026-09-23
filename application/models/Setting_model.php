<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

    protected $table = 'tb_settings';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil pengaturan website (baris pertama)
     *
     * @return object|null
     */
    public function get_settings()
    {
        $setting = $this->db->get($this->table)->row();

        // Jika belum ada data sama sekali di database, inisialisasi data default
        if (!$setting) {
            $default = [
                'website_name'         => 'JWP Wedding Organizer',
                'phone_number1'        => '081234567890',
                'phone_number2'        => '081298765432',
                'email1'               => 'info@jwpwedding.com',
                'email2'               => 'support@jwpwedding.com',
                'address'              => 'Jl. Pengantin No. 1, Jakarta',
                'maps'                 => '',
                'logo'                 => '',
                'facebook_url'         => 'https://facebook.com',
                'instagram_url'        => 'https://instagram.com',
                'youtube_url'          => 'https://youtube.com',
                'header_business_hour' => 'Senin - Sabtu',
                'time_business_hour'   => '09:00 - 17:00 WIB'
            ];
            $this->db->insert($this->table, $default);
            return $this->db->get($this->table)->row();
        }

        return $setting;
    }

    /**
     * Perbarui data pengaturan website
     *
     * @param array $data
     * @return bool
     */
    public function update_settings($data)
    {
        $setting = $this->db->get($this->table)->row();

        if ($setting) {
            return $this->db->where('id', $setting->id)->update($this->table, $data);
        } else {
            return $this->db->insert($this->table, $data);
        }
    }
}
