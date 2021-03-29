<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/16/2020
 * Time: 10:23 AM
 */

namespace Absoft\App\Engines;

use \Absoft\App\Routing\Route;
use Absoft\App\Security\IpCheck;
use Absoft\Line\Api\Controllers\ApiController;
use Absoft\Line\Attributes\Creator;
use Users\Super\AdminController;

class ControlEngine
{

    public $headers = null;
    public $requests = null;
    public $files = null;
    public $_main_address = "";
    public $_app_url = "";

    function __construct(\stdClass $_headers, $_request, \stdClass $_file, $address){

        $this->headers = $_headers;
        $this->requests = $_request;
        $this->files = $_file;
        $this->_main_address = $address;
        $this->_app_url = $_SESSION["_system"]["_app_url"];

    }

    static function checkCompatibility($_headers){

        if(isset($_headers->controller) && isset($_headers->mtd)){

            return true;

        }else if(isset($_headers->system_call) && isset($_headers->mtd)){

            return true;

        }else if(isset($_headers->api)){

            return true;

        }else{

            return false;

        }

    }

    function control(){

        if(isset($this->headers->controller) && isset($this->headers->mtd)){

            if($this->headers->controller == "api"){

                \ErrorHandler::errorForApi();
                $controller_object = new ApiController();
                return $controller_object->route($this->headers->mtd, $this->requests);

            }
            elseif($this->headers->controller == "Admin"){

                \ErrorHandler::errorForApi();
                $controller_object = new AdminController();
                return $controller_object->route($this->headers->mtd, $this->requests);

            }
            else if($this->headers->controller != "api"){

                $controller_name = $this->headers->controller;

                if(!file_exists($this->_main_address."app/Controller/$controller_name.php")){

                    \ErrorHandler::reportError(
                        "Controller Not Found!",
                        "There is no file or controller on ' $this->_main_address Controller/$controller_name.php '",
                        __FILE__. " on line ".__LINE__
                    );

                    return Route::display("system_templates", "error");

                }


                include_once $this->_main_address."app/Controller/$controller_name.php";

                $full_c_name = 'Users\Controllers\\'.$controller_name;

                $controller_object = new $full_c_name($this->headers, $this->requests, $this->_main_address, $this->_app_url, $this->files);//Controller Initialization

                if($controller_object){

                    \ControllerNotFound::controller_not_found($this->headers->controller);

                    return \ControllerNotFound::displayError();

                }

                return $controller_object->route($this->headers->mtd, $this->requests);

            }
            else{

                \ErrorHandler::reportError(
                    "Method Were Not Set!",
                    "no method were set in controller. this might be because of error in Route class in route method.",
                    "controller"
                 );

                return Route::display("system_templates", "error");

            }

        }
        else if(isset($this->headers->system_call) && isset($this->headers->mtd)){

            if(IpCheck::isLocal(IpCheck::clientIp())){

                $method = $this->headers->mtd;

                $controller_object = new Creator();
                $response = $controller_object->route($method, $this->requests);
                print $response;
                $response_go = '
            {
                "headers": "json",
                "request": '. $response.' } ';
                return $response_go;

            }else{
                return "";
            }

        }
        else{

            \ErrorHandler::reportError(
                "No Controller provided",
                "No controller name were provided. this might be because because of class route.",
                __FILE__." on line ".__LINE__
             );

            return Route::display("system_templates", "error");

        }

    }


}
