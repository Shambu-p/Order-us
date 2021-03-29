<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/18/2020
 * Time: 11:58 AM
 */

$this->loadTemplate("header2.php");
?>
<br>
<div class="row">
    <div class="col-lg-3 col-md-2 col-sm-12">
        <div class="container">
            <img src="<?php Loader::imageAddress("index.jpg"); ?>" width="100%" class="img-thumbnail" alt="Cinque Terre">
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6 col-xl-3">

        <div class="container">

            <?php

            print "
                Name: ".$_SESSION['f_name']." ".$_SESSION['l_name']."<br>
                email: ".$_SESSION['email']." <br>
                role: ".$_SESSION['role']." <br>
                ";

            ?>

        </div>

    </div>
</div>
<br>
<div class="accordion" id="accordionExample">
    <div class="card">

        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?php print $_SESSION['email']; ?>
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="btn-group-vertical">

                    <form action="">
                        <div class="row">
                            <div class="col">
                                <input type="text" id="f_name_input" class="form-control" placeholder="First name">
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" id="register_btn">Change Email</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Change Name: <?php print $_SESSION['f_name']." ".$_SESSION['l_name']; ?>
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse bg-light" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="btn-group-vertical">

                    <form action="">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="text" id="f_name_input" class="form-control" placeholder="First name">
                            </div>
                            <br>
                            <div class="col-sm-10">
                                <input type="text" id="f_name_input" class="form-control" placeholder="First name">
                            </div>
                            <br>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" id="register_btn">Change Name</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Change Password
                </button>
            </h5>
        </div>
        <div id="collapseThree" class="collapse bg-light" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                <div class="btn-group-vertical">

                    <div class="form-group">
                        <label for="old_password_input">Current Password</label>
                        <input type="password" class="form-control" id="old_password_input" placeholder="Create Password">
                    </div>
                    <div class="form-group">
                        <label for="c_password_input">Confirm Password</label>
                        <input type="password" class="form-control" id="c_password_input" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <label for="c_password_input">Confirm Password</label>
                        <input type="password" class="form-control" id="c_password_input" placeholder="Confirm Password">
                    </div>

                    <button class="btn btn-primary" id="register_btn">Change Name</button>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->loadTemplate("footer2.php");
?>
