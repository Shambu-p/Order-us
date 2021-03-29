<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/9/2020
 * Time: 4:52 PM
 */

namespace Absoft\App\Loaders;

class Loader
{

    /**
     * @param $model_name
     * @return object|null
     */
    public static function getModel($model_name){

        $md_name = Loader::capitalizeFirst($model_name, "Model");

        try{

            $reflection = new \ReflectionClass($md_name);
            $return = $reflection->newInstance();

        }catch (\Exception $e){

            $return = null;

        }

        return $return;

    }

    /**
     * @param $name
     * @param $suffix
     * @return string
     */
    public static function capitalizeFirst($name, $suffix){

        $md_name = "";
        $f_char = "";

        for ($i = 0; $i<strlen($name); $i++){

            if($i == 0){

                $f_char .= $name[$i];

            }else{

                $md_name .= $name[$i];

            }

        }

        $md_name = strtoupper($f_char).$md_name.$suffix;

        return $md_name;

    }

    /**
     * @param $name
     * @return object|null
     */
    public static function getEntity($name){

        $en_name = Loader::capitalizeFirst($name, "");

        try{

            $reflection = new \ReflectionClass($en_name);
            $return = $reflection->newInstance();

        }catch (\Exception $e){

            $return = null;

            \ErrorHandler::reportError(
                "Exception Occurred! Loading $name",
                $e->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

        }

        return $return;

    }

    public static function loadControllers($main_add){

        $path = $main_add."app/Controller";

        if(file_exists($path) && is_dir($path)){

            $list = dir($path);

            while(($file = $list->read()) != false) {

                if ($file == "." || $file == "..") {

                    continue;

                } else {

                    if(strpos($file, "Controller.php") > 0){

                        include_once $path."/$file";


                    }

                }

            }

        }else{

            \ErrorHandler::reportError("Folder Not Found!",
                "The controllers directory '".$path."' has been changed or deleted from the project folder. <br> 
                                    This might be because of the address fault or the project really edited.",
                __FILE__. " on line ".__LINE__,
                "immediate"
            );

        }

    }

    public static function loadModels($main_add){

        $path = $main_add."app/Models";

        if(file_exists($path) && is_dir($path)){

            $list = dir($path);

            while(($file = $list->read()) != false) {

                if ($file == "." || $file == ".." || $file == ""){

                    continue;

                } else {

                    if(strpos($file, "Model.php") > 0){

                        include_once $path."/$file";


                    }

                }

            }

        }else{

            \ErrorHandler::reportError("Folder Not Found!",
                "The controllers directory '".$path."' has been changed or deleted from the project folder. 
                                    This might be because of the address fault or the project really edited.",
                __FILE__. " on line ".__LINE__,
                "immediate"
            );

        }

    }

    public static function loadInitializer($main_add){

        $path = $main_add."app/Initializers";

        if(file_exists($path) && is_dir($path)){

            $list = dir($path);

            while(($file = $list->read()) != false) {

                if ($file == "." || $file == ".." || $file == "") {

                    continue;

                } else {

                    if(strpos($file, "Initializer.php") > 0){

                        include_once $path."/$file";


                    }

                }

            }

        }else{

            \ErrorHandler::reportError("Folder Not Found!",
                "The controllers directory '".$path."' has been changed or deleted from the project folder. 
                                    This might be because of the address fault or the project really edited.",
                __FILE__. " on line ".__LINE__,
                "immediate"
            );

        }

    }

    public static function loadEntity($main_add){

        $path = $main_add."app/DatabaseBuilder";

        if(file_exists($path) && is_dir($path)){

            $list = dir($path);

            while(($file = $list->read()) != false) {

                if ($file == "." || $file == "..") {

                    continue;

                } else {

                    include_once $path."/$file";

                }

            }

        }else{

            \ErrorHandler::reportError("Folder Not Found!",
                "The controllers directory '".$path."' has been changed or deleted from the project folder. 
                                    This might be because of the address fault or the project really edited.",
                __FILE__. " on line ".__LINE__,
                "immediate"
            );

        }

    }

    public static function checkIp(){

        include_once "../SystemConstructor/App/Security/ip_checker.php";
    }

    public static function loadModel($model_name){

        include_once "./Models/$model_name.php";

    }

    public static function jsAddress($js_name){

        if(file_exists($_SESSION["_system"]["_main_url"]."src/js/$js_name")){

            return file_get_contents($_SESSION["_system"]["_main_url"]."src/js/$js_name");

        }
        else{

            \ErrorHandler::reportError("JS Not Found!",
                "js not found on ".$_SESSION["_system"]["_main_url"]."src/js/$js_name",
                __FILE__. " on line ".__LINE__,
                "immediate"
            );

            return "";

        }

    }

    public static function cssAddress($css_name){

        if(file_exists($_SESSION["_system"]["_main_url"]."src/css/$css_name")){
            return file_get_contents($_SESSION["_system"]["_main_url"]."src/css/$css_name");
        }
        else{

            \ErrorHandler::reportError("JS Not Found!",
                "js not found on ".$_SESSION["_system"]["_main_url"]."src/css/$css_name",
                __FILE__. " on line ".__LINE__,
                "immediate"
            );

            return "";

        }

    }

}
