<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 11:19 AM
 */

$this->loadTemplate("layouts/open_header.php");
?>

<div class="row mt-3 p-3 mb-3">

    <div class="col-sm-10 col-lg-7 " >

        <div class="bg-white rounded-top shadow p-2 mb-2">
            <h4>Order</h4>
        </div>

        <div id="order_place">

        </div>

        <div id="preference_place">

        </div>
        <!-- statusii kan request button jiran kan nuuf fidu  -->
    </div>
    <div class="col">
        <div class="bg-white rounded shadow pl-3 p-2 mb-2">
            <h4 id="order_status" class="text-info"></h4>
            <div class="border-top pt-2">
                <!-- status database irra jiran gara deliverd, finished fi ... jijjiira -->
                <a id="set_to_preview" href="<?php print $this->route_address("Orders.set_to_preview", ["order" => $this->request->order]); ?>" class="btn btn-primary">Send to Preview</a>
                <a id="exit_order" href="<?php print $this->route_address("Orders.exit_order"); ?>" class="btn btn-primary">Exit Order</a>
                <a id="receive_order" href="<?php print $this->route_address("Orders.set_to_delivered", ["order" => $this->request->order]); ?>" class="btn btn-primary">Receive Order</a>
                <a id="set_to_finished" href="<?php print $this->route_address("Orders.set_to_finished", ["order" => $this->request->order]); ?>" class="btn btn-primary">Finished</a>
            </div>
        </div>

        <div class="bg-white rounded shadow pl-2 p-2 mb-2" id="assign_designer">

            <div class="border-bottom">
                <h4>Assign Designer</h4>
            </div>
            <div>
                <!-- order kamiif disigner kamtu ramadame kan jedhu adda baasa -->
                <form action="<?php print $this->route_address("OrdersDesigners.save"); ?>" method="post" class="input-group mt-2">
                    <select class="custom-select" id="assign_designer_select" name="designer" aria-label="assign designer">
                    </select>
                    <input type="hidden" class="form-control" name="order" value="<?php print $this->request->order; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Assign</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="bg-white rounded shadow pl-2 p-2 mb-2" id="order_approval">

            <div class="border-bottom">
                <h4>Order Approval</h4>
            </div>
            <div>
                <!-- approve fi deeclaini button fidan kan display nuuf godhudha -->
                <form action="<?php print $this->route_address("Orders.approve"); ?>" method="post" class="input-group mt-2">
                    <div class="input-group-prepend">
                        <a href="<?php print $this->route_address("Orders.admin_cancel", ["order", $this->request->order]); ?>" class="btn btn-danger">decline</a>
                    </div>
                    <input type="hidden" class="form-control" name="order" value="<?php print $this->request->order; ?>">
                    <input type="number" name="return_date" placeholder="order will be ready after" class="form-control" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Approve</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="bg-white rounded-top shadow pl-3 p-2 mb-2">
            <h4>Suggested Image</h4>
        </div>
        <div class="bg-white rounded-bottom shadow p-2 mb-2">
            <img class="rounded-bottom" width="100%" src="" id="suggested_image" alt="Card image cap">
        </div>

        <div class="bg-white rounded-top shadow pl-3 p-2 mb-2">
            <h4>Selected Design</h4>
        </div>
        <div class="bg-white rounded-bottom shadow p-2 mb-2" id="order_design">

        </div>

        <div class="bg-white rounded-top shadow p-2 mb-2">
            <h4>Previews</h4>
        </div>
        <div class="bg-white rounded-bottom shadow p-2 pt-3 pb-5" id="previews_container">
        </div>

    </div>
</div>

