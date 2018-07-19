<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Method untuk mengambil data user berupa username/email, password dan role
     * @param  string $email email dari user
     * @return array     data user berupa email, password dan role
     */
    public function get_user_info($email)
    {
        $this->db->select('email, password, isAdmin');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_user_name($name)
    {
        $this->db->select('nama');
        $htis->db->from('user');
        $this->db->like('nama', $name);
        $this->db->limit(3);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function is_user_exist($data)
    {
        $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $query = $this->db->get_where('user', $condition);

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
