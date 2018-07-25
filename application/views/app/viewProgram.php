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

  #picWrapper row card {

  }
  </style>
  <title>PEMIDA</title>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top shadow-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        PEMIDA
        <img src="" alt="">
      </a>
    </div>
  </nav>
  <div class="container mt-3 mb-3">
    <div class="card mb-3 shadow">
      <div class="h3 card-header">
        <?php echo $program_info['nama'] ?> <span class="badge badge-warning">Dalam Proses</span>
      </div>
    </div>
    <div id="picWrapper" class="container">
      <div class="row">
        <?php foreach ($program_pic as $row) { ?>
          <div class="col-xl-3 col-md-6">
            <div class="card shadow mb-3" style="width: 100%;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['email'] ?></h6>
                <a href="#" class="card-link">Lihat Profil</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <ul class="list-group shadow">
      <li class="list-group-item list-group-header shadow-sm">
        Rapat Penjelasan
        <span> - </span>
        <span class="date">6 Juli 2018</span>
      </li>
      <li class="list-group-item">
        <h6>Deskripsi</h6>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="separator mb-3"></div>
        <h6>Dokumen</h6>
      </li>
    </ul>
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
