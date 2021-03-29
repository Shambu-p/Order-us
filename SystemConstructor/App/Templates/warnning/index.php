<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 6/25/2020
 * Time: 6:32 PM
 */
$message = "not set";
if(isset($_SESSION["_system"]["error_handling"]["error"]["description"])){

    $message = $_SESSION["_system"]["error_handling"]["error"]["description"];

}

ErrorHandler::clearError();

?>

<html>
<head>
    <title>Warning</title>
    <link rel="stylesheet" href="<?php \Absoft\App\Loaders\Loader::cssAddress("bootstrap.min.css"); ?>">
</head>
<body class="bg-light">
<br>
<div class="container shadow p-3 mb-5 bg-light">
    <h1 class="display-5">You are not Eligible to use this page!</h1>
    <hr>
    <p>
        <small>
            <?php print $message; ?>
        </small>
    </p>
    <!--
    <div class="jumbotron rounded shadow-sm">
    </div>
    -->

</div>
</body>
</html>
