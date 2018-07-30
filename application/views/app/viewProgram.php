<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PEMIDA : Pemantauan Permintaan Pengadaan</title>
  <!--bootstrap.css-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style media="screen">
  @media (max-width: 575.98px) {
    .text-mobile-center {
      text-align: center!important;
    }
  }
  @media (min-width: 575.98px) {
    #picWrapper .row {
      height: 55px;
    }
  }
  .list-group-header {
    z-index: 100;
    font-weight: bold;
    font-size: large;
    color: white;
    background-color: #43719c;
  }

  .list-group-header .date {
    color: white;
    font-weight: lighter;
  }

  .separator {
    width: 100%;
    border-style: solid;
    border-color: lightgrey;
    border-width: 1px 0px 0px 0px;
  }

  .card-header {
    background-color: #43719c;
    color: white;
  }

  .a {
    height: 53px;
    line-height: 53px;
  }

  #proses-procurement .disable {
    color: lightgrey;
  }

  .pointer {
    cursor: pointer;
  }

  .alert-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1100;
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
  <?php if (true): ?>
    <div class="alert-wrapper">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil di update!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  <?php endif; ?>
  <!-- navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top shadow-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo site_url(); ?>">
        <img src=<?php echo site_url('assets/img/Asset1ldpi.png'); ?> width="30" height="30" class="d-inline-block align-top" alt="">
        PEMIDA
      </a>
      <div class="d-flex flex-row bd-highlight">
        <div class="dropdown pointer">
          <img id="navbar-avatar" class="rounded-circle dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src=<?php echo site_url('assets/img/avatar.png') ?> width="30" height="30" class="d-inline-block align-top" alt="">
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">Logout</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div class="container mt-3 mb-1">
    <div class="row">
      <div class="col-xl">
        <div class="h6">RINCIAN PROGRAM</div>
        <div class="h2 mb-3">
          <?php echo $program_info['nama'] ?> <span class="badge badge-warning"><?php echo $status; ?></span>
        </div>
        <!-- deskripsi -->
        <p><?php echo $program_info['deskripsi']; ?></p>
        <!-- pic -->
        <ul class="list-group shadow mb-4">
          <li class="list-group-item">
            <h6>PERSON IN CHARGE</h6>
            <div class="separator"></div>
          </li>
          <?php foreach ($program_pic as $row) {?>
            <li class="list-group-item">
              <div id="picWrapper">
                <div class="row">
                  <div class="col-sm-3 col-lg-4 text-mobile-center">
                    <img class="rounded-circle" src=<?php echo site_url('assets/img/avatar.png') ?> width="60" height="60" class="d-inline-block align-top" alt="">
                  </div>
                  <div class="col-sm-9 col-lg-8 text-mobile-center">
                    <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['email'] ?></h6>
                  </div>
                </div>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-xl">
        <!-- procurement -->
        <ul id="proses-procurement" class="list-group shadow mb-4">
          <li class="list-group-item">
            <h6>PROSES PROCUREMENT</h6>
            <form style="display:none" id="update" action=<?php echo site_url('program/update') ?> method="post">
              <input type="hidden" name="program_slug" value=<?php echo $program_info['slug'] ?>>
              <input type="hidden" name="user_logged_in" value=<?php echo $user_logged_in ?>>
            </form>
            <div class="separator"></div>
          </li>
            <?php $disable = 0; ?>
            <?php for ($i=0; $i < 9; $i++) { ?>
              <li class="list-group-item">
                <?php if ($proc_status[$i] == 1): ?>
                  <div class="a">
                  <?php else: ?>
                    <div class="a disable">
                    <?php endif; ?>
                    <?php echo $proc_list[$i]['proses']; ?>
                    <?php if ($i == 4 && $proc_status[4] == 1 && $proc_status[3] == 0): ?>
                      <?php echo $i ?><span class="badge badge-primary ml-3"><?php echo $proc_data[3]['submitDate'] ?></span>
                    <?php else: ?>
                      <?php if ($i == 4 && $proc_status[4] == 1 && $proc_status[3] == 1): ?>
                        <span class="badge badge-primary ml-3"><?php echo $proc_data[4]['submitDate'] ?></span>
                      <?php else: ?>
                        <?php if ($proc_status[$i] == 1): ?>
                          <span class="badge badge-primary ml-3"><?php echo $proc_data[$i]['submitDate'] ?></span>
                        <?php else: ?>
                          <?php if ($disable == 0): ?>
                            <button id="update_program" class="ml-3 btn btn-danger shadow" type="submit" form="update" name="button">Update</button>
                            <?php $disable = 1 ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>

        <script type="text/javascript">
        // Search Filter
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

      <!--jQuery, Popper.js, bootstrap.js-->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
      <!--<script src="js/searchFilter.js"></script>-->
    </body>
    </html>
