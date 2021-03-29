<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/18/2020
 * Time: 9:07 PM
 */

$this->loadTemplate("admin/admin_header.php");
?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="h2">Admin Panel</h1>

    </div>

<?php

\Absoft\App\Pager\Alert::displayAlert();

?>

<div class="container">

    <div class="list-group">

        <?php

        if(isset($this->request->data)){

            $data = $this->request->data;

            foreach($data as $table){

                print '
            
                <a href="'.$this->route_address("Admin.view", ["table" => $table->entity_name]).'" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">'.$table->entity_name.'</h5>
                    </div>
                    <p class="mb-1">';

                foreach ($table->object->ATTRIBUTES as $attribute){

                    print $attribute->name." ".$attribute->type.", ";

                }

                print '
                    </p>
                    <small>Created on: '.date("d M Y", $table->created_on).'</small>
                </a>
                
                ';

            }

        }

        ?>
    </div>

</div>


<?php
$this->loadTemplate("admin/admin_footer.php");
?>
