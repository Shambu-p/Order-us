<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/29/2020
 * Time: 10:54 AM
 */

$this->loadTemplate("layouts/open_header.php");
?>


<div class="row pl-3 pr-3">
    <div class="col"></div>
    <div class="alert-success col-sm-10 col-lg-4 shadow rounded p-3">

        You order has been sent Successfully.
        <hr>
        To check your order you have to remember your <strong>Order Number</strong> and your <strong>Password</strong> <br>
        Your order number is <b> <?php print $this->request->order; ?> </b>
        <hr>
        Thank you for choosing Smart Techno

    </div>
    <div class="col"></div>
</div>


<?php
$this->loadTemplate("layouts/open_footer.php");
