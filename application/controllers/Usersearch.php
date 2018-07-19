<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersearch extends CI_Controller {

 function index()
 {
  $this->load->view('usersearch');
 }

 function fetch()
 {
  $output = '';
  $query = '';
  $this->load->model('usersearch_model');
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->usersearch_model->fetch_data($query);
  $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <tr>
       <th>Nama</th>
      </tr>
  ';
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $row)
   {
    $output .= '
      <tr>
       <td>'.$row->nama.'</td>
      </tr>
    ';
   }
  }
  else
  {
   $output .= '<tr>
       <td colspan="5">No Data Found</td>
      </tr>';
  }
  $output .= '</table>';
  echo $output;
 }

}
