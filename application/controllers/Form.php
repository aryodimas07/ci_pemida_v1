<?php

   class Form extends CI_Controller {

      public function index() {
         /* Load form helper */
         $this->load->helper(array('form', 'url'));

         /* Load form validation library */
         $this->load->library('form_validation');

         /* Set validation rule for name field in the form */
         $this->form_validation->set_rules('nama', 'Nama program', 'required',
                                            array('required' => '%s harus diisi.'));
         $this->form_validation->set_rules('deskripsi', 'Deskripsi program', 'required',
                                            array('required' => '%s harus diisi.'));

         if ($this->form_validation->run() == FALSE) {
            $this->load->view('programform');
         }
         else {
            $this->load->view('formsuccess');
         }
      }
   }
?>
