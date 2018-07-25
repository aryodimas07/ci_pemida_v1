<?php

   class Createprogramform extends CI_Controller {

      public function index() {
         /* Load form helper */
         $this->load->model('user_model');
         $this->load->model('insert_model');
         $this->load->helper('date');
         $this->load->helper(array('form', 'url'));

         /* Load form validation library */
         $this->load->library('form_validation');

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

         if ($this->form_validation->run() == FALSE) {
            $this->load->view('programform');
         }
         else {
           $data_program = array(
            'nama' => $this->input->post('nama'),
            'deskripsi' => $this->input->post('deskripsi'),
            'dateCreated' => $this->input->post('date')
            );
            //Transfering data to Model
           $id_program = $this->insert_model->program_insert('program',$data_program);


           $i=0;
           foreach($_POST['name'] as $key=>$val){
              $user = $this->user_model->get_user_id($val);
              $id_user = array(
                  'username' => $user->id
              );
             $data_pic[$i]['id_pic'] = $id_user['username'];
             $data_pic[$i]['id_program']= $id_program;
             $data_pic[$i]['keterangan']= $_POST['keterangan'][$key];
             $i++;
           }
            //Transfering data to Model
            $this->db->insert_batch('program_pic',$data_pic);


            $data['message'] = 'Data Inserted Successfully';
            //Loading View
            $this->load->view('programformsuccess', $data);

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
                       $this->form_validation->set_message('username_check', 'kolom {field} harus sesuai dengan nama user');
                       return FALSE;
               }
        }


   }
?>
