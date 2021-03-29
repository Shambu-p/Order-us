<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 9:07 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<form action="<?php print $this->route_address("Orders.cup_preference"); ?>" method="post" >

    <h2 class="display-5" style="text-align: center">
        Cup Preference
    </h2> <br>
    
    <label for="cupSize">
        Here select the size of Cup.
    </label>
    <select class="form-control form-control-lg" name="cup_size" id="cupSize" required>
        <option value="sm">Small</option>
        <option value="md">Medium</option>
        <option value="lg">Large</option>
    </select>
    
    <label for="cupColor">
        Here select Cup Color
    </label>
    <select class="form-control form-control-lg" name="cup_color" id="cupColor" required>
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
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    
    <button class="btn btn-dark" type="submit" name="design_for" value="cup">
        Submit
    </button>

</form>

<?php
$this->loadTemplate("layouts/order_footer.php");
