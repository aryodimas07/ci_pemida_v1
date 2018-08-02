<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style media="screen">
  .pointer {
    cursor: pointer;
  }


  </style>
  <title>PEMIDA</title>
  <style media="screen">
  </style>
</head>
<body>
  <nav id="nav-lg" class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid d-flex bd-highlight">
      <a class="navbar-brand" href=<?php echo site_url() ?>>
        <img src=<?php echo site_url('assets/img/Asset1ldpi.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
        PEMIDA
      </a>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link"  href="<?php echo site_url() ?>">Kembali <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
        <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      <div id="avatar" class="dropdown pointer collapse navbar-collapse">
        <img id="navbar-avatar" class="rounded-circle dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src=<?php echo site_url('assets/img/avatar.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          <h6 class="dropdown-header"><?php echo get_email_info() ?></h6>
          <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">Logout</a>
        </div>
      </div>
    </li>
  </ul>
      <button class="navbar-toggler p-2" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </div>
  </nav>
