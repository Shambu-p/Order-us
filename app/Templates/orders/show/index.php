<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/20/2020
 * Time: 8:42 AM
 */

$this->loadTemplate("header2.php");
?>

<div class="container" style="overflow-x: auto;">

    <?php

    if(isset($this->request->data)){

        $data = (array) $this->request->data;

        foreach($data as $order){

            print '
            
            <div class="card text-white bg-dark mb-3">
                <div class="card-header"><h3>'.$order->type.'</h3></div>
                <div class="card-body">
                    <h4 class="card-title">
                        '.$order->type.'
                    </h4>
                    <p class="card-text">
                        Order Number: '.$order->id.' <br>
                        Customer: '.$order->full_name.' <br>
                        Phone Number: <strong>'.$order->phone_number.'</strong> <br>
                        Email: '.$order->email.' <br>
                        <strong>
                            Status: '.$order->status.' <br>
                            <big>Payment: '.$order->payment.' Birr</big> <br>
                        </strong>
                        <small class="text-muted"><strong>';

            if(isset($order->order_date) && $order->order_date != ""){

                print "Order on ".date("d m Y", $order->order_date);

            }
            else{

                print "order date not set";

            }

            if(isset($order->return_date) && $order->return_date != ""){

                print " will be return on ".date("d m Y", $order->return_date);

            }
            else{

                print " return date not set ";

            }

                        print '</strong></small>
                    </p>
                    <a href="'.Route::goRouteAddress("Orders.view", ["order" => $order->id]).'" type="button" class="btn btn-primary">View</a>
                    ';

            if($order->status == "request"){

                print '
                <a href="'.Route::goRouteAddress("Orders.change_status", ["order" => $order->id, "status" => "decline"]).'" type="button" class="btn btn-danger">Decline</a>
                
                ';

            }
            else if($order->status == "preview"){

                print '
                
                <a href="'.Route::goRouteAddress("Previews.show", ["order" => $order->id]).'" type="button" class="btn btn-secondary">Previews</a>
                
                ';

            }
            else if($order->status == "approved" && isset($_SESSION["login"]) && $_SESSION["login"] == "true" && isset($_SESSION["role"]) && $_SESSION["role"] == "cashier"){

                print '
                
                <a href="'.Route::goRouteAddress("Orders.change_status", ["order" => $order->id, "status" => "payed"]).'" type="button" class="btn btn-secondary">Payed</a>
                
                ';

            }
            else if($order->status == "payed" && $order->designer == "" && isset($_SESSION["login"]) && $_SESSION["login"] == "true" && isset($_SESSION["role"]) && $_SESSION["role"] == "director"){

                print '
                
                <a href="'.Route::goRouteAddress("Users.assign_designer", ["order" => $order->id]).'" type="button" class="btn btn-secondary">Assign Designer</a>
                
                ';

            }


            print'                    
                    
                </div>
            </div>
            
            ';

        }

    }

    ?>



</div>

<?php
$this->loadTemplate("footer2.php");
?>
