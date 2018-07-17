<html>

   <head>
      <title>Buat program</title>
   </head>

   <body>
      <!-- <form action = "" method = ""> -->
         <?php echo validation_errors(); ?>
         <?php echo form_open('form'); ?>

         <h5>Nama program</h5>
         <input type = "text" name = "nama" value = "" size = "36" />

         <h5>Deskripsi program</h5>
         <input type = "text" name = "deskripsi" value = "" size = "100" />

         <div><input type = "submit" value = "Submit" /></div>
      </form>
   </body>

</html>
