<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/4/2020
 * Time: 12:22 PM
 */

?>
<html lang="en">

<head>
    <title>Smart Techno</title>
    <link rel="icon" href="<?php Loader::imageAddress("line.png"); ?>">
    <link rel="stylesheet" href="<?php Loader::cssAddress("bootstrap.min.css"); ?>">
    <meta name="viewport" content="width=device-width, scale=1">
</head>

<body>
<div class="row bg-dark text-white" >
    <div class="col">
        <h1 class="display-4">
            Smart Techno
        </h1>
    </div>
    <div class="col">

    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print Route::goRouteAddress("Users.login"); ?>">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php print Route::goRouteAddress("Orders.view"); ?>">Check Order</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php print Route::goRouteAddress("Orders.re_init"); ?>">New Order</a>
            </li>

        </ul>
    </div>
</nav>

<div class="row">

    <div class="col">

    </div>
    <div class="col-xl-9 col-md-10 col-lg-10 col-sm-12 bg-white">

        <br>
        <?php

        ?>


