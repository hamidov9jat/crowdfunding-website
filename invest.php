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

// store it in $_SESSION
$_SESSION['donated_project'] = $donated_project;





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="justify-content-center">
    <h1 class="text-center">
        Donate
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

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
            <form action="modify.php" method="POST">
                <h3>Invest in <?php echo $donated_project->getProjectName()?></h3>
                <div class="form-group">
                    <label for="amount">Amount to invest</label>
                    <input class="form-control" placeholder="Min value is $0" name="donate" type="number" min="0" step="0.01"
                           id="amount" autofocus>
                </div>
                <div class="form-group">
                    <label for="date">Date for investment</label>
                    <input class="form-control" placeholder="Before end date and after start date of the project" name="investment-date" type="date"
                           id="date">
                </div>


                <input class="btn btn-lg btn-success btn-block" type="submit" value="Invest" name="invest-form">

            </form>
        </div>
    </div>
</div>
</body>
</html>
