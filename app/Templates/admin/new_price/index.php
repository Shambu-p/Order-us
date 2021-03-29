<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/18/2020
 * Time: 4:20 PM
 */

$this->loadTemplate("layouts/admin_header.php");
?>
<div class="row mt-5">

    <div class="col"></div>
    <div class="col-sm-11 col-md-10 col-lg-8 p-2">

        <form action="<?php print $this->route_address("Prices.save"); ?>" method="post">

            <h3 class="mb-4 text-center">New Price</h3>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="type_description">Type</span>
                </div>
                <select class="form-control" name="type" aria-label="Type" aria-describedby="type_description">
                    <option value="banner">Banner</option>
                    <option value="shirt">T-Shirt</option>
                    <option value="cup">Cup</option>
                    <option value="wedding_card">Wedding Card</option>
                    <option value="flier_card">Flier</option>
                    <option value="business_card">Business Card</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="for_determiner">Determiner</span>
                </div>
                <input type="text" name="determiner" class="form-control" placeholder="Determiner" aria-label="Determiner" aria-describedby="for_determiner">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="for_value">Value</span>
                </div>
                <input type="text" class="form-control" placeholder="Value" aria-label="Value" name="value" aria-describedby="for_value">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Price</span>
                </div>
                <input type="number" name="price" placeholder="Price in Ethiopian Birr" min="0" class="form-control" aria-label="Amount (to the nearest birr)">
                <div class="input-group-append">
                    <span class="input-group-text">Birr</span>
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-primary">Add Price</button>

        </form>

    </div>
    <div class="col"></div>

</div>

<?php
$this->loadTemplate("layouts/admin_footer.php");
