<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 6:04 PM
 */

$this->loadTemplate("layouts/open_header.php");

if(isset($this->request->order) && $this->request->order != ""){

    print '

    <ul class="list-group">
        <li class="list-group-item bg-dark text-white">
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
            <a href="' . $this->route_address("Users.assign_designer", ["order" => $this->request->order->id, "change" => ""]) . '" type="button" class="btn btn-dark">Change</a>
            ';

        }

    }

    print '
        </li>
        <li class="list-group-item">
            <strong><big>Order Amount:</big></strong> '.$this->request->order->amount.'
        </li>
        <li class="list-group-item">
            <strong><big>Order Date:</big></strong>
    ';

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

    print '
    <li class="list-group-item">
        <strong><big>Payment:</big></strong> '.$this->request->order->payment.'
    </li>
                
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
                
    <li class="list-group-item">
        <strong><big>Status:</big></strong> '.$this->request->order->status.'
    </li>
    <li class="list-group-item">
        <strong><big>Additional Preference:</big></strong> <br>
        '.$this->request->order->text.'
    </li>
    
    
    <li class="list-group-item bg-light">
        <strong><big>'.strtoupper($this->request->order->type).'</big></strong>
    </li>';

    foreach ($this->request->order->preferences as $key => $value){

        print '
        
        <li class="list-group-item">
            <strong><big>'.strtoupper($key).':</big></strong> '.$value.'
        </li>
        
        ';

    }

    print '

    <li class="list-group-item">
        <div class="btn-group" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-primary" href="'.$this->route_address("Orders.exit_order").'" >Exit</a>
    ';

    if($this->request->order->status == "preview"){

        print '
        <a href="' . $this->route_address("Previews.show", ["for" => "printing", "" => "", "order" => $this->request->order->id]) . '" type="button" class="btn btn-dark">Previews</a>
        ';

    }
    else if($this->request->order->status == "finished"){

        print '
        <a href="'.$this->route_address("Orders.change_status", ["order" => $this->request->order->id, "status" => "received"]).'" type="button" class="btn btn-success">Received</a>
        ';

    }

    print '
    </div>
    </li>
    ';

    if($this->request->order->type != "card"){

        print '
                
        <li class="list-group-item">
            
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Suggested Image</h5>
              </div>
              <img class="card-img-top" src="'.$this->load_img("preview_images/".$this->request->order->suggested_image).'" alt="Card image cap">
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
              <img class="card-img-top" src="'.$this->load_img("design_images/".$this->request->order->suggested_image).'" alt="Card image cap">
            </div>
                
        </li>
        ';

    }

    print '</ul>';

    if($this->request->order->design){
        $design = $this->request->order->design;

        print '
        
        <li class="list-group-item">
        
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Design Image</h5>
              </div>
              <img class="card-img-top" src="'.$this->load_img("design_images/".$design->image).'" alt="Card image cap">
            </div>
            
        </li>
        
        ';

    }

    if($this->request->order->suggested_image){

        print '
        
        <li class="list-group-item">
        
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Suggested Image</h5>
              </div>
              <img class="card-img-top" src="'.$this->load_img("suggested_images/".$this->request->order->suggested_image).'" alt="Card image cap">
            </div>
            
        </li>
        
        ';

    }

}

$this->loadTemplate("layouts/open_footer.php");

?>



