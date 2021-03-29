<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/11/2020
 * Time: 10:56 AM
 */

?>
<html>
<head>
    <link rel="icon" href="<?php print \Absoft\App\Loaders\Resource::imageAddress("line.png")?>">
    <title>Line Control Panel</title>
    <style>
        <?php print \Absoft\App\Loaders\Loader::cssAddress("bootstrap.min.css"); ?>
    </style>
</head>
<body>

<div class="row bg-dark text-white shadow p-3 mb-5">
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

<br>
<div class="row p-2" id="home_page" >

    <div class="col-sm-4 col-md-3" style="overflow-x: hidden">

        <br><br>

        <div class="accordion" id="accordionExample">
            <div class="list-group list-group-flush">

                <div class="list-group-item bg-white" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Introduction To Line
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body bg-white">
                        <div class="list-group list-group-flush" style="align-items: flex-start;">

                            <button onclick="loadPage('from_developers.php')" class="btn btn-link">From the Developers</button>
                            <button onclick="loadPage('prepare_framework.php')" class="btn btn-link">Preparing the Framework</button>
                            <button onclick="loadPage('change_first_page.php')" class="btn btn-link">Changing the First page of the Project</button>
                            <button onclick="loadPage('the_frontend.php')" href="introduction/the_front_end.php" class="btn btn-link">The Front End</button>
                            <button onclick="loadPage('project folder.php')" class="btn btn-link">Project folder</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Creating Entities, Models and Controllers
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse bg-light" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body bg-white">
                        <div class="list-group list-group-flush" style="align-items: flex-start;">

                            <button onclick="loadPage('creating_entity.php')" class="btn btn-link">Create Database Builder</button>
                            <button onclick="loadPage('creating_model.php')" class="btn btn-link">Create Models</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <div class="card-header bg-white" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Modeling
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse bg-white" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body bg-white">
                        <div class="list-group list-group-flush">

                            <button class="btn btn-link">get Address</button>
                            <button class="btn btn-link">get Address</button>
                            <button class="btn btn-link">get Address</button>
                            <button class="btn btn-link">get Address</button>
                            <button class="btn btn-link">get Address</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
    </div>

    <div class="col-md-9 col-sm-8">

        <div class="container">


            <div id="display">

            </div>


        </div>

    </div>


</div>

<!--
<div class="row" >
    <div class="col">

    </div>
    <div class="col-10 p-2 mb-5">


    </div>
    <div class="col">

    </div>
</div>
-->
<script>

    function _(id){

        return document.getElementById(id);

    }

    function loadPage(address){

        let method = "POST";
        let model_display = _("display");
        address = "../templates/documentation/" + address;
        let ajax = new XMLHttpRequest();


        ajax.open(method, address, true);
        ajax.send();
        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                model_display.innerHTML = this.responseText;

            }else{

                model_display.innerHTML += this.readyState + "  ";
                model_display.innerHTML += this.status;
                model_display.innerHTML += address;

            }

        };

    }

</script>

<script><?php print \Absoft\App\Loaders\Loader::jsAddress("jquery3.3.1.min.js"); ?></script>
<script><?php print \Absoft\App\Loaders\Loader::jsAddress("popper.min.js"); ?></script>
<script><?php print \Absoft\App\Loaders\Loader::jsAddress("bootstrap.min.js"); ?></script>
</body>
</html>
