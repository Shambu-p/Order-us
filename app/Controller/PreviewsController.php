<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Absoft\App\Security\Auth;
use Users\Models\OrdersModel;
use Users\Models\PreviewsModel;

class PreviewsController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show($parameter);

        }else if($name == "save"){

            $response = $this->save($parameter);

        }else if($name == "update"){

            $response = $this->update($parameter);

        }else if($name == "api_admin_preview"){

            $response = $this->adminApiView($parameter);

        }else if($name == "api_designer_preview"){

            $response = $this->designerApiView($parameter);

        }
        else if($name == "customer_view"){

            $response = $this->customerView($parameter);

        }
        else if($name == "api_decline"){

            $response = $this->apiDecline($parameter);

        }
        else if($name == "api_grant"){

            $response = $this->apiGrant($parameter);

        }
        else if($name == "api_delete"){

            $response = $this->apiDelete($parameter);

        }
        else if($name == "customer_select"){

            $response = $this->customerSelect($parameter);

        }
        else{

            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named PreviewsController.".$name,
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

        \ErrorHandler::errorForApi();
        $model = new PreviewsModel();

        return Route::display("my_api", "api", $model->byOrder($request->order));

    }

    private function customerView($request){

        if(!isset($_SESSION["customer_log"])){
            return Route::display("my_api", "api", []);
        }

        \ErrorHandler::errorForApi();
        $model = new PreviewsModel();
        $result = $model->search(
            [
                [
                    "name" => "orders",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "status",
                    "value" => "granted",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        return Route::display("my_api", "api", $result);

    }

    private function designerApiView($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "designer")){

            return Route::display("my_api", "api", []);

        }

        \ErrorHandler::errorForApi();
        $model = new PreviewsModel();

        return Route::display("my_api", "api", $model->byOrder($request->order));

    }

    private function apiDecline($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", ["status" => false, "message" => "you are not authorized"]);

        }

        $model = new PreviewsModel();
        \ErrorHandler::errorForApi();

        $result = $model->update(
            [
                "status" => "declined",
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->preview,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            return Route::display("my_api", "api", ["status" => true, "message" => "preview has been declined"]);

        }
        else{

            return Route::display("my_api", "api", ["status" => false, "message" => "unknown error"]);

        }

    }

    private function apiGrant($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", ["status" => false, "message" => "you are not authorized"]);

        }

        $model = new PreviewsModel();
        \ErrorHandler::errorForApi();

        $result = $model->update(
            [
                "status" => "granted",
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->preview,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            return Route::display("my_api", "api", ["status" => true, "message" => "preview has been granted"]);

        }
        else{

            return Route::display("my_api", "api", ["status" => false, "message" => "unknown error"]);

        }

    }

    private function customerSelect($request){

        /*

        ይሰደዳል ልብቤ ካለሽበት ቦታ

        ዳገት አቀበቱ ጋራውም ሳይገታው ጋራውም ሳይገታው
        ሳይጎዳው ጋሬጣ እንቅፋት ሳይመታው እንቅፋት ሳይመታው
        ያዘግማል ወዳንቺ ልቤ በትዝታ

        እንዲያው በሰመመን ናፍቆቱ ተሰዶ ናፍቆቱ ተሰዶ
        ባሳብ በትዝታሽ በርቀት በማዶ በርቀት በማዶ
        ይደረስልሽ ቃሌ ሞገዱን ሰርግዶ

        ከተጫወትንበት ከዋልንበት ቦታ
        ከተማረክንበት ካበቦቹ ሽታ
        ይጓዛል ወደ እኔ ያለፈው ትዝታ ያለፈው ትዝታ

        በሚነፍሰው አየር በሚመላለሰው
        በሚወርደው ጅረት ካፋፍ በሚፈሰው
        ትዝታ ናፍቆትሽ እየገሰገሰ

        */

        if(!isset($_SESSION["customer_log"]) || Auth::checkLogin()){

            Alert::sendErrorAlert("You are not authorized!");
            Route::goHome();

        }

        $model = new PreviewsModel();
        $order_model = new OrdersModel();
        \ErrorHandler::errorForApi();

        $result = $model->selectPreview($request->preview);

        if($result){

            $result1 = $order_model->setToPrinting($request->order);

            if($result1){

                Alert::sendSuccessAlert("Order has been selected for printing");
                return Route::display("customer", "check_order", ["order" => $_SESSION["customer_log"]]);
                //Route::goRoute("Orders.", "api", ["status" => true, "message" => "preview has been granted"]);

            }

        }

        Alert::sendErrorAlert("Unknown Error occurred");
        Route::goHome();
        return "";

    }

    private function apiDelete($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "designer")){

            return Route::display("my_api", "api", ["status" => false, "message" => "you are not authorized"]);

        }

        $model = new PreviewsModel();
        \ErrorHandler::errorForApi();

        $result = $model->deleteRecord(
            [
                [
                    "name" => "id",
                    "value" => $request->preview,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "designer",
                    "value" => Auth::user()->username,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            return Route::display("my_api", "api", ["status" => true, "message" => "preview has been granted"]);

        }
        else{

            return Route::display("my_api", "api", ["status" => false, "message" => "unknown error"]);

        }

    }

    public function show($request){

        $return = [];

        if(isset($request->type) && isset($request->for) && $request->for == "selection"){

            if($request->type == "cup" || $request->type == "banner" || $request->type == "shirt"){

                $model = new PreviewsModel();
                $model1 = new OrdersModel();

                $result1 = $model1->search(
                    [
                        "type" => [
                            "value" => $request->type,
                            "equ" => "=",
                            "det" => "and"
                        ]
                    ],
                    [
                        "id"
                    ]
                );

                $data1 = $result1["returned"];

                foreach($data1 as $order_id){

                    $result = $model->search(
                        [
                            "orders" => [
                                "value" => $order_id["id"],
                                "equ" => "=",
                                "det" => "and"
                            ]
                        ],
                        [
                            "designer",
                            "image",
                            "time"
                        ]
                    );

                    $data = $result["returned"];
                    $count = 0;

                    foreach($data as $prev){

                        $return["data"][$count]["designer"] = $prev["designer"];
                        $return["data"][$count]["image_id"] = $prev["image"];
                        $return["data"][$count]["time"] = $prev["time"];
                        $return["data"][$count]["order_id"] = $order_id["id"];

                        $model2 = new ImagesModel();

                        $result2 = $model2->find($prev["image"]);

                        $return["data"][$count]["image"] = "preview_image_".$prev["image"].".".$result2["returned"][0]["location"];

                        $count += 1;

                    }

                }

                $return["for"] = $request->for;
                return Route::display("previews", "show", $return);

            }
            else{

                Alert::sendErrorAlert("nothing to show");
                return Route::display("previews", "show", $return);

            }

        }
        else if(isset($request->for) && $request->for == "acceptance"){

            if(isset($request->order) && $request->order != ""){

                $model = new PreviewsModel();
                $result = $model->search(
                    [
                        "orders" => [
                            "value" => $request->order,
                            "equ" => "=",
                            "det" => "and"
                        ]
                    ],
                    [
                        "designer",
                        "image",
                        "time",
                        "status"
                    ]
                );

                $data = $result["returned"];
                $count = 0;

                foreach($data as $prev){

                    $return["data"][$count]["designer"] = $prev["designer"];
                    $return["data"][$count]["image_id"] = $prev["image"];
                    $return["data"][$count]["time"] = $prev["time"];
                    $return["data"][$count]["status"] = $prev["status"];

                    $model2 = new ImagesModel();

                    $result2 = $model2->find($prev["image"]);

                    $return["data"][$count]["image"] = "preview_image_".$prev["image"].".".$result2["returned"][0]["location"];

                    $count += 1;

                }

                $return["order_id"] = $request->order;
                $return["for"] = $request->for;
                Alert::sendSuccessAlert("All Previews");
                return Route::display("previews", "show", $return);

            }else{

                Alert::sendErrorAlert("no order were given!!");
                return Route::display("previews", "show", $return);

            }

        }
        else if(isset($request->for) && $request->for == "printing"){

            if(isset($request->order) && $request->order != ""){

                $model = new PreviewsModel();
                $result = $model->search(
                    [
                        "orders" => [
                            "value" => $request->order,
                            "equ" => "=",
                            "det" => "and"
                        ],
                        "status" => [
                            "value" => "accepted",
                            "equ" => "=",
                            "det" => "and"
                        ]
                    ],
                    [
                        "designer",
                        "image",
                        "time",
                        "status"
                    ]
                );

                $data = $result["returned"];
                $count = 0;

                foreach($data as $prev){

                    $return["data"][$count]["designer"] = $prev["designer"];
                    $return["data"][$count]["image_id"] = $prev["image"];
                    $return["data"][$count]["time"] = $prev["time"];
                    $return["data"][$count]["status"] = $prev["status"];

                    $model2 = new ImagesModel();

                    $result2 = $model2->find($prev["image"]);

                    $return["data"][$count]["image"] = "preview_image_".$prev["image"].".".$result2["returned"][0]["location"];

                    $count += 1;

                }

                $return["order_id"] = $request->order;
                $return["for"] = $request->for;
                Alert::sendSuccessAlert("All Previews");
                return Route::display("previews", "show", $return);

            }
            else{

                $return["error_message"] = "no order were given!!";
                return Route::display("previews", "show", $return);

            }

        }
        else {

            Alert::sendErrorAlert("missing parameter");
            return Route::display("previews", "show", $return);

        }

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

        if(isset($this->files->inputImage)){

            $oname = $this->files->inputImage->name;
            $tmp_place = $this->files->inputImage->tmp_name;
            $type = strtolower(pathinfo($oname)["extension"]);

            $allowed = array("jpg", "jpeg", "png", "ico");

            if(in_array($type, $allowed)){

                $time = strtotime("now");

                if(move_uploaded_file($tmp_place, "./resource/images/preview_images/preview_image_$time.$type")){

                    $model1 = new PreviewsModel();

                    $result = $model1->addRecord(
                        [
                            "orders" => $request->order,
                            "designer" => Auth::user()->username,
                            "image" => "preview_image_$time.$type",
                            "status" => "pending",
                            "date" => $time
                        ]
                    );

                    if($result){

                        Alert::sendSuccessAlert("New Preview has been uploaded!");

                    }
                    else{
                        Alert::sendErrorAlert("Unknown Error!");
                        unlink($tmp_place);
                    }

                }
                else{


                    Alert::sendErrorAlert("Cannot move the file. Posting failed!");
                    //return Route::display("orders", "add", ["now" => "suggested_image"]);

                }
            }
            else{
                unlink($tmp_place);
                Alert::sendErrorAlert("Incorrect Image Format! ".$type);
                //return Route::display("orders", "add", ["now" => "suggested_image"]);
            }

        }
        else{

            Alert::sendErrorAlert("No Image file uploaded. Posting failed!");
            //return Route::display("orders", "add", ["now" => "suggested_image"]);

        }

        Route::goRoute("Orders.designer_view", ["order" => $request->order]);
        return "";

    }

    public function update($request){

        $return = [];

        if(isset($request->attribute) && $request->attribute == "status"){

            if(isset($request->status) && $request->status != ""){

                if(isset($request->order) && isset($request->image)){

                    $model = new PreviewsModel();

                    $model->update(
                        [
                            "status" => $request->status
                        ],
                        [
                            "orders" => [
                                "value" => $request->order,
                                "equ" => "=",
                                "det" => "and"
                            ],
                            "image" => [
                                "value" => $request->image,
                                "equ" => "=",
                                "det" => "and"
                            ]
                        ]
                    );

                    Alert::sendSuccessAlert("Design Selected");

                    return Route::route("Previews.show", ["order" => $request->order, "for" => "acceptance"]);

                }else{

                    Alert::sendErrorAlert("Order or image were not set!!");
                    return Route::display("previews", "show");

                }

            }else{

                Alert::sendErrorAlert("status were not Set");
                return Route::display("previews", "show");

            }

        }
        else if(isset($request->attribute) && $request->attribute == "printing"){

            if(isset($request->order) && isset($request->image)){

                $model = new PreviewsModel();
                $model1 = new OrdersModel();

                $model->update(
                    [
                        "status" => "selected"
                    ],
                    [
                        "orders" => [
                            "value" => $request->order,
                            "equ" => "=",
                            "det" => "and"
                        ],
                        "image" => [
                            "value" => $request->image,
                            "equ" => "=",
                            "det" => "and"
                        ]
                    ]
                );

                $model1->update(
                    [
                        "preview" => $request->image,
                        "status" => "printing"
                    ],
                    [
                        "id" => [
                            "value" => $request->order,
                            "equ" => "=",
                            "det" => "and"
                        ]
                    ]
                );
                return Route::route("Orders.view", ["id" => $request->order]);

            }else{

                Alert::sendErrorAlert("order or Image were not set!!");
                return Route::display("previews", "show");

            }

        }

        return $request;
    }

}
?>
