<?php

include_once "User.php";
include_once "connect_database.php";
global $link;
include_once "Project.php";

session_start();

// set the default timezone to use.
date_default_timezone_set('Asia/Baku');

if (!$_SESSION['email'] || !$_SESSION['code'] ||
    !array_key_exists('code', $_GET) || !array_key_exists($_GET['code'], $_SESSION['code'])) {
    header("Location: homepage.php");//redirect to the login page to secure the welcome page without login access.
    exit();
}

// get the project is from encrypted url
$id_project = $_SESSION['code'][$_GET['code']];


// get info about project and create corresponding Project object :-)
$query = "select * from projects where idProject = '$id_project'";
$run_query = mysqli_query($link, $query) or die(mysqli_error($link));//here run the sql query.
$row_assoc = mysqli_fetch_assoc($run_query);

//print_r($row_assoc);
$donated_project = new Project(...array_values($row_assoc));

?>
<html>
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Statistics</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

          var data = google.visualization.arrayToDataTable([
                  ['Funds', 'Amount'],
                  <?php
                    $result = mysqli_query($link,
                        "SELECT projects.requestedFund, SUM(projects_investors.investmentFund ) AS totalInvestment 
                                FROM projects 
                                JOIN projects_investors ON (projects.idProject =projects_investors.idProject ) 
                                where projects.idProject='$id_project'") or die(mysqli_error($link));
//              print_r(mysqli_fetch_assoc($result));
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "['Requested Fund'," . $row['requestedFund'] . "],";
                  echo "['Total Investment'," . $row['totalInvestment'] . "]";
              }
                  ?>
              ]);

          var options = {
              title: 'Statistics for <?php echo $donated_project->getProjectName(); ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
  <div class="justify-content-center">
      <h1 class="text-center">
          Statistics
      </h1>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
          <!--        <a class="navbar-brand" href="#">Crowdfunding</a>-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                  aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="homepage.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="logout.php">Logout</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
