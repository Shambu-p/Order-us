<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/15/2020
 * Time: 11:23 AM
 */

$this->loadTemplate("header2.php");
?>

<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Order Number</th>
            <th scope="col">status</th>
            <th scope="col">Option</th>
        </tr>
        </thead>
        <tbody>

        <?php

        if(isset($this->request->data)){

            $data = (array) $this->request->data;

            foreach($data as $order){

                print '
                
                <tr>
                    <th scope="row">'.$order->orders.'</th>
                    <td>'.$order->status.'</td>
                    <td>
                        <a type="button" class="btn btn-primary btn-sm" href="'.Route::goRouteAddress("Orders.view", ["order" => $order->orders]).'">view</a>
                    </td>
                </tr>
                
                ';

            }

        }

        ?>
        </tbody>
    </table>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

</div>

<?php
$this->loadTemplate("footer2.php");
?>
