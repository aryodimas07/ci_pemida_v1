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

          public function autocomplete(){
               // load model
               $this->load->model('User_Model');

               $name = $this->input->post('search');

               $result = $this->User_Model->get_name($name);

               if (!empty($result))
               {
                    foreach ($result as $row):
                         echo "<li><a onClick=selectUser('".$row->nama."') href='#'>" . $row->nama . "</a></li>";
                    endforeach;
               }
               else
               {
                     echo "<li> <em> Not found ... </em> </li>";
               }
          }
          //check if username exist
          public function username_check($str){
                $this->load->model('User_Model');
              if($this->User_Model->user_exist($str))
                   {
                            return TRUE;
                   }
                   else
                   {
                           $this->form_validation->set_message('username_check', 'semua kolom {field} harus sesuai dengan nama user dan tidak boleh kosong');
                           return FALSE;
                   }
            }

            private function name_to_slug($text)
            {
                // replace non letter or digits by -
                $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

                // trim
                $text = trim($text, '-');

                // transliterate
                $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

                // lowercase
                $text = strtolower($text);

                // remove unwanted characters
                $text = preg_replace('~[^-\w]+~', '', $text);

                if (empty($text))
                {
                    return 'n-a';
                }

                return $text;
            }

    public function create_program(){
      /* Load form helper */
      $this->load->model('user_model');
      $this->load->model('insert_model');
      $this->load->helper('date');
      $this->load->helper(array('form', 'url'));

      /* Load form validation library */
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      /* Set validation rule for name field in the form */
      $this->form_validation->set_rules('nama', 'Nama program', 'required',
                                         array(
                                           'required' => 'kolom %s tidak boleh kosong.'
                                       )
                                     );
      $this->form_validation->set_rules('deskripsi', 'Deskripsi program', 'required',
                                         array(
                                           'required' => 'kolom %s tidak boleh kosong.'
                                       )
                                     );
      $this->form_validation->set_rules('name[]', 'Nama PIC', 'required|callback_username_check',
                                         array(
                                           'required' => 'kolom %s tidak boleh kosong.'
                                       )
                                     );
      $this->form_validation->set_rules('timeplan', 'timeplan program', 'required',
                                        array(
                                          'required' => 'kolom %s tidak boleh kosong.'
                                       )
                                     );
      $this->form_validation->set_rules('nilai_release', 'nilai release', 'required',
                                        array(
                                          'required' => 'kolom %s tidak boleh kosong.'
                                        )
                                     );
      $this->form_validation->set_rules('role[]', 'peran PIC', 'required',
                                       array(
                                         'required' => 'pilihan %s tidak boleh kosong.'
                                          )
                                     );
      if ($this->form_validation->run() == FALSE) {
         $this->load->view('programform');
      }
      else {
        $names = $this->input->post('nama');
    //  $nameslug = strtolower(trim(preg_replace('/[A-Za-z0-9-]+/', '-', $names)));
        $nameslug = $this->name_to_slug($names);
        $data_program = array(
      // 'nama' => $this->input->post('nama'),
         'nama' => $names,
         'deskripsi' => $this->input->post('deskripsi'),
         'timeplan' => $this->input->post('timeplan'),
         'dateCreated' => $this->input->post('date'),
         'slug' => $nameslug,
         'nilaiRelease' => $this->input->post('nilai_release'),
         );
         //Transfering data to Model
        $id_program = $this->insert_model->program_insert('program',$data_program);
        //trying to change slug using update
        //$this->program_model->update_slug($nameslug,$id_program);

        $i=1;
        foreach($this->input->post('name') as $key=>$val){
           $user = $this->user_model->get_user_id($val);
           $id_user = array(
               'username' => $user->id
           );
          $data_pic[$i]['id_pic'] = $id_user['username'];
          $data_pic[$i]['id_program']= $id_program;
          $data_pic[$i]['role_id']= $this->input->post('role')[$key];
          $data_pic[$i]['keterangan']= $this->input->post('keterangan')[$key];
          $i++;
        }
         //Transfering data to Model
         $this->db->insert_batch('program_pic',$data_pic);


         //$data['message'] = $nameslug;
         //Loading View
         $data['nameslug']=$nameslug;
         $this->load->view('programformsuccess',$data);

      }
    }
}
