<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 9:33 AM
 */

$this->loadTemplate("layouts/open_header.php");
?>

<div class="row">

    <div class="col"></div>
    <div class="col-sm-12 col-md-6 col-lg-6 p-sm-3">
        <div class="alert alert-success" role="alert">
            <h3 class="alert-heading">
                <strong>Your Order Number is </strong> <?php //print $this->request->order_number; ?>
            </h3>
            <p>
                You should Remember your order number to view your order state and to take
                necessary actions on the way.
            </p>
            <hr>
            <p class="mb-0">
                You have sent the order Successfully wait until it is approved and
                <strong>
                    <big>
                        Remember your Order number and Password
                    </big>
                </strong>
                you enter.
            </p>
            <br>
            <a class="btn btn-success" href="<?php print $this->route_address("Orders.re_init"); ?>">
                <div class="row">
                    <div class="col">
                        <img src="<?php print $this->load_img("tick.png"); ?>" alt="image" width="30">
                    </div>
                    <div class="col">
                        <strong>
                            <big>
                                Ok
                            </big>
                        </strong>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col"></div>

</div>


<?php
$this->loadTemplate("layouts/open_footer.php");
