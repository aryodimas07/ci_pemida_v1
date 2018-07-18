<!DOCTYPE HTML>
<html>
<head>
  <title>HOME</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://chartjs-plugin-datalabels.netlify.com/chartjs-plugin-datalabels.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <style media="screen">
  #table {
    font-size: small;
  }

  .section-header {
    border-style: solid;
    border-width: 0px 0px 1px 0px;
    border-color: lightgrey;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }
  #table td {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
  }
  #table #new td:hover, #table #co td:hover {
    background-color: lightgrey;
    border-style: solid;
    border-width: 2px;
    border-color: blue;
    box-sizing: border-box;
  }

  #table input {
    width: 50px;
    border: none;
    background-color:rgba(0, 0, 0, 0);
  }

  #table input:focus {
    background-color: lightgrey;
    font-weight: bold;
  }

  #table {
    webkit-box-sizing: border-box;
    moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  #formTitle {
    width: 500px;
  }

  .chartContainer {
    width: 800px;
    height: 400px;
  }

  #resizable {
    padding-bottom: 35px;
  }

  canvas {
    margin: auto;
  }

  </style>
</head>
<body>
  <div class="main-wrapper">
    <main role="main" class="container-fluid">
      <h2 class="section-header">CAPEX DIT</h2>
      <!--DATA TABLE-->
      <table id="table" class="table table-bordered table-striped">
        <tr class="table-primary">
          <td></td>
          <th scope="col">COMM RKAP</th>
          <th scope="col">COMM REL (n-1)</th>
          <th scope="col">COMM REL</th>
          <th scope="col">PR (n-1)</th>
          <th scope="col">PR</th>
          <th scope="col">PO (n-1)</th>
          <th scope="col">PO</th>
          <th scope="col">PAY RKAP</th>
          <th scope="col">PAY REL</th>
          <th scope="col">ACTUAL (n-1)</th>
          <th scope="col">ACTUAL</th>
        </tr>
        <tr id="new">
          <th scope="row">NEW</th>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
        </tr>
        <tr id="co">
          <th scope="row">CO</th>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
          <td><input type="text" value="150"></td>
        </tr>
        <tr>
          <th scope="row">Total</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>

      <!--UPDATE CHART BUTTON-->
      <button id="updateData" class="btn btn-primary">Update Data</button>

      <!--Aspect Ratio-->
      <select id="aspectRatioDD">
        <option value="4 / 3">4 : 3</option>
        <option value="16 / 9">16 : 9</option>
        <option value="1 / 1">1 : 1</option>
      </select>
      <input type="text" name="" value="">

      <!--CHART-->
      <h2 class="section-header">Chart</h2>
      <div id="resizable" class=" chartContainer ui-widget-content">
        <canvas id="myChart" height="200" width="400"></canvas>
      </div>

    </main>

  </div>
  <!--TITLE-->
  <!--<script src="https://chartjs-plugin-datalabels.netlify.com/samples/utils.js"></script>-->
  <script type="text/javascript">
  $(function() {
    $("#resizable").resizable({
      minWidth: 730
    });
  });

  $('#table, #titleText').bind('keydown', function(event) {
    if (event.keyCode == 13) {
      refreshData();
    }
  });

  var ctx = document.getElementById("myChart");
  var table = document.getElementById("table");

  //var data NEW & CO
  var dataNEW = [];
  var dataCO = [];

  //value table -> var data
  for (var i = 1; i <= table.rows[0].cells.length - 1; i = i + 1) {
    dataNEW.push(table.rows[1].cells[i].childNodes[0].value);
    dataCO.push(table.rows[2].cells[i].childNodes[0].value);
  }


  var NEW = {
    label: 'NEW',
    data: dataNEW,
    backgroundColor: 'orange',
    borderWidth: 0
  };
  var CO = {
    label: 'CO',
    data: dataCO,
    backgroundColor: 'blue',
    borderWidth: 0
  };
  var Total = {
    label: 'TOTAL',
    data: [200, 150, 150, 150, 150, 10, 20, 130, 0, 0, 0],
    backgroundColor: 'grey',
    borderWidth: 0
  };
  var DATA = {
    labels: ["COMM RKAP", "COMM REL (n-1)", "COMM REL", "PR (n-1)", "PR", "PO (n-1)", "PO", "PAY RKAP", "PAY REL", "ACTUAL (n-1)", "ACTUAL"],
    datasets: [CO, NEW]
  };

  var inputTitle = document.getElementById("titleText");

  var OPTION = {
    title: {
      display: true,
      text: "Custom Title",
      fontSize: 20
    },
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      xAxes: [{
        stacked: true,
        ticks: {
          fontSize: 11
        }
      }],
      yAxes: [{
        stacked: true,
      }]
    },
    plugins: {
      datalabels: {
        color: 'white',
        display: function(context) {
          return context.dataset.data[context.dataIndex] > 15;
        },
        font: {
          weight: 'bold'
        },
        formatter: Math.round
      }
    }
  };

  var myChart = new Chart(ctx, {
    type: 'bar',
    data: DATA,
    options: OPTION
  });

  document.getElementById('updateData').addEventListener('click', function() {
    refreshData();
  });

  function refreshData() {
    dataNEW.splice(0, dataNEW.length);
    dataCO.splice(0, dataCO.length);
    for (var i = 1; i <= table.rows[0].cells.length - 1; i = i + 1) {
      dataNEW.push(table.rows[1].cells[i].childNodes[0].value);
      dataCO.push(table.rows[2].cells[i].childNodes[0].value);
    }
    //Chart.options.title.text = "New Title"
    window.myChart.update();
  }

  </script>
</body>
</html>
