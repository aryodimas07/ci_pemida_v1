<!doctype html>
<html>
<html lang="en">
     <head>
       <html lang="en">
       <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


      <title>Register</title>
   </head>
<body>
  <?php
				if(isset($errorMsg))
				{
					echo '<div class="error-msg">';
					echo $errorMsg;
					echo '</div>';
					unset($errorMsg);
				}
			?>
  <?php
  $attributes = array('id' => 'identicalForm', 'class' => 'class=form-horizontal');
  echo form_open('register',$attributes);
  ?>
  <div class="form-group">
    <label for="formnama" class="col-sm-2 col-form-label">Nama</label>
      <input type = "text" id='formnama' name = "nama" class="form-control" value = "<?php echo set_value('nama'); ?>" size = "127" placholder:"Nama lengkap" />
    <?php echo form_error('nama', '<div class="error" style="background-color:red">', '</div>'); ?>
  </div>
  <div class="form-group">
    <label for="formemail" class="col-sm-2 col-form-label">E-mail</label>
    <input type = "text" id='formemail' name = "email" class="form-control" value = "<?php echo set_value('email'); ?>" size = "127" placholder:"Nama lengkap" />
    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
  </div>
  <div class="form-group">
    <label for="formtelp" class="col-sm-2 col-form-label">Nomor telefon</label>
    <input type = "number" id='formtelp' name = "telp" class="form-control" value = "<?php echo set_value('telp'); ?>" size = "127" placholder:"Telephone number" />
    <?php echo form_error('telp', '<div class="error">', '</div>'); ?>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <input type = "password" id='password' name = "password" class="form-control" value = "<?php echo set_value('password'); ?>" size = "127" placholder:"Password" />
    <?php echo form_error('password', '<div class="error">', '</div>'); ?>
  </div>
  <div class="form-group">
    <label for="confirmpassword" class="col-sm-2 col-form-label">Ketik ulang Password</label>
    <div class="text-container">
      <input type = "password" id='confirmpassword' name = "confirmpassword" class="form-control" value = "<?php echo set_value('password'); ?>" size = "127" placholder:"Repeat Password" />
      <span id='message'></span>
    <div>
    <?php echo form_error('confirmpassword', '<div class="error">', '</div>'); ?>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
  <div>
</form>

</body>
</html>
<script>
$('#password, #confirmpassword').on('keyup', function () {
  if ($('#password').val() == $('#confirmpassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else
    $('#message').html('Not Matching').css('color', 'red');
});

</script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
