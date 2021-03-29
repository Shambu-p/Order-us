<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/15/2020
 * Time: 11:22 AM
 */

namespace Absoft\App\Engines;

use Absoft\App\Loaders\Loader;
use Absoft\App\Loaders\Resource;
use Absoft\App\Pager\Alert;
use Absoft\App\Routing\Route;

class ViewerEngine
{

    public $headers = [];
    public $request = null;
    public $GO_TO_ADDRESS = "";
    public $_main_address = "";
    public $_app_url = "";
    private $error_page = false;

    function __construct(\stdClass $_headers, $_request, $address){

        $this->headers = $_headers;
        $this->request = $_request;
        $this->_main_address = $address;
        $this->_app_url = $_SESSION["_system"]["_app_url"];

    }

    static function checkCompatibility($_headers){

        //$hdr = (array) $_headers;
        if(isset($_headers->page_name) && isset($_headers->sub_page)){

            return true;

        }else if(isset($_headers->home_page)){

            return true;

        }else{

            return false;

        }

    }

    function prepareView(){

        if(isset($this->headers->page_name) && isset($this->headers->sub_page)){

            $page = strtolower($this->headers->page_name);

            $sub_page = strtolower($this->headers->sub_page);

            if($page == "system"){

                $this->GO_TO_ADDRESS = $this->_main_address."SystemConstructor/App/Templates/$sub_page.php";

            }
            else if($page == "system_templates"){

                $this->GO_TO_ADDRESS = $this->_main_address."SystemConstructor/App/Templates/$sub_page/index.php";

            }
            else{

                $this->GO_TO_ADDRESS = $this->_main_address."app/Templates/$page/$sub_page/index.php";

            }

        }
        else if(isset($this->headers->home_page)){

            //$this->GO_TO_ADDRESS = $this->_main_address."app/Templates/public.php";

            Route::goRoute("Posts.show", ["page_number" => 1]);
            //die("");

        }

        if($this->GO_TO_ADDRESS == $this->_main_address."SystemConstructor/App/Templates/error/index.php"){

            $this->error_page = true;

        }else{
            $this->error_page = false;
        }

    }

    function showPage(){

        if(!$this->error_page){

            \ErrorHandler::showError();

        }

        if(file_exists($this->GO_TO_ADDRESS)){

            include_once ($this->GO_TO_ADDRESS);

        }else{

            $this->request = new \stdClass();
            $this->request->title = "File Not found";
            $this->request->error_file = __FILE__." on line ".__LINE__;
            $this->request->description = "File path $this->GO_TO_ADDRESS dose not exist.";

            include_once $this->_main_address."SystemConstructor/App/Templates/error/index.php";

        }

        \ErrorHandler::showError();

    }

    function loadTemplate($template_name){

        include_once "./Templates/$template_name";

    }

    function load_css($style_name){

        return Loader::cssAddress($style_name);

    }

    function load_js($js_name){

        return Loader::jsAddress($js_name);

    }

    function load_img($img_name){

        return Resource::imageAddress($img_name);

    }

    function load_doc($doc_address){

        return Resource::loadDocuments($doc_address);

    }

    function route_address($name, $request_array = []){

        return Route::goRouteAddress($name, $request_array);

    }

    function view_address($page_name, $sub_page, $request_array=[]){

        return Route::viewAddress($page_name, $sub_page, $request_array);

    }

    function view($page_name, $sub_page, $request_array=[]){

        Route::view($page_name, $sub_page, $request_array);

    }

    function route($name, $request_array=[]){

        Route::goRoute($name, $request_array);

    }

    function show_alert(){

        Alert::displayAlert();

    }

    function set_alert_classname($success="", $info="", $error=""){

        Alert::setErrorClassName($error);
        Alert::setSuccessClassName($success);
        Alert::setInfoClassName($info);

    }

}
