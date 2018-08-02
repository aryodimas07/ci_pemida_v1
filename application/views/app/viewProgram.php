<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#343a40">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <title>PEMIDA : Pemantauan Permintaan Pengadaan</title>
  <!--bootstrap.css-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style media="screen">
  #update-sm {
    display: none;
  }

  @media (max-width: 1200px) {
    #update-sm {
      display: block;
    }
    #update-xl {
      display: none;
    }
  }

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

  .tag-role {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding-left: 10px;
    padding-bottom: 3px;
    padding-right: 5px;
    color: white;
    background-color: #343a40;
    border-bottom-left-radius: 10px;
  }

  </style>
</head>
<body>
  <?php if (isset($state)): ?>
    <div class="alert-wrapper">
      <?php if ($state == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Data berhasil di update
        <?php else: ?>
          <?php if ($state == 2): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Anda tidak memiliki kewenangan untuk mengupdate proses ini!
            <?php endif; ?>
          <?php endif; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    <?php endif; ?>
    <div class="container mt-3 mb-1">
      <div class="h6">RINCIAN PROGRAM</div>
      <div class="row">
        <div class="col-xl">
          <div class="h2 mb-3">
            <?php if (strtolower($status) == 'selesai'): ?>
              <?php $badge_type = 'success' ?>
            <?php else: ?>
              <?php $badge_type = 'warning' ?>
            <?php endif; ?>
            <?php echo $program_info['nama'] ?> <span class="badge badge-<?php echo $badge_type;; ?>">
              <?php echo $status; ?>
            </span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl">
          <!-- deskripsi -->
          <p><?php echo $program_info['deskripsi']; ?></p>
        </div>
        <div class="col-xl d-flex align-items-end">
          <?php if (strtolower($status) != 'selesai'): ?>
            <button id="update-xl" type="button" class="mb-3 btn btn-danger shadow" data-toggle="modal" data-target="#exampleModalCenter">
              Update Procurement
            </button>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-xl">
          <!-- release PR PO GR -->
          <ul class="list-group shadow mb-4">
            <li class="list-group-item">
              <div class="h6 mb-1">
                RELEASE
              </div>
              <div class="price" style="color: grey">
                Rp<?php echo number_format($program_info['nilaiRelease'], 2, ".", ","); ?>
              </div>
            </li>
            <li class="list-group-item">
              <div class="h6 mb-1">
                NILAI PR
              </div>
              <div class="price" style="color: grey">
                <?php if ($program_info['nilaiPR'] == null): ?>
                  -
                <?php else: ?>
                  Rp<?php echo number_format($program_info['nilaiPR'], 2, ".", ","); ?>
                <?php endif; ?>
              </div>
            </li>
            <li class="list-group-item">
              <div class="h6 mb-1">
                NILAI PO
              </div>
              <div class="price" style="color: grey">
                <?php if ($program_info['nilaiPO'] == null): ?>
                  -
                <?php else: ?>
                  Rp<?php echo number_format($program_info['nilaiPO'], 2, ".", ","); ?>
                <?php endif; ?>
              </div>
            </li>
            <li class="list-group-item">
              <div class="h6 mb-1">
                NILAI GR
              </div>
              <div class="price" style="color: grey">
                <?php if ($program_info['nilaiGR'] == null): ?>
                  -
                <?php else: ?>
                  Rp<?php echo number_format($program_info['nilaiGR'], 2, ".", ","); ?>
                <?php endif; ?>
              </div>
            </li>
          </ul>
          <!-- pic -->
          <ul id="pic" class="list-group shadow mb-4">
            <li class="list-group-item">
              <h6 class="mb-0">PERSON IN CHARGE</h6>
            </li>
            <?php foreach ($program_pic as $row) {
              ?>
              <li class="list-group-item">
                <div class="tag-role shadow">
                  <?php echo $row['role'] ?>
                </div>
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
              <?php
            } ?>
          </ul>
        </div>
        <div class="col-xl">
          <!-- procurement -->
          <?php if (strtolower($status) != 'selesai'): ?>
            <button id="update-sm" type="button" class="mb-3 btn btn-danger shadow" data-toggle="modal" data-target="#exampleModalCenter" style="width: 100%">
              Update Procurement
            </button>
          <?php endif; ?>
            <!-- <form class="" action=<?php echo site_url('program/update_nilaipr'); ?> method="post">
              <input type="hidden" name="slug" value=<?php echo $program_info['slug'] ?>>
              <input type="hidden" name="nilai_pr" value="5000000000">
              <input type="submit" name="" value="update nilai PR">
            </form> -->
          <ul id="proses-procurement" class="list-group shadow mb-4">
            <li class="list-group-item">
              <h6 class="mb-0">PROSES PROCUREMENT</h6>
            </li>
            <?php for ($i=0; $i < 10; $i++) { ?>
              <li class="list-group-item">
                <div class="a">
                  <?php echo $proc_list[$i]['proses']; ?>
                  <?php if (isset($proc_data[$i]) && $proc_data[$i] != null): ?>
                    <span class="badge badge-primary ml-3"><?php echo $proc_data[$i]['submitDate'] ?></span>
                  <?php endif; ?>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>

        <!-- modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php if ($proc_update != 3 && $proc_update != 9 && $proc_update != 10): ?>
                  <form id="update" name="" action=<?php echo site_url('program/update') ?> method="post">
                    <div class="form-group">
                      <?php
                      $data = array(
                        'program_slug' => $program_info['slug'],
                        'user_logged_in' => $user_logged_in,
                        'proc_update' => $proc_update
                      );
                      echo form_hidden($data);
                      ?>
                    </div>
                  </form>
                <?php else: ?>
                  <?php if ($proc_update == 3): ?>
                    <form id="update" name="nilai_pr" action=<?php echo site_url('program/update') ?> method="post">
                      <div class="form-group">
                        <?php
                        $data = array(
                          'program_slug' => $program_info['slug'],
                          'user_logged_in' => $user_logged_in,
                          'proc_update' => $proc_update
                        );
                        echo form_hidden($data);
                        ?>
                        <label for="nilai">Nilai PR</label>
                        <input type="number" class="form-control" name="nilai_pr" placeholder="Masukkan nilai PR" required>
                      </div>
                    </form>
                  <?php else: ?>
                    <?php if ($proc_update == 9): ?>
                      <form id="update" name="nilai_po" action=<?php echo site_url('program/update') ?> method="post">
                        <div class="form-group">
                          <?php
                          $data = array(
                            'program_slug' => $program_info['slug'],
                            'user_logged_in' => $user_logged_in,
                            'proc_update' => $proc_update
                          );
                          echo form_hidden($data);
                          ?>
                          <label for="nilai">Nilai PO</label>
                          <input type="number" class="form-control" name="nilai_po" placeholder="Masukkan nilai PO" required>
                        </div>
                      </form>
                    <?php else: ?>
                      <?php if ($proc_update == 10): ?>
                        <form id="update" name="nilai_gr" action=<?php echo site_url('program/update') ?> method="post">
                          <div class="form-group">
                            <?php
                            $data = array(
                              'program_slug' => $program_info['slug'],
                              'user_logged_in' => $user_logged_in,
                              'proc_update' => $proc_update
                            );
                            echo form_hidden($data);
                            ?>
                            <label for="nilai">Nilai PO</label>
                            <input type="number" class="form-control" name="nilai_gr" placeholder="Masukkan nilai GR" required>
                          </div>
                        </form>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>

                <?php endif; ?>
                Anda yakin ingin mengupdate?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="update_program" class="btn btn-primary" type="submit" form="update" name="button">Update</button>
              </div>
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
