<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/13/2020
 * Time: 4:46 PM
 */


?>

<html>
<head>
    <title>SmartTechno</title>
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <style>
        <?php print $this->load_css("bootstrap.min.css"); ?>
    </style>
</head>
<body class="bg-light">

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-light border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Smart Techno</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?php print "http://".$_SERVER["HTTP_HOST"]; ?>">Home</a>
        <a class="p-2 text-dark" href="<?php print $this->route_address("Auth.sign_in"); ?>">My Account</a>
        <a class="p-2 text-dark" href="<?php print $this->route_address("Designs.open_designs", ["type" => "banner"]); ?>">Designs</a>
        <a class="p-2 text-dark" href="<?php print $this->route_address("Prices.open_show"); ?>">Pricing</a>
    </nav>
    <!--<a class="btn btn-outline-primary" href="<?php print $this->route_address("Orders.check_my_order"); ?>">My Order</a>-->
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
</nav>
-->
<div class="pl-sm-2 pl-lg-5 pr-sm-2 pr-lg-5">

<?php
$this->set_alert_classname("alert alert-success mt-3", "alert alert-info mt-3", "alert alert-danger mt-3");
$this->show_alert();
?>

</div>
