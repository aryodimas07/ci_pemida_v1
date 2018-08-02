<?php

   class Sendnotifikasi extends CI_Controller {

       public function __construct() {
          parent::__construct();
          // load email lib
          $this->load->library('email');
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
      }
      function index()
    {
        $this->load->helper('form');
        $this->load->view('notifikasi');
    }
    public function send_mail() {
      //  ini_set( 'sendmail_from', "myself@my.com" ); \\ My usual e-mail address
      //  ini_set( 'SMTP', "mail.bigpond.com" );  \\ My usual sender
    //    ini_set( 'smtp_port', 25 );
    $this->load->library('parser');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'pemida.bot@gmail.com',
            'smtp_pass' => 'dimasafif97',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap' => TRUE
        );
       $this->load->library('email', $config);
       $this->email->set_newline("\r\n");
       $to_email = $this->input->post('email');
        $sender = $this->input->post('pengirim');
         $message = $this->input->post('isi');

      $this->email->set_header('Header1', 'Value1');
       $this->email->from('pemida.bot@gmail.com', $sender);
       $this->email->to($to_email);
       $this->email->subject('Program reminder');
       $this->email->message($message);

       //Send mail
       if($this->email->send())
       {
          $this->session->set_flashdata("email_sent","Email sent successfully.");
       }
       else
       {
          $this->session->set_flashdata("email_sent","Error in sending Email.");
          $this->load->view('notifikasi');
       }
    }
    public function send_mail($emailto, $process) {
      //  ini_set( 'sendmail_from', "myself@my.com" ); \\ My usual e-mail address
      //  ini_set( 'SMTP', "mail.bigpond.com" );  \\ My usual sender
    //    ini_set( 'smtp_port', 25 );
    $this->load->library('parser');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'pemida.bot@gmail.com',
            'smtp_pass' => 'dimasafif97',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
      //  $to_email = $this->input->post('email');
        //$sender = $this->input->post('pengirim');
        //$message = $this->input->post('isi');

        //$this->email->set_header('Header1', 'Value1');
        $this->email->from('pemida.bot@gmail.com', 'PEMIDA');
        $this->email->to($emailto);
        $this->email->subject('Update reminder');
        $message = 'you have been warned that the procurement process have been updated';
        $this->email->message($message);

       //Send mail
       if($this->email->send())
       {
         $this->session->set_flashdata("email_sent","Email sent successfully.");
       }
       else
       {
         $this->session->set_flashdata("email_sent","Error in sending Email.");
       }
    }
 }



?>
