<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/18/2020
 * Time: 11:57 AM
 */

$this->loadTemplate("header.php");
?>

<div class="row">
    <div class="col" id="side_bar">

    </div>
    <div class="col-xl-8 col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <div class="alert bg-light" role="alert">
            <h4 class="alert-heading">Welcome</h4>
            <p>
                In this page you will be abel to request registration for your self.
                when the management approves your request you will be abel to get access to your account accordingly.
            </p>
            <hr>
            <p class="mb-0">
                Here you have to fill the following form to request for registration.
            </p>
        </div>

        <form class="container" action="<?php Route::goRouteAddress("Users.save"); ?>" method="post">

            <div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" aria-describedby="usernameHelp" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email Address" required>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <input type="text" name="f_name" class="form-control" placeholder="First name">
                        <br>
                    </div>
                    <br>
                    <div class="col-md-6 col-sm-12">
                        <input type="text" name="l_name" class="form-control" placeholder="Last name">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <input type="number" class="form-control" name="phone" aria-describedby="phoneHelp" placeholder="Phone Number" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="user_role">Employee Type</label>
                    </div>
                    <select class="custom-select" id="user_role" name="role" required>
                        <option value="designer">Designer</option>
                        <option value="cashier">cashier</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="n_password_input">Create Password</label>
                    <input type="password" class="form-control" id="n_password_input" name="password" placeholder="Create Password" required>
                </div>
                <div class="form-group">
                    <label for="c_password_input">Confirm Password</label>
                    <input type="password" class="form-control" id="c_password_input" name="confirmation" placeholder="Confirm Password" required>
                </div>
                <button class="btn btn-primary" type="submit">Request Registration</button>
            </div>

        </form>
    </div>
    <div class="col"></div>
</div>

<br>

<?php
$this->loadTemplate("footer1.php");
?>
