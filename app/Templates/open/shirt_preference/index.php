<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 8:59 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<form action="<?php print $this->route_address("Orders.shirt_preference"); ?>" method="post">

    <h2 class="display-5" style="text-align: center">
        T-Shirt Preference
    </h2>
    
    <br>
    <label for="shirtMaterial">
        Here select the material type which the Shirt should be made of.
    </label>
    <select class="form-control form-control-lg" name="shirt_type" id="shirtMaterial" required>
        <option value="first">First</option>
        <option value="second">Second</option>
        <option value="third">Third</option>
    </select>
    
    <label for="shirtSize">
        Here select the size of Shirt.
    </label>
    <select class="form-control form-control-lg" name="shirt_size" id="shirtSize" required>
        <option value="xs">Extra Small</option>
        <option value="sm">Small</option>
        <option value="md">Medium</option>
        <option value="lg">Large</option>
        <option value="xl">Extra Large</option>
    </select>
    
    <label for="shirtColor">
        Here select shirt Color
    </label>
    <select class="form-control form-control-lg" name="shirt_color" id="shirtColor" required>
        <option value="black">Black</option>
        <option value="white">White</option>
        <option value="gray">Gray</option>
        <option value="red">Red</option>
        <option value="dark_red">Dark Red</option>
        <option value="blue">Blue</option>
        <option value="dark_blue">Dark Blue</option>
        <option value="pink">Pink</option>
    </select>
    
    <div class="form-group">
        <label for="amount">
            Amount/How many
        </label>
        <input type="number" class="form-control" name="amount" id="amount" value="1" required>
    </div>
    
    <button class="btn btn-dark" type="submit" name="design_for" value="shirt">
        Submit
    </button>

</form>

<?php
$this->loadTemplate("layouts/order_footer.php");
