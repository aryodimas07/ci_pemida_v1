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
    if (is_logged_in()) {
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
          $this->set_status($slug, 1);
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

        $data['proc_list'] = $this->program_model->get_procurement($slug);
        $data['proc_data'] = $proc_data;

        $data['status'] = $data['program_info']['status'];
        if ($data['program_info']['status'] == 0) {
          $data['status'] = 'Dalam Proses';
        } else {
          $data['status'] = 'Selesai';
        }

        //user logged in
        $data['user_logged_in'] = get_email_info();

        $this->load->view('app/viewprogram', $data);
      } else {
        show_error('Tidak terdapat program bernama '.$slug, 404, 'Nama Program Tidak Ditemukan!');
      }
    } else {
      $this->load->view('auth/loginPage');
    }
  }

  public function create_program()
  {
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
      $proc_update = 0;
      for ($i=1; $i <= 9; $i++) {
        if (!isset($proc_data[$i]['id_procurement'])) {
          $proc_update = $i;
          break;
        }
      }

      //cek role yg dimiliki user dlm progrm
      $pic_role = $this->program_model->get_pic_role($user, $program_slug);

      //jika tidak ada role maka user tidak memiliki kewenangan
      if ($pic_role == null) {
        echo "Anda tidak memiliki kewenangan dalam program ini";
      } else {
        //cek apakah role tsb dapat mengupdate tahap tersebut
        if ($role[$pic_role['role_id']][$proc_update] == 1) {
          //update informasi proses procurement
          header("location:javascript://history.go(-1)");
        } else {
          echo "Anda tidak memiliki kewenangan untuk mengupdate proses ini";
        }
      }



      //jika bisa maka update
      //jika tidak bisa maka keluarkan modal error

  }

  public function name_to_slug($name)
  {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    return $slug;
  }
}
