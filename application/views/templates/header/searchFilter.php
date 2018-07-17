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
