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
            $data['program_list_done'] = $this->program_model->get_program_info_by_status_and_email(1, $login_email);
            $data['program_list_not_done'] = $this->program_model->get_program_info_by_status_and_email(0, $login_email);
            $this->load->view('app/programsearch', $data);
        } else {
            $this->load->view('auth/loginPage');
        }
    }

    public function view($slug, $state = false)
    {
        if ($state !== false) {
            $data['state'] = $state;
        }
        if (is_logged_in()) {
            $data['user_logged_in'] = get_email_info();
            if ($this->program_model->is_program_exists($slug)) {
                $data['program_info'] = $this->program_model->get_program_info($slug);
                $data['program_pic'] = $this->program_model->get_program_pic($slug);

                // 1 Revisi TOR & BOQ
                // 2 Permintaan Pengadaan
                // 3 Rapat Penjelasan
                // 4 Evaluasi Teknis  5 Evaluasi Harga
                // 6 Negosiasi
                // 7 Pembuatan PO
                // 8 Penyerahan SP3
                // 9 Kontrak

                //cek proses procurement sudah sampai mana
                //jika tidak ada sama sekali
                //maka semua 0
                //jika sudah sampai informasi.id_procurement 5
                //maka id_procurement 6 dan seterusnya 0
                //jika sudah sampai 9
                //maka id proc semua 1
                //dan ubah program status program selesai

                //initial proc val
                for ($i=0; $i < 9 ; $i++) {
                    $data['proc_status'][$i] = 0;
                }
                //ambil proc dari database
                $proc_data = $this->program_model->get_procurement_relate($slug);
                //cek proses procurement sampai berapa
                $proc_length = count($proc_data);
                // jika sudah sampai tahap 9
                if ($proc_length == 9) {
                    //ubah status menjadi 1 (selesai)
                    $this->program_model->set_status($slug, 1);
                    //dan set semua proses menjadi 1 (selesai)
                    for ($i=0; $i < 9 ; $i++) {
                        $data['proc_status'][$i] = 1;
                    }

                    //jika sudah sampai tahap ke 4
                } elseif ($proc_length == 4) {
                    //ambil tahap terakhir
                    $last_proc = end($proc_data);
                    if ($last_proc == 4) {
                        //set selesai dari 1 - 4
                        for ($i=0; $i < 4 ; $i++) {
                            $data['proc_status'][$i] = 1;
                        }
                    } else {
                        //set selesai dari 1 - 3 dan 5
                        for ($i=0; $i < 3 ; $i++) {
                            $data['proc_status'][$i] = 1;
                        }
                        $data['proc_status'][5-1] = 1;
                    }
                    //jika tahap lain
                } else {
                    // code...
                    for ($i=0; $i < $proc_length ; $i++) {
                        $data['proc_status'][$i] = 1;
                    }
                }

                $data['proc_list'] = $this->program_model->get_procurement();
                $data['proc_data'] = $proc_data;

                $data['status'] = $data['program_info']['status'];
                if ($data['program_info']['status'] == 0) {
                    $data['status'] = 'Dalam Proses';
                } else {
                    $data['status'] = 'Selesai';
                }
                $this->load->view('app/viewProgram', $data);
            } else {
                show_error("Tidak terdapat program bernama:<br/>".$slug);
            }
        } else {
            $this->load->view('auth/loginpage');
        }
    }

    public function update_program()
    {
        //update role for IPA
        $role[1][1] = 0;
        $role[1][2] = 0;
        $role[1][3] = 0;
        $role[1][4] = 0;
        $role[1][5] = 0;
        $role[1][6] = 0;
        $role[1][7] = 0;
        $role[1][8] = 0;
        $role[1][9] = 0;
        //update role for PMO
        $role[2][1] = 0;
        $role[2][2] = 0;
        $role[2][3] = 0;
        $role[2][4] = 0;
        $role[2][5] = 0;
        $role[2][6] = 0;
        $role[2][7] = 0;
        $role[2][8] = 0;
        $role[2][9] = 0;
        //update role for GAF
        $role[3][1] = 0;
        $role[3][2] = 0;
        $role[3][3] = 0;
        $role[3][4] = 0;
        $role[3][5] = 1;
        $role[3][6] = 1;
        $role[3][7] = 1;
        $role[3][8] = 1;
        $role[3][9] = 1;
        //update role for DEV
        $role[4][1] = 1;
        $role[4][2] = 1;
        $role[4][3] = 1;
        $role[4][4] = 1;
        $role[4][5] = 0;
        $role[4][6] = 0;
        $role[4][7] = 0;
        $role[4][8] = 0;
        $role[4][9] = 0;

        $user = $this->input->post('user_logged_in');
        $program_slug = $this->input->post('program_slug');

        //cek tahap yg harus di update
        $proc_data = $this->program_model->get_procurement_relate($program_slug);
        $proc_length = count($proc_data);
        $proc_update = 100;
        echo json_encode($proc_data);
        echo "proc update : ".$proc_update;
        for ($i=0; $i < count($proc_data); $i++) {
            $proc_updated[$i] = $proc_data[$i]['id_procurement'];
        }
        echo json_encode($proc_updated);
        for ($i=1; $i <= 9; $i++) {
            if (!in_array($i, $proc_updated)) {
                $proc_update = $i;
                break;
            }
        }
        echo $proc_update;

        //cek role yg dimiliki user dlm program
        $pic_role = $this->program_model->get_pic_role($user, $program_slug);

        //jika tidak ada role maka user tidak memiliki kewenangan
        if ($pic_role == null) {
            echo "Anda tidak memiliki kewenangan dalam program ini";
        } else {
            //cek apakah role tsb dapat mengupdate tahap tersebut
            if ($role[$pic_role['role_id']][$proc_update] == 1) {
                //update informasi proses procurement
                $this->program_model->create_information($proc_update, $program_slug);
                redirect(site_url('program/view/'.$program_slug));
            } else {
                redirect(site_url('program/view/'.$program_slug.'/2'));
            }
        }
    }

    public function name_to_slug($name)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        return $slug;
    }

    public function autocomplete()
    {
        // load model
        $this->load->model('User_Model');

        $name = $this->input->post('search');
        $index = $this->input->post('idx');

        $result = $this->User_Model->get_name($name);

        if (!empty($result)) {
            foreach ($result as $row):
      //  echo "<li><a onClick=selectUser('".$row->nama."') href='#'>" . $row->nama . "</a></li>";
    //   echo "<li>" . $row->nama . "</li>";
       echo "<li><a onClick=selectUser('".$index."','".$row->nama."') href='javascript:void(0)'>" . $row->nama . "</a></li>";

       //<a onClick=selectUser('".$row->nama."') href='#'></a>

            endforeach;
        } else {
            echo "<li> <em> Not found ... </em> </li>";
        }
    }

    public function create_program()
    {
        /* Load form helper */
        $this->load->model('user_model');
        $this->load->model('insert_model');
        $this->load->helper('date');
        $this->load->helper(array('form', 'url'));

        /* Load form validation library */
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        /* Set validation rule for name field in the form */
        $this->form_validation->set_rules(
        'nama',
        'Nama program',
        'trim|required',
    array(
      'required' => 'kolom %s tidak boleh kosong.'
    )
  );
        $this->form_validation->set_rules(
      'deskripsi',
      'Deskripsi program',
      'trim|required',
  array(
    'required' => 'kolom %s tidak boleh kosong.'
  )
);
        $this->form_validation->set_rules(
    'name[]',
    'Nama PIC',
    'trim|required|callback_username_check',
array(
  'required' => 'kolom %s tidak boleh kosong.'
)
);
        $this->form_validation->set_rules(
    'timeplan',
    'timeplan program',
    'trim|required',
array(
  'required' => 'kolom %s tidak boleh kosong.'
)
);
        $this->form_validation->set_rules(
    'nilai_release',
    'nilai release',
    'trim|required',
array(
  'required' => 'kolom %s tidak boleh kosong.'
)
);
        $this->form_validation->set_rules(
    'role[]',
    'peran PIC',
    'trim'
);
        if ($this->form_validation->run() == false) {
            $this->load->view('programform');
        } else {
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
            $id_program = $this->insert_model->program_insert('program', $data_program);
            //trying to change slug using update
            //$this->program_model->update_slug($nameslug,$id_program);

            $i=1;
            foreach ($this->input->post('name') as $key=>$val) {
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
            $this->db->insert_batch('program_pic', $data_pic);


            //$data['message'] = $nameslug;
            //Loading View
            $data['nameslug']=$nameslug;
            $this->load->view('programformsuccess', $data);
        }
    }

    //check if username exist
    public function username_check($str)
    {
        $this->load->model('User_Model');
        if ($this->User_Model->user_exist($str)) {
            return true;
        } else {
            $this->form_validation->set_message('username_check', 'semua kolom {field} harus sesuai dengan nama user dan tidak boleh kosong');
            return false;
        }
    }
}
