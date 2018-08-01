<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('User_Model');
	}

	public function index()
	{
		$this->load->view('register');
	}
  public function registeruser()
  {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('user_model');
            $this->load->helper('email');
            $this->load->model('insert_model');
            //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            $this->form_validation->set_rules('nama', 'Nama', 'trim|required',
                                                  array(
                                                    'required' => 'Kolom %s tidak boleh kosong.'
                                                )
                                              );
            $this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email',
                                                  array(
                                                    'required' => 'Kolom %s tidak boleh kosong.',
                                                    'valid_email' => 'Kolom %s harus berisi alamat e-mail yang valid'
                                                )
                                              );
            $this->form_validation->set_rules('telp', 'Nomor telefon', 'trim|required',
                                                  array(
                                                    'required' => 'Kolom %s tidak boleh kosong.'
                                                )
                                              );
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]',
                                                array(
                                                  'required' => 'Kolom %s tidak boleh kosong.',
                                                  'min_length[8]' => '%s minimal 8 karakter'
                                                )
                                              );

            if ($this->form_validation->run() == FALSE)
        		{
        			$this->load->view('register');
        		}
            else{
                $email = $this->input->post('email');
                if($this->user_model->isEmailDuplicate($email)){
                    $data['errorMsg'] = 'User email already exists';
                    $this->load->view('register',$data);
                }else{
                  $nama = $this->input->post('nama');
                  $telpno = $this->input->post('telp');
                  $password = $this->input->post('password');
                  //$options = array("cost"=>4);
			            $hashpassword = password_hash($password,PASSWORD_BCRYPT);

                  $insertData = array('nama'=>$nama,
                  								'notelp'=>$telpno,
                  								'email'=>$email,
                  								'password'=>$hashpassword
                                );
                  $insertUser = $this->insert_model->insertUser($insertData);

          				if($insertUser)
          				{
          					redirect('user/thankyou');
          				}
          				else
          				{
          					$data['errorMsg'] = 'Unable to save user. Please try again';
          					$this->load->view('register',$data);
          				}
                }
            }
  }
  function thankyou()
	{
		$this->load->view('thankyou');
	}
  public function chk_password_expression($str)

    {

    if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $str))

    {
        $this->form_validation->set_message('chk_password_expression', '%s must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit');
        return FALSE;
    }

    else

    {
        return TRUE;
    }
  }
}
?>
