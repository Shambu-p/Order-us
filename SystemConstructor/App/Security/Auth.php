<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/9/2020
 * Time: 12:55 PM
 */

namespace Absoft\App\Security;

use Users\Models\UsersModel;

class Auth{

    public static function grant($user){

        $user_model = new UsersModel();
        $_SESSION["auth"]["login"] = "true";

        foreach ($user_model->MAINS as $main => $value){

            if(isset($user[$main])){

                $_SESSION["auth"][$main] = $user[$main];

            }

        }

    }

    public static function user(){

        if(isset($_SESSION["auth"]) && sizeof($_SESSION["auth"]) > 0){

            return (object) $_SESSION["auth"];

        }

        return null;

    }

    public static function deni(){

        unset($_SESSION["auth"]);

    }

    public static function checkLogin(){

        if(isset($_SESSION["auth"]["login"]) && $_SESSION["auth"]["login"] == "true"){
            return true;
        }

        return false;

    }

    public static function checkUser($key, $value){

        if(self::checkLogin() && self::user()->$key == $value){

            return true;

        }

        return false;

    }

}
