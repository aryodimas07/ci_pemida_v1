<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_program_info($email)
    {
        $this->db->select('*');
        $this->db->from('program');
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
