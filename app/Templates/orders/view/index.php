<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/5/2020
 * Time: 12:47 AM
 */

if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    $this->loadTemplate("header2.php");


}else{

    $this->loadTemplate("header.php");

}

?>

<div class="row">

    <div class="col"></div>

    <div class="col-xl-8 col-lg-10 col-md-10 col-sm-12">

            <?php

            if(isset($this->request->order) && $this->request->order != ""){

                print '

                <ul class="list-group">
                    <li class="list-group-item bg-info text-white">
                        <h1 class="display-4" style="text-align: center">
                            Order
                        </h1>
                    </li>
                
                <li class="list-group-item">
                    <strong><big>Order Number:</big></strong> '.$this->request->order->id.'
                </li>
                <li class="list-group-item">
                    <strong><big>Customer:</big></strong> '.$this->request->order->full_name.'
                </li>
                <li class="list-group-item">
                    <strong><big>Email:</big></strong> '.$this->request->order->email.'
                </li>
                <li class="list-group-item">
                    <strong><big>Phone Number:</big></strong> '.$this->request->order->phone_number.'
                </li>
                
               
                <li class="list-group-item">
                    <strong><big>Designer:</big></strong> '.$this->request->order->designer;
                if($this->request->order->designer != "not_assigned" && $this->request->order->status != "finished" && $this->request->order->status != "printing" && $this->request->order->status != "received"){

                    if(isset($_SESSION["login"]) && $_SESSION["login"] == "true" && $_SESSION["role"] == "director"){

                        print '
                    
                        <a href="' . Route::goRouteAddress("Users.assign_designer", ["order" => $this->request->order->id, "change" => ""]) . '" type="button" class="btn btn-dark">Change</a>
                        
                        ';

                    }

                }

                print '
                </li>
                <li class="list-group-item">
                    <strong><big>Order Amount:</big></strong> '.$this->request->order->amount.'
                </li>
                <li class="list-group-item">
                    <strong><big>Order Date:</big></strong> ';

                print date("d/M/Y", $this->request->order->order_date).'</li>';

                if($this->request->order->return_date != ""){

                    $r_date = date("d/M/Y", $this->request->order->return_date);

                    print '
                    
                    <li class="list-group-item">
                        <strong><big>Return Date:</big></strong> '.$r_date.'
                    </li>
                    
                    ';

                }
                else {

                    print '
                    
                    <li class="list-group-item">
                        <strong><big>Return Date:</big></strong> not Set
                    </li>
                    
                    ';

                }

                if(isset($_SESSION["role"])){

                    if($_SESSION["role"] != "designer"){

                        print '
                    
                        <li class="list-group-item">
                            <strong><big>Payment:</big></strong> '.$this->request->order->payment.'
                        </li>
                        
                        ';

                    }

                }
                else{

                    print '
                    
                        <li class="list-group-item">
                            <strong><big>Payment:</big></strong> '.$this->request->order->payment.'
                        </li>
                        
                        ';

                }

                print '
                
                <li class="list-group-item">
                    <strong><big>Status:</big></strong> '.$this->request->order->status.'
                </li>
                <li class="list-group-item">
                    <strong><big>Additional Preference:</big></strong> <br>
                    '.$this->request->order->text.'
                </li>
                
                ';

                if(isset($this->request->order->type) && $this->request->order->type == "banner"){

                    print '
                
                <li class="list-group-item bg-light">
                    <strong><big>Banner</big></strong>
                </li>
    
                <li class="list-group-item">
                    <strong><big>Banner Material:</big></strong> '.$this->request->order->other_preference->material.'
                </li>
                <li class="list-group-item">
                    <strong><big>Banner Width:</big></strong> '.$this->request->order->other_preference->width.'
                </li>
                <li class="list-group-item">
                    <strong><big>Banner Height:</big></strong> '.$this->request->order->other_preference->height.'
                </li>
                
                ';

                }
                else if(isset($this->request->order->type) && $this->request->order->type == "card"){

                    print '
                
                <li class="list-group-item bg-light">
                    <strong><big>Card</big></strong>
                </li>
                <li class="list-group-item">
                    <strong><big>Card Type:</big></strong> '.$this->request->order->other_preference->type.'
                </li>
                <li class="list-group-item">
                    <strong><big>Card Size:</big></strong> '.$this->request->order->other_preference->size.'
                </li>
                <li class="list-group-item">
                    <strong><big>Card Design:</big></strong>
                    <a href="'.Route::goRouteAddress("Designs.view", ["design" => $this->request->order->other_preference->design]).'" class="btn btn-primary btn-sm">Card Design</a>
                </li>
                    
                ';

                }
                else if(isset($this->request->order->type) && $this->request->order->type == "cup"){

                    print '
                
                <li class="list-group-item bg-light">
                    <strong><big>Cup</big></strong>
                </li>
                <li class="list-group-item">
                    <strong><big>Cup Color:</big></strong> '.$this->request->order->other_preference->color.'
                </li>
                <li class="list-group-item">
                    <strong><big>Cup Size:</big></strong> '.$this->request->order->other_preference->size.'
                </li>
    
                ';

                }
                else if(isset($this->request->order->type) && $this->request->order->type == "shirt"){

                    print '
                
                <li class="list-group-item bg-light">
                    <strong><big>T-Shirt</big></strong>
                </li>
                <li class="list-group-item">
                    <strong><big>Shirt Material:</big></strong> '.$this->request->order->other_preference->type.'
                </li>
                <li class="list-group-item">
                    <strong><big>Shirt Size:</big></strong> '.$this->request->order->other_preference->size.'
                </li>
                <li class="list-group-item">
                    <strong><big>Shirt Color:</big></strong> '.$this->request->order->other_preference->color.'
                </li>
                
                ';

                }

                if($this->request->order->type != "card"){

                    print '
                
                <li class="list-group-item">
                    
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Suggested Image</h5>
                      </div>
                      <img class="card-img-top" src="'; Loader::imageAddress("preview_images/".$this->request->order->suggested_image); print '" alt="Card image cap">
                    </div>
                    
                </li>
                
                ';

                }
                else{

                    print '
                
                <li class="list-group-item">
                    
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Suggested Image</h5>
                      </div>
                      <img class="card-img-top" src="'; Loader::imageAddress("design_images/".$this->request->order->suggested_image); print '" alt="Card image cap">
                    </div>
                    
                </li>
                
                ';

                }

                if(isset($_SESSION["order"]["order_number"]) && $_SESSION["order"]["order_number"] != ""){

                    print '
                    <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-primary" href="'.Route::goRouteAddress("Orders.exit_order").'" >Exit</a>
                    ';

                    if($this->request->order->status == "preview"){

                        print '
                            <a href="' . Route::goRouteAddress("Previews.show", ["for" => "printing", "" => "", "order" => $this->request->order->id]) . '" type="button" class="btn btn-dark">Previews</a>
                        ';

                    }
                    else if($this->request->order->status == "finished"){

                        print '
                            <a href="'.Route::goRouteAddress("Orders.change_status", ["order" => $this->request->order->id, "status" => "received"]).'" type="button" class="btn btn-success">Received</a>
                        ';

                    }

                    print '
                    </div>
                    </li>
                    
                    ';

                }
                else if(isset($_SESSION["login"]) && isset($_SESSION["role"])) {

                    if ($_SESSION["role"] == "director") {

                        print '
                     
                    <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic example">
                        ';

                        if ($this->request->order->status == "request") {

                            print '
                        
                            <a href="' . Route::goRouteAddress("Orders.decline", ["order" => $this->request->order->id]) . '" type="button" class="btn btn-danger">Decline</a>
                        ';

                        }
                        else if ($this->request->order->status == "preview") {

                            print '
                            
                           <a href="' . Route::goRouteAddress("Previews.show", ["for" => "acceptance", "" => "", "order" => $this->request->order->id]) . '" type="button" class="btn btn-dark">Previews</a>
                            
                            
                            ';

                        }
                        else if ($this->request->order->status == "payed") {

                            if ($this->request->order->designer == "not_assigned") {

                                print '
                            
                                <a href="' . Route::goRouteAddress("Users.assign_designer", ["order" => $this->request->order->id]) . '" type="button" class="btn btn-dark">Assign Designer</a>
                                
                                ';

                            }
                            else{

                                print '
                            
                                <a type="button" class="btn btn-dark" href="' . Route::goRouteAddress("Orders.set_to_preview", ["order" => $this->request->order->id]) . '">Set to Preview</a>
                                <a type="button" class="btn btn-dark" href="' . Route::goRouteAddress("Previews.show", ["for" => "acceptance", "" => "", "order" => $this->request->order->id]) . '">Previews</a>
                                
                                ';

                            }

                        }
                        else if ($this->request->order->status == "printing") {

                            print '
                            
                           <a href="'.Route::goRouteAddress("Orders.change_status", ["order" => $this->request->order->id, "status" => "finished"]).'" type="button" class="btn btn-dark">Finish</a>
                            
                            
                            ';

                        }

                        print '
                    
                        </div>
                    </li>
                    
                    ';


                        if($this->request->order->status == "request"){

                            print '
                        <li class="list-group-item">
                            <form action="'.Route::goRouteAddress("Orders.change_status").'" method="post">
            
                                <label for="returnDate">
                                    Set Return Date and Approve Order Request. Set the number of Days after today
                                </label>
                                <div class="form-row">
                                    <div class="col-lg-10 col-sm-10 col-8">
                                        <input type="hidde" class="invisible"  id="returnDate" placeholder="number of days" name="order" value="'.$this->request->order->id.'">
                                        <input type="number" class="form-control" name="return_date"  id="returnDate" placeholder="number of days">
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-4">
                                    <br>
                                        <button type="submit" class="btn btn-success" name="status" value="approved">Approve</button>
                                    </div>
                                </div>
            
                            </form>
                        </li>
                        ';

                        }


                    }
                    else if ($_SESSION["role"] == "cashier") {

                        if ($this->request->order->status == "approved") {

                            print '
                        <li class="list-group-item">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="'.Route::goRouteAddress("Orders.change_status").'" method="post">
                            
                                <input type="hidden" style="display: none;" name="order" value="'.$this->request->order->id.'">
                                <input type="hidden" style="display: none;" name="status" value="payed">
                                <button type="submit" class="btn btn-success">Payed</button>
                                
                            </form>
                                
                            </div>
                        </li>
                        ';

                        }

                    }
                    else if ($_SESSION["role"] == "designer") {

                        if ($this->request->order->status == "payed") {

                            print '
                        <li class="list-group-item">
                            
                            <form enctype="multipart/form-data" action="'.Route::goRouteAddress("Previews.save").'" method="post">
            
                                <div class="input-group">
                                    <input type="number" name="order" value="'.$this->request->order->id.'" style="display: none;">
                                    <input type="text" name="designer" value="'.$_SESSION["username"].'" style="display: none;">
                                    <input required type="file" name="inputImage" class="form-control form-control-lg" aria-label="Recipient\'s username with two button addons" aria-describedby="button-addon4">
                                    <div class="input-group-append" id="button-addon4">
                                        <button class="btn btn-light" type="submit">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="'; Loader::imageAddress("attach.png"); print '" alt="Attach" width="30"> <strong><big> |</big></strong>
                                                </div>
                                                <div class="col">
                                                    <strong><big>Add Preview</big></strong>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                    
                            </form>
                            
                        </li>
                        
                        <li class="list-group-item">
                            <a href="'.Route::goRouteAddress("OrdersDesigners.finish_order", ["order" => $this->request->order->id, "designer" => $_SESSION["username"]]).'" class="btn btn-dark btn-sm">Finish</a>
                        </li>
                      
                        ';

                        }

                    }

                }

                print '</ul>';

            }
            else if(isset($this->request->check_order)){

                print '
                
                <div class="row">
                    <div class="col">
        
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-10 col-xl-8 shadow p-3 mb-5 rounded bg-light">
                        <div class="container">
                            <h1 class="display-4" style="text-align: center;">
                                Check your Order
                            </h1>
                            <br>
        
                            <form action="'.Route::goRouteAddress("Orders.view") .'" method="post">
                                <div class="form-group">
                                    <input type="number" class="form-control bg-light" id="InputUsername" name="order" placeholder="Enter Order Number">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="password" class="form-control bg-light" id="InputPassword" name="password" placeholder="Password">
                                </div>
        
                                <button type="submit" class="btn btn-dark">Check</button>
                            </form>
                        </div>
                    </div>
                    <div class="col">
        
                    </div>
                </div>
                
                ';

            }
            if(isset($this->request->order_received) && $this->request->order_received != "" ){

                print '
                <br>
                <br>
                <div class="alert alert-success" role="alert">
                    <h3 class="alert-heading">
                        <strong>ORDER NUMBER '.$this->request->order_received.' IS DELIVERED!</strong>
                    </h3>
                    <p>
                        If You are seeing this page this means you have received the order that you order before.
                    </p>
                    <hr>
                    <p class="mb-0">
                        If you want any of our products you can order by using our website. <strong><big>Thanks for choosing us.</big></strong>
                    </p>
                    <br>
                    <a class="btn btn-success" href="'.Route::goRouteAddress("Orders.exit_order").'">
                    <div class="row">
                        <div class="col"><img src="'; Loader::imageAddress("tick.png"); print '" alt="image" width="30"></div>
                        <div class="col"><strong><big>Ok</big></strong></div>
                    </div>
                    </a>
                </div>
                ';

            }

            ?>

        <br>

        <div class="modal fade" id="myConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Order Cancelling
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        If you cancel the Request you will stop the production of the product and you will not get the money you pay.
                        and we will not be accountable for the fee. <br>
                        <strong><big>Do You Really want to cancel The Request?</big></strong>
                    </div>
                    <div class="modal-footer">
                        <a href="#" type="button" class="btn btn-danger" data-dismiss="modal">Yes</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col"></div>

</div>

<?php

if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    $this->loadTemplate("footer2.php");

}else{

    $this->loadTemplate("footer.php");

}

?>
