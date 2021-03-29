<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/13/2020
 * Time: 12:18 PM
 */

$this->loadTemplate("api/api_header.php");

//print_r($this->request);
?>


<div class="pt-3 pb-1 mb-3 border-bottom">
    <h1 class="h2">Add New API User</h1>
</div>

<?php
\Absoft\App\Pager\Alert::displayAlert();
?>

<form class="mt-5" action="<?php print $this->route_Address("api.save"); ?>" method="post">

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Company Name</span>
        </div>
        <input type="text" name="company_name" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Agent Name</span>
        </div>
        <input type="text" class="form-control" name="agent_name" required>
    </div>

    <button class="btn btn-primary btn-lg" type="submit">ADD</button>

</form>


<?php
$this->loadTemplate("api/api_footer.php");
?>


