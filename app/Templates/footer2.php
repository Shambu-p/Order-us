<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/21/2020
 * Time: 8:36 PM
 */


?>

<hr>
<br>
<div class="container">
    <div class="row">
        <div class="col-10">
            <p>
                Smart Techno All Rights Reserved
                <?php
                $date = new DateTime();
                print $date->format("M Y").'<sup>&copy;</sup>';
                ?>

            </p>
        </div>
        <div class="col-2">
            Powered by Ab Soft
        </div>
    </div>
</div>

</div>
<!-- end of central column -->
<div class="col"></div>
</div>
<!-- end of row -->

</div>
<!-- end of inner-container -->

</div>
<!-- end of outer-container -->

<script src="<?php Loader::jsAddress("jquery3.3.1.min.js"); ?>"></script>
<script src="<?php Loader::jsAddress("popper.min.js"); ?>"></script>
<script src="<?php Loader::jsAddress("bootstrap.min.js"); ?>"></script>
<script src="<?php Loader::jsAddress("home_2.js"); ?>"></script>

</body>
</html>
