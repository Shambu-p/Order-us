<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/15/2020
 * Time: 7:52 PM
 */

//print $this->_app_url;

?>

<html lang="en">
<head>

    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <title> Line Home </title>
    <style><?php print $this->load_css("bootstrap.min.css"); ?></style>
    <style><?php print $this->load_css("main.css");?></style>

</head>
<body>

<br><br>

<div class="container">

    <h1 class="display-1 my_heading">
        LINE
    </h1>

    <br>
    <br>

</div>

<div class="row">

    <div class="col">

    </div>

    <div class="col-10">

        <div class="row">

            <div class="col animate " id="first">

                <div class="container">

                    <div class="card bg-dark text-white">
                        <img src="<?php print $this->load_img("project-puzzle-pieces.jpg"); ?>" class="card-img" alt="...">
                        <div class="card-img-overlay">

                        </div>
                    </div>

                    <br>
                    <form action="<?php print $this->view_address("system", "command"); ?>" method="post">
                        <button type="submit" class="btn btn-block btn-outline-light text-dark">Back to My Project</button>
                    </form>
                </div>

            </div>

            <div class="col animate " id="second">
                <div class="container">
                    <div class="card bg-dark text-white">
                        <img src="<?php print $this->load_img("documentation.png"); ?>" class="card-img" alt="...">
                        <div class="card-img-overlay">

                        </div>
                    </div>
                    <br>
                    <form action="<?php print $this->view_address("system", "documentation"); ?>" method="post">
                        <button type="submit" class="btn btn-block btn-outline-light text-dark">Line Documentation</button>
                    </form>
                </div>
            </div>

            <div class="col animate" id="third">
                <div class="container">
                    <div class="card bg-dark text-white">
                        <img src="<?php print $this->load_img("help-europe.jpg");  ?>" class="card-img" alt="...">
                        <div class="card-img-overlay">

                        </div>
                    </div>
                    <br>
                    <form action="#" method="post">
                        <button type="submit" class="btn btn-block btn-outline-light text-dark btn-sm">Help</button>
                    </form>
                </div>
            </div>

            <div class="col animate " id="fourth" >
                <div class="container">
                    <div class="card bg-dark text-white">
                        <img src="<?php print $this->load_img("absoft b&w.ico"); ?>" class="card-img" alt="...">
                        <div class="card-img-overlay">

                        </div>
                    </div>
                    <br>
                    <form action="<?php print $this->view_address("system", "contact_us"); ?>" method="post">
                        <button type="submit" class="btn btn-block btn-outline-light text-dark">Contact us Ab soft</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <div class="col">
    </div>

</div>

</body>
</html>
