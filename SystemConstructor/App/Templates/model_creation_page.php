<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/11/2020
 * Time: 11:06 AM
 */

?>

<div class="row" id="create_model_page" style="display: none">
    <div class="col-9">
        <div class="container">
            <br>

            <div class="form-row align-items-center">

                <button class="btn btn-dark" id="model_creation_button">Create</button>

                <div class="col-sm-3 my-1">
                    <input type="text" class="form-control" id="modelNameInput" placeholder="Model Name">
                </div>

                <div class="col-sm-3 my-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="m_entity" value="entity">
                        <label class="form-check-label" for="m_entity">
                            also Create Entity
                        </label>
                    </div>
                </div>
                <div class="col-sm-3 my-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="m_controller" value="controller">
                        <label class="form-check-label" for="m_controller">
                            also Create Controller
                        </label>
                    </div>
                </div>

            </div>
            <br>

        </div>
    </div>
    <div class="col-3" >

        <li class="list-group-item bg-dark text-white">All the models you have created</li>
        <br>
        <div class="container" >
            <ul class="list-group list-group-flush" id="all_model_display">

                <li class="list-group-item bg-light">Cras justo odio</li>
                <li class="list-group-item bg-light">Dapibus ac facilisis in</li>
                <li class="list-group-item bg-light">Morbi leo risus</li>
                <li class="list-group-item bg-light">Porta ac consectetur ac</li>
                <li class="list-group-item bg-light">Vestibulum at eros</li>
            </ul>
        </div>

    </div>
</div>
