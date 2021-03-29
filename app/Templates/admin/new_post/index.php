<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/18/2020
 * Time: 3:47 PM
 */

use Absoft\App\Routing\Route;

$this->loadTemplate("layouts/admin_header.php");

?>

<div class="container mt-3">
    <form action="<?php print Route::goRouteAddress("Posts.save") ?>" method="post" enctype="multipart/form-data">

        <h2 class="display-4" style="text-align: center">
            New Posting
        </h2> <br>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Post Text</span>
            </div>
            <textarea class="form-control" aria-label="With textarea" name="text"></textarea>
        </div>
        <br>

        <label for="imageInput">
            <strong>
                Choose image for your post
            </strong>
        </label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="imageInput" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>

        <br>
        <button type="submit" class="btn btn-light" value="image">
            <div class="row">
                <div class="col">
                    <img src="<?php print \Absoft\App\Loaders\Resource::imageAddress("attach.png"); ?>" alt="Attach" width="30"> <strong><big> |</big></strong>
                </div>
                <div class="col">
                    <strong><big>Attach and Post</big></strong>
                </div>
            </div>
        </button>

    </form>
</div>
<br>

<?php

$this->loadTemplate("layouts/admin_footer.php");

?>
