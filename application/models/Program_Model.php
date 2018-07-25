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
        if ($this->is_admin($email)) {
          //ambil data nama dan tanggal pembuatan dari semua program
          $this->db->select('nama, dateCreated');
          $this->db->from('program');
          $query = $this->db->get();
          return $query->result_array();
        } else {
          //ambil data nama dan tanggal pembuatan dari program bersangkutan
          $this->db->select('program.nama, program.dateCreated');
          $this->db->from('user');
          $this->db->join('program_pic', 'user.id = program_pic.id_pic');
          $this->db->join('program', 'program_pic.id_program = program.id');
          $query = $this->db->get();
          return $query->result_array();
        }
    }

    public function is_admin($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('isAdmin', 1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function get_login_info()
    {
        $result = $this->session->userdata()['logged_in']['email'];
        return $result;
    }
}
