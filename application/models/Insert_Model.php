<?php
class Insert_Model extends CI_Model
{
      function __construct()
      {
          $this->load->database();
      }
      function program_insert($table,$data)
      {
      // Inserting in Table(students) of Database(college)
          $query = $this->db->insert($table, $data);
          return $this->db->insert_id();
      }
}
?>
