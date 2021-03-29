<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/7/2020
 * Time: 11:10 PM
 */

$this->loadTemplate("header.php");


if(isset($this->request->for) && isset($this->request->data) && $this->request->data != "" && $this->request->data != null){


    if($this->request->for == "selection"){

        print '
        
        <form action="" method="post">

            <h2 class="display-5" style="text-align: center">
                Card Designs
            </h2><br>
            <div class="form-row">
        
        ';

        $data = (array) $this->request->data;

        foreach($data as $n => $preview){

            print '
            
            <div class="col-lg-4 col-md-6 col-sm-6 col-xl-4">
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
                    <img class="card-img-top" src="'; Loader::imageAddress("images/design_images/$preview->image"); print '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            Designed By
                            <a href="#" class="btn btn-link" >'.$preview->designer.'</a>
                        </h5>
                        <a href="' . Route::goRouteAddress("Orders.attach_image", ["selected_image" => $preview->image_id]) . '" class="btn btn-primary" name="suggested_image" value="the value">Select Image</a>
                    </div>
                </div>
            </div>
            
            ';

        }

        print '
        
            </div>
        </form>
        
        ';

    }
}


?>

<?php

$this->loadTemplate("footer.php");

?>
