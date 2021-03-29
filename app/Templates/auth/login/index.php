<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/15/2020
 * Time: 11:37 AM
 */

\Absoft\App\Pager\Alert::setSuccessClassName("alert alert-success mt-3");
\Absoft\App\Pager\Alert::setErrorClassName("alert alert-danger mt-3");
\Absoft\App\Pager\Alert::setInfoClassName("alert alert-info mt-3");

?>

<html lang="en">

<head>
    <title>Login Page</title>
    <link rel="icon" href="<?php print $this->load_img("line.png"); ?>">
    <style><?php print $this->load_css("signin.css"); ?></style>
    <style><?php print $this->load_css("bootstrap.min.css"); ?></style>
</head>
<body class="text-center">

<form action="<?php print $this->route_address("Auth.login"); ?>" method="post" class="form-signin">
    <img class="mb-4 rounded" src="<?php print $this->load_img("line.png"); ?>" alt="" width="100">
    <br>
        <!--
    <a class="h3" href="#" style="text-decoration: none;">
    Geresu Duki Preparatory School
    </a>-->
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <?php \Absoft\App\Pager\Alert::displayAlert(); ?>

    <label for="username" class="sr-only">Username</label>
    <input type="text" id="username" class="form-control" placeholder="Username" name="user_name" required >
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" required>

    <button class="btn btn-lg btn-secondary btn-block mb-3" type="submit">Sign in</button>

    <a href="http://localhost/pages/auth/forget_password">Forgot Password?</a>

    <p class="mt-5 mb-3 text-muted">&copy; 2012E.C/2020G.C</p>
</form>

</body>

</html>
