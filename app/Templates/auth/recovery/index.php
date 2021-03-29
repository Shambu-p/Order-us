<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/15/2020
 * Time: 11:37 AM
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
            <h2 class="text-center">Confirm Who You are</h2>
            <p class="text-center lead">Confirmation code has been sent to your email address. <br>Enter the confirmation code here</p>

            <?php \Absoft\App\Pager\Alert::displayAlert(); ?>

            <div class="container">

                <form method="post" action="<?php print $this->route_address("Auth.confirm"); ?>">

                    <div class="form-row">

                        <div class="col"></div>
                        <div class="col-sm-11 col-md-6 col-lg-7">

                            <?php

                            if(isset($this->request->state)){

                                print '
                                
                                <div class="form-group mb-5 mt-3">
                                    <input max="9999" min="0" type="number" class="form-control form-control-lg line-position-center" placeholder="Confirmation code" required>
                                    <small class="form-text text-muted text-center">I don\'t Receive the code. <a href="#" class="card-link">Resend Code</a></small>
                                </div>
                                <button type="submit" class="btn btn-dark btn-lg line-position-center">Submit</button>
                                
                                ';

                            }
                            else{

                                print '
                                <small class="form-text text-muted text-center">I don\'t Receive the code. <a href="'.$this->view_address("auth", "forget_password").'" type="submit" class="card-link">Resend Code</a></small>
                                ';

                            }

                            ?>

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
