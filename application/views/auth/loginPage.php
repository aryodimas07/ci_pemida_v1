<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CAPEXRT</title>
  <!--bootstrap.css-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style media="screen">
  html, body{
    height: 100%;
  }

  body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #e3e3e3;
  }

  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
  }

  .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .title {
    color: red;
  }

  #btn-signin {
    background-color: #343a40;
    color: white;
  }

  .alert-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
  }
  .alert {
    margin: 0 auto;
    margin-top: 1rem;
    margin-left: 1rem;
    margin-right: 1rem;
  }
  </style>
</head>
<body>
  <div class="container-fluid text-center">
    <?php if (isset($alert)): ?>
      <div class="alert-wrapper">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Email dan Password salah!</strong> Jika belum mendaftar, segera mendaftar di
          <a href=<?php echo site_url('register'); ?>>link ini</a>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    <?php endif; ?>
    <img src=<?php echo site_url('assets/img/Black-Logoldpi.png') ?> width=100 height="100" class="mb-3 d-inline-block align-top" alt="">

    <!-- <h1 class="title h1">PEMIDA</h1> -->
    <form class="form-signin" action=<?php echo site_url('login'); ?> method="post" autocomplete="off">
      <h1 class="h3 mb-3 font-weight-normal">Mohon login terlebih dahulu</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Alamat email" required aut
      >
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required aut
      >
      <button id="btn-signin" class="btn btn-lg btn-block" type="submit">Sign in</button>
    </form>
  </div>

  <!--jQuery, Popper.js, bootstrap.js-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
