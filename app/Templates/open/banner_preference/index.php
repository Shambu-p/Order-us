<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 8:56 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<form action="<?php print $this->route_address("Orders.banner_preference"); ?>" method="post">

    <h2 class="display-5" style="text-align: center">
        Banner Preference
    </h2> <br>

    <label for="bannerMaterial">
        Here select the material type which the banner should be made of.
    </label>
    <select class="form-control form-control-lg" name="banner_material" id="bannerMaterial" required>
        <option value="first">First</option>
        <option value="second">Second</option>
        <option value="third">Third</option>
    </select>

    <div class="form-group">
        <label for="bannerWidth">
            Width
        </label>
        <input type="number" class="form-control" name="banner_width" id="bannerWidth" placeholder="Banner Width" required>
    </div>
    <div class="form-group">
        <label for="bannerHeight">
            Height
        </label>
        <input type="number" class="form-control" name="banner_height" id="bannerHeight" placeholder="Banner Height" required>
    </div>

    <div class="form-group">
        <label for="amount">
            Amount/How many
        </label>
        <input type="number" class="form-control" name="amount" id="amount" value="1" required>
    </div>

    <button class="btn btn-dark" type="submit" name="design_for" value="banner">
        Submit
    </button>

</form>

<?php
$this->loadTemplate("layouts/order_footer.php");
