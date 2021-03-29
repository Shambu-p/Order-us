<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 8:43 AM
 */

?>
<html>
<head>
    <title>SmartTechno</title>
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <style><?php print $this->load_css("bootstrap.min.css"); ?></style>
</head>
<body class="bg-light">

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-light border-bottom sticky-top shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Smart Techno</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?php print "http://".$_SERVER["HTTP_HOST"]; ?>">Home</a>
        <a class="p-2 text-dark" href="<?php print $this->route_address("Auth.sign_in"); ?>">My Account</a>
        <a class="p-2 text-dark" href="<?php print $this->route_address("Designs.open_designs", ["type" => "banner"]); ?>">Designs</a>
        <a class="p-2 text-dark" href="#">Pricing</a>
    </nav>
</div>

<!--<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top mb-lg-3 mb-sm-5">
    <a class="navbar-brand" href="">Smart Techno</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Login <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Designs</a>
            </li>
        </ul>
    </div>
</nav>-->

<div class="row pl-lg-5 pl-sm-3 pr-lg-5 pr-sm-3">
    <div class="col-sm-12 col-md-5 col-lg-3">

        <div class="list-group">

            <a href="<?php print $this->route_address("Orders.re_init"); ?>" class="list-group-item list-group-item-action">

                <?php
                if(isset($_SESSION["order"]["order_type"])){
                    print '<span class="badge badge-success">V</span>';
                }
                else{
                    print '<span class="badge badge-warning">X</span>';
                }
                ?>

                Restart Ordering
            </a>
            <a href="<?php

            if(isset($_SESSION["order"]["order_type"])){
                print $this->route_address("Designs.open_designs", ["type" => $_SESSION["order"]["order_type"]]);
            }else{
                print $this->route_address("Orders.re_init");
            }

            ?>" class="list-group-item list-group-item-action">
                <?php
                if(isset($_SESSION["order"]["design"])){
                    print '<span class="badge badge-success">V</span>';
                }
                else{
                    print '<span class="badge badge-warning">X</span>';
                }
                ?>
                Select Design
            </a>
            <a href="<?php print $this->view_address("open", "attach_image"); ?>" class="list-group-item list-group-item-action">
                <?php
                if(isset($_SESSION["order"]["suggested_image"])){
                    print '<span class="badge badge-success">V</span>';
                }
                else{
                    print '<span class="badge badge-warning">X</span>';
                }
                ?>
                Attach Suggested Image
            </a>

            <a href="<?php print $this->route_address("Orders.to_preference"); ?>" class="list-group-item list-group-item-action">
                <?php
                if(isset($_SESSION["design_preference"])){
                    print '<span class="badge badge-success">V</span>';
                }
                else{
                    print '<span class="badge badge-warning">X</span>';
                }
                ?>
                Preferences
            </a>

            <a href="<?php print $this->view_address("open", "shipment"); ?>" class="list-group-item list-group-item-action">
                Shipment Info
            </a>

            <li class="list-group-item list-group-item-action bg-light disabled">
                Calculated Price:
                <?php
                if(isset($_SESSION["order"]["payment"])){

                    print '<strong>'.$_SESSION["order"]["payment"]."  Birr</strong>";

                }
                else{
                    print '<strong>0.0 Birr</strong>';
                }
                ?>

            </li>

            <a href="<?php print $this->route_address("Orders.save"); ?>" class="list-group-item list-group-item-action text-light bg-dark">
                Order
            </a>

        </div>

    </div>

    <div class="col">

    <?php
    $this->set_alert_classname("alert alert-success mt-3", "alert alert-info mt-3", "alert alert-danger mt-3");
    $this->show_alert();
