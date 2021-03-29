<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 9:10 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<form action="<?php
if($this->request->type == "flier_card"){
    print $this->router_address("Orders.flier_preference");
}
else if($this->request->type == "business_card"){
    print $this->router_address("Orders.business_preference");
}
else if($this->request->type == "wedding_card"){
    print $this->router_address("Orders.wedding_preference");
}
?>" method="post">

    <h2 class="display-5" style="text-align: center">
        Card Preference
    </h2>
    <br>

    <label for="cardSize">
        Here select the size of card.
    </label>
    <select class="form-control form-control-lg" name="card_size" id="cardSize" required>
        <option value="first">size one</option>
        <option value="second">size two</option>
        <option value="third">size three</option>
    </select>

    <!--
    <label for="cardType">
        Here Select card Type
    </label>
    <select class="form-control form-control-lg" name="card_type" id="cardType" required>
        <option value="flier">Flier</option>
        <option value="business">Business</option>
        <option value="wedding">Wedding</option>
    </select>
    -->

    <div class="form-group">
        <label for="amount">
            Amount/How many
        </label>
        <input type="number" class="form-control" name="amount" id="amount" value="1" required>
    </div>

    <button class="btn btn-dark" type="submit" name="design_for" value="card">
        Submit
    </button>

</form>

<?php
$this->loadTemplate("layouts/order_footer.php");
