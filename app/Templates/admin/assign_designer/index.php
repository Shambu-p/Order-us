<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/22/2020
 * Time: 10:07 AM
 */

$this->loadTemplate("layouts/admin_header.php");
?>

<div class="container mt-3">

    <form action="<?php print $this->route_address("OrdersDesigners.save"); ?>" method="post">

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
$this->loadTemplate("layouts/admin_footer.php");
