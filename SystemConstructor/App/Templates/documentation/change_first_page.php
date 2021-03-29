<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/28/2020
 * Time: 9:25 PM
 */

?>

<h1 class="display-4">Change First Page of the Project</h1>
<p>

    <big>
        When you navigate to the http://localhost/framework/public/ this will open default page of
        the framework. You can change this page into your page first page in two ways. The first is
        you can redirect to the page you created inside the Templates folder.
    </big> <br>
</p>

<img src="../../../images/doc_img1.png" width="100%" alt="doc_image1">

<p>

    <big>
        And the second is you can redirect to the controller you wish to be computed. To do that
        first you need to find ../SystemConstructor/App/Engines/ViewerEngine.php file. Inside this
        file you should delete the include_once under the prepare method and then set route or
        redirect to the page you wish to display. for example :-
    </big>

</p>
<code>
    <big>
        }else{ <br>
        <i>//$this->GO_TO_ADDRESS = $this->_main_address."Templates/public.php";</i> <br>
        Route::goRoute("PostController.show"); <br>
        } <br>
    </big>
</code>
