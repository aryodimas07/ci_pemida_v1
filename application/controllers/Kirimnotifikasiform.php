<?php

   class Kirimnotifikasiform extends CI_Controller {

      public function index() {
         /* Load form helper */
         $this->load->helper(array('form', 'url'));

         /* Load form validation library */
         $this->load->library('form_validation');

         /* Set validation rule for name field in the form */
    //     $this->form_validation->set_rules('nama', 'Nama program', 'required',
    //                                        array('required' => '%s tidak boleh kosong.'));
         $this->form_validation->set_rules('pesan', 'Isi pesan', 'required',
                                            array('required' => '%s tidak boleh kosong.'));

         if ($this->form_validation->run() == FALSE) {
            $this->load->view('notifikasiform');
         }
         else {
            $this->load->view('notifikasisukses');
         }
      }
   }
?>
