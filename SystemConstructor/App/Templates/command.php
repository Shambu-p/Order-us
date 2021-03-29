<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/11/2020
 * Time: 12:32 AM
 */

$_main_address = str_replace("\\", "/", __DIR__)."/";
//$_main_url = $_SERVER["SERVER_NAME"];

?>

<html>
<head>
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <title>Line Control Panel</title>
    <style><?php print $this->load_css("bootstrap.min.css"); ?></style>
    <style><?php print $this->load_css("main.css"); ?></style>
</head>
<body>

<?php

$client_ip = \Absoft\App\Security\IpCheck::clientIp();

if(!\Absoft\App\Security\IpCheck::isLocal($client_ip)){

    ErrorHandler::reportError("", "the ip address $client_ip is not trusted ip address.", "");
    \Absoft\App\Routing\Route::view("system_templates", "warnning");
    die("");

}

?>

<div class="row bg-dark text-white">
    <div class="col">
        <div class="container">
            <h1 class="display-4">Line</h1>
        </div>
    </div>
    <div class="col">
        <div class="container">
            <br>
            <p class="lead float-right">
                Line PHP Framework by <i>ab soft</i>
            </p>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top shadow p-3 mb-5">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="create_model_button">
                <a class="nav-link"  href="#">Create Model</a>
            </li>
            <li class="nav-item" id="create_controller_button">
                <a class="nav-link" href="#">Create Controller</a>
            </li>
            <li class="nav-item" id="create_entity_button">
                <a class="nav-link" href="#">Create Entity</a>
            </li>
            <li class="nav-item" id="cli_button">
                <a class="nav-link"  href="#">Open CLI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Update</a>
            </li>
        </ul>
    </div>

</nav>

<div class="row" >
    <div class="col">

    </div>
    <div class="col-10 rounded bg-light shadow p-3 mb-5" id="main_display">

        <div class="alert bg-warning text-dark animate" id="warning" style="display: none;">

        </div>

        <div class="alert bg-danger text-white animate" id="error" style="display: none;">

        </div>

        <div class="alert bg-success text-white animate" id="success" style="display: none;">

        </div>

        <?php
        include_once "$_main_address/cli_page.php";
        include_once "$_main_address/model_creation_page.php";
        include_once "$_main_address/controller_creation_page.php";
        include_once "$_main_address/entity_creation_page.php";
        ?>

    </div>
    <div class="col">

    </div>
</div>

<script><?php print '
let location_address = {

    _main_address: "http://localhost:'.$_SERVER["SERVER_PORT"].'"

};
'; ?></script>
<script><?php print $this->load_js("jquery3.3.1.min.js"); ?></script>
<script><?php print $this->load_js("popper.min.js"); ?></script>
<script><?php print $this->load_js("bootstrap.min.js"); ?></script>
<script><?php print $this->load_js("_main.js"); ?></script>

</body>
</html>
