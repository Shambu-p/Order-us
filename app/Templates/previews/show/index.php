<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/6/2020
 * Time: 8:45 PM
 */

if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    $this->loadTemplate("header2.php");

}else{
    $this->loadTemplate("header.php");
}


if(isset($request->for) && isset($this->request->data) && $this->request->data != "" && $this->request->data != null){


    if($this->request->for == "selection"){

        print '
        
        <form action="" method="post">

            <h2 class="display-5" style="text-align: center">
                Previous Work Image Suggestion
            </h2><br>
            <div class="form-row">
        
        ';

        $data = (array) $this->request->data;

        foreach($data as $n => $preview){

            print '
            
            <div class="col-lg-4 col-md-6 col-sm-6 col-xl-4">
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
                    <img class="card-img-top" src="'; Loader::imageAddress("preview_images/$preview->image"); print '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            Designed By
                            <a href="#" class="btn btn-link" >'.$preview->designer.'</a>
                        </h5>
                        <div class="row">
                            <div class="col">
                                <a href="' . Route::goRouteAddress("Orders.attach_image", ["selected_image" => $preview->image_id]) . '" class="btn btn-primary" name="suggested_image" value="the value">Select Image</a>
                            </div>
                            <div class="col">   
                                <p class="card-text"><small class="text-muted">Posted on '.date("M d Y", $preview->time).'</small></p>
                            </div>
                        </div>
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
    else if($this->request->for == "acceptance" && isset($_SESSION["login"]) && $_SESSION["login"] == "true" && $_SESSION["role"] == "director"){

        print '
        
        <div>

            <h2 class="display-5" style="text-align: center">
                Designed Previews
            </h2><br>
            <div class="form-row">
        
        ';

        $data = (array) $this->request->data;

        foreach($data as $n => $preview){

            print '
            
            <div class="col-lg-4 col-md-6 col-sm-6 col-xl-4">
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
                    <img class="card-img-top" src="'; Loader::imageAddress("preview_images/$preview->image"); print '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            Designed By
                            <a href="#" class="btn btn-link" >'.$preview->designer.'</a>
                        </h5>
                        <div class="row">';

            if($preview->status == "pending"){

                print '
                            <div class="col">
                                <form action="'.Route::goRouteAddress("Previews.update").'" method="post">
                                    <input type="hidden" style="display: none;" name="status" value="accepted">
                                    <input type="hidden" style="display: none;" name="attribute" value="status">
                                    <input type="hidden" style="display: none;" name="order" value="'.$this->request->order_id.'">
                                    <input type="hidden" style="display: none;" name="image" value="'.$preview->image_id.'">
                                    <button class="btn btn-primary" type="submit" name="suggested_image" value="the value" >Select Image</button>
                                </form>
                                
                            </div>';

            }else{

                print '
                            <div class="col">
                                Accepted
                            </div>
                ';
            }

                    print ' <div class="col">   
                                <p class="card-text"><small class="text-muted">Posted on '.date("M d Y", $preview->time).'</small></p>
                            </div>
                        </div>
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
    else if($this->request->for == "printing"){

        print '
        
        <div >

            <h2 class="display-5" style="text-align: center">
                Previous Work Image Suggestion
            </h2><br>
            <div class="form-row">
        
        ';

        $data = (array) $this->request->data;

        foreach($data as $n => $preview){

            print '
            
            <div class="col-lg-4 col-md-6 col-sm-6 col-xl-4">
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
                    <img class="card-img-top" src="'; Loader::imageAddress("preview_images/$preview->image"); print '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">
                            Designed By
                            <a href="#" class="btn btn-link" >'.$preview->designer.'</a>
                        </h5>
                        <div class="row">
                            <div class="col">
                            
                                <form action="'.Route::goRouteAddress("Previews.update").'" method="post">
                                    <input type="hidden" style="display: none;" name="attribute" value="printing">
                                    <input type="hidden" style="display: none;" name="order" value="'.$this->request->order_id.'">
                                    <input type="hidden" style="display: none;" name="image" value="'.$preview->image_id.'">
                                    <button class="btn btn-primary" type="submit" name="suggested_image" value="the value" >Select Image</button>
                                </form>
                                
                            </div>
                            <div class="col">   
                                <p class="card-text"><small class="text-muted">Posted on '.date("M d Y", $preview->time).'</small></p>
                            </div>
                        </div>
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

if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    $this->loadTemplate("footer2.php");

}else{
    $this->loadTemplate("footer.php");
}

?>
