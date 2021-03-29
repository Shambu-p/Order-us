<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/15/2020
 * Time: 12:40 PM
 */

$this->loadTemplate("layouts/designer_header.php");

?>

<div class="container">

    <form method="post" class="mt-sm-5 mt-lg-3" action="<?php print $this->route_address("Designs.save"); ?>" enctype="multipart/form-data">

        <h3>Create New Design</h3>

        <label for="types">
            Card Type
        </label>
        <select class="form-control" name="type" id="types">
            <option value="wedding_card">Wedding</option>
            <option value="flier_card">Flier</option>
            <option value="business_card">Business Card</option>
            <option value="banner">Banner</option>
            <option value="shirt">Shirt</option>
            <option value="cup">Cup</option>
        </select>
        <br>

        <label for="types">
            Design Name
        </label>
        <input class="form-control" type="text" placeholder="Design Name" name="name" id="types">
        <br>
        <br>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" name="design_image" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>

        <button type="submit"  class="btn btn-dark btn-block btn-lg">Upload</button>

    </form>

</div>s

<?php
$this->loadTemplate("layouts/admin_footer.php");
?>
