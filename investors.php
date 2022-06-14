<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>


<body>

<div class="jumbotron">
    <h1 class="text-center">
        Investors of the Project
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
    <!--    <h1 align="center">Investors for the project</h1>-->

    <div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->
        <table class="flex-column table-bordered table-hover table-striped" style="table-layout: fixed;">
            <thead>

            <tr>

                <th>Project Id</th>
                <th>Project Name</th>
                <th>User First Name</th>
                <th>User Last Name</th>
                <th>User E-mail</th>
                <th>Amount Invested</th>
            </tr>
            </thead>

            <?php

            include_once "User.php";
            include_once "connect_database.php";
            global $link;

            session_start();

            if (!$_SESSION['email'] || !$_SESSION['code'] ||
                !array_key_exists('code', $_GET) || !array_key_exists($_GET['code'], $_SESSION['code'])) {
                header("Location: homepage.php");//redirect to the login page to secure the welcome page without login access.
                exit();
            }

            // get the project is from encrypted url
            $id_project = $_SESSION['code'][$_GET['code']];

            // select all investors for a given project
            $investors = " SELECT projects.idProject, projects.projectName, users.firstname,
                                users.lastname, users.email, projects_investors.investmentFund 
                                FROM projects_investors JOIN projects ON (projects.idProject =projects_investors .idProject )
                                JOIN users ON (users .idUser =projects_investors.idUser ) WHERE projects.idProject='$id_project' ";

            $run = mysqli_query($link, $investors);//here run the sql query.

            while ($row = mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
            {
                $id_project = $row[0];
                $project_name = $row[1];
                $user_firstname = $row[2];
                $user_lastname = $row[3];
                $user_email = $row[4];
                $user_invested = $row[5];
                ?>

                <tr>
                    <!--here showing results in the table -->
                    <td><?php echo $id_project; ?></td>
                    <td><?php echo $project_name; ?></td>
                    <td><?php echo $user_firstname; ?></td>
                    <td><?php echo $user_lastname; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td><?php echo $user_invested; ?></td>

                </tr>

            <?php } ?>

        </table>
    </div>
</div>
</body>

</html>