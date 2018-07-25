<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        if (is_logged_in()) {
          redirect(site_url('program'));
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

        //cek apakah user ada
        $result = $this->user_model->is_user_exist($data);

        //jika user ada
        if ($result == true) {
            //ambil data login user
            $email = $this->input->post('email');
            $result = $this->user_model->get_user_info($email);
            $session_data = array('email' => $result['email'], 'password' => $result['password'], 'isAdmin' => $result['isAdmin'] );

            //masukkan ke session
            $this->session->set_userdata('logged_in', $session_data);
            redirect(site_url());
        } else {
            $data['alert'] = '1';
            $this->load->view('auth/loginpage', $data);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('logged_in', ''));
        redirect(site_url());
    }
}
