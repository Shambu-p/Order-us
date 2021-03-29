<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/16/2020
 * Time: 2:38 PM
 */

$this->loadTemplate("layouts/designer_header.php");
?>

    <div class="table-responsive mt-5">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Order Type</th>
                <th>Amount</th>
                <th>status</th>
                <th>opt</th>
            </tr>
            </thead>
            <tbody>

            <?php

            if(isset($this->request->data) && sizeof((array) $this->request->data)){

                $orders = $this->request->data;

                foreach ($orders as $order){

                    print '
                    
                    <tr>
                        <td>'.$order->orders->id.'</td>
                        <td>'.$order->orders->full_name.'</td>
                        <td>'.$order->orders->type.'</td>
                        <td>'.$order->orders->amount.'</td>
                        <td>'.$order->status.'</td>
                        <td>
                            <a class="card-link small" href="'.$this->route_address("Orders.designer_view", ["order" => $order->orders->id]).'">View</a>
                        </td>
                    </tr>
                    
                    ';

                }

            }
            else{

                print '
                    </tbody>
                </table>
                <tr>
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No Order</h1>
                        </div>
                    </div>
                </tr>
                ';

            }

            ?>
            </tbody>
        </table>
    </div>

<?php
$this->loadTemplate("layouts/admin_footer.php");
