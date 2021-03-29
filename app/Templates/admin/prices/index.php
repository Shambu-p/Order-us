<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/18/2020
 * Time: 3:06 PM
 */

$this->loadTemplate("layouts/admin_header.php");
?>

    <div class="table-responsive mt-5">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Type</th>
                <th>Determiner</th>
                <th>Name</th>
                <th>Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php

            if(isset($this->request->prices) && sizeof((array) $this->request->prices)){

                $prices = $this->request->prices;

                foreach ($prices as $price){

                    print '
                    
                    <tr>
                        <td>'.$price->type.'</td>
                        <td>'.$price->determiner.'</td>
                        <td>'.$price->value.'</td>
                        <td>'.$price->price.' Birr</td>
                        <td>
                            <form action="'.$this->route_address("Prices.delete").'" method="post">
                                <input type="hidden" name="type" value="'.$price->type.'">
                                <input type="hidden" name="determiner" value="'.$price->determiner.'">
                                <input type="hidden" name="value" value="'.$price->value.'">
                                <button type="submit" class="btn btn-outline-danger p-1 pt-0 pb-0 btn-sm">delete</button>
                            </form>
                        </td>
                    </tr>
                    
                    ';

                }

            }
            else{

                print '
                    </tbody>
                </table>
                <tr>
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No Prices</h1>
                        </div>
                    </div>
                </tr>
                ';

            }

            ?>
            </tbody>
        </table>
    </div>

<?php
$this->loadTemplate("layouts/admin_footer.php");

