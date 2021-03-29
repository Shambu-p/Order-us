<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 1:23 PM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<form action="<?php print $this->route_address("Orders.initialize_order"); ?>" method="post">

    <h2 class="display-5" style="text-align: center">
        Order Initialization
    </h2>
    <br>

    <label for="orderType">
        Here select on what type of material you want to order.
    </label>
    <select class="form-control form-control-lg" name="type" required id="orderType">
        <option value="shirt">T-Shirt</option>
        <option value="banner">Banner</option>
        <option value="cup">Cup</option>
        <option value="business_card">Business Card</option>
        <option value="wedding_card">Wedding Card</option>
        <option value="flier_card">Fliers</option>
    </select>

    <br>

    <button class="btn btn-dark" type="submit" name="shirt_design">
        Submit
    </button>

</form>

<?php
$this->loadTemplate("layouts/order_footer.php");
