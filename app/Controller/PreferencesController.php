<?php
namespace Users\Controllers;

use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Absoft\App\Security\Auth;
use Users\Models\PreferencesModel;

class PreferencesController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show();

        }else if($name == "save"){

            $response = $this->save($parameter);

        }else if($name == "designer_api_view"){

            $response = $this->designerApiView($parameter);

        }else if($name == "customer_view"){

            $response = $this->customerView($parameter);

        }else if($name == "admin_api_view"){

            $response = $this->adminApiView($parameter);

        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named PreferencesController.".$name,
                __FILE__." on Line ".__LINE__
            );
        
            $response = Route::display("system_templates", "error");
        
        }
        
        return $response;

    }

    private function adminApiView($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", []);

        }

        $model = new PreferencesModel();
        $return = $model->simpleByOrder($request->order);

        return Route::display("my_api", "api", $return);

    }

    private function customerView($request){

        if(!isset($_SESSION["customer_log"])){
            return Route::display("my_api", "api", []);
        }

        $model = new PreferencesModel();
        $return = $model->simpleByOrder($request->order);

        return Route::display("my_api", "api", $return);

    }

    private function designerApiView($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "designer")){

            return Route::display("my_api", "api", []);

        }

        $model = new PreferencesModel();
        $return = $model->simpleByOrder($request->order);

        return Route::display("my_api", "api", $return);

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
