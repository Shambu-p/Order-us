<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/6/2020
 * Time: 4:31 PM
 */

$this->loadTemplate("header.php");

?>

<div class="container">

    <?php

    if(isset($this->request->image) && isset($this->request->text)){

        print '
        
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
            <img class="card-img-top" src="'; Loader::imageAddress("post_images/".$this->request->image); print '"  alt="Card image cap">
            <div class="card-body">
                <p class="card-text">
                    '.$this->request->text.'
                </p>
            </div>
        </div>
        
        ';

    }

    ?>

</div>

<?php

$this->loadTemplate("footer.php");

?>
