<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/16/2021
 * Time: 10:39 PM
 */

use Absoft\App\Security\Auth;

if(Auth::checkUser("role", "admin")){
    $this->loadTemplate("layouts/admin_header.php");
}
else if(Auth::checkUser("role", "designer")){
    $this->loadTemplate("layouts/designer_header.php");
}
else if(Auth::checkUser("role", "cashier")){
    $this->loadTemplate("layouts/cashier_header.php");
}
else{
    print '
    
    <div class="jumbotron">
        <h1 class="display-4">Incorrect page</h1>
    </div>
    
    ';
    die();
}

?>

<div class="container mt-3">

    <?php

    if(isset($this->request->user) && sizeof((array) $this->request->user) > 0){

        $user = $this->request->user;

        if(Auth::user()->username == $user->username){

            print '
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">change Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">change Password</a>
                </li>
            </ul>
            
            ';

        }

        print '
        
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active pt-3" id="home" role="tabpanel" aria-labelledby="home-tab">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">'.$user->f_name." ".$user->l_name.'</li>
                <li class="list-group-item">'.$user->username.'</li>
                <li class="list-group-item">'.$user->email.'</li>
                <li class="list-group-item">'.$user->phone_number.'</li>
                <li class="list-group-item">'.strtoupper($user->role).'</li>
                <li class="list-group-item">'.$user->status.'</li>
            </ul>
        </div>
        <div class="tab-pane fade pt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form action="'.$this->route_address("Users.change_name").'" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="name_description">Change Your Name</span>
                    </div>
                    <input type="text" class="form-control" name="f_name" value="'.$user->f_name.'" placeholder="First Name" aria-label="First Name" aria-describedby="name_description">
                    <input type="text" class="form-control" name="l_name" value="'.$user->l_name.'" placeholder="Last Name" aria-label="Last Name" aria-describedby="name_description">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="submit">Change</button>
                    </div>
                </div>
            </form>

                <form action="'.$this->route_address("Users.change_email").'" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="email_description">Change Your Email</span>
                    </div>
                    <input type="email" class="form-control" name="email" value="'.$user->email.'" placeholder="Email Address" aria-label="Email Address" aria-describedby="email_description">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="submit">Change</button>
                    </div>
                </div>
            </form>

            <form action="'.$this->route_address("Users.change_phone").'" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="phone_description">Change Your Phone</span>
                    </div>
                    <input type="number" class="form-control" name="phone" value="'.$user->phone_number.'" placeholder="Phone Number" aria-label="Phone Description" aria-describedby="phone_description">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="submit">Change</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="tab-pane fade pt-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <form action="'.$this->route_address("Users.change_password").'" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="old_pass_description">Change Your Phone</span>
                    </div>
                    <input type="password" class="form-control" name="old_pass" placeholder="Old Password" aria-label="Phone Description" aria-describedby="old_pass_description">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="new_pass_description">New Password</span>
                    </div>
                    <input type="password" class="form-control" name="new_pass" placeholder="New Password" aria-label="Phone Description" aria-describedby="new_pass_description">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="conf_pass_description">Confirm New Password</span>
                    </div>
                    <input type="password" class="form-control" name="conf_pass" placeholder="Confirm Password" aria-label="Phone Description" aria-describedby="conf_pass_description">
                </div>

                <button class="btn btn-dark" type="submit">Change</button>

            </form>
        </div>
    </div>
        
        ';

    }

    ?>

</div>

<?php
$this->loadTemplate("layouts/admin_footer.php");
?>
