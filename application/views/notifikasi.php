<!DOCTYPE html>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>CodeIgniter Email Example</title>
   </head>

   <body>
      <?php
         echo $this->session->flashdata('email_sent');
         echo form_open('/Sendnotifikasi/send_mail');
      ?>
      <br>
      <label class="form-check-label" for="to">Alamat tujuan</label>
      <div>
        <input type = "email" name = "email" id="to" required />
      </div>
        <label class="form-check-label" for="input">Subjek</label>
      <div>
        <input type = "input" name = "pengirim" id="input" value="Pemida: Pemantauan Permintaan Pengadaan" required />
      </div>
      <label class="form-check-label" for="isi">Isi pesan tambahan</label>
      <div>
        <textarea name = "isi" id="isi" required ></textarea>
      </div>
      <p><div>
        <input type = "submit" value = "SEND MAIL">
      </div></p>

      <?php
         echo form_close();
      ?>
   </body>

</html>
