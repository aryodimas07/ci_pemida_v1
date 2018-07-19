<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

	public function index()
	{
		$this->load->view('welcome_message');
	}

  public function login()
  {
    //
  }
}
