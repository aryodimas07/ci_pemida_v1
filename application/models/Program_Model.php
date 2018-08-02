<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_program_relate($email)
    {
        if (is_admin()) {
          //ambil data nama dan tanggal pembuatan dari semua program
          $this->db->select('nama, dateCreated, deskripsi, slug');
          $this->db->from('program');
          $query = $this->db->get();
          return $query->result_array();
        } else {
          //ambil data nama dan tanggal pembuatan dari program bersangkutan
          $this->db->select('program.nama, program.dateCreated, program.deskripsi, program.slug');
          $this->db->from('user');
          $this->db->join('program_pic', 'user.id = program_pic.id_pic');
          $this->db->join('program', 'program_pic.id_program = program.id');
          $this->db->where('email', $email);
          $query = $this->db->get();
          return $query->result_array();
        }
    }

    public function get_program_info_by_status_and_email($status, $email)
    {
      if (is_admin()) {
        //ambil data nama dan tanggal pembuatan dari semua program
        $this->db->select('nama, dateCreated, deskripsi, slug');
        $this->db->from('program');
        $this->db->where('status', $status);
        $query = $this->db->get();
        return $query->result_array();
      } else {
        //ambil data nama dan tanggal pembuatan dari program bersangkutan
        $this->db->select('program.nama, program.dateCreated, program.deskripsi, program.slug');
        $this->db->from('user');
        $this->db->join('program_pic', 'user.id = program_pic.id_pic');
        $this->db->join('program', 'program_pic.id_program = program.id');
        $this->db->where('email', $email);
        $this->db->where('status', $status);
        $query = $this->db->get();
        return $query->result_array();
      }
    }

    public function get_program_info($slug)
    {
        $this->db->select('*');
        $this->db->from('program');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_id_program_by_slug($slug)
    {
      $this->db->select('id');
      $this->db->from('program');
      $this->db->where('slug', $slug);
      $query = $this->db->get();
      return $query->row_array()['id'];
    }

    public function get_program_pic($slug)
    {
        $this->db->select('user.id, user.nama, user.email, user.notelp, role.nama as role');
        $this->db->from('program');
        $this->db->join('program_pic', 'program.id = program_pic.id_program');
        $this->db->join('user', 'program_pic.id_pic = user.id');
        $this->db->join('role', 'program_pic.role_id = role.id');
        $this->db->where('program.slug', $slug);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function is_program_exists($slug)
    {
      $this->db->select('program.slug');
      $this->db->from('user');
      $this->db->join('program_pic', 'user.id = program_pic.id_pic');
      $this->db->join('program', 'program_pic.id_program = program.id');
      $this->db->where('slug', $slug);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_procurement_relate($slug)
    {
      $this->db->select('informasi.id_procurement, procurement.proses, informasi.submitDate');
      $this->db->from('program');
      $this->db->join('informasi', 'program.id = informasi.id_program');
      $this->db->join('procurement', 'informasi.id_procurement = procurement.id');
      $this->db->where('program.slug', $slug);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function get_procurement()
    {
      $this->db->select('*');
      $this->db->from('procurement');
      $query = $this->db->get();
      return $query->result_array();
    }

    public function set_status($slug, $status)
    {
      $this->db->set('status', $status);
      $this->db->where('slug', $slug);
      $this->db->update('program');
    }

    public function get_pic_role($user, $slug)
    {
        $this->db->select('program_pic.role_id');
        $this->db->from('program');
        $this->db->join('program_pic', 'program.id = program_pic.id_program');
        $this->db->join('user', 'program_pic.id_pic = user.id');
        $this->db->where('user.email', $user);
        $this->db->where('program.slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_nilaipr($slug, $nilai)
    {
        $data = array(
        'nilaiPR' => $nilai,
        );
        $this->db->where('slug', $slug);
        $this->db->update('program', $data);
    }

    public function update_nilaipo($slug, $nilai)
    {
        $data = array(
        'nilaiPO' => $nilai,
        );
        $this->db->where('slug', $slug);
        $this->db->update('program', $data);
    }

    public function update_nilaigr($slug, $nilai)
    {
        $data = array(
        'nilaiGR' => $nilai,
        );
        $this->db->where('slug', $slug);
        $this->db->update('program', $data);
    }

    public function update_slug($slug,$index)
    {
      $data = array(
      'slug' => $slug,
        );
        $this->db->where('id', $index);
        $this->db->update('program', $data);
    }

    public function create_information($proc, $slug)
    {
      $id_program = $this->get_id_program_by_slug($slug);
      $data = array(
        'id_program' => $id_program,
        'id_procurement' => $proc,
        'submitDate' => date('y-m-d')
      );
      $this->db->insert('informasi', $data);

      //jika tahap proc sudah sampai "kontrak"
      if ($proc == 10) {
        $this->db->where('slug', $slug);
        $this->db->update('program', array('status' => 1));
      }


    }
}
