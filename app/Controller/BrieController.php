<?php
namespace Users\Controllers;

use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;

class BrieController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show();

        }else if($name == "save"){

            $response = $this->save($parameter);

        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named BrieController.".$name,
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
