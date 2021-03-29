<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/21/2020
 * Time: 8:36 PM
 */

if(!isset($_SESSION["login"]) || $_SESSION["login"] != "true"){

    Route::display("users","login");
    die();

}

?>

<html lang="en">

<head>
    <title>

        <?php
        if(isset($this->header->page_name)){
            print $this->header->page_name;
        }else{
            print "Smart Techno";
        }
        ?>

    </title>
    <link rel="icon" href="<?php Loader::imageAddress("line.png"); ?>">
    <link rel="stylesheet" href="<?php Loader::cssAddress("bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php Loader::cssAddress("my_style.css"); ?>">

    <meta name="viewport" content="width=device-width, scale=1">
</head>

<body>
<div class="outer_container">

    <div id="menu-container" class="menu-container">

        <div class="container sticky-top">

        <?php
        $role = $_SESSION["role"];

        print'
        
        ';

        print '

            <div class="accordion" id="accordionExample">

                <div class="card">

                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                My
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body bg-light">
                            
                            <a class="dropdown-item" href="'.Route::goRouteAddress("Users.view").'">Profile</a>
                            ';

        if($role == "admin"){

            print '
                        </div>
                    </div>

                </div>
            ';

            print '

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Administration
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <a class="dropdown-item" href="'.Route::goRouteAddress("Users.show", ["type" => "all_employees"]).'">All Employees</a>
                            </div>
                        </div>
                    </div>
                ';

        }

        if($role == "director"){


            print '
                          <a class="dropdown-item" href="'.Route::goRouteAddress("Posts.save").'">New Post</a>
                        </div>
                    </div>

                </div>';

            print '
            
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Director
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Users.show", ["type" => "all_employees"]).'">All Employees</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Users.show", ["type" => "reg_request"]).'">Registration Requests</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Orders.show", ["determiner" => "payed"]).'">Payed Orders</a>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Orders.show", ["determiner" => "request"]).'">Requested Orders</a>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Orders.show", ["determiner" => "printing"]).'">Printing Orders</a>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Orders.show", ["determiner" => "finished"]).'">Finished Orders</a>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Orders.show", ["determiner" => "received"]).'">Received Orders</a>
                        </div>
                    </div>
                </div>
            
            ';

        }

        if($role == "designer"){

            print '
                    </div>
                    </div>

                </div>';

            print '
            
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Designer
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Users.show", ["type" => "all_employees"]).'">All Employees</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("OrdersDesigners.show", ["type" => "my_orders", "designer" => $_SESSION["username"]]).'">Orders</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Designs.save").'">New Card Design</a>
                        </div>
                    </div>
                </div>
            
            ';


        }

        if($role == "cashier"){

            print '
                    </div>
                    </div>

                </div>';

            print '
            
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Cashier
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <a class="dropdown-item" href="'.Route::goRouteAddress("Users.show", ["type" => "all_employees"]).'">All Employees</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::goRouteAddress("Orders.show", ["determiner" => "approved"]).'">Approved Orders</a>
                        </div>
                    </div>
                </div>
            
            ';

        }

            print '
                        
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Logout
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="container">
                                            <span>Do you want to logout?</span>
                                            <br>
                                            <br>
                                            <a href="'.Route::goRouteAddress("Users.logout").'" class="btn btn-danger active" role="button" aria-pressed="true">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
            
                </div>
              ';
        ?>
        </div>
    </div>

    <div class="inner-container" id="container">

        <div class="form-row sticky-top shadow rounded bg-dark">

            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-3">
                <button id="hide_show_btn" class="menu-display">
                    <p class="span"></p>
                    <p class="span"></p>
                    <p class="span"></p>
                </button>
            </div>
            <div class="col" style="overflow-x: hidden;">
                <a class="navbar-brand" href="index.php">
                    <h2 class="display-4 text-white" style="text-align: center;">
                        Smart Techno
                    </h2>
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 shadow-sm p-3 mb-5 bg-white rounded">

                <br>

        <?php
        Alert::setErrorClassName("alert bg-danger text-white alert-dismissible fade show animate");
        Alert::setInfoClassName("alert bg-info text-white alert-dismissible fade show animate");
        Alert::setSuccessClassName("alert bg-success text-white alert-dismissible fade show animate");
        Alert::displayAlert();
        ?>



