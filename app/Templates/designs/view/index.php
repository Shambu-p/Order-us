<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/11/2020
 * Time: 12:20 PM
 */

if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    $this->loadTemplate("header2.php");

}else{

    $this->loadTemplate("header.php");

}

?>

<div class="container">

    <?php

    if(isset($this->request->image) && isset($this->request->designer) && isset($this->request->type)){

        print '
        
        <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
            <img class="card-img-top" src="'; Loader::imageAddress("design_images/".$this->request->image); print '"  alt="Card image cap">
            <div class="card-body">
                <p class="card-text">
                    Designed by '.$this->request->designer.'
                </p>
            </div>
        </div>
        
        ';

    }

    ?>

</div>

<?php

if(isset($_SESSION["login"]) && $_SESSION["login"] == "true"){

    $this->loadTemplate("footer2.php");

}else{

    $this->loadTemplate("footer.php");

}

?>
