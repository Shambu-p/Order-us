<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Users\Models\DesignsModel;
use Users\Models\UsersModel;
use Absoft\App\Security\Auth;

class DesignsController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show($parameter);

        }else if($name == "save"){

            $response = $this->save($parameter);

        }else if($name == "view"){

            $response = $this->view($parameter);

        }else if($name == "admin_approval"){

            $response = $this->forAdminApproval($parameter);

        }else if($name == "open_designs"){

            $response = $this->openDesign($parameter);

        }
        else if($name == "selected_design"){

            $response = $this->selectedDesign($parameter);

        }
        else if($name == "approve_design"){

            $response = $this->approveDesign($parameter);

        }
        else if($name == "reject_design"){

            $response = $this->rejectDesign($parameter);

        }
        else{

            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named DesignsController.".$name,
                __FILE__." on Line ".__LINE__
            );

            $response = Route::display("system_templates", "error");
        
        }

        return $response;

    }

    private function approveDesign($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", ["status" => false, "message" => "you are not authorized!"]);

        }

        $model = new DesignsModel();

        $result = $model->update(
            [
                "price" => $request->price,
                "state" => "approved"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->design,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            return Route::display("my_api", "api", ["status" => true, "message" => ""]);

        }else{
            return Route::display("my_api", "api", ["status" => false, "message" => "unknown error"]);
        }

    }

    private function rejectDesign($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", ["status" => false, "message" => "you are not authorized!"]);

        }

        $model = new DesignsModel();

        $result = $model->update(
            [
                "state" => "rejected"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->design,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            return Route::display("my_api", "api", ["status" => true, "message" => ""]);

        }else{
            return Route::display("my_api", "api", ["status" => false, "message" => "unknown error"]);
        }

    }

    public function show($request){

        $return = [];

        //print_r($request);

        if(isset($this->request->for) && $this->request->for == "selection" && isset($this->request->card_type)){

            $model = new DesignsModel();

            $result = $model->search(
                [
                    [
                        "name" => "card_type",
                        "value" => $request->card_type,
                        "equ" => "=",
                        "det" => "and"
                    ]
                ]
            );

            $data1 = $result["returned"];
            $count = 0;

            foreach($data1 as $designs){

                $return["data"][$count]["designer"] = $designs["designer"];
                $return["data"][$count]["image_id"] = $designs["image"];
                $return["data"][$count]["type"] = $designs["card_type"];

                $model2 = new ImagesModel();

                $result2 = $model2->find($designs["image"]);

                $return["data"][$count]["image"] = "design_image_".$designs["image"].".".$result2["returned"][0]["location"];

                $count += 1;

            }

            Alert::sendSuccessAlert("All Designs!!");
            $return["for"] = $request->for;
            return Route::display("designs", "show", $return);

        }
        else{

            Alert::sendErrorAlert("missing parameter!!");
            return Route::display("designs", "show");

        }

    }

    private function forAdminApproval($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new DesignsModel();
        $users = new UsersModel();
        $return = [];

        $result = $model->forApproval($request->type);

        foreach($result as $item){

            $res = $users->getName($item["designer"]);

            if(sizeof($res)){
                $item["designer"] = $res;
            }
            else{
                $item["designer"] = $users->MAINS;
            }

            $return[] = $item;

        }

        unset($result);
        return Route::display("admin", "designes", ["type" => $request->type, "designs" => $return]);

    }

    private function openDesign($request){

        $model = new DesignsModel();
        $users = new UsersModel();
        $return = [];

        $result = $model->getOpen($request->type);

        foreach($result as $item){

            $res = $users->getName($item["designer"]);

            if(sizeof($res)){
                $item["designer"] = $res;
            }
            else{
                $item["designer"] = $users->MAINS;
            }

            $return[] = $item;

        }

        unset($result);
        return Route::display("open", "designes", ["designs" => $return]);

    }

    public function save($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "designer")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        if(isset($this->files->design_image)){

            $designer = Auth::user()->username;
            $oname = $this->files->design_image->name;
            $tmp_place = $this->files->design_image->tmp_name;
            $type = strtolower(pathinfo($oname)["extension"]);

            $allowed = array("jpg", "jpeg", "png", "ico");

            if(in_array($type, $allowed)){

                $model1 = new DesignsModel();

                $image_id = strtotime("now");

                if(move_uploaded_file($tmp_place, "resource/images/design_images/design_image_$image_id.$type")){

                    $model1->addRecord(
                        [
                            "image" => "design_image_$image_id.$type",
                            "type" => $request->type,
                            "name" => $request->name,
                            "price" => 0,
                            "state" => "new",
                            "designer" => $designer
                        ]
                    );

                    Alert::sendSuccessAlert("You have added new Design");
                    Route::view("designer", "new_design");

                }
                else{

                    unlink($tmp_place);
                    Alert::sendErrorAlert(" Cannot move the file. Operation failed!");
                    return Route::display("designer", "new_design");

                }

            }
            else{
                unlink($tmp_place);
                Alert::sendErrorAlert(" Incorrect Image Format! $type");
                return Route::display("designer", "new_design");
            }

        }
        else{

            Alert::sendInfoAlert("Add your New Design");
            return Route::display("designer", "new_design");

        }

        return "";

    }

    public function view($request){

        $return = [];

        if(isset($request->design)){

            $model = new DesignsModel();

            $result = $model->search(
                [
                    "id" => [
                        "value" => $request->design,
                        "equ" => "=",
                        "det" => "and"
                    ]
                ]
            );

            $i_id = $result["returned"][0]["image"];

            $return["type"] = $result["returned"][0]["card_type"];
            $return["designer"] = $result["returned"][0]["designer"];

            $model1 = new ImagesModel();
            $result1 = $model1->find($i_id);

            $return["image"] = "design_image_$i_id.".$result1["returned"][0]["location"];

            return Route::display("designs", "view", $return);

        }else{

            Alert::sendErrorAlert("no design id were set!!");
            return Route::display("designs", "view");

        }

    }

    private function selectedDesign($request){

        if(!Auth::checkLogin() && !isset($_SESSION["customer_log"])){

            return Route::display("my_api", "api", []);

        }

        $model = new DesignsModel();
        $result = $model->find($request->design);

        return Route::display("my_api", "api", $result);


    }
}
?>
