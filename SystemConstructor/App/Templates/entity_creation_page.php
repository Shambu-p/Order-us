<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/14/2020
 * Time: 10:57 AM
 */

?>

<div class="row" id="create_entity_page" style="display: none">
    <div class="col-9">
        <div class="container">
            <br>

            <div class="form-row align-items-center">

                <button class="btn btn-dark" id="entity_creation_button">Create</button>

                <div class="col-sm-3 my-1">
                    <input type="text" class="form-control" id="entityNameInput" placeholder="Entity Name">
                </div>

                <div class="col-sm-3 my-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="e_model" value="model">
                        <label class="form-check-label" for="e_model">
                            also Create Model
                        </label>
                    </div>
                </div>
                <div class="col-sm-3 my-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="e_controller" value="controller">
                        <label class="form-check-label" for="e_controller">
                            also Create Controller
                        </label>
                    </div>
                </div>

            </div>
            <br>

        </div>
    </div>
    <div class="col">

        <li class="list-group-item bg-dark text-white">All the Entities you have created</li>
        <br>
        <div class="container" >
            <ul class="list-group list-group-flush" id="all_entity_display">

                <li class="list-group-item bg-light">Cras justo odio</li>
                <li class="list-group-item bg-light">Dapibus ac facilisis in</li>
                <li class="list-group-item bg-light">Morbi leo risus</li>
                <li class="list-group-item bg-light">Porta ac consectetur ac</li>
                <li class="list-group-item bg-light">Vestibulum at eros</li>
            </ul>
        </div>

    </div>
</div>
