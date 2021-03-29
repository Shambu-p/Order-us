<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/16/2020
 * Time: 11:02 AM
 */

namespace Absoft\App\Engines;

use Absoft\App\Routing\Route;

class Engine
{

    public $headers = null;
    public $files = null;
    public $request = null;
    public $_main_address = "";

    function __construct($address){

        $this->_main_address = $address;

        $received = $this->receiveRequest();

        $this->init($received->headers, $received->request, $received->files);

    }

    function init($_headers, $_request, $_files){

        //print "initializing the engine <br>";

        $this->headers = $_headers;
        $this->files = $_files;
        $this->request = $_request;

        //print_r($this->request);

    }

    function interpretRequest(){

        //print_r($this->headers);
        //print "interpreting request <br>";
        if(ViewerEngine::checkCompatibility($this->headers)){

            return "view";

        }else if(ControlEngine::checkCompatibility($this->headers)){

            return "control";

        }

        return "none";

    }

    function interpretResponse($response){

        //print "interpreting response <br>";
        $r_object = json_decode($response);

        //print_r($r_object);
        //print_r($this->headers);

        $headers = null;
        $request = null;

        if(isset($r_object->headers)){

            $headers = $r_object->headers;

        }

        if(isset($r_object->request)){

            $request = $r_object->request;

        }

        $this->init($headers, $request, new \stdClass());

        //print_r($this->request);
        //print_r($this->headers);

        $this->start();

    }

    function getRequests($index, $name, $header){

        if($header[1] == "api"){

            if(isset($_POST["request"])){

                return json_decode($_POST["request"]);

            }

        }

        $reqs = [];
        $route_addresses = Route::getRouteAddress();

        if(isset($route_addresses[$name])){

            $def = explode("/", $route_addresses[$name]);

            if(sizeof($def) > 1){

                for($i = 1; $i < sizeof($def); $i++){

                    if(isset($_POST[$def[$i]])){

                        $reqs[$def[$i]] = $_POST[$def[$i]];

                    }
                    else if(isset($header[$index])){

                        $reqs[$def[$i]] = $header[$index];

                    }
                    else{

                        \ErrorHandler::reportError(
                            "Missing Parameter",
                            "In route ".$name." parameter named ".$def[$i]." missed.",
                            __FILE__." on line ".__LINE__,
                            "immediate"
                        );
                        break;

                    }

                    $index += 1;

                }

            }

        }
        else{

            for($i = $index; $i < sizeof($header); $i++){

                $reqs[] = $header[$i];

            }

        }

        return (object) $reqs;

    }

    function receiveRequest(){

        $return = new \stdClass();
        $return->headers = new \stdClass();

        $header = explode("/", $_SERVER["REQUEST_URI"]);

        if(!isset($header[1])){

            $return->headers->home_page = "home";
            $return->request = new \stdClass();
            $return->files = new \stdClass();

            return $return;

        }

        if($header[1] == "system_call"){
            $_SESSION["_system"]["error_handling"]["error_for"] = "UI";

            $return->headers->system_call = $header[1];
            $return->headers->mtd = $header[2];

            $name = "/system_call/".$header[2];

            $index = 3;

        }
        else if($header[1] == "pages"){
            $_SESSION["_system"]["error_handling"]["error_for"] = "UI";

            if($header[2] == "home_page"){

                $return->headers->home_page = $header[2];

                $index = 3;
                $name = "/pages/home_page";

            }else{

                $return->headers->page_name = $header[2];
                $return->headers->sub_page = $header[3];

                $index = 4;
                $name = "/pages/".$header[1]."/".$header[2];

            }

        }
        else if(empty($header[1])){

            $_SESSION["_system"]["error_handling"]["error_for"] = "UI";
            $return->headers->home_page = "home";

            $index = 1;
            $name = "/";

        }
        else{

            if($header[1] == "api"){

                $_SESSION["_system"]["error_handling"]["error_for"] = "API";
                $return->headers->controller = $header[1];

            }
            else{

                $_SESSION["_system"]["error_handling"]["error_for"] = "UI";
                $return->headers->controller = $header[1]."Controller";

            }

            $return->headers->mtd = $header[2];

            $index = 3;
            $name = "/".$header[1]."/".$header[2];

        }

        $return->request = $this->getRequests($index, $name, $header);

        if(sizeof($_FILES) > 0){

            $return->files = json_decode(json_encode($_FILES));

        }else{

            $return->files = new \stdClass();

        }

        return $return;

    }

    public static function loadAddress(){

        if($_SERVER["SERVER_PORT"] != 80){
            $_SESSION["_system"]["_app_url"] = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/";
            $_SESSION["_system"]["_main_url"] = str_replace("\\", "/", dirname(dirname(dirname( __DIR__))))."/app/";
        }
        else{
            $_SESSION["_system"]["_app_url"] = "http://".$_SERVER["SERVER_NAME"]."/";
            $_SESSION["_system"]["_main_url"] = str_replace("\\", "/", dirname(dirname(dirname( __DIR__))))."/app/";
        }

    }

    function start(){

        $to = $this->interpretRequest();

        if($to == "view"){

            $view = new ViewerEngine($this->headers, $this->request, $this->_main_address);
            $view->prepareView();
            $view->showPage();

        }else if($to == "control"){

            $control = new ControlEngine($this->headers, $this->request, $this->files, $this->_main_address);
            $response = $control->control();

            $this->interpretResponse($response);

        }else{

            //$rs = new stdClass();
            //$rs->headers = $this->headers;
            //$rs->request = $this->request;
            //print_r($this->headers);
            //print json_encode($this->headers);

        }

    }

}
