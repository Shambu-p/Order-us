<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/3/2020
 * Time: 1:51 PM
 */

$this->loadTemplate("header.php");

?>

<div class="row">

    <div class="col">

    </div>

    <div class="col-xl-8 col-lg-10 col-md-10 col-sm-12">

        <div class="row card-header">

            <div class="col">
                <a href="<?php print Route::goRouteAddress("Orders.re_init"); ?>" class="btn btn-warning">Restart Ordering</a>
            </div>
            <div class="col">
                <strong>
                    <big>
                        <?php
                        if(isset($_SESSION['order']['payment'])){
                            print "Payment:  ".$_SESSION['order']['payment']." Birr";
                        }
                        ?>
                    </big>
                </strong>
            </div>

        </div>

        <div class="container">

            <?php

            if(!isset($_SESSION["order"]) && isset($this->request->now) && $this->request->now == "initialize"){

                print '
                
                <form action="'. Route::goRouteAddress("Orders.initialize_order") .'" method="post">

                    <h2 class="display-5" style="text-align: center">
                        Order Initialization
                    </h2>
                    <br>
    
                    <div class="form-group">
                        <label for="fullName">
                            Full Name
                        </label>
                        <input type="text" class="form-control form-control-lg" id="fullName" required name="name" placeholder="Full Name">
                    </div>
                    <br>
    
                    <label for="orderType">
                        Here select on what type of material you want to order.
                    </label>
                    <select class="form-control form-control-lg" name="type" required id="orderType">
                        <option value="shirt">T-Shirt</option>
                        <option value="banner">Banner</option>
                        <option value="cup">Cup</option>
                        <option value="card">Card</option>
                    </select>
    
                    <br>
    
                    <div class="form-group">
                        <label for="address">
                            Here Enter your address if you want us to deliver to you at your place. <br>
                            <strong>
                                <u>
                                    you should know that it will cost you. and the cost will be added on the payment.
                                    The place you enter should be inside the city otherwise we can\'t deliver you the product you will only west your money
                                </u>
                            </strong>
                        </label>
    
                        <input type="text" class="form-control" id="address" name="address" >
    
                    </div>
    
                    <button class="btn btn-dark" type="submit" name="shirt_design">
                        Submit
                    </button>
    
                </form>
                
                ';

            }
            else if(isset($_SESSION["order"]) && !isset($_SESSION["design_preference"]) && isset($_SESSION["order"]["order_type"]) && isset($this->request->now) && $this->request->now == "design_preference"){

                if(isset($_SESSION["order"]["order_type"]) && $_SESSION["order"]["order_type"] == "banner"){

                    print '
                
                    <form action="'.Route::goRouteAddress("Orders.design_preference").'" method="post">
        
                        <h2 class="display-5" style="text-align: center">
                            Banner Preference
                        </h2> <br>
        
                        <label for="bannerMaterial">
                            Here select the material type which the banner should be made of.
                        </label>
                        <select class="form-control form-control-lg" name="banner_material" id="bannerMaterial" required>
                            <option value="first">First</option>
                            <option value="second">Second</option>
                            <option value="third">Third</option>
                        </select>
        
                        <div class="form-group">
                            <label for="bannerWidth">
                                Width
                            </label>
                            <input type="number" class="form-control" name="banner_width" id="bannerWidth" placeholder="Banner Width" required>
                        </div>
                        <div class="form-group">
                            <label for="bannerHeight">
                                Height
                            </label>
                            <input type="number" class="form-control" name="banner_height" id="bannerHeight" placeholder="Banner Height" required>
                        </div>
        
                        <div class="form-group">
                            <label for="amount">
                                Amount/How many
                            </label>
                            <input type="number" class="form-control" name="amount" id="amount" value="1" required>
                        </div>
        
                        <button class="btn btn-dark" type="submit" name="design_for" value="banner">
                            Submit
                        </button>
        
                    </form>
                
                ';

                }
                else if($_SESSION["order"]["order_type"] == "shirt"){

                    print '
                
                <form action="'.Route::goRouteAddress("Orders.design_preference").'" method="post">

                    <h2 class="display-5" style="text-align: center">
                        T-Shirt Preference
                    </h2>
    
                    <br>
                    <label for="shirtMaterial">
                        Here select the material type which the Shirt should be made of.
                    </label>
                    <select class="form-control form-control-lg" name="shirt_type" id="shirtMaterial" required>
                        <option value="first">First</option>
                        <option value="second">Second</option>
                        <option value="third">Third</option>
                    </select>
    
                    <label for="shirtSize">
                        Here select the size of Shirt.
                    </label>
                    <select class="form-control form-control-lg" name="shirt_size" id="shirtSize" required>
                        <option value="xs">Extra Small</option>
                        <option value="sm">Small</option>
                        <option value="md">Medium</option>
                        <option value="lg">Large</option>
                        <option value="xl">Extra Large</option>
                    </select>
    
                    <label for="shirtColor">
                        Here select shirt Color
                    </label>
                    <select class="form-control form-control-lg" name="shirt_color" id="shirtColor" required>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="gray">Gray</option>
                        <option value="red">Red</option>
                        <option value="dark_red">Dark Red</option>
                        <option value="blue">Blue</option>
                        <option value="dark_blue">Dark Blue</option>
                        <option value="pink">Pink</option>
                    </select>
    
                    <div class="form-group">
                        <label for="amount">
                            Amount/How many
                        </label>
                        <input type="number" class="form-control" name="amount" id="amount" value="1" required>
                    </div>
    
                    <button class="btn btn-dark" type="submit" name="design_for" value="shirt">
                        Submit
                    </button>
    
                </form>
                
                ';

                }
                else if($_SESSION["order"]["order_type"] == "cup"){

                    print '
                
                <form action="'.Route::goRouteAddress("Orders.design_preference").'" method="post" >

                    <h2 class="display-5" style="text-align: center">
                        Cup Preference
                    </h2> <br>
    
                    <label for="cupSize">
                        Here select the size of Cup.
                    </label>
                    <select class="form-control form-control-lg" name="cup_size" id="cupSize" required>
                        <option value="sm">Small</option>
                        <option value="md">Medium</option>
                        <option value="lg">Large</option>
                    </select>
    
                    <label for="cupColor">
                        Here select Cup Color
                    </label>
                    <select class="form-control form-control-lg" name="cup_color" id="cupColor" required> 
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="gray">Gray</option>
                        <option value="red">Red</option>
                        <option value="dark_red">Dark Red</option>
                        <option value="blue">Blue</option>
                        <option value="dark_blue">Dark Blue</option>
                        <option value="pink">Pink</option>
                    </select>
    
                    <div class="form-group">
                        <label for="amount">
                            Amount/How many
                        </label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
    
                    <button class="btn btn-dark" type="submit" name="design_for" value="cup">
                        Submit
                    </button>
    
                </form>
                
                ';

                }
                else if($_SESSION["order"]["order_type"] == "card"){

                    print '
                
                <form action="'.Route::goRouteAddress("Orders.design_preference").'" method="post">

                    <h2 class="display-5" style="text-align: center">
                        Card Preference
                    </h2>
                    <br>
    
                    <label for="cardSize">
                        Here select the size of card.
                    </label>
                    <select class="form-control form-control-lg" name="card_size" id="cardSize" required>
                        <option value="first">size one</option>
                        <option value="second">size two</option>
                        <option value="third">size three</option>
                    </select>
    
                    <label for="cardType">
                        Here Select card Type
                    </label>
                    <select class="form-control form-control-lg" name="card_type" id="cardType" required>
                        <option value="flier">Flier</option>
                        <option value="business">Business</option>
                        <option value="wedding">Wedding</option>
                    </select>
    
                    <div class="form-group">
                        <label for="amount">
                            Amount/How many
                        </label>
                        <input type="number" class="form-control" name="amount" id="amount" value="1" required>
                    </div>
    
                    <button class="btn btn-dark" type="submit" name="design_for" value="card">
                        Submit
                    </button>
    
                </form>
                
                ';

                }

            }
            else if(isset($_SESSION["order"]) && isset($_SESSION["design_preference"]) && isset($_SESSION["order"]["suggested_image"]) && isset($this->request->now) && $this->request->now == "more_info"){

                print '
                
                <form action="'.Route::goRouteAddress("Orders.more_info").'" method="post">

                    <h2 class="display-5" style="text-align: center;">
                        More Information About the Order
                    </h2>
                    <br>
    
                    <div class="form-group">
    
                        <label for="additionalText">
                            Additional Preference
                        </label>
                        <textarea class="form-control" id="additionalText" name="additional_text" rows="3" required></textarea>
    
                    </div>
    
                    <div class="form-group">
                        <label for="email">Your Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                    </div>
                    <br>
    
                    <div class="form-group">
                        <label for="phone">
                            Phone Number
                        </label>
                        <input type="number" class="form-control" name="phone_number" id="phone" placeholder="Your working Phone Number" required>
                    </div>
    
                    <div class="form-group">
                        <label for="new_password">Create Password</label>
                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Create Password" required>
                    </div>
    
                    <div class="form-group">
                        <label for="confirm_pass">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_pass" placeholder="Confirm Password" required>
                    </div>
    
                    <button class="btn btn-dark" type="submit" name="shirt_design">
                        Submit
                    </button>
    
                </form>
                
                ';


            }
            else if(isset($_SESSION["order"]) && isset($_SESSION["design_preference"]) && !isset($_SESSION["order"]["suggested_image"]) && isset($this->request->now) && $this->request->now == "suggested_image"){

                print '
                <br>
                <br>
                <form enctype="multipart/form-data" action="'.Route::goRouteAddress("Orders.attach_image").'" method="post">

                    <h2 class="display-5" style="text-align: center">
                        Suggested Image
                    </h2>
                    <br>

                    <div class="input-group">
                        <input required type="file" name="inputImage" class="form-control form-control-lg" aria-label="Recipient\'s username with two button addons" aria-describedby="button-addon4">
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-danger" type="submit">
                                <div class="row">
                                    <div class="col">
                                        <img src="'; Loader::imageAddress("attach.png"); print '" alt="Attach" width="30"> <strong><big> |</big></strong>
                                    </div>
                                    <div class="col">
                                        <strong><big>Attach</big></strong>
                                    </div>
                                </div>
                            </button>';

                if($_SESSION["order"]["order_type"] != "card"){

                    print '
                            <a href="'.Route::goRouteAddress("Previews.show", ["type" => $_SESSION["order"]["order_type"], "for" => "selection"]).'" class="btn btn-danger" type="button">
                                <strong><big>Previous Works</big></strong>
                            </a>';

                }else{

                    print '
                            <a href="#" class="btn btn-danger" type="button">
                                <strong><big>Designs</big></strong>
                            </a>';

                }

                print '
                            
                        </div>
                    </div>
        
                </form>
                
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>    
                <br>
                <br>
                <br>
                <br>
                <br>
                ';

            }
            else if(isset($_SESSION["order"]) && isset($_SESSION["design_preference"]) && isset($_SESSION["order"]["suggested_image"]) && isset($this->request->now) && $this->request->now == "finishing"){

                print '
                <br>
                <br>
                <ul class="list-group">
                    <li class="list-group-item bg-info text-white">
                        <h1 class="display-4" style="text-align: center">
                            Order
                        </h1>
                    </li>
                    <li class="list-group-item bg-light">
                        <strong><big>All Design Preferences</big></strong>
                    </li>
                
                ';

                foreach ($_SESSION["design_preference"] as $key => $value){

                    print '
                    
                    <li class="list-group-item">
                        <strong><big>'.$key.':</big></strong> '.$value.'
                    </li>
                    
                    ';

                }

                print '
                
                <li class="list-group-item bg-light">
                    <strong><big>All Information</big></strong>
                </li>
                
                ';

                foreach ($_SESSION["order"] as $key => $value){

                    if(($key == "address" && $value == "") || $key == "suggested_image"){
                        continue;
                    }

                    if($key == "password"){

                        print '
                    
                    <li class="list-group-item">
                        <strong><big>'.$key.':</big></strong> ********
                    </li>
                    
                    ';
                        continue;

                    }

                    print '
                    
                    <li class="list-group-item">
                        <strong><big>'.$key.':</big></strong> '.$value.'
                    </li>
                    
                    ';

                }

                print '
                
                    <li class="list-group-item">
    
                        <a href="'.Route::goRouteAddress("Orders.save").'" type="button" class="btn btn-success">Send Order</a>
                        <a href="'.Route::goRouteAddress("Orders.re_init").'" type="button" class="btn btn-danger">Cancel Order</a>
    
                    </li>
                </ul>
                <br>
                
                ';

            }
            else if(isset($this->request->order_number) && $this->request->order_number != "" && isset( $this->request->now) && $this->request->now == "display_order_number"){

                print '
                
                <br>
                <br>
                <div class="alert alert-success" role="alert">
                    <h3 class="alert-heading">
                        <strong>Your Order Number is </strong> '.$this->request->order_number.'
                    </h3>
                    <p>
                        You should Remember your order number to view your order state and to take necessary actions on the way.
                    </p>
                    <hr>
                    <p class="mb-0">
                        You have sent the order Successfully wait until it is approved and <strong><big>Remember your Order number and Password</big></strong> you enter.
                    </p>
                    <br>
                    <a class="btn btn-success" href="'.Route::goRouteAddress("Orders.re_init").'">
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

        </div>

    </div>

    <div class="col"></div>

</div>

<?php

$this->loadTemplate("footer.php");

//'. Route::routeAddress("PreviewsController.show", ["for" => "selection"]) .'
?>


