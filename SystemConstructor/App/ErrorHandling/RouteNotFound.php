<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 6/19/2020
 * Time: 11:00 PM
 */

class RouteNotFound extends ErrorHandler
{

    private static $title = "RouteNotFound Exception";
    private static $error_file = "SystemConstructor/App/Routing/route.php";
    private static $description = "";
    private static $urgency = "immediate";


    /*
    public static function reportError($title, $description, $error_file, $urgency="immediate"){

        $title = "RouteNotFound Exception";

        $file_address = explode(" on line ", $error_file);

        $file_lines = file($file_address[0]);

        $description .= "<br> ".implode("<br>", $file_lines);

        parent::reportError($title, $description, $error_file, $urgency);

    }*/

    public static function route_not_found($route_name){

        self::$description = "there is no route named $route_name ";

        parent::reportError(self::$title, self::$description, self::$error_file, self::$urgency);

    }

}