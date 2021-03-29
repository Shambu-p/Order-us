<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/18/2020
 * Time: 2:54 AM
 */


if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    Route::view("orders", "show");
    die();

}

?>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="icon" href="<?php Loader::imageAddress("line.png"); ?>">
    <link rel="stylesheet" href="<?php Loader::cssAddress("bootstrap.min.css"); ?>">
    <script type="text/javascript" src="<?php Loader::jsAddress("main.js"); ?>"></script>
    <meta name="viewport" content="width=device-width, scale=1">
</head>
<body>

<nav class="navbar navbar-dark bg-dark shadow">
        <a class="navbar-brand" href="<?php print Route::goRouteAddress("Posts.show"); ?>">
        <h1 class="display-4">
            Smart Techno
        </h1></a>
</nav>

<div class="container">
    <div class="row">
        <div class="col">

        </div>
        <div class="col-lg-7 col-md-7 col-sm-10 col-xl-6 col-xs-12 shadow p-3 mb-5 rounded bg-light">
            <div class="container">
                <h1 class="display-4" style="text-align: center;">
                    Login Here
                </h1>
                <br>

                <?php
                Alert::setErrorClassName("alert bg-danger text-white alert-dismissible fade show animate");
                Alert::setInfoClassName("alert bg-info text-white alert-dismissible fade show animate");
                Alert::setSuccessClassName("alert bg-success text-white alert-dismissible fade show animate");
                Alert::displayAlert();
                ?>


                <form action="<?php print Route::goRouteAddress("Users.login"); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control bg-light" id="InputUsername" name="username" placeholder="Enter Username">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control bg-light" id="InputPassword" name="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-dark">Login</button>

                    <a class="card-link" href="#">Forget Password</a>
                </form>
            </div>
        </div>
        <div class="col">

        </div>
    </div>
</div>

</body>
</html>
