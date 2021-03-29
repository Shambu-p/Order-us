<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/14/2020
 * Time: 10:57 AM
 */

?>

<div class="row" id="create_controller_page" style="display: none">
    <div class="col-9">
        <div class="container">
            <br>

            <div class="form-row align-items-center">

                <button class="btn btn-dark" id="controller_creation_button">Create</button>

                <div class="col-sm-3 my-1">
                    <input type="text" class="form-control" id="controllerNameInput" placeholder="Controller Name">
                </div>

                <div class="col-sm-3 my-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="c_model" value="model">
                        <label class="form-check-label" for="c_model">
                            also Create Model
                        </label>
                    </div>
                </div>

            </div>
            <br>

        </div>
    </div>
    <div class="col">

        <li class="list-group-item bg-dark text-white">All the Controllers you have created</li>
        <br>
        <div class="container" >
            <ul class="list-group list-group-flush" id="all_controller_display">

            </ul>
        </div>

    </div>
</div>
