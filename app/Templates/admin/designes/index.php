<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/13/2020
 * Time: 4:43 PM
 */

$this->loadTemplate("layouts/admin_header.php");
?>

<div class="container mt-3 justify-content-center">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <?php
            if($this->request->type == "cup"){
                print '<a class="nav-link active" href="'.$this->route_address("Designs.admin_approval", ["type" => "cup"]).'">Cup</a>';
            }else{
                print '<a class="nav-link" href="'.$this->route_address("Designs.admin_approval", ["type" => "cup"]).'">Cup</a>';
            }
            ?>
        </li>
        <li class="nav-item">
            <?php
            if($this->request->type == "banner"){
                print '<a class="nav-link active" href="'.$this->route_address("Designs.admin_approval", ["type" => "banner"]).'">Banner</a>';
            }else{
                print '<a class="nav-link" href="'.$this->route_address("Designs.admin_approval", ["type" => "banner"]).'">Banner</a>';
            }
            ?>
        </li>
        <li class="nav-item">
            <?php
            if($this->request->type == "shirt"){
                print '<a class="nav-link active" href="'.$this->route_address("Designs.admin_approval", ["type" => "shirt"]).'">T-Shirt</a>';
            }else{
                print '<a class="nav-link" href="'.$this->route_address("Designs.admin_approval", ["type" => "shirt"]).'">T-Shirt</a>';
            }
            ?>
        </li>
        <li class="nav-item">
            <?php
            if($this->request->type == "wedding_card"){
                print '<a class="nav-link active" href="'.$this->route_address("Designs.admin_approval", ["type" => "wedding_card"]).'">Wedding Card</a>';
            }else{
                print '<a class="nav-link" href="'.$this->route_address("Designs.admin_approval", ["type" => "wedding_card"]).'">Wedding Card</a>';
            }
            ?>
        </li>
        <li class="nav-item">
            <?php
            if($this->request->type == "flier_card"){
                print '<a class="nav-link active" href="'.$this->route_address("Designs.admin_approval", ["type" => "flier_card"]).'">Flier Card</a>';
            }else{
                print '<a class="nav-link " href="'.$this->route_address("Designs.admin_approval", ["type" => "flier_card"]).'">Flier Card</a>';
            }
            ?>
        </li>
        <li class="nav-item">
            <?php
            if($this->request->type == "business_card"){
                print '<a class="nav-link active" href="'.$this->route_address("Designs.admin_approval", ["type" => "business_card"]).'">Business Card</a>';
            }else{
                print '<a class="nav-link " href="'.$this->route_address("Designs.admin_approval", ["type" => "business_card"]).'">Business Card</a>';
            }
            ?>
        </li>
    </ul>

    <?php

    if(isset($this->request->designs) && sizeof((array) $this->request->designs)){

        $data = (array) $this->request->designs;

        print '<div class="card-columns mt-3">';

        foreach($data as $n => $preview){

            if($preview->state == "new"){
                print '
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" width="100%" src="'.$this->load_img("design_images/$preview->image").'" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title mb-2"><strong>Title: </strong>'.$preview->name.'</h5>
                            <h5 class="card-title mb-2" id="price_display_'.$preview->id.'"><strong>Price: </strong>'.$preview->price.' Birr</h5>
                            <p class="card-text mb-2">
                                Designed by <a href="#" class="btn btn-link" >'.$preview->designer->f_name." ".$preview->designer->l_name.'</a>
                            </p>
                            <div class="m-0 p-0" id="approval_form_'.$preview->id.'">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger btn-sm" onclick="rejectDesign('.$preview->id.')">Reject</button>
                                    </div>
                                    <input type="number" id="price_input_'.$preview->id.'" class="form-control form-control-sm" placeholder="Price In Ethiopian Birr">
                                    <div class="input-group-append">
                                        <button class="btn btn-success btn-sm" onclick="approveDesign('.$preview->id.')">Approve</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
            else if($preview->state == "approved"){

                print '
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" width="100%" src="'.$this->load_img("design_images/$preview->image").'" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Title: </strong>'.$preview->name.'</h5>
                            <h5 class="card-title" id="price_display_'.$preview->id.'"><strong>Price: </strong>'.$preview->price.' Birr</h5>
                            <p class="card-text">
                                Designed by <a href="#" class="btn btn-link" >'.$preview->designer->f_name." ".$preview->designer->l_name.'</a>
                            </p>
                            <div class="m-0 p-0" id="approval_form_'.$preview->id.'">
                                <h4>Approved</h4>
                            </div>
                        </div>
                    </div>
                ';

            }
            else if($preview->state == "rejected"){

                print '
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" width="100%" src="'.$this->load_img("design_images/$preview->image").'" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Title: </strong>'.$preview->name.'</h5>
                            <p class="card-text">
                                Designed by <a href="#" class="btn btn-link" >'.$preview->designer->f_name." ".$preview->designer->l_name.'</a>
                            </p>
                            <div class="m-0 p-0" id="approval_form_'.$preview->id.'">
                                <h4>Rejected</h4>
                            </div>
                        </div>
                    </div>
                ';

            }

        }
        //action="'.$this->route_address("Orders.init_by_design", ["type" => $preview->type, "design" => $preview->id]).'" method="post"
        print '</div>';

    }
    else{
        print '
        
        <div class="jumbotron jumbotron-fluid mt-2">
            <div class="container">
                <h1 class="display-4">No Designs Yet</h1>
            </div>
        </div>
        
        ';
    }

    ?>

</div>
<?php
print '<script>';

print 'constants = {';

print 'approve_address: "'.$this->route_address("Designs.approve_design").'",';
print 'reject_address: "'.$this->route_address("Designs.reject_design").'"';

print '};';

print $this->load_js("designes.js");

print '</script>';
$this->loadTemplate("layouts/open_footer.php");
