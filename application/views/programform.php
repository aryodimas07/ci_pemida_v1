<html>

   <head>
      <title>Buat program</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>

   <body>
      <!-- <form action = "" method = ""> -->
         <?php echo validation_errors(); ?>
         <?php echo form_open('createprogramform'); ?>

         <h5>Nama program</h5>
         <input type = "text" name = "nama" value = "<?php echo set_value('nama'); ?>" size = "127" />

         <h5>Deskripsi program</h5>
         <input type = "text" name = "deskripsi" value = "<?php echo set_value('deskripsi'); ?>" size = "254" />

        <p><div><input type = "submit" value = "Submit" /></div></p>
        <!-- <script>
            $(document).ready(function(){ alert("jquerytest"); });
         </script> -->
      </form>
   </body>

</html>
