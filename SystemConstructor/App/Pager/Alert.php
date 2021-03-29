<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 6/20/2020
 * Time: 11:47 AM
 */

namespace Absoft\App\Pager;

class Alert
{

    public static function sendSuccessAlert($message){

        $_SESSION["_system"]["alert"]["success"]["message"] = $message;

    }

    public static function sendInfoAlert($message){

        $_SESSION["_system"]["alert"]["info"]["message"] = $message;

    }

    public static function sendErrorAlert($message){

        $_SESSION["_system"]["alert"]["error"]["message"] = $message;

    }

    public static function displayAlert(){

        if(isset($_SESSION["_system"]["alert"]["success"]["message"]) && $_SESSION["_system"]["alert"]["success"]["message"] != ""){

            print '
            
            <div class="'.$_SESSION["_system"]["alert"]["success"]["class_name"].'">
            
            '.$_SESSION["_system"]["alert"]["success"]["message"].'
            
            </div>
            
            ';

            $_SESSION["_system"]["alert"]["success"]["message"] = "";

        }

        if(isset($_SESSION["_system"]["alert"]["info"]["message"]) && $_SESSION["_system"]["alert"]["info"]["message"] != ""){

            print '
            
            <div class="'.$_SESSION["_system"]["alert"]["info"]["class_name"].'">
            
            '.$_SESSION["_system"]["alert"]["info"]["message"].'
            
            </div>
            
            ';

            $_SESSION["_system"]["alert"]["info"]["message"] = "";

        }

        if(isset($_SESSION["_system"]["alert"]["error"]["message"]) && $_SESSION["_system"]["alert"]["error"]["message"] != ""){

            print '
            
            <div class="'.$_SESSION["_system"]["alert"]["error"]["class_name"].'">
            
            '.$_SESSION["_system"]["alert"]["error"]["message"].'
            
            </div>
            
            ';

            $_SESSION["_system"]["alert"]["error"]["message"] = "";

        }

    }

    public static function setSuccessClassName($name){

        $_SESSION["_system"]["alert"]["success"]["class_name"] = $name;

    }

    public static function setErrorClassName($name){

        $_SESSION["_system"]["alert"]["error"]["class_name"] = $name;

    }

    public static function setInfoClassName($name){

        $_SESSION["_system"]["alert"]["info"]["class_name"] = $name;

    }

}
