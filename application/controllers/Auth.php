<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if (isset($this->session->userdata()['logged_in'])) {
            $this->load->view('app/index');
        } else {
            $this->load->view('auth/loginPage');
        }
    }

    public function login()
    {
        //ambil data dari input form
        $data = array(
  'email' => $this->input->post('email'),
  'password' => $this->input->post('password')
  );
    }
}
