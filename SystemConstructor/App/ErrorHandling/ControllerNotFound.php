<?php



class ControllerNotFound extends ErrorHandler
{

    private static $title = "ControllerNotFound Exception";
    private static $error_file = "SystemConstructor/App/Engines/ControlEngine.php";
    private static $description = "";
    private static $urgency = "immediate";

    public static function controller_not_found($controller_name){

        self::$description = "
        There is no Controller named ' $controller_name '. 
        this might be because the controller not defined in routes.php 
        or may be it is defined incorrectly.";

        parent::reportError(self::$title, self::$description, self::$error_file, self::$urgency);

    }

}