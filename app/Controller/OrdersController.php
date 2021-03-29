<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use Absoft\App\Pager\Pager;
use Absoft\App\Security\Auth;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Users\DatabaseBuilders\Orders;
use Users\DatabaseBuilders\Preferences;
use Users\Models\DesignsModel;
use Users\Models\OrdersModel;
use Users\Models\PreferencesModel;
use Users\Models\PricesModel;
use Users\Models\UsersModel;

class OrdersController extends Controller{

    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show($parameter);

        }
        else if($name == "new_orders"){

            $response = $this->new_orders();

        }
        else if($name == "save"){

            $response = $this->save();

        }else if($name == "initialize_order"){

            $response = $this->initializeOrder($parameter);

        }else if($name == "flier_preference"){

            $response = $this->flierPreference($parameter);

        }else if($name == "business_preference"){

            $response = $this->businessPreference($parameter);

        }else if($name == "cup_preference"){

            $response = $this->cupPreference($parameter);

        }else if($name == "shirt_preference"){

            $response = $this->shirtPreference($parameter);

        }else if($name == "banner_preference"){

            $response = $this->bannerPreference($parameter);

        }else if($name == "wedding_preference"){

            $response = $this->weddingPreference($parameter);

        }else if($name == "to_preference"){

            $response = $this->toPreference();

        }else if($name == "more_info"){

            $response = $this->moreInformation($parameter);

        }
        else if($name == "re_init"){

            $response = $this->reInitializeOrder();

        }else if($name == "attach_image"){

            $response = $this->attachImage($parameter);

        }else if($name == "admin_api_order"){

            $response = $this->adminApiView($parameter);

        }else if($name == "designer_api_order"){

            $response = $this->designerApiView($parameter);

        }else if($name == "exit_order"){

            $response = $this->exit_order();

        }else if($name == "change_status"){

            $response = $this->changeStatus($parameter);

        }else if($name == "set_to_preview"){

            $response = $this->setToPreview($parameter);

        }else if($name == "set_to_payed"){

            $response = $this->setToPayed($parameter);

        }else if($name == "admin_view"){

            $response = $this->adminView($parameter);

        }else if($name == "admin_view"){

            $response = $this->customerOrder($parameter);

        }else if($name == "customer_order"){

            $response = $this->customerOrder($parameter);

        }else if($name == "init_by_design"){

            $response = $this->initializeOrderWithDesign($parameter);

        }else if($name == "designer_view"){

            $response = $this->designerView($parameter);

        }else if($name == "approved_orders"){

            $response = $this->approvedOrders();

        }else if($name == "payed_orders"){

            $response = $this->payedOrders();

        }else if($name == "finished_orders"){

            $response = $this->finishedOrders();

        }else if($name == "printing_orders"){

            $response = $this->onPrinting();

        }else if($name == "delivered_orders"){

            $response = $this->ሄሎ();

        }else if($name == "set_to_printing"){

            $response = $this->setToPrinting($parameter);

        }else if($name == "set_to_finished"){

            $response = $this->setToFinished($parameter);

        }else if($name == "set_to_delivered"){

            $response = $this->setToReceived();

        }else if($name == "check_my_order"){

            $response = $this->check($parameter);

        }
        else if($name == "cancel"){

            $response = $this->cancelOrder($parameter);

        }
        else if($name == "admin_cancel"){

            $response = $this->adminCancel($parameter);

        }
        else if($name == "approve"){

            $response = $this->approveOrder($parameter);

        }
        else if($name == "stat"){

            $response = $this->statistics($parameter);

        }
        else{

            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named OrdersController.".$name,
                __FILE__." on Line ".__LINE__
            );

            $response = Route::display("system_templates", "error");

        }

        return $response;

    }

    private function cancelOrder($request){

        if(!isset($_SESSION["customer_log"])){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "canceled"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Alert::sendInfoAlert("Order has been canceled");

        }
        else{

            Alert::sendErrorAlert("Unknown error");

        }

        Route::goRoute("Orders.exit_order");
        return "";

    }

    private function adminCancel($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "canceled"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){
            Alert::sendSuccessAlert("Order has been canceled!");
        }
        else{
            Alert::sendErrorAlert("Unknow error occurred");
        }

        Route::goRoute("Orders.admin_view", ["order" => $request->order]);

    }

    private function adminApiView($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "admin")){

            return Route::display("my_api", "api", []);

        }

        \ErrorHandler::errorForApi();
        $model = new OrdersModel();
        $result = $model->find($request->order);

        if(sizeof($result)){

            if($result["order_date"]){
                $result["order_date"] = date("l M d Y", $result["order_date"]);
            }

            if($result["return_date"]){
                $result["return_date"] = date("l M d Y", $result["return_date"]);
            }

        }

        return Route::display("my_api", "api", $result);

    }

    private function designerApiView($request){

        if(!Auth::checkLogin() || !Auth::checkUser("role", "designer")){

            return Route::display("my_api", "api", []);

        }

        \ErrorHandler::errorForApi();
        $model = new OrdersModel();
        $result = $model->find($request->order);

        if(sizeof($result)){

            if($result["order_date"]){
                $result["order_date"] = date("l M d Y", $result["order_date"]);
            }

            if($result["return_date"]){
                $result["return_date"] = date("l M d Y", $result["return_date"]);
            }

            unset($result["payment"]);

        }

        return Route::display("my_api", "api", $result);

    }

    private function check($request){

        unset($_SESSION["order"]);
        unset($_SESSION["design_preference"]);

        if(Auth::checkLogin()){
            Route::goHome();
        }
        else if(isset($_SESSION["customer_log"])){
            return Route::display("customer", "check_order", ["order" => $_SESSION["customer_log"]]);
        }

        $model = new OrdersModel();
        //$pref = new PreferencesModel();

        $result = $model->find($request->order);

        //print_r($result);
        //exit();

        if(sizeof($result) > 0){

            if($result["status"] != "delivered" && $result["status"] != "declined"){

                if(password_verify($request->password, $result["password"])){

                    //$prefs = $pref->byOrder($request->order);

                    $_SESSION["customer_log"] = $request->order;
                    return Route::display("customer", "check_order", ["order" => $request->order]);

                    /*
                    if(sizeof($prefs)){

                        $result["preferences"] = $prefs;
                        Alert::sendSuccessAlert("Here is your Order");
                        return Route::display("customer", "check_order", ["order" => $result]);

                    }else{

                        Alert::sendInfoAlert("The Order is Corrupted! Communicate with the company in person. thank you");
                        Route::goHome();

                    }*/

                }
                else{

                    Alert::sendErrorAlert("Incorrect password!");
                    Route::goHome();

                }

            }else if($result["status"] != "received"){
                Alert::sendInfoAlert("This Order has delivered.");
                Route::goHome();
            }else{
                Alert::sendInfoAlert("Order has declined");
                Route::goHome();
            }

        }
        else{

            Alert::sendErrorAlert("Order not found");
            Route::goHome();

        }

        //Route::view("open", "my_order");

        return "";

    }

    public function show($request){

        if(isset($request->determiner)){

            $det = $request->determiner;

            if($det == "this_week"){

                $start = strtotime("this week");
                $end = strtotime("next week");

                return $this->orders($det,[
                    [
                        "name" => "order_date",
                        "value" => $start,
                        "equ" => ">",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => $end,
                        "equ" => "<",
                        "det" => "and"
                    ]
                ], $request->page_number);

            }
            else if($det == "this_month"){

                $start = strtotime("this month");
                $end = strtotime("next month");

                return $this->orders($det,[
                    [
                        "name" => "order_date",
                        "value" => $start,
                        "equ" => ">",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => $end,
                        "equ" => "<",
                        "det" => "and"
                    ]
                ], $request->page_number);

            }
            else if($det == "this_year"){

                $start = strtotime("this year");
                $end = strtotime("next year");

                return $this->orders($det,[
                    [
                        "name" => "order_date",
                        "value" => $start,
                        "equ" => ">",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => $end,
                        "equ" => "<",
                        "det" => "and"
                    ]
                ], $request->page_number);

            }
            else{
                return $this->orders($det,[], $request->page_number);
            }


        }
        else{

            return Route::display("admin", "orders");

        }

    }

    private function orders($type, $condition, $page_number){

        $data[$type] = "";
        $model = new OrdersModel();

        $result = $model->search($condition, [],
            "",
            [
                "att" => "id",
                "det" => "0"
            ]
        );

        $pager = new Pager();
        $header = new \stdClass();
        $header->page_name = "admin";
        $header->sub_page = "orders";
        $pager->create($header, "Orders.show", "orders", 20, ["determiner" => $type]);

        $data = Pager::pageData($result, "orders", $page_number);

        //Alert::sendSuccessAlert("All the Orders are here");
        $data["data"] = $result['returned'];

        return Route::display("orders", "show", $data);

    }

    public function save(){

        $session = $_SESSION;
        $model = new OrdersModel();

        if(isset($session['order']) && isset($session['design_preference'])){

            $date = strtotime("today");

            $insert = [

                "full_name" => $session["order"]["customer"],
                "type" => $session["order"]["order_type"],
                "email" => $session["order"]["email"],
                "phone_number" => $session["order"]["phone_number"],
                "amount" => $session["order"]["amount"],
                "status" => "request",
                "text" => $session["order"]["additional_text"],
                "password" => $session["order"]["password"],
                "suggested_image" => (isset($session["order"]["suggested_image"])) ? $session["order"]["suggested_image"] : "default_image.png",
                "payment" => $session["order"]["payment"],
                "order_date" => $date

            ];

            if(isset($session["order"]["address"]) && $session["order"]["address"] != ""){
                $insert["address"] = $session["order"]["address"];
            }
            else{
                $insert["address"] = "unknown";
            }

            if(isset($session["order"]["design"]) && $session["order"]["design"] != ""){
                $insert["design"] = $session["order"]["design"];
            }

            $preferences = new PreferencesModel();

            if($model->addRecord($insert)){

                $order_id = $model->getMaxOf("id");
                //$session["design_preference"]["orders"] = $order_id;

                foreach ($session["design_preference"] as $key => $value){

                    if(!$preferences->addRecord(
                        [
                            "orders" => $order_id,
                            "name" => $key,
                            "value" => $value
                        ]
                    )){

                        $model->deleteOrder($order_id);
                        $preferences->deleteByOrder($order_id);

                        Alert::sendErrorAlert("Unknown Error Encountered! please Try again");
                        Route::view("orders", "shipment");
                        break;

                    }

                }

                //Alert::sendSuccessAlert("Your Orders has sent. Thank you for choosing us");
                //Route::goRoute("Orders.order_result", ["order" => $order_id]);
                return $this->finishOrdering($order_id);

            }
            else{

                Alert::sendErrorAlert("Unknown Error Encountered! please Try again");
                Route::view("orders", "final_order");

            }

        }
        else{

            Alert::sendErrorAlert("Order is not Finished! Finish Ordering and try again!");
            Route::view("orders", "add", ["now" => "initialize"]);

        }

        return "";

    }

    private function finishOrdering($order_id){

        unset($_SESSION["order"]);
        unset($_SESSION["design_preference"]);

        return Route::display("open", "ordering_result", ["order" => $order_id]);

    }

    private function adminView($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        /*
        $model = new OrdersModel();
        $pref = new PreferencesModel();
        $result = $model->find($request->order);

        if(sizeof($result)){

            $p_result = $pref->byOrder($request->order);

            if(sizeof($p_result)){

                $result["preferences"] = $p_result;



            }
            else{

                Alert::sendInfoAlert("Corrupted order! No preference found");
                Route::goRoute("Orders.new_orders");

            }

        }else{

            Alert::sendInfoAlert("No order found");
            Route::goRoute("Orders.new_orders");

        }*/

        return Route::display("admin", "view_order", ["order" => $request->order]);

    }

    private function designerView($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "designer")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        return Route::display("designer", "view_order", ["order" => $request->order]);

        /*
        $model = new OrdersModel();
        $pref = new PreferencesModel();
        $result = $model->find($request->order);

        if(sizeof($result)){

            $p_result = $pref->byOrder($request->order);

            if(sizeof($p_result)){

                $result["preferences"] = $p_result;



            }
            else{

                Alert::sendInfoAlert("Corrupted order! No preference found");
                Route::goRoute("OrdersDesigners.my_orders");

            }

        }else{

            Alert::sendInfoAlert("No order found");
            Route::goRoute("OrdersDesigner.my_orders");

        }

        return "";*/

    }

    public function customerOrder($request){

        if(!isset($_SESSION["customer_log"])){
            return Route::display("my_api", "api", []);
        }

        \ErrorHandler::errorForApi();
        $model = new OrdersModel();
        $result = $model->find($request->order);

        if(sizeof($result)){

            if($result["order_date"]){
                $result["order_date"] = date("l M d Y", $result["order_date"]);
            }

            if($result["return_date"]){
                $result["return_date"] = date("l M d Y", $result["return_date"]);
            }

            //unset($result["payment"]);

        }

        return Route::display("my_api", "api", $result);

    }

    public function initializeOrder($request){

        $_SESSION["order"]["order_type"] = $request->type;

        Route::goRoute("Designs.show_customer", ["for" => $request->type]);

        return "";

    }

    private function initializeOrderWithDesign($request){

        //$designs = new DesignsModel();

        $_SESSION["order"]["order_type"] = $request->type;
        $_SESSION["order"]["design"] = $request->design;
        $_SESSION["order"]["payment"] = $request->payment;

        Route::view("open", "attach_image");

        return "";

    }

    private function toPreference(){

        if(isset($_SESSION["order"]["order_type"])){

            $type = $_SESSION["order"]["order_type"];

            if($type == "banner"){
                Route::view("open", "banner_preference");
            }
            else if($type == "shirt"){
                Route::view("open", "shirt_preference");
            }
            else if($type == "cup"){
                Route::view("open", "cup_preference");
            }
            else if($type == "flier_card" || $type == "wedding_card" || $type == "business_card"){
                return Route::display("open", "card_preference", ["type" => $type]);
            }

        }

        Alert::sendInfoAlert("Order type were not set! Therefore Ordering has been reinitialized");
        Route::goRoute("Orders.re_init");

        return "";

    }

    private function weddingPreference($request){

        $prices = new PricesModel();
        $p_result = $prices->byType("wedding_card");

        if(isset($_SESSION["order"]["design"]) && isset($_SESSION["order"]["payment"])){

            $design_price = $_SESSION['order']['payment'];
            $_SESSION["design_preference"]["card_size"] = $request->card_size;
            //$_SESSION["design_preference"]["card_type"] = $request->card_type;
            $_SESSION["order"]["amount"] = $request->amount;

            $size_price = $p_result["card_size"][$request->card_size];
            $_SESSION['order']['payment'] = ($design_price + $size_price)*$request->amount;

            Route::view("open", "shipment");

        }else{
            Alert::sendInfoAlert("Select Card Design");
            Route::goRoute("Designs.show_customer", ["type" => "wedding_card"]);
        }

        return "";

    }

    private function businessPreference($request){

        $prices = new PricesModel();
        $p_result = $prices->byType("business_card");

        if(isset($_SESSION["order"]["design"]) && isset($_SESSION["order"]["payment"])){

            $design_price = $_SESSION['order']['payment'];
            $_SESSION["design_preference"]["card_size"] = $request->card_size;
            //$_SESSION["design_preference"]["card_type"] = $request->card_type;
            $_SESSION["order"]["amount"] = $request->amount;

            $size_price = $p_result["card_size"][$request->card_size];
            $_SESSION['order']['payment'] = ($design_price + $size_price)*$request->amount;

            Route::view("open", "shipment");

        }else{
            Alert::sendInfoAlert("Select Card Design");
            Route::goRoute("Designs.show_customer", ["type" => "business_card"]);
        }

        return "";

    }

    private function flierPreference($request){

        $prices = new PricesModel();
        $p_result = $prices->byType("flier_card");

        if(isset($_SESSION["order"]["design"]) && isset($_SESSION["order"]["payment"])){

            $design_price = $_SESSION['order']['payment'];
            $_SESSION["design_preference"]["card_size"] = $request->card_size;
            //$_SESSION["design_preference"]["card_type"] = $request->card_type;
            $_SESSION["order"]["amount"] = $request->amount;

            $size_price = $p_result["card_size"][$request->card_size];
            $_SESSION['order']['payment'] = ($design_price + $size_price)*$request->amount;

            Route::view("open", "shipment");

        }else{
            Alert::sendInfoAlert("Select Card Design");
            Route::goRoute("Designs.show_customer", ["type" => "flier_card"]);
        }

    }

    private function bannerPreference($request){

        $prices = new PricesModel();
        $p_result = $prices->byType("banner");

        if(isset($_SESSION["order"]["design"]) && isset($_SESSION["order"]["payment"])){

            $_SESSION["design_preference"]["banner_height"] = $request->banner_height;
            $_SESSION["design_preference"]["banner_width"] = $request->banner_width;
            $_SESSION["design_preference"]["banner_material"] = $request->banner_material;
            $_SESSION["order"]["amount"] = $request->amount;

            $area = $request->banner_height * $request->banner_width;
            $design_price = $_SESSION["order"]["payment"];
            $m_price = $p_result["banner_material"][$request->banner_material];
            $single_price = ($area * $m_price)+$design_price;
            $_SESSION['order']['payment'] = $single_price*$request->amount;

            Route::view("open", "shipment");

        }
        else{
            Alert::sendInfoAlert("Select Banner Design!");
            Route::goRoute("Designs.open_designs", ["type" => "banner"]);
        }

    }

    private function shirtPreference($request){

        if(isset($_SESSION["order"]["design"]) && isset($_SESSION["order"]["payment"])){

            $prices = new PricesModel();
            $p_result = $prices->byType("shirt");

            $_SESSION["design_preference"]["shirt_type"] = $request->shirt_type;
            $_SESSION["design_preference"]["shirt_size"] = $request->shirt_size;
            $_SESSION["design_preference"]["shirt_color"] = $request->shirt_color;
            $_SESSION["order"]["amount"] = $request->amount;

            $type_price = $p_result[$request->shirt_type][$request->shirt_size];
            //$size_price = $p_result["size"];
            $design_price = $_SESSION["order"]["payment"];

            $single_price = $type_price + $design_price;
            $_SESSION['order']['payment'] = $single_price * $request->amount;

            Route::view("open", "shipment");

        }
        else{
            Alert::sendInfoAlert("Select Shirt Design");
            Route::goRoute("Designs.show_customer", ["type" => "shirt"]);
        }

    }

    private function cupPreference($request){

        if(isset($_SESSION["order"]["design"]) && isset($_SESSION["order"]["payment"])){

            $prices = new PricesModel();
            $p_result = $prices->byType("cup");

            $_SESSION["design_preference"]["cup_color"] = $request->cup_color;
            $_SESSION["design_preference"]["cup_size"] = $request->cup_size;
            $_SESSION["order"]["amount"] = $request->amount;

            $design_price = $_SESSION['order']['payment'];
            $size_price = $p_result["size"][$request->cup_size];
            $single_price = $design_price + $size_price;

            $_SESSION['order']['payment'] = $single_price * $request->amount;

            Route::view("open", "shipment");

        }
        else{
            Alert::sendInfoAlert("Select Cup Design");
            Route::goRoute("Designs.show_customer", ["type" => "cup"]);
        }

    }

    public function moreInformation($request){

        if($request->new_password == $request->confirm_password){

            $_SESSION["order"]["additional_text"] = $request->additional_text;
            $_SESSION["order"]["email"] = $request->email;
            $_SESSION["order"]["phone_number"] = $request->phone_number;
            $_SESSION["order"]["address"] = $request->address;
            $_SESSION["order"]["customer"] = $request->name;
            $_SESSION["order"]["password"] = $request->new_password;

            Route::view("open", "final_order");

        }else{

            Alert::sendErrorAlert("password does not match");
            Route::view("open", "shipment");

        }

        return "";

    }

    public function reInitializeOrder(){

        unset($_SESSION["order"]);
        unset($_SESSION["design_preference"]);

        Route::view("open", "start_order");

        return "";

    }

    public function attachImage($request){

        if(isset($this->files->inputImage)){

            $oname = $this->files->inputImage->name;
            $tmp_place = $this->files->inputImage->tmp_name;
            $type = strtolower(pathinfo($oname)["extension"]);

            $allowed = array("jpg", "jpeg", "png", "ico");

            if(in_array($type, $allowed)){

                if(isset($_SESSION["order"]["suggested_image"])){

                    if(move_uploaded_file($tmp_place, "resource/images/suggested_images/".$_SESSION["order"]["suggested_image"])){

                        //$_SESSION["order"]["suggested_image"] = "suggested_$image_id.$type";
                        Alert::sendInfoAlert("Image Suggestion has been updated");
                        Route::goRoute("Orders.to_preference");

                    }
                    else{

                        unlink($tmp_place);
                        Alert::sendErrorAlert("Cannot move the file. Image suggestion failed! But you still have the older suggestion");
                        Route::goRoute("Orders.to_preference");

                    }

                }
                else{

                    $image_id = strtotime("now");

                    if(move_uploaded_file($tmp_place, "resource/images/suggested_images/suggested_$image_id.$type")){

                        $_SESSION["order"]["suggested_image"] = "suggested_$image_id.$type";

                        Alert::sendSuccessAlert("Suggestion saved!");
                        Route::goRoute("Orders.to_preference");

                    }
                    else{

                        unlink($tmp_place);
                        Alert::sendErrorAlert("Cannot move the file. Suggestion failed! please try again later");
                        Route::goRoute("Orders.to_preference");

                    }

                }

            }
            else{
                unlink($tmp_place);
                Alert::sendErrorAlert("Incorrect Image Format! ".$type);
                Route::view("open", "attach_image");
            }

        }
        else{

            Alert::sendErrorAlert("No Image file uploaded. Posting failed!");
            Route::view("open", "attach_image");

        }

        return "";

    }

    public function exit_order(){

        unset($_SESSION["customer_log"]);

        Route::goHome();
        return "";

    }

    //////////////// change status update /////////////////////////

    public function changeStatus($request){

        if(isset($request->order) && $request->order != "" && isset($request->status) && $request->status != ""){

            $order = $request->order;
            $status = $request->status;
            $sets = ["status" => $status];

            if($status == "payed"){

                if(!isset($_SESSION["login"]) || $_SESSION["login"] != "true" || $_SESSION["role"] != "cashier"){

                    Alert::sendErrorAlert("your are not Granted to do this operation. Operation failed!");
                    return Route::display("orders", "show");

                }

            }
            else if($status == "decline" || $status == "preview" || $status == "finished"){

                if(!isset($_SESSION["login"]) || $_SESSION["login"] != "true" || $_SESSION["role"] != "director"){

                    Alert::sendErrorAlert("your are not Granted to do this operation. Operation failed!");
                    return Route::display("orders", "show");

                }

            }
            else if($status == "received"){

                if(!isset($_SESSION["order"]["order_number"]) || $_SESSION["order"]["order_number"] == ""){

                    Alert::sendErrorAlert("your are not Granted to do this operation. Operation failed!");
                    return Route::display("orders", "view");

                }

            }
            else if($status == "approved"){

                if(isset($request->return_date) && $request->return_date != ""){

                    $r_date = strtotime("today") + (24 * 3600 * $request->return_date);

                    $sets["return_date"] = $r_date;

                }else{

                    Alert::sendInfoAlert("You forget to set the return date");
                    return Route::display("orders", "view");

                }

            }

            $model = new OrdersModel();
            $result = $model->update($sets,
                [
                    "id" => [
                        "value" => $order,
                        "equ" => "=",
                        "det" => "and"
                    ]
                ]
            );

            if($result["message"] == "1"){

                if($request->status == "received"){

                    return Route::display("orders", "view", ["order_received" => $order]);

                }else{

                    return Route::route("OrdersController.view", ["order" => $order]);

                }

            }
            else{

                Alert::sendErrorAlert($result["returned"]);
                return Route::display("orders", "view");

            }

        }else{

            Alert::sendErrorAlert("missing Parameter. Operation failed! ");
            return Route::display("orders", "view");

        }

    }

    private function approveOrder($request){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();

        $r_date = strtotime("today") + (24 * 3600 * $request->return_date);

        $result = $model->update(
            [
                "return_date" => $r_date,
                "status" => "approved"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Alert::sendSuccessAlert("Order has been approved");

        }else{

            Alert::sendInfoAlert("Unknown Error occurred! try again later");

        }

        Route::goRoute("Orders.admin_view", ["order" => $request->order]);
        return "";

    }

    public function setToPreview($request){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "preview"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){
            Alert::sendInfoAlert("Order has been set to preview");
        }
        else{
            Alert::sendErrorAlert("Unknown Error");
        }

        Route::goRoute("Order.admin_view", ["order" => $request->order]);
        return "";

    }

    public function setToPayed($request){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "cashier")){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "payed"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Alert::sendInfoAlert("Order Updated to payed");

        }
        else{

            Alert::sendErrorAlert("Unknown error");

        }

        Route::goRoute("Orders.approved_orders");
        return "";

    }

    private function setToPrinting($request){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "printing"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Alert::sendInfoAlert("Order Updated to payed");

        }
        else{

            Alert::sendErrorAlert("Unknown error");

        }

        Route::goRoute("Orders.previewed");
        return "";

    }

    private function setToFinished($request){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "finished"
            ],
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Alert::sendInfoAlert("Order has been finished");

        }
        else{

            Alert::sendErrorAlert("Unknown error");

        }

        Route::goRoute("Orders.printing_orders");
        return "";

    }

    private function setToReceived(){

        if(!isset($_SESSION["customer_log"])){
            Route::goHome();
        }

        $model = new OrdersModel();

        $result = $model->update(
            [
                "status" => "delivered"
            ],
            [
                [
                    "name" => "id",
                    "value" => $_SESSION["customer_log"],
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if($result){

            Alert::sendInfoAlert("Order Delivered! Thank you for choosing us!");

        }
        else{

            Alert::sendErrorAlert("Unknown error");

        }

        Route::goRoute("Orders.exit_order");
        return "";

    }

/////////////////////// show orders /////////////////////////////

    private function new_orders(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();
        $result = $model->byStatus("request");

        return Route::display("admin", "orders", ["orders" => $result]);

    }

    private function approvedOrders(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "cashier")){
            Alert::sendErrorAlert("Not Eligible");
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();
        $result = $model->byStatus("approved");

        return Route::display("cashier", "approved", ["orders" => $result]);

    }

    private function payedOrders(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            Alert::sendErrorAlert("Not Eligible");
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();
        $result = $model->byStatus("payed");

        return Route::display("admin", "orders", ["orders" => $result]);

    }

    private function finishedOrders(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            Alert::sendErrorAlert("Not Eligible");
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();
        $result = $model->byStatus("finished");

        return Route::display("admin", "orders", ["orders" => $result]);

    }

    private function ሄሎ(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            Alert::sendErrorAlert("Not Eligible");
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();
        $result = $model->byStatus("delivered");

        return Route::display("admin", "orders", ["orders" => $result]);

    }

    private function onPrinting(){

        if(!Auth::checkLogin()){
            return Route::route("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            Alert::sendErrorAlert("Not Eligible");
            return Route::route("Auth.get_in");
        }

        $model = new OrdersModel();
        $result = $model->byStatus("printing");

        return Route::display("admin", "orders", ["orders" => $result]);

    }

    private function statistics($request){

        if(!Auth::checkLogin()){

            return Route::display("my_api", "api", []);

        }

        $model = new OrdersModel();

        if($request->when == "this_month"){

            $result = $model->search(
                [
                    [
                        "name" => "order_date",
                        "value" => strtotime("next month"),
                        "equ" => "<",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => strtotime("this month"),
                        "equ" => ">",
                        "det" => "and"
                    ]
                ],
                [
                    "id",
                    "type",
                    "status",
                    "amount",
                    "payment"
                ]
            );

        }
        else if($request->when == "this_month"){

            $result = $model->search(
                [
                    [
                        "name" => "order_date",
                        "value" => strtotime("this month"),
                        "equ" => "<",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => strtotime("last month"),
                        "equ" => ">",
                        "det" => "and"
                    ]
                ],
                [
                    "id",
                    "type",
                    "status",
                    "amount",
                    "payment"
                ]
            );

        }
        else if($request->when == "this_year") {

            $result = $model->search(
                [
                    [
                        "name" => "order_date",
                        "value" => strtotime("next year"),
                        "equ" => "<",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => strtotime("this year"),
                        "equ" => ">",
                        "det" => "and"
                    ]
                ],
                [
                    "id",
                    "type",
                    "status",
                    "amount",
                    "payment"
                ]
            );

        }
        else if($request->when == "last_year"){

            $result = $model->search(
                [
                    [
                        "name" => "order_date",
                        "value" => strtotime("this year"),
                        "equ" => "<",
                        "det" => "and"
                    ],
                    [
                        "name" => "order_date",
                        "value" => strtotime("last year"),
                        "equ" => ">",
                        "det" => "and"
                    ]
                ],
                [
                    "id",
                    "type",
                    "status",
                    "amount",
                    "payment"
                ]
            );

        }
        else{

            $result = $model->search(
                [],
                [
                    "id",
                    "type",
                    "status",
                    "amount",
                    "payment"
                ]
            );

        }
        
        $return = [
            "type" => [
                "cup" => 0,
                "shirt" => 0,
                "banner" => 0,
                "wedding_card" => 0,
                "flier_card" => 0,
                "business_card" => 0,
            ],
            "amount" => [
                "cup" => 0,
                "shirt" => 0,
                "banner" => 0,
                "wedding_card" => 0,
                "flier_card" => 0,
                "business_card" => 0
            ],
            "payment" => [
                "cup" => 0,
                "shirt" => 0,
                "banner" => 0,
                "wedding_card" => 0,
                "flier_card" => 0,
                "business_card" => 0
            ],
            "payed" => [
                "cup" => 0,
                "shirt" => 0,
                "banner" => 0,
                "wedding_card" => 0,
                "flier_card" => 0,
                "business_card" => 0
            ],
            "decline" => [
                "cup" => 0,
                "shirt" => 0,
                "banner" => 0,
                "wedding_card" => 0,
                "flier_card" => 0,
                "business_card" => 0
            ]

        ];
        
        foreach($result as $order){

            if($order["status"] != "declined" && $order["status"] != "request"){

                $return["type"][$order["type"]] += 1;
                $return["amount"][$order["type"]] += $order["amount"];
                $return["payment"][$order["type"]] += $order["payment"];
                $return["payed"][$order["type"]] += 1;

            }
            else if($order["status"] != "declined"){

                $return["decline"][$order["type"]] += 1;

            }
            
        }
        
        return Route::display("my_api", "api", $return);

    }

}
?>
