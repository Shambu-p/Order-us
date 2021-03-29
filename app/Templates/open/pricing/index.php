<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/30/2020
 * Time: 10:03 AM
 */

$this->loadTemplate("layouts/open_header.php");
?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Pricing</h1>
        <p class="lead">
            Smart Techno has good pricing you can see them down. <br>All currencies are in Ethiopian Birr.
        </p>
    </div>

    <div class="container">

<?php

if(isset($this->request->prices) && sizeof((array) $this->request->prices)){

    $prices = $this->request->prices;

    foreach ($prices as $type => $price){

        print '<hr>
        <h3 class="text-center">'.strtoupper($type).'</h3>
        <hr>
        <div class="card-columns mb-3 text-center">';

        if($type == "banner"){

            foreach ($price as $key => $item){

                foreach($item as $values => $pay){

                    print '
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">'.$type.'</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$'.$pay.'<small class="text-muted">/banner</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Material: '.$values.'</li>
                                <li>Area: 1m &times; 1m</li>
                            </ul>
                        </div>
                    </div>
                    ';

                }

            }

        }
        elseif($type == "shirt"){

            foreach ($price as $key => $item){

                foreach($item as $values => $pay){

                    print '
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">'.$type.'</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$'.$pay.'<small class="text-muted">/shirt</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Shirt Material: '.$key.'</li>
                                <li>Shirt Size: '.$values.'</li>
                            </ul>
                        </div>
                    </div>
                    ';

                }

            }

        }
        elseif($type == "cup"){

            foreach ($price as $key => $item){

                foreach($item as $values => $pay){

                    print '
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">'.$type.'</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$'.$pay.'<small class="text-muted">/cup</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Cup Size: '.$values.'</li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    ';

                }

            }

        }
        else{

            foreach ($price as $key => $item){

                foreach($item as $values => $pay){

                    print '
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">'.$type.'</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$'.$pay.'<small class="text-muted">/card</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Card Size: '.$values.'</li>
                                <li>Card Material: '.$key.'</li>
                            </ul>
                        </div>
                    </div>
                    ';

                }

            }

        }

        print '</div>';



    }

}

?>

<?php
$this->loadTemplate("layouts/open_footer.php");
