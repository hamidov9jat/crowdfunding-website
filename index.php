
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="jumbotron">
    <h1 class="text-center">
        Crowdfunding
    </h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
            <form role='form' action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" placeholder="E-mail" name="email" type="email" id="email" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="pass" id="password">
                </div>

                <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login">

            </form>
        </div>
    </div>
</div>
</body>
</html>
