<?php

include_once "User.php";
include_once "connect_database.php";
include_once "securedData.inc.php";
global $link;

session_start();

if (!$_SESSION['email']) {
    header("Location: index.php");//redirect to the login page to secure the welcome page without login access.
    exit();
}

$logged_in_user = $_SESSION['user_object'];
$logged_user_id = $logged_in_user->getIdUser();

// create an array for storing project ids in $_SESSION

$_SESSION['project_ids'] = array();
$_SESSION['code'] = array();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="jumbotron">
    <h1 class="text-center">
        Projects Open for Funding
    </h1>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Crowdfunding</a>
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

<div class="table-scroll">

    <div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->
        <!--        <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">-->
        <table class="flex-column table-bordered table-hover table-striped" style="table-layout: fixed">
            <thead>

            <tr>

                <th>Project Name</th>
                <th>Description</th>
                <th>Owner</th>
                <th>E-mail</th>
                <th>End Date</th>
                <th>Requested Fund</th>
                <th>Additional</th>
            </tr>
            </thead>

            <?php


            //            !!! Modify
            // display all projects
            $projects = "SELECT projects.projectName, projects.projectDescription, users.firstname, users.email,
                            projects.projectEndDate, projects.requestedFund, projects.idProject, projects.idUser
                            FROM projects JOIN users ON (users .idUser=projects.idUser );";

            $run = mysqli_query($link, $projects) or die(mysqli_error($link));//here run the sql query.

            while ($row = mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.
            {
                $project_name = $row[0];
                $description = $row[1];
                $user_firstname = $row[2];
                $user_email = $row[3];
                $end_date = $row[4];
                $requested_fund = $row[5];

                $id_Project = $row[6];
                $_SESSION['project_ids'][$id_Project] = $id_Project;

                // anonymize the project id in url
                $theCode = random_pw(8);
                $_SESSION['code'][$theCode] = $id_Project;


                $id_user = $row[7];



                ?>

                <tr>
                    <!--here showing results in the table -->
                    <td><?php echo $project_name; ?></td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $user_firstname; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td><?php echo $end_date; ?></td>
                    <td><?php echo $requested_fund; ?></td>

                    <td>


                        <?php
                        echo '<a class="btn btn-secondary" href="pie_chart.php?code=' . $theCode . '">
                                    More Info
                                </a>';
                        ?>

                        <?php
                        // check if the user can invest in the project
                        $query = "SELECT * FROM `projects_investors` where idUser = '$logged_user_id' and idProject='$id_Project'";
                        $run_query = mysqli_query($link, $query) or die(mysqli_error($link));//here run the sql query.

                        if (mysqli_num_rows($run_query) == 0) { // the user can invest
                            echo
                                '<a class="btn btn-secondary" href="invest.php?code=' . $theCode . '">
                                    Invest
                                </a>';
                        }

                        ?>


                        <?php // display list of investors button for the project if the logged-in user is its owner
                        if ($_SESSION['isOwner'] && ($id_user == $logged_in_user->getIdUser())) {

                            echo '<a class="btn btn-primary" href="investors.php?code=' . $theCode . '">
                            Investors
                            </a>';
                        } ?>

                    </td>
                </tr>

            <?php } ?>

        </table>
    </div>
</div>
</body>

</html>