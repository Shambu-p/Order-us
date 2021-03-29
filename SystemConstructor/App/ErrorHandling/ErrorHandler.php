<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 6/19/2020
 * Time: 11:00 PM
 */

use Absoft\App\Routing\Route;

abstract class ErrorHandler{

    public function getError(){

        return $_SESSION["_system"]["error_handling"]["error"];

    }

    public static function checkError(){

        if(isset($_SESSION["_system"]["error_handling"]["occurrence"]) && ($_SESSION["_system"]["error_handling"]["occurrence"] != null || $_SESSION["_system"]["error_handling"]["occurrence"] != "")){
            return $_SESSION["_system"]["error_handling"]["occurrence"];
        }else{
            return false;
        }
    }

    public static function showError(){

        if (ErrorHandler::checkError()) {

            Route::view("system_templates", "error");
            $_SESSION["_system"]["error_handling"]["occurrence"] = false;
            die("error");

        }

    }

    public static function displayError(){

        $_SESSION["_system"]["error_handling"]["occurrence"] = false;
        return Route::display("system_templates", "error");

    }

    public static function reportError($title, $description, $error_file, $urgency = "not_immediate"){

        $_SESSION["_system"]["error_handling"]["error"]["title"] = $title;
        $_SESSION["_system"]["error_handling"]["error"]["description"] = $description;
        $_SESSION["_system"]["error_handling"]["error"]["error_file"] = $error_file;
        $_SESSION["_system"]["error_handling"]["occurrence"] = true;

        if(isset($_SESSION["_system"]["error_handling"]["error_for"]) && $_SESSION["_system"]["error_handling"]["error_for"] != "API"){

            if($urgency == "immediate"){

                self::showError();

            }

        }

    }

    public static function clearError(){

        $_SESSION["_system"]["error_handling"]["error"] = [];
        $_SESSION["_system"]["error_handling"]["occurrence"] = false;

    }

    public static function errorForApi(){

        $_SESSION["_system"]["error_handling"]["error_for"] = "API";

    }

    public static function errorForUI(){

        $_SESSION["_system"]["error_handling"]["error_for"] = "UI";

    }

}