<?php
/*
if(isset($this->request->order) && sizeof((array)$this->request->order)){//

    $order = $this->request->order;

    foreach($order as $order_key => $order_value){

        if($order_key != "password" && $order_key != "type" && $order_key != "suggested_image" && $order_key != "preferences" && $order_key != "return_date"){

            print '
        
            <div class="row">
                <div class="col pr-1">
                    <div class="bg-white shadow p-2 mb-2">
                        <h5 class="text-right">'.strtoupper(str_replace("_", " ", $order_key)).'</h5>
                    </div>
                </div>
                <div class="col pl-1">
                    <div class="bg-white shadow p-2 mb-2">';

            if($order_key == "email"){
                print '<h5 class="text-left">'.$order_value.'</h5>';
            }else if($order_key == "order_date"){
                print '<h5 class="text-left">'.date("d/M/Y", $order_value).'</h5>';
            }else if($order_key == "designer"){
                if($order_value){
                    print '<h5 class="text-left">'.$order_value.'</h5>';
                }else{
                    print '<h5 class="text-left">not assigned';
                    print '</h5>';
                }
                print '<h5 class="text-left">'.$order_value.'</h5>';
            }else if($order_key == "return_date"){
                if($order_value){
                    print '<h4 class="text-left">'.date("d/M/Y", $order_value).'</h4>';
                }else{
                    print '<h4 class="text-left">not Set</h4>';
                }
            }else{
                print '<h4 class="text-left">'.$order_value.'</h4>';
            }

            print '
                    </div>
                </div>
            </div>
            
            ';

        }

    }

    print '
    <div class="bg-white shadow p-2 mt-2 mb-2">
        <h2>'.strtoupper(str_replace("_", " ", $order->type)).'</h2>
    </div>
    ';

    foreach ($order->preferences as $key => $value){

        print '
        
            <div class="row">
                <div class="col pr-1">
                    <div class="bg-white shadow p-2 mb-2">
                        <h4 class="text-right">'.strtoupper(str_replace("_", " ", $key)).'</h4>
                    </div>
                </div>
                <div class="col pl-1">
                    <div class="bg-white shadow p-2 mb-2">
                        <h4 class="text-left">'.strtoupper(str_replace("_", " ", $value)).'</h4>
                    </div>
                </div>
            </div>
            
            ';

    }

    print '
    <div class="bg-white shadow p-2 mb-2">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-primary" href="'.$this->route_address("Orders.exit_order").'" >Exit</a>
    ';

    if($order->status == "preview"){

        print '
        <a href="'.$this->route_address("Previews.show", ["for" => "printing", "" => "", "order" => $order->id]).'" type="button" class="btn btn-dark">Previews</a>
        ';

    }
    else if($order->status == "finished"){

        print '
        <a href="'.$this->route_address("Orders.change_status", ["order" => $order->id, "status" => "received"]).'" type="button" class="btn btn-success">Received</a>
        ';

    }

    print '
            </div>
        </div>
    </div>
    <div class="col">
    
        <div class="bg-info rounded shadow pl-3 p-2 mb-2">
            <h4>'.$order->status.'</h4>
        </div>
        
        <div class="bg-white rounded shadow pl-3 p-2 mb-2" id="assign_designer">
        
            <div class="border-bottom">
                <h4>Assign Designer</h4>
            </div>
            <div>
                <form action="'.$this->route_address("OrdersDesigners.save").'" method="post" class="input-group mt-2">
                    <select class="custom-select" id="assign_designer_select" name="designer" aria-label="assign designer">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Assign</button>
                    </div>
                </form>
            </div>
            
        </div>
        
        <div class="bg-white rounded shadow pl-3 p-2 mb-2" id="approve_order">
        
            <div class="border-bottom">
                <h4>Order Approval</h4>
            </div>
            <div>
                <form action="'.$this->route_address("OrdersDesigners.save").'" method="post" class="input-group mt-2">
                    <div class="input-group-prepend">
                        <a href="#" class="btn btn-danger">decline</a>
                    </div>
                    <input type="number" name="days" placeholder="order will be ready after" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Approve</button>
                    </div>
                </form>
            </div>
            
        </div>
    
        <div class="bg-white rounded-top shadow pl-3 p-2 mb-2">
            <h4>Suggested Image</h4>
        </div>
        <div class="bg-white rounded-bottom shadow p-2 mb-2">
            <img class="rounded-bottom" width="100%" src="" id="suggested_image" alt="Card image cap">  
        </div>
    
        <div class="bg-white rounded-top shadow p-2 mb-2">
            <h4>Previews</h4>
        </div>
        <div class="bg-white rounded-bottom shadow p-2 pt-3 pb-5" >
    ';
//'.$this->load_img("suggested_images/".$order->suggested_image).'
    if(isset($order->preview)){

        foreach($order->preview as $prev){

            print '';

        }

    }
    else{

        print '
            <h4 class="text-center">No preview</h4>
        ';

    }

    print '</div></div></div>';

}
else{

    print '
    
    <div class="jumbotron">
        <h2 class="display-4">Order Not Found</h2>
    </div>
   
    ';

}
*/

print '<script>';

//print 'var sug_img = "'.$this->request->order->suggested_image.'";';




print '
var constants = {

    preview_address: "'.$this->route_address("Previews.customer_view").'",
    preview_decline_address: "",
    preview_grant_address: "",
    preview_delete_address: "",
    preview_select_address: "'.$this->route_address("Previews.customer_select").'",
    design_address: "'.$this->route_address("Designs.selected_design").'",
    image_address: "'.$this->route_address("Archive.get_image").'",
    preference_address: "'.$this->route_address("Preferences.customer_view").'",
    order_address: "'.$this->route_address("Orders.customer_order").'",
    user_address: "'.$this->route_address("Users.active_designers").'",
    user: "customer",
    order_id: '.$this->request->order.'

};
';

print $this->load_js("my.js");

//print "hi";
print '</script>';

?>
<?php
$this->loadTemplate("layouts/open_footer.php");
