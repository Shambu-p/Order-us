<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/20/2020
 * Time: 10:23 PM
 */

$this->loadTemplate("admin/admin_header.php");

if(isset($this->request->table)){

    print '

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">'.strtoupper($this->request->table).'</h1>
    </div>
    
    ';

}
else{

    $this->loadTemplate("admin/admin_footer.php");
    die();

}

?>

<form class="container" action="<?php print $this->route_address("Admin.save"); ?>" method="post">

    <?php

    if(isset($this->request->table)){

        print '<input type="hidden" name="table" value="'.$this->request->table.'">';

    }

    ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="category">Category</span>
        </div>
        <select class="form-control" name="category" id="category" >

            <option value="hidden">Hidden</option>
            <option value="attributes">Not Hidden</option>

        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="att_name">Name</span>
        </div>
        <input type="text" name="name" class="form-control" placeholder="Name" aria-describedby="att_name">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="att_length">Length</span>
        </div>
        <input type="number" name="length" min="0" class="form-control" placeholder="Length" aria-describedby="att_length">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="type">Type</span>
        </div>
        <select class="form-control" name="type" id="type">

            <option value="string">Varchar</option>
            <option value="text">Text</option>
            <option value="int">Integer</option>
            <option value="autoIncrement">Auto Increment</option>
            <option value="time">Time</option>
            <option value="date">Date</option>
            <option value="double">Double</option>
            <option value="float">Float</option>
            <option value="timestamp">Time Stamp</option>
            <option value="hidden">Hidden</option>

        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="nullable">Nullable</span>
        </div>
        <select class="form-control" name="nullable" id="nullable" >

            <option value="">Unset</option>
            <option value="true">True</option>
            <option value="false">False</option>

        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="Reference">Reference to</span>
        </div>
        <input type="text" class="form-control" name="Reference" placeholder="Reference to" aria-describedby="reference">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="on">Reference on</span>
        </div>
        <input type="text" class="form-control" name="on" placeholder="Reference on" aria-describedby="on">
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="sign">Sign</span>
        </div>
        <select class="form-control" name="sign" >

            <option value="">Unset</option>
            <option value="true">True</option>
            <option value="false">False</option>

        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="unique">Unique</span>
        </div>
        <select class="form-control" name="unique" >

            <option value="">Unset</option>
            <option value="true">True</option>
            <option value="false">False</option>

        </select>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="key">Key</span>
        </div>
        <select class="form-control" name="setPrimaryKey" >

            <option value="">Unset</option>
            <option value="primary">Primary Key</option>

        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="auto_increment">Auto Increment</span>
        </div>
        <select class="form-control" name="autoincrement" >
            <option value="">Unset</option>
            <option value="false">False</option>
            <option value="true">True</option>
        </select>
    </div>

    <button class="btn btn-dark" type="submit">Create</button>

</form>


<?php
$this->loadTemplate("admin/admin_footer.php");
?>
