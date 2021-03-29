<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/4/2020
 * Time: 12:22 PM
 */

?>
<br>
<div class="container">
    <div class="row">
        <div class="col-10">
            <p>
                Smart Techno ሁሉም መብቱ በህግ የተጠበቀ
                <?php
                $date = new DateTime();
                print $date->format("M Y").'<sup>&copy;</sup>';
                ?>

            </p>
        </div>
        <div class="col-2">
            <strong>በ Ab Soft ኀ/የተ/የግ/ማ የተሰራ</strong>
        </div>
    </div>
</div>

</div>
<div class="col">

</div>
</div>

<script src="<?php Loader::jsAddress("jquery3.3.1.min.js"); ?>"></script>
<script src="<?php Loader::jsAddress("popper.min.js"); ?>"></script>
<script src="<?php Loader::jsAddress("bootstrap.min.js"); ?>"></script>
<script src="<?php Loader::jsAddress("main.js"); ?>"></script>

</body>
</html>
