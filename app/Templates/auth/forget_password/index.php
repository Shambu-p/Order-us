<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/16/2020
 * Time: 11:41 PM
 */

\Absoft\App\Pager\Alert::setSuccessClassName("alert alert-success mt-3");
\Absoft\App\Pager\Alert::setErrorClassName("alert alert-danger mt-3");
\Absoft\App\Pager\Alert::setInfoClassName("alert alert-info mt-3");

?>

<html lang="en">
<head>
    <title>Confirm Who You are</title>
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <style>
        <?php print $this->load_css("bootstrap.min.css"); ?>
    </style>
    <style>
        <?php print $this->load_css("line.css"); ?>
    </style>
</head>
<body class="bg-light">

<div class="row">
    <div class="col"></div>

    <div class="col-sm-11 col-md-6 col-lg-8 mt-5 bg-light">

        <img src="<?php print $this->load_img("line.png"); ?>" class="rounded mb-2 line-position-center line-forms-animation" width="100px" alt="image">
        <h2 class="text-center">Do You Forget your Password?</h2>
        <p class="text-center lead">First Search for your account by using your username and email<br> after that confirmation code will be sent to your email address.</p>

        <div class="container">

            <?php \Absoft\App\Pager\Alert::displayAlert(); ?>

            <form action="<?php print $this->route_address("Auth.forget_password"); ?>" method="post">
                <div class="form-row">

                    <div class="col"></div>
                    <div class="col-sm-11 col-md-6 col-lg-8">

                        <div class="form-group mb-3 line-forms-animation" style="animation-delay: 0.1s;">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" required class="form-control" id="email" name="email" placeholder="Email Address">
                        </div>
                        <div class="form-group mb-3 line-forms-animation" style="animation-delay: 0.2s;">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" required class="form-control" id="username" name="user_name" placeholder="Username">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-2">Find</button>

                    </div>
                    <div class="col"></div>

                </div>
            </form>

        </div>


    </div>

    <div class="col"></div>
</div>

</body>
</html>
