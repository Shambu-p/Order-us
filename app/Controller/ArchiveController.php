<?php
namespace Users\Controllers;

use Absoft\App\Loaders\Resource;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;

class ArchiveController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "get_image"){

            $response = $this->get_image($parameter);

        }else if($name == "save"){

            $response = $this->save($parameter);

        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named ArchiveController.".$name,
                __FILE__." on Line ".__LINE__
            );
        
            $response = Route::display("system_templates", "error");
        
        }
        
        return $response;

    }

    public function show(){
        //here write showing codes to be Executed
        return "";
    }

    private function get_image($request){

        print Resource::imageAddress($request->image);

        die();

    }
    
    public function view($request){
        //here write viewing codes to be Executed
        return "";
    }

    public function save($request){
        //Here write save codes to be Executed
        return "";
    }
    
    public function update($request){
        //here write updating codes to be Executed
        return "";
    }
    
    public function delete($request){
        //here write deleting codes to be Executed
        return "";
    }

}
?>
