<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 9:26 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<ul class="list-group">
    <li class="list-group-item bg-info text-white">
        <h1 class="display-4" style="text-align: center">
            Order
        </h1>
    </li>
    <li class="list-group-item bg-light">
        <strong><big>All Design Preferences</big></strong>
    </li>

    <?php

    foreach ($_SESSION["design_preference"] as $key => $value){

        print '
    
        <li class="list-group-item">
            <strong><big>'.$key.':</big></strong> '.$value.'
        </li>
    
        ';

    }

    print '

    <li class="list-group-item bg-light">
        <strong><big>All Information</big></strong>
    </li>

    ';

    foreach ($_SESSION["order"] as $key => $value){

        if(($key == "address" && $value == "") || $key == "suggested_image"){
        continue;
        }

        if($key == "password"){

            print '
        
            <li class="list-group-item">
                <strong><big>'.$key.':</big></strong> ********
            </li>
        
            ';
            continue;

        }

        print '
    
        <li class="list-group-item">
            <strong><big>'.$key.':</big></strong> '.$value.'
        </li>
    
        ';

    }

    print '

    <li class="list-group-item">

        <a href="'.$this->route_address("Orders.save").'" type="button" class="btn btn-success">Send Order</a>
        <a href="'.$this->route_address("Orders.re_init").'" type="button" class="btn btn-danger">Cancel Order</a>

    </li>
    ';

    ?>
</ul>

<?php
$this->loadTemplate("layouts/order_footer.php");
