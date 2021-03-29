<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/9/2020
 * Time: 1:56 PM
 */

$this->loadTemplate("layouts/admin_header.php");
?>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Date</th>
                <th>opt</th>
            </tr>
            </thead>
            <tbody>

            <?php

            if(isset($this->request->orders) && sizeof((array) $this->request->orders)){

                $orders = $this->request->orders;

                foreach ($orders as $order){

                    print '
                    
                    <tr>
                        <td>'.$order->id.'</td>
                        <td>'.$order->full_name.'</td>
                        <td>'.$order->type.'</td>
                        <td>'.$order->amount.'</td>
                        <td>'.$order->payment.'</td>
                        <td>'.date("d-M-Y", $order->order_date).'</td>
                        <td>
                            <a class="card-link small" href="'.$this->route_address("Orders.admin_view", ["order" => $order->id]).'">View</a>
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
                            <h1 class="display-4">No new Order</h1>
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

