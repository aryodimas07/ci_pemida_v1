<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_model');
    }


    public function index()
    {
        if (is_logged_in()) {
            $login_email = $this->session->userdata()['logged_in']['email'];
            $data['program_list'] = $this->program_model->get_program_relate($login_email);
            $this->load->view('app/programsearch', $data);
        } else {
            $this->load->view('auth/loginPage');
        }
    }

    public function view($slug)
    {
        if ($this->program_model->is_program_exists($slug)) {
            $data['program_info'] = $this->program_model->get_program_info($slug);
            $data['program_pic'] = $this->program_model->get_program_pic($slug);
            $this->load->view('app/viewprogram', $data);
        } else {
            show_error('Tidak terdapat program bernama '.$slug, 404, 'Nama Program Tidak Ditemukan!');
        }
    }

    public function create_program(){}

    public function name_to_slug($name)
    {
      $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
      return $slug;
    }

}
