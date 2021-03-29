<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 9:42 AM
 */

use Absoft\App\Pager\Pager;

$this->loadTemplate("layouts/open_header.php");
?>

    <style>
        body{
            background: white;
        }
    </style>

    <div class="row pl-lg-5 pl-sm-3 pr-lg-5 pr-sm-3">

        <div class="col">

                <?php

                if(isset($this->request->posts) && sizeof( (array) $this->request->posts)){

                    $data = (array) $this->request->posts;

                    print '<div class="card-columns">';

                    foreach($data as $post){

                        print '
                            <div class="card">
                                <img class="card-img-top" src="'.$this->load_img($post->image).'" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">'.$post->text.'</p>
                                    <p class="card-text"><small class="text-muted">Posted on '.date("l M d Y", $post->date).'</small></p>
                                </div>
                            </div>
                        ';

                    }

                    print '</div>';

                    print '
                    <div class="btn-group" role="group" aria-label="Basic example">
                        '.Pager::pagerView("posts").'
                    </div>
                    ';


                }
                else{
                    print '
                    <div class="jumbotron">
                        <h1 class="display-4">No Posts Yet!</h1>
                    </div>
                    ';
                }

                ?>

        </div>

        <div class="col-sm-12 col-md-5 col-lg-3">

            <?php

            if(isset($_SESSION["customer_log"])){
                print '<div class="bg-light rounded shadow p-3">';
                print '<div class="border-bottom mb-2"><h6>Already Authenticated Order</h6></div>';
                print '<a class="btn btn-sm btn-primary mr-2" href="'.$this->route_address("Orders.check_my_order", ["order" => $_SESSION["customer_log"], "password" => "ready"]).'">View Order</a>';
                print '<a class="btn btn-sm btn-danger mr-2" href="'.$this->route_address("Orders.exit_order").'">Exit Order</a>';
                print '</div>';
            }else{

                print '
                
                <form action="'.$this->route_address("Orders.check_my_order").'" method="post" class="bg-light rounded shadow pr-4 pl-4 p-3">

                    <h5 class="text-center border-bottom">Check Order</h5>
    
                    <input type="number" class="form-control form-control-sm mb-3" placeholder="Order Number" name="order" required>
                    <input type="password" class="form-control form-control-sm mb-3"  placeholder="Password" name="password" required>
                    <button class="btn btn-sm btn-dark btn-block" type="submit">Check</button>
    
                </form>
                
                ';

            }

            ?>

        </div>

    </div>

<?php
$this->loadTemplate("layouts/open_footer.php");



