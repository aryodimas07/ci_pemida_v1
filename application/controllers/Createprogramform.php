<?php

   class Createprogramform extends CI_Controller {

      public function index() {
         /* Load form helper */
         $this->load->helper(array('form', 'url'));

         /* Load form validation library */
         $this->load->library('form_validation');

         /* Set validation rule for name field in the form */
         $this->form_validation->set_rules('nama', 'Nama program', 'required',
                                            array('required' => '%s tidak boleh kosong.'));
         $this->form_validation->set_rules('deskripsi', 'Deskripsi program', 'required',
                                            array('required' => '%s tidak boleh kosong.'));










         if ($this->form_validation->run() == FALSE) {
            $this->load->view('programform');
         }
         else {
            $this->load->view('programformsuccess');
         }
      }

      public function autocomplete(){
           // load model
           $this->load->model('User_Model');

           $name = $this->input->post('search');

           $result = $this->User_Model->get_name($name);

           if (!empty($result))
           {
                foreach ($result as $row):
                     echo "<li><a href='#'>" . $row->nama . "</a></li>";
                endforeach;
           }
           else
           {
                 echo "<li> <em> Not found ... </em> </li>";
           }
      }


   }
?>
