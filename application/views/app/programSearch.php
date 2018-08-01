<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#343a40">
  <title>PEMIDA : Pemantauan Permintaan Pengadaan</title>
  <!--bootstrap.css-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <title>PEMIDA</title>
  <style media="screen">
  .nav-sm {
    display: none;
  }

  @media (max-width: 575.98px) {
    .nav-sm {
      display: block;
    }
    #nav-lg {
      display: none;
    }
  }

  #nav-search {
    background: linear-gradient(to top, rgba(255,0,0,0), white);
  }

  #inputSearchFilter {

  }

  </style>
</head>
<body>

  <div class="container mt-3 mb-3">
    <div class="row">
      <div class="col-sm">
        <h3>Daftar Program</h3>
        <div id="programList" class="list-group mb-3">
          <p class="h5 list-group-item list-group-item-warning">Dalam Proses</p>
          <?php if (count($program_list_not_done) != 0): ?>
            <?php foreach ($program_list_not_done as $row): ?>
              <a href=<?php echo site_url('program/view/'.$row['slug']); ?> class="list-group-item list-group-item-action"><?php echo $row['nama'] ?></a>
            <?php endforeach; ?>
          <?php else: ?>
            <a href="#" class="list-group-item list-group-item-action">-</a>
          <?php endif; ?>
          <p class="h5 list-group-item list-group-item-success mt-3">Selesai</p>
          <?php if (count($program_list_done) != 0): ?>
            <?php foreach ($program_list_done as $row): ?>
              <a href=<?php echo site_url('program/view/'.$row['slug']); ?> class="list-group-item list-group-item-action"><?php echo $row['nama'] ?></a>
            <?php endforeach; ?>
          <?php else: ?>
            <a href="#" class="list-group-item list-group-item-action">-</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!--jQuery, Popper.js, bootstrap.js-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <!--<script src="js/searchFilter.js"></script>-->
</body>
</html>
