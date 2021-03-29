<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/18/2020
 * Time: 1:29 PM
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
        if(isset($gets->page_name)){
            print $gets->page_name;
        }else{
            print "Unknown";
        }
        ?>

    </title>
    <link rel="icon" href="<?php print $_main_url; ?>images/line.png">
    <link rel="stylesheet" href="<?php print $_main_url; ?>Bootstrap/css/bootstrap.min.css">

    <meta name="viewport" content="width=device-width, scale=1">
</head>

<body>
<br>
<div class="row">
    <div class="col">

    </div>
    <div class="col-lg-10 col-sm-12 shadow p-3 mb-5 bg-light rounded">
        <nav class="navbar navbar-light bg-light rounded-top">
            <a class="navbar-brand" href="index.php">
                <h2 class="display-4" style="text-align: center;">
                    Smart Techno
                </h2>
            </a>
        </nav>

        <?php
        $role = $_SESSION["role"];

            print '
            <nav class="navbar navbar-expand-md navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                
                <ul class="navbar-nav mr-auto">
                
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="myDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      My
                    </a>
                    <div class="dropdown-menu " aria-labelledby="myDropdown">
                      <a class="dropdown-item" href="'.Route::routeAddress("UsersController.view").'">Profile</a>
                      
                      ';

            if($role == "admin"){

                print '
                    </div>
                  </li>';

                print '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="headDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="headDropdown">
                          <a class="dropdown-item" href="'.Route::routeAddress("UsersController.show", ["type" => "all_employees"]).'">All Employees</a>
                        </div>
                      </li>';

            }

            if($role == "director"){

                print '
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="'.Route::routeAddress("PostsController.save").'">New Post</a>
                    </div>
                  </li>';

                print '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="directorDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Director
                            </a>
                            <div class="dropdown-menu" aria-labelledby="directorDropdown">
                              <a class="dropdown-item" href="'.Route::routeAddress("UsersController.show", ["type" => "all_employees"]).'">All Employees</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::routeAddress("UsersController.show", ["type" => "reg_request"]).'">Registration Requests</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::routeAddress("OrdersController.show", ["determiner" => "payed"]).'">Payed Orders</a>
                          <a class="dropdown-item" href="'.Route::routeAddress("OrdersController.show", ["determiner" => "request"]).'">Requested Orders</a>
                          <a class="dropdown-item" href="'.Route::routeAddress("OrdersController.show", ["determiner" => "assigned"]).'">Printing Orders</a>
                            </div>
                          </li>';

            }

            if($role == "designer"){

                print '
                    </div>
                  </li>';

                print '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="designerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Designer
                            </a>
                            <div class="dropdown-menu" aria-labelledby="designerDropdown">
                              <a class="dropdown-item" href="'.Route::routeAddress("UsersController.show", ["type" => "all_employees"]).'">All Employees</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::routeAddress("OrdersDesignersController.show", ["type" => "my_orders", "designer" => $_SESSION["username"]]).'">Orders</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::routeAddress("DesignsController.add").'">New Card Design</a>
                            </div>
                          </li>';

            }

            if($role == "cashier"){

                print '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="designerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Cashier
                            </a>
                            <div class="dropdown-menu" aria-labelledby="designerDropdown">
                              <a class="dropdown-item" href="'.Route::routeAddress("UsersController.show", ["type" => "all_employees"]).'">All Employees</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="'.Route::routeAddress("OrdersController.show", ["determiner" => "approved"]).'">Approved Orders</a>
                            </div>
                          </li>';

            }

            print '
                    <li class="nav-item dropdown">
                        <a id="logoutDropdown" href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Logout</a>
                        <div class="dropdown-menu" aria-labelledby="logoutDropdown">
                            <div class="container">
                                <span>Do you want to logout?</span>
                                <br>
                                <br>
                                <a href="'.Route::routeAddress("UsersController.logout").'" class="btn btn-danger active" role="button" aria-pressed="true">Logout</a>
                            </div>
                        </div>
                    </li>                 
                </ul>
              </div>
            </nav>
            ';
            
        ?>
        <br>
        <?php
        if(isset($request->error_message)){

            print '
            <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                '.$request->error_message.'
            </div>
            ';

        }
        if(isset($request->message)){

            print '
            <div class="alert bg-info text-white alert-dismissible fade show" role="alert">
                '.$request->message.'
            </div>
            ';

        }
        if(isset($request->success_message)){

            print '
            <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
                '.$request->success_message.'
            </div>
            ';

        }
        ?>



