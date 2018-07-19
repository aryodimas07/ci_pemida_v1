<?php
class Usersearch_model extends CI_Model
{
  public function __construct()
  {
      $this->load->database();
  }
 function fetch_data($query)
 {
  $this->db->select("*");
  $this->db->from("user");
  if($query != '')
  {
   $this->db->like('nama', $query);
  }
  $this->db->order_by('id', 'DESC');
  return $this->db->get();
 }
}
?>
