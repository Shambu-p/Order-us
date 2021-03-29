<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/5/2020
 * Time: 3:52 PM
 */

$title = "Not set";
$description = "";
$error_file = "";
if(isset($_SESSION["_system"]["error_handling"]["error"])){

    $er_array = $_SESSION["_system"]["error_handling"]["error"];

}else{
    $er_array = [];
}

if(isset($this->request->title)){

    $title = $this->request->title;

}else if(isset($er_array["title"])){

    $title = $er_array["title"];

}

if(isset($this->request->description)){

    $description = $this->request->description;

}else if(isset($er_array["description"])){

    $description = $er_array["description"];

}

if(isset($this->request->error_file)){

    $error_file = $this->request->error_file;

}else if(isset($er_array["error_file"])){

    $error_file = $er_array["error_file"];

}

ErrorHandler::clearError();

?>

<html lang="en">
<head>
    <title>Error</title>
    <style><?php print \Absoft\App\Loaders\Loader::cssAddress("bootstrap.min.css"); ?></style>
    <style><?php print \Absoft\App\Loaders\Loader::cssAddress("main.css"); ?></style>
</head>
<body>
<br>
<div class="container shadow p-3 mb-5 rounded mycolor-white-level-2">
    <nav class="navbar navbar-light bg-light">
        <span class="navbar-brand mb-0 h1">
            <strong><i>Line</i></strong> <i>Framework</i>
        </span>
    </nav>
    <br>
    <div class="jumbotron bg-danger text-white">
        <h1 class="display-4">
            <?php

            /*

            $req = (Array) $this->request;
            $size = sizeof($req);

            $title = $req[$size-1];
            $description = $req[0];
            $er_page = "";

            for($i = 1; $i < $size-1; $i++){

                $er_page .= $req[$i]."/";

            }

             */

            if($title == E_NOTICE){

                print "ERROR NOTICE!!";

            }else if($title == E_WARNING){

                print "ERROR WARNING!!";

            }else if($title == E_ERROR){

                print "FATAL ERROR!!";

            }else{

                print $title;

            }
            //print_r($this->request);
            ?>
        </h1>
        <hr class="my-4">
        <p class="lead">
            <?php

            print "Error occurred in file ".$error_file;
            ?>
        </p>
    </div>
    <div class="container text_color_red">
        <?php
        print $description;
        ?>
    </div>
</div>

<!--
<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
mycolor-white-level-2
<div class="shadow-sm p-3 mb-5 bg-white rounded">Small shadow</div>
<div class="shadow p-3 mb-5 bg-white rounded">Regular shadow</div>
-->

</body>
</html>
