<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/5/2020
 * Time: 8:43 AM
 */

namespace Absoft\App\Routing;

class Route{

    private static $route_map = [];


    function __construct(){

    }

    public static function route($name, $req_array = []){

        $return["headers"] = Route::routeAddress($name);
        $return["request"] = $req_array;
        $return["files"] = new \stdClass();
        if(isset($return["headers"]["controller"]) && $return["headers"]["controller"] != "api"){
            $return["headers"]["controller"] .= "Controller";
        }

        return json_encode($return);

    }

    public static function routeAddress($name){

        $pos = strpos($name, ".");
        $count = 0;
        $controller = "";
        $method = "";

        if($pos){

            while(isset($name[$count])){

                if($count > $pos){

                    $method .= $name[$count];

                }else if($count < $pos){

                    $controller .= $name[$count];

                }

                $count +=1;
            }

        }else {

            $controller .= $name;

        }

        //$address = "request.php?controller=$controller&mtd=$method&$request";
        $return["controller"] = $controller;
        $return["mtd"] = $method;

        return $return;

    }

    public static function getController($name){

        $return = null;

        try{

            $reflection = new \ReflectionClass($name);
            $return = $reflection->newInstance();

        }catch(\ReflectionException $e){

            \ErrorHandler::reportError(
                "Can't Initialize Class $name",
                $e->getMessage(),
                __FILE__." on line ".__LINE__,
                "immediate"
            );

            die("error");

        }

        return $return;

    }

    public static function getModel($name){

        $return = null;

        if(isset(Route::$route_map[$name])){

            try{

                $mdl = Route::$route_map[$name];
                $reflection = new \ReflectionClass($mdl."Model");
                $return = $reflection->newInstance();

            }catch(\ReflectionException $e){

                \ErrorHandler::reportError(
                    "Can't Initialize Class",
                    $e->getMessage(),
                    __FILE__." on line ".__LINE__,
                    "immediate"
                );

                die("error");

            }

        }

        return $return;

    }

    public static function getModelName($cont_name){

        $return = "";

        if(isset(Route::$route_map[$cont_name])){

            $return .= Route::$route_map[$cont_name];

        }

        return $return;

    }

    public static function display($page_name, $sub_page, $request = array()){

        $return = [];

        $return["headers"]["page_name"] = $page_name;
        $return["headers"]["sub_page"] = $sub_page;

        if(sizeof($request) > 0){

            $return["request"] = $request;

        }else{

            $return["request"] = null;

        }

        return json_encode($return);

    }

    public static function goRoute($name, $req_array = array()){

        header("location: ".Route::goRouteAddress($name, $req_array));
        die();

    }

    public static function goRouteAddress($name, $req_array = array()){

        $header = Route::routeAddress($name);
        $request = '';
        $address = $header["controller"]."/".$header["mtd"];
        $route_address = Route::getRouteAddress();

        if(isset($route_address["/$address"])){

            $str = explode("/", $route_address["/".$address]);

            foreach ($str as $key => $value){

                if($key > 0 && isset($req_array[$value])){

                    $request .= "/".$req_array[$value];

                }

            }

        }

        return $_SESSION["_system"]["_app_url"].$address.$request;

    }

    public static function viewAddress($page_name, $sub_page, $parameter_array = array()){

        $req = '';
        $address = "pages/$page_name/$sub_page";
        $route_address = Route::getRouteAddress();

        if(isset($route_address["/$address"])){

            $str = explode("/", $route_address["/".$address]);

            foreach ($str as $key => $value){

                if($key != 0 && isset($parameter_array[$value])){

                    $req .= "/".$parameter_array[$value];

                }

            }

        }

        return $_SESSION["_system"]["_app_url"].$address.$req;

    }

    public static function view($page_name, $sub_page, $parameter_array = array()){

        $address = Route::viewAddress($page_name, $sub_page, $parameter_array);
        header("location: ".$address);
        die("redirected");

    }

    public static function homeAddress(){

        if($_SERVER["SERVER_PORT"] != 80){
            return "http://".$_SERVER["HTTP_HOST"];
        }

        return "http://".$_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"];

    }

    public static function goHome(){

        header("Location: ".self::homeAddress());

        die();

    }

    public static function get($name){

        $return = "";

        if(isset(Route::$route_map[$name])){

            $return .= Route::$route_map[$name];

        }else{

            \ErrorHandler::reportError(
                "No Route exist",
                "there is no route named $name ",
                __FILE__." on line ".__line__
            );

            die("error");

        }

        return $return;

    }

    public static function set($route_name, $parameters){

        Route::$route_map[$route_name] = $parameters;

    }

    public static function getRouteAddress(){

        return self::$route_map;

    }

    public static function lineVariables(){

        $json = file_get_contents($_SESSION["_system"]["_main_url"]."conf.json");
        $conf = json_decode($json);
        unset($json);
        return (Array) $conf;

    }

}
