<html>

   <head>
      <title>Kirim notifikasi</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>

   <body>
      <!-- <form action = "" method = ""> -->
         <?php echo validation_errors(); ?>
         <?php echo form_open('kirimnotifikasiform'); ?>

         <h5>Nama Penerima</h5>
         <!--<input type = "text" name = "nama" value = "<?php echo set_value('nama'); ?>" size = "36" />-->

         <h5>Isi pesan</h5>
         <input type = "text" name = "pesan" value = "<?php echo set_value('pesan'); ?>" size = "254" />

        <p><div><input type = "submit" value = "Submit" /></div></p>
        <!-- <script>
            $(document).ready(function(){ alert("jquerytest"); });
         </script> -->
      </form>
   </body>

</html>
