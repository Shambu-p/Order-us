<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/16/2020
 * Time: 10:50 PM
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

    <div class="col-sm-11 col-md-6 col-lg-8 pt-5 mt-3 mb-3 bg-light rounded pb-5">

        <img src="<?php print $this->load_img("line.png"); ?>" class="rounded mb-2 line-position-center line-forms-animation" width="100px" alt="image">
        <h2 class="text-center">Register Here</h2>
        <p class="text-center lead">To register you have to fill the following form and submit.</p>

        <div class="container pt-5">

            <?php \Absoft\App\Pager\Alert::displayAlert(); ?>

            <form>

                <div class="form-row line-forms-animation" style="animation-delay: 0.1s;">
                    <div class="form-group col-md-6">
                        <label for="first_name">Firs Name</label>
                        <input type="text" class="form-control" id="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group line-forms-animation" style="animation-delay: 0.2s;">
                    <label for="Username">Username</label>
                    <input type="text" class="form-control" id="Username" placeholder="Username">
                </div>

                <div class="form-group line-forms-animation" style="animation-delay: 0.2s;">
                    <label for="email_address">Email Address</label>
                    <input type="email" class="form-control" id="email_address" placeholder="Email Address">
                </div>
                <div class="form-group line-forms-animation" style="animation-delay: 0.2s;">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-row line-forms-animation" style="animation-delay: 0.2s;">
                    <div class="form-group col">
                        <label for="new_password">New Password</label>
                        <input type="password" placeholder="Password" class="form-control" id="new_password">
                    </div>
                    <div class="form-group col line-forms-animation">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="text" class="form-control" placeholder="Confirm Password" id="confirm_password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>

        </div>

    </div>

    <div class="col"></div>
</div>



</body>
</html>
