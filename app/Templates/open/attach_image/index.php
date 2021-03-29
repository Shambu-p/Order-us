<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/14/2020
 * Time: 9:19 AM
 */

$this->loadTemplate("layouts/order_header.php");
?>

<form enctype="multipart/form-data" action="<?php print $this->route_address("Orders.attach_image"); ?>" method="post">

    <h2 class="display-5" style="text-align: center">
        Suggested Image
    </h2>
    <br>

    <div class="input-group">

        <input required type="file" name="inputImage" class="form-control form-control-lg" aria-label="Recipient\'s username with two button addons" aria-describedby="button-addon4">
        <div class="input-group-append" id="button-addon4">
            <button class="btn btn-danger" type="submit">
                <div class="row">
                    <div class="col">
                        <img src="<?php print $this->load_img("attach.png"); ?>" alt="Attach" width="30"> <strong><big> |</big></strong>
                    </div>
                    <div class="col">
                        <strong><big>Attach</big></strong>
                    </div>
                </div>
            </button>
        </div>

    </div>

</form>

<?php
$this->loadTemplate("layouts/order_footer.php");
