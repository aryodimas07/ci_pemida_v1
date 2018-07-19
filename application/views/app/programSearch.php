<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PEMIDA : Pemantauan Permintaan Pengadaan</title>
  <!--bootstrap.css-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <title>PEMIDA</title>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PEMIDA</a>
      <div class="input-group">
        <input id="inputSearchFilter" onkeyup="searchFilter()" type="text" class="form-control" placeholder="Cari nama program...">
      </div>
    </div>
  </nav>
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
  <div class="container mt-3 mb-3">
    <div class="row">
      <div class=" mb-3 col-sm col-md">
        <h3>Terakhir Dibuka</h3>
        <div id="recentlyOpened" class="list-group">
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
        </div>
      </div>
      <div class="col-sm">
        <h3>Daftar Program</h3>
        <div id="programList" class="list-group">
          <p class="h5 list-group-item list-group-item-warning">Dalam Proses</p>
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program1 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program2 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program3 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program4 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">z - CAPEX DIT 2018</a>
          <p class="h5 list-group-item list-group-item-success">Selesai</p>
          <a href="#" class="list-group-item list-group-item-action">Program - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program1 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program2 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program3 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">Program4 - CAPEX DIT 2018</a>
          <a href="#" class="list-group-item list-group-item-action">z - CAPEX DIT 2018</a>
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
