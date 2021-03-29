<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/9/2020
 * Time: 12:01 PM
 */

use \Absoft\App\Security\Auth;
?>

<!doctype html>
<html lang="en">

<!-- Mirrored from getbootstrap.com/docs/4.1/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:41:51 GMT -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Abnet Kebede">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">

    <title>Admin</title>

    <style>
        <?php print $this->load_css("bootstrap.min.css"); ?>
    </style>
    <style>
        <?php print $this->load_css("dashboard.css"); ?>
    </style>
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php print "http://".$_SERVER["HTTP_HOST"]; ?>">Smart Techno</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?php print $this->route_address("Auth.logout"); ?>">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Order Management</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Orders.new_orders"); ?>">
                            <span data-feather="shopping-cart"></span>
                            Requested Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("OrdersDesigners.admin_show"); ?>">
                            <span data-feather="shopping-cart"></span>
                            Orders on Design
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Orders.payed_orders"); ?>">
                            <span data-feather="users"></span>
                            Payed Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Orders.canceled_orders"); ?>">
                            <span data-feather="bar-chart-2"></span>
                            Canceled Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Orders.finished_orders"); ?>">
                            <span data-feather="layers"></span>
                            Finished Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Orders.printing_orders"); ?>">
                            <span data-feather="layers"></span>
                            Orders on Print
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Orders.delivered_orders"); ?>">
                            <span data-feather="layers"></span>
                            Delivered Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Designs.admin_approval", ["type" => "cup"]); ?>">
                            <span data-feather="layers"></span>
                            Designs Approval
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->view_address("common", "statstics"); ?>">
                            <span data-feather="layers"></span>
                            Statistics
                        </a>
                    </li>

                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Employee Management</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Users.show"); ?>">
                            <span data-feather="file-text"></span>
                            All Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Users.active_employees"); ?>">
                            <span data-feather="file-text"></span>
                            Active Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Users.deleted_employees"); ?>">
                            <span data-feather="file-text"></span>
                            Deleted Accounts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->view_address("admin", "add_user"); ?>">
                            <span data-feather="file-text"></span>
                            New Employee
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Users.view", ["user" => Auth::user()->username]); ?>">
                            <span data-feather="file-text"></span>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Posts.add"); ?>">
                            <span data-feather="file-text"></span>
                            New Post
                        </a>
                    </li>

                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Price Management</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->route_address("Prices.show"); ?>">
                            <span data-feather="file-text"></span>
                            All Price
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php print $this->view_address("admin", "new_price"); ?>">
                            <span data-feather="file-text"></span>
                            New Price
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <?php
            $this->set_alert_classname("alert alert-success mt-3", "alert alert-info mt-3", "alert alert-danger mt-3");
            $this->show_alert();
