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
        ini_set( 'sendmail_from', "myself@my.com" ); \\ My usual e-mail address
        ini_set( 'SMTP', "mail.bigpond.com" );  \\ My usual sender
        ini_set( 'smtp_port', 25 );
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'afifbambangp@gmail.com',
            'smtp_pass' => '',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
      $this->load->library('email', $config);
       $this->email->set_newline("\r\n");
       $from_email = "afifbambanpg@gmail.com";
       $to_email = $this->input->post('email');

       //Load email library
       $this->load->library('email');

       $this->email->from($from_email, 'Your Name');
       $this->email->to($to_email);
       $this->email->subject('Email Test');
       $this->email->message('Testing the email class.');

       //Send mail
       if($this->email->send())
       $this->session->set_flashdata("email_sent","Email sent successfully.");
       else
       $this->session->set_flashdata("email_sent","Error in sending Email.");
       $this->load->view('email_form');
    }
 }



?>
