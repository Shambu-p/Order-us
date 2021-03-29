<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/27/2020
 * Time: 8:40 AM
 */

function ErrorHandler(){

// Let's get last error that was fatal.
    $error = error_get_last();

// This is error-only handler for example purposes; no error means that
// there were no error and shutdown was proper. Also ensure it will handle

    if (null === $error) {
        return;
    }


    $error_type = $error["type"];
    $error_file = $error["file"];
    $error_line = $error["line"];
    $error_message = ''.$error["message"];

    \ErrorHandler::reportError($error_type, $error_message, ($error_file." on line ".$error_line), "immediate");

}

ini_set('display_errors', 0);

error_reporting(E_ALL);

register_shutdown_function('ErrorHandler');

?>

