<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/18/2020
 * Time: 11:36 AM
 */

\Absoft\App\Pager\Alert::setSuccessClassName("alert alert-success mt-3");
\Absoft\App\Pager\Alert::setErrorClassName("alert alert-danger mt-3");
\Absoft\App\Pager\Alert::setInfoClassName("alert alert-info mt-3");

?>

<html lang="en">
<head>
    <title>Home Page</title>
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

        <div class="container">

            <h2>Smart Techno</h2>
            <?php \Absoft\App\Pager\Alert::displayAlert(); ?>
            <p class="lead">
                This is the home page and you have successfully logged in. <br>
                <a class="card-link" href="<?php print $this->route_address("Auth.get_in    "); ?>">go to my account</a>
            </p>
            <form action="<?php print $this->route_address("Auth.logout"); ?>" method="post">

                <button class="btn btn-primary btn-sm" type="submit">Sign Out</button>

            </form>

        </div>


    </div>

    <div class="col"></div>
</div>

</body>
</html>
