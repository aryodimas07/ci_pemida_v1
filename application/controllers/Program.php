<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        require('Auth.php');
        $auth = new Auth();
    }


    public function index()
    {
        if ($auth->is_logged_in()) {
            $login_email = $this->session->userdata()['logged_in']['email'];
            $data['program_list'] = $this->program_model->get_program_info($login_email);
            $this->load->view('app/programsearch', $data);
        } else {
            redirect(site_url());
        }
    }
}
