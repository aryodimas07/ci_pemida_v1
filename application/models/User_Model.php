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
        $this->db->from('user');
        $this->db->like('nama', $name);
        $this->db->limit(3);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_name($name)
    {
        $this->db->select('nama');
        $this->db->like('nama', $name);
        return $this->db->get('user',10)->result();
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
    function user_exist($key)
    {
      $this->db->where('nama',$key);
      $query = $this->db->get('user');
      if ($query->num_rows() > 0){
          return true;
      }
      else{
          return false;
      }
    }
    function get_user_id($nama)
    {
      $this->db->select('id');
      $this->db->from('user');
      $this->db->where('nama',$nama);
      $this->db->limit(1);
      $query = $this->db->get();
      return $query->row();
    }

    function get_user_id_by_email($email)
    {
      $this->db->select('id');
      $this->db->from('user');
      $this->db->where('email',$email);
      $this->db->limit(1);
      $query = $this->db->get();
      return $query->row();
    }

    public function isEmailDuplicate($email)
    {
      $this->db->get_where('user', array('email' => $email), 1);
      return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}
