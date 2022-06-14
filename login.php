<?php


include("connect_database.php");
global $link;

include ("User.php");

session_start();//session starts here



if (isset($_POST['login'])) {
    $user_email = $_POST['email'];
    $user_pass = $_POST['pass'];

    $check_user = "SELECT * FROM users WHERE email='$user_email'AND password='$user_pass'";

    $run = mysqli_query($link, $check_user) or die(mysqli_error($link));

    if (mysqli_num_rows($run)) {

        $row = $run->fetch_array();
//        dcornhill1@salon.com
//        NT0paN
//        print_r(array_unique($row));

        // create user that is successfully logged in using User class and pass it to Session
        $logged_in_user = new User(...array_unique($row));

        // $_SESSION['email'] is redundant, but we used it here just for the check in welcome.php
        $_SESSION['email'] = $user_email;//here session is used and value of $user_email store in $_SESSION.

        // pass the user as object in session variable
        $_SESSION['user_object'] = $logged_in_user;

        // check if the logged in user has project i.e. is a project owner
        $id_user = $logged_in_user->getIdUser();
        $projects_query = "   SELECT * FROM projects WHERE idUser='$id_user'   ";
        $project_rows = mysqli_query($link, $projects_query) or die(mysqli_error($link));

        $_SESSION['isOwner'] = (mysqli_num_rows($project_rows) != 0);

        echo "<script>window.open('homepage.php','_self')</script>";

    } else {
        echo "<script>alert('Email or password is incorrect!')</script>";
        echo "<script>window.open('index.php','_self')</script>";


    }
}