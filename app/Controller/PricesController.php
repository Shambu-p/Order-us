<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use Absoft\App\Security\Auth;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Users\Models\PricesModel;

class PricesController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show();

        }else if($name == "save"){

            $response = $this->save($parameter);

        }else if($name == "open_show"){

            $response = $this->openShow();

        }else if($name == "delete"){

            $response = $this->delete($parameter);

        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named PricesController.".$name,
                __FILE__." on Line ".__LINE__
            );
        
            $response = Route::display("system_templates", "error");
        
        }
        
        return $response;

    }

    public function show(){
        //ToDo: here write showing codes to be Executed

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new PricesModel();

        $result = $model->search([]);

        return Route::display("admin", "prices", ["prices" => $result]);

    }

    private function openShow(){

        $model = new PricesModel();

        $result = $model->allPrices();

        return Route::display("open", "pricing", ["prices" => $result]);

    }
    
    public function view($request){
        //ToDo: here write viewing codes to be Executed
        return "";
    }

    private function save($request){
        //ToDo: Here write save codes to be Executed

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new PricesModel();

        $result = $model->addRecord(
            [
                "type" => $request->type,
                "determiner" => $request->determiner,
                "value" => $request->value,
                "price" => $request->price
            ]
        );

        if($result){

            Alert::sendSuccessAlert("New Price add for ".$request->type);
            Route::view("admin", "new_price");

        }
        else{

            Alert::sendErrorAlert("Unknown Error");
            Route::view("admin", "new_price");

        }

        return "";
    }
    
    public function update($request){
        //here write updating codes to be Executed
        return "";
    }
    
    public function delete($request){
        //here write deleting codes to be Executed

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new PricesModel();
        $result = $model->deleteRecord(
            [
                [
                    "name" => "type",
                    "value" => $request->type,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "determiner",
                    "value" => $request->determiner,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "value",
                    "value" => $request->value,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Route::goRoute("Prices.show");

        }
        else{
            Alert::sendErrorAlert("Operation failed!");
            Route::goRoute("Prices.show");
        }

        return "";
    }

}
?>
