<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/13/2020
 * Time: 4:43 PM
 */

$this->loadTemplate("layouts/open_header.php");
?>

<div class="row pl-lg-5 pl-sm-3 pr-lg-5 pr-sm-3">
    <div class="col-sm-12 col-md-5 col-lg-3">

        <div class="list-group">
            <a href="<?php print $this->route_address("Designs.open_designs", ["type" => "cup"]); ?>" class="list-group-item list-group-item-action">Cup Designs</a>
            <a href="<?php print $this->route_address("Designs.open_designs", ["type" => "banner"]); ?>" class="list-group-item list-group-item-action">Banner Designs</a>
            <a href="<?php print $this->route_address("Designs.open_designs", ["type" => "shirt"]); ?>" class="list-group-item list-group-item-action">T-Shirt Designs</a>
            <a href="<?php print $this->route_address("Designs.open_designs", ["type" => "wedding_card"]); ?>" class="list-group-item list-group-item-action">Wedding Card Designs</a>
            <a href="<?php print $this->route_address("Designs.open_designs", ["type" => "flier_card"]); ?>" class="list-group-item list-group-item-action">Flier Card Designs</a>
            <a href="<?php print $this->route_address("Designs.open_designs", ["type" => "business_card"]); ?>" class="list-group-item list-group-item-action">Business Card Designs</a>
        </div>

    </div>
    <div class="col">

            <?php

            if(isset($this->request->designs) && sizeof((array) $this->request->designs)){

                $data = (array) $this->request->designs;
                
                print '<div class="card-columns">';

                foreach($data as $n => $preview){

                    print '
                        <div class="card" style="width: 17rem;">
                            <img class="card-img-top" width="100%" src="'.$this->load_img("design_images/$preview->image").'" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"> <strong>Title: </strong>'.$preview->name.'</h5>
                                <h5 class="card-title"> <strong>Price: </strong>'.$preview->price.' Birr</h5>
                                <p class="card-text">
                                    Designed by <a href="#" class="btn btn-link" >'.$preview->designer->f_name." ".$preview->designer->l_name.'</a>
                                </p>
                                <form class="m-0 p-0" action="'.$this->route_address("Orders.init_by_design", ["type" => $preview->type, "design" => $preview->id]).'" method="post">
                                    <input type="hidden" name="type" value="'.$preview->type.'">
                                    <input type="hidden" name="design" value="'.$preview->id.'">
                                    <input type="hidden" name="payment" value="'.$preview->price.'">
                                    <button type="submit" class="btn btn-sm btn-primary">Order</button>
                                </form>
                            </div>
                        </div>
                    ';

                }

                print '</div>';

            }
            else{
                print '
                
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">No Designs Yet</h1>
                    </div>
                </div>
                
                ';
            }

            ?>

    </div>
</div>

<?php
$this->loadTemplate("layouts/open_footer.php");
