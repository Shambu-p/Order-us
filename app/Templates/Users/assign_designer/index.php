<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/5/2020
 * Time: 6:37 PM
 */

$this->loadTemplate("header2.php");

?>

    <div class="container">

        <form action="<?php print Route::goRouteAddress("OrdersDesigners.save") ?>" method="post">

            <h2 class="display-4" style="text-align: center">
                Assign Designer To an Order
            </h2>
            <br>
            <label for="designer">
                Designer
            </label>
            <br>
            <div class="form-row">

                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-8">

                    <select class="form-control form-control-lg" name="designer" id="designer">

                        <?php

                        if(isset($this->request->data)){

                            $data = (array) $this->request->data;

                            foreach($data as $designer){

                                print '<option value="'.$designer->username.'">'.$designer->f_name." ".$designer->l_name.'</option>';

                            }

                        }

                        ?>

                    </select>
                    <br>
                    <?php

                    if(isset($this->request->change)){

                        print '<input type="text" name="change" value="change" style="display: none">';

                    }

                    ?>

                </div>
                <div class="col">

                    <button class="btn btn-dark btn-lg btn-block" type="submit" name="assign_designer">
                        Assign
                    </button>

                </div>

            </div>

        </form>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </div>

<?php

$this->loadTemplate("footer2.php");

?>
