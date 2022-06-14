<?php
include_once "User.php";
include_once "connect_database.php";
global $link;
include_once "Project.php";

session_start();
date_default_timezone_set('Asia/Baku');


if (isset($_POST['invest-form'])) {

    $logged_in_user = $_SESSION['user_object'];
    $id_user = $logged_in_user->getIdUser();

    $id_project = $_SESSION['donated_project']->getIdProject();

    $investment_fund = $_POST['donate'];
    $requested_fund = $_SESSION['donated_project']->getRequestedFund();

    $date_of_investment = strtotime($_POST['investment-date']);
    $project_end_date = strtotime($_SESSION['donated_project']->getProjectEndDate());
    $project_start_date = strtotime($_SESSION['donated_project']->getProjectStartDate());


    if ($investment_fund < ($requested_fund - $investment_fund) and $investment_fund > 0) {

        if ($project_start_date <=$date_of_investment and $date_of_investment < $project_end_date) {

            $date_of_investment = date("Y-m-d", $date_of_investment);

            $res = mysqli_query($link,
                "  INSERT into `projects_investors` (idUser, idProject, investmentFund, investmentDate)
                     VALUES ($id_user, $id_project, $investment_fund, DATE('$date_of_investment') )")
            or die(mysqli_error($link));

            unset($_POST['invest-form']);
            unset($_POST['donate']);
            unset($_POST['investment-date']);

            echo "<script>alert('Successfully invested!!!')</script>";
            echo "<script>window.open('homepage.php','_self')</script>";
        }

        else {
            unset($_POST['invest-form']);
            unset($_POST['donate']);
            unset($_POST['investment-date']);

            echo "<script>alert('You can invest before end date and after start date of the project')</script>";
            echo "<script>window.open('homepage.php','_self')</script>";
        }

    } else {
        unset($_POST['invest-form']);
        unset($_POST['donate']);
        unset($_POST['investment-date']);

        echo "<script>alert('You can only invest if the invested amount is less than the expected amount and greater than 0!')</script>";
        echo "<script>window.open('homepage.php')</script>";
    }


}
