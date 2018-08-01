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
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src=<?php echo site_url('assets/img/Asset1ldpi.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
          PEMIDA
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      </div>
    </div>
        <div class="input-group">
          <input id="inputSearchFilter1" onkeyup="searchFilter1()" type="text" class="form-control" placeholder="Cari nama program...">
        </div>
        <div class="d-flex flex-row bd-highlight ml-3">
          <div class="dropdown pointer">
            <img id="navbar-avatar" class="rounded-circle dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src=<?php echo site_url('assets/img/avatar.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <h6 class="dropdown-header"><?php echo get_email_info() ?></h6>
              <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <nav class="nav-sm navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src=<?php echo site_url('assets/img/Asset1ldpi.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
          PEMIDA
        </a>
        <div class="d-flex flex-row bd-highlight ml-3">
          <div class="dropdown pointer">
            <img id="navbar-avatar" class="rounded-circle dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src=<?php echo site_url('assets/img/avatar.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <h6 class="dropdown-header"><?php echo get_email_info() ?></h6>
              <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">Logout</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <nav id="nav-search" class="nav-sm navbar navbar-expand-md sticky-top">
      <div class="container-fluid">
        <div class="input-group">
          <input id="inputSearchFilter" onkeyup="searchFilter()" type="text" class=" shadow form-control form-control-lg" placeholder="Cari nama program...">
        </div>
      </div>
    </nav>
    <script type="text/javascript">
    // Search Filter
    function searchFilter1() {
      var input, filter, div, list, a, i;
      input = document.getElementById('inputSearchFilter1');
      filter = input.value.toUpperCase();
      div = document.getElementById('programList');
      list = div.getElementsByTagName('a');
      for (var i = 0; i < list.length; i++) {
        if (list[i].text.toUpperCase().indexOf(filter) > -1) {
          list[i].style.display = "";
        } else {
          list[i].style.display = "none"
        }
      }
    }
    function searchFilter() {
      var input, filter, div, list, a, i;
      input = document.getElementById('inputSearchFilter');
      filter = input.value.toUpperCase();
      div = document.getElementById('programList');
      list = div.getElementsByTagName('a');
      for (var i = 0; i < list.length; i++) {
        if (list[i].text.toUpperCase().indexOf(filter) > -1) {
          list[i].style.display = "";
        } else {
          list[i].style.display = "none"
        }
      }
    }
    </script>
