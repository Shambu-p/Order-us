<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use Absoft\App\Security\Auth;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Users\Models\OrdersModel;
use \Users\Models\UsersModel;

class UsersController extends Controller{

    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show();

        }else if($name == "save"){

            $response = $this->save($parameter);

        }
        else if($name == "active_employees"){

            $response = $this->activeUsers();

        }
        else if($name == "active_designers"){

            $response = $this->adminApiShow();

        }
        else if($name == "deleted_employees"){

            $response = $this->deletedUsers();

        }
        else if($name == "delete"){

            $response = $this->delete($parameter);

        }
        else if($name == "view"){
            $response = $this->view($parameter);
        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named UsersController.".$name,
                __FILE__." on Line ".__LINE__
            );
        
            $response = Route::display("system_templates", "error");
        
        }
        
        return $response;

    }

    public function show(){
        //here write showing codes to be Executed

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new UsersModel();
        $result = $model->search([]);

        return Route::display("admin", "show_users", ["users" => $result]);

    }

    public function activeUsers(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new UsersModel();
        $result = $model->search(
            [
                [
                    "name" => "status",
                    "value" => "active",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        return Route::display("admin", "show_users", ["users" => $result]);

    }

    public function deletedUsers(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new UsersModel();
        $result = $model->search(
            [
                [
                    "name" => "status",
                    "value" => "deleted",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        return Route::display("admin", "show_users", ["users" => $result]);

    }
    
    public function view($request){
        //here write viewing codes to be Executed

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }

        $model = new UsersModel();

        $result = $model->byUsername($request->user);

        unset($result["password"]);

        return Route::display("common", "user_info", ["user" => $result]);

    }

    private function adminApiShow(){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", []);

        }

        $model = new UsersModel();
        $result = $model->activeDesigners();

        return Route::display("my_api", "api", $result);


    }

    public function save($request){

        if(!Auth::checkLogin()){
            Route::goRoute("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            Route::goRoute("Auth.get_in");
        }

        $model = new UsersModel();

        $result = $model->search([
            [
                "name" => "username",
                "value" => $request->username,
                "equ" => "=",
                "det" => "and"
            ]
        ]);

        if(sizeof($result)){

            Alert::sendInfoAlert("Same Username exist");
            Route::view("admin", "add_user");

        }
        else{

            $password = "pass_".strtotime("now");
            $adding = $model->addRecord(
                [
                    "username" => $request->username,
                    "f_name" => $request->f_name,
                    "l_name" => $request->l_name,
                    "email" => $request->email,
                    "role" => $request->role,
                    "status" => "active",
                    "phone_number" => $request->phone,
                    "password" => "pass_".strtotime("now")
                ]
            );

            if($adding){
                Alert::sendSuccessAlert("New $request->role has been added! the generated password is $password");
            }else{
                Alert::sendErrorAlert("Unknown Error Occurred");
            }

            Route::view("admin", "add_user");

        }

        return "";

    }

    public function change_password($request){

        if(!Auth::checkLogin()){
            Route::goRoute("Auth.sign_in");
        }

        $model = new UsersModel();

        $result = $model->search([
            [
                "name" => "username",
                "value" => Auth::user()->username,
                "equ" => "=",
                "det" => "and"
            ]
        ]);

        if(sizeof($result)){

            Alert::sendInfoAlert("Same Username exist");
            Route::view("admin", "add_user");

        }
        else{

            $password = "pass_".strtotime("now");
            $adding = $model->addRecord(
                [
                    "username" => $request->username,
                    "f_name" => $request->f_name,
                    "l_name" => $request->l_name,
                    "email" => $request->email,
                    "role" => $request->role,
                    "status" => "active",
                    "phone_number" => $request->phone,
                    "password" => "pass_".strtotime("now")
                ]
            );

            if($adding){
                Alert::sendSuccessAlert("New $request->role has been added! the generated password is $password");
            }else{
                Alert::sendErrorAlert("Unknown Error Occurred");
            }

            Route::view("admin", "add_user");

        }

        return "";

    }

    //ይህ ማጣት ቁጭቱን ረመጡን ጪሮ
    //ቢቃጠል አይሸታት ሆዴ ተንጨርጭሮ
    //ልቤ እንዲያ ሲቃጠል ላይቀናው ሰው ውዶ
    //ሲጨሰው ይደርሳል ባሳብ ወዲያ ማዶ
    //pass_1608118224
    public function delete($request){
        //here write updating codes to be Executed

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new UsersModel();

        $result = $model->changeState($request->user, "deleted");

        if($result){
            Alert::sendInfoAlert("Users has been Deleted");
        }else{
            Alert::sendErrorAlert("Unknown Error occurred! Operation failed");
        }

        Route::goRoute("Users.view", ["user" => $request->user]);
        return "";
        //አሰራሁ እንጂ ኩታውን ኩታውን አስጠለፍኩ እንጂ ጥለቱን አልጨረስኩትም ቁጭቱን

    }

}
?>
