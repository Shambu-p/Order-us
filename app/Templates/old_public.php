<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/4/2020
 * Time: 12:33 PM
 */

?>

<html>
<head>
    <title>Line Homepage</title>
    <style>
        <?php print $this->load_css("bootstrap.min.css"); ?>
    </style>
    <style>
        <?php print $this->load_css("style.css"); ?>
    </style>
    <style>
        <?php print $this->load_css("sticky-footer.css"); ?>
    </style>
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <meta name="viewport" content="width=device-width, scale=1">
</head>
<body>

<div class="line_heading my_dark">
    <img class="heading_img" src="<?php print $this->load_img("line.png"); ?>" alt="image">
    <h3 class="title_head">LINE</h3>
</div>

<div class="line_container">
    <br>
    <img src="<?php print $this->load_img("line.png"); ?>" class="main_img" alt="image">

    <h3 class="line_title">LINE</h3>
    <p class="sub_title">Right Choice For Simple Applications</p>


    <div class="row">
        <div class="container text-center my-5 ">

            <p class="mb-1"><sup>&copy;</sup>2012 Line</p>
            <ul class="list-inline">

                <li class="list-inline-item">
                    <a href="#">Contact us</a>
                </li>

                <li class="list-inline-item">
                    <a href="#">About Us</a>
                </li>

            </ul>

        </div>
    </div>
</div>

<?php //print_r($_SESSION["_system"]["error_handling"]); ?>

<!--
<div class="container shadow p-3 mb-5 bg-white rounded">

    <div class="jumbotron">
        <h1 class="display-4">Hello User!</h1>
        <p class="lead">
            This is line framework from <strong>AbSoft</strong>.
        </p>
        <hr class="my-4">
        <p>
            This can be your home page of your project or if you don't want it to be then you can change it on
            SystemConstructor/App/Engines/ViewerEngine.php
        </p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>

</div>-->

<script src="<?php $this->load_js("jquery3.3.1.min.js"); ?>"></script>
<script src="<?php $this->load_js("popper.min.js"); ?>" ></script>
<script src="<?php $this->load_js("bootstrap.min.js"); ?>"></script>

</body>
</html>
