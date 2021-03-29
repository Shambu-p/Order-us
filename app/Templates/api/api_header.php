<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/13/2020
 * Time: 11:26 AM
 */


?>
<!doctype html>
<html lang="en">
<!-- Mirrored from getbootstrap.com/docs/4.1/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:41:51 GMT -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Abnet Kebede">
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">

    <title>Line API Dashboard</title>
    <style>
        <?php print $this->load_css("bootstrap.min.css"); ?>
    </style>
    <style>
        <?php print $this->load_css("dashboard.css"); ?>
    </style>
    <style>
        <?php print $this->load_css("line.css"); ?>
    </style>
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">

    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Line Framework</a>

    <form action="<?php print $this->route_address("api.search"); ?>" class="form-inline w-75" method="post">
        <input class="form-control form-control-dark w-75" name="word" type="text" placeholder="Search">
    </form>

</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("api.show"); ?>">
                            <span data-feather="home"></span>
                            API Dashboard
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("api.new_api_user"); ?>">
                            <span data-feather="file"></span>
                            New User
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


<?php

\Absoft\App\Pager\Alert::setSuccessClassName("alert alert-success mt-3");
\Absoft\App\Pager\Alert::setErrorClassName("alert alert-danger mt-3");
\Absoft\App\Pager\Alert::setInfoClassName("alert alert-info mt-3");
?>
