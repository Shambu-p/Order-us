<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Users\Models\OrdersDesignersModel;
use Users\Models\OrdersModel;
use Absoft\App\Security\Auth;

class OrdersDesignersController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show($parameter);

        }else if($name == "save"){

            $response = $this->save($parameter);

        }else if($name == "my_order"){

            $response = $this->designerShow($parameter);

        }else if($name == "assign_designer"){

            $response = $this->assignDesigner($parameter);

        }else if($name == "finish_order"){

            $response = $this->finishOrder($parameter);

        }
        else if($name == "admin_show"){

            $response = $this->adminShow();

        }
        else{

            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named OrdersDesignersController.".$name,
                __FILE__." on Line ".__LINE__
            );
            $response = Route::display("system_templates", "error");
        
        }

        return $response;

    }



    private function designerShow($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "designer")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new OrdersDesignersModel();
        $orders = new OrdersModel();
        $return = [];

        $condition = [
            [
                "name" => "designer",
                "value" => $request->designer,
                "equ" => "=",
                "det" => "and"
            ],
            [
                "name" => "status",
                "value" => "pending",
                "equ" => "=",
                "det" => "and"
            ]
        ];

        $data = $model->search($condition);


        foreach($data as $order){

            $or_result = $orders->find($order["orders"]);

            if(sizeof($or_result)){
                $order["orders"] = $or_result;//$orders->byId($order["orders"]);
            }else{
                $order["orders"] = $orders->MAINS;
            }

            $return[] = $order;

        }

        //Alert::sendSuccessAlert("all your Orders are here");
        return Route::display("designer", "my_order", ["data" => $return]);

    }

    private function adminShow(){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new OrdersDesignersModel();
        $orders = new OrdersModel();
        $return = [];

        $data = $model->search([]);


        foreach($data as $order){

            $or_result = $orders->find($order["orders"]);

            if(sizeof($or_result)){
                $order["orders"] = $or_result;//$orders->byId($order["orders"]);
            }else{
                $order["orders"] = $orders->MAINS;
            }

            $return[] = $order;

        }

        //Alert::sendSuccessAlert("all your Orders are here");
        return Route::display("admin", "on_design", ["data" => $return]);

    }

    public function show($request){

        if(isset($request->type)){

            if($request->type == "my_orders" && isset($request->designer) && $request->designer != ""){



            }
            else if($request->type == "designed"){

                $designer = $request->designer;

                $model = new OrdersDesignersModel();
                $condition = [
                    [
                        "name" => "designer",
                        "value" => $designer,
                        "equ" => "=",
                        "det" => "and"
                    ],
                    [
                        "name" => "status",
                        "value" => "pending",
                        "equ" => "=",
                        "det" => "and"
                    ]
                ];

                $result = $model->search($condition, ["orders", "designer", "status"]);

                $data = $result["returned"];

                return Route::display("ordersDesigners", "show", [
                    "data" => $data
                ]);

            }
            else if($request->type == "order" && isset($request->order) && $request->order != ""){



            }
            else{
                Alert::sendErrorAlert("Incorrect parameter");
                return Route::display("ordersDesigners", "show");
            }

        }
        else{

            Alert::sendErrorAlert("nothing is set to be shown");
            return Route::display("ordersDesigners", "show");

        }

    }

    public function save($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "admin")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new OrdersModel();

        $result = $model->search(
            [
                [
                    "name" => "id",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ],
            [
                "id",
                "designer"
            ]
        );

        if(sizeof($result)){

            $model1 = new OrdersDesignersModel();

            $del_result = $model1->deleteRecord(
                [
                    [
                        "name" => "orders",
                        "value" => $request->order,
                        "equ" => "=",
                        "det" => "and"
                    ],
                    [
                        "name" => "designers",
                        "value" => $request->designer,
                        "equ" => "!=",
                        "det" => "and"
                    ]
                ]
            );

            if($del_result){

                $add_result = $model1->addRecord([
                    "orders" => $request->order,
                    "designer" => $request->designer,
                    "status" => "pending"
                ]);

                if($add_result){

                    $update_result = $model->update(
                        [
                            "designer" => $request->designer,
                            "status" => "designing"
                        ],
                        [
                            /*[
                                "name" => "status",
                                "value" => "payed",
                                "equ" => "=",
                                "det" => "and"
                            ],*/
                            [
                                "name" => "id",
                                "value" => $request->order,
                                "equ" => "=",
                                "det" => "and"
                            ]
                        ]
                    );

                    if($update_result){

                        Alert::sendSuccessAlert("Orders has been set to designing");
                        Route::goRoute("Orders.payed_orders");

                    }else{

                        $model1->deleteRecord(
                            [
                                [
                                    "name" => "orders",
                                    "value" => $request->order,
                                    "equ" => "=",
                                    "det" => "and"
                                ],
                                [
                                    "name" => "designers",
                                    "value" => $request->designer,
                                    "equ" => "!=",
                                    "det" => "and"
                                ]
                            ]
                        );
                        Alert::sendErrorAlert("Unknown Error");
                    }

                }else{
                    Alert::sendErrorAlert("Unknown Error");
                }

            }else{
                Alert::sendErrorAlert("Unknown Error");
            }

            Route::goRoute("Orders.admin_view", ["order" => $request->order]);

        }else{

            Alert::sendErrorAlert("No order found with the order number ".$request->order);

        }

        return "";

    }

    public function assignDesigner($request){



    }

    public function myOrders($request){



    }

    public function finishOrder($request){

        if(!Auth::checkLogin()){

            Alert::sendErrorAlert("login First!");
            Route::goRoute("Auth.sign_in");

        }
        else if(!Auth::checkUser("role", "designer")){

            Alert::sendInfoAlert("You are not eligible for this");
            Route::goRoute("Auth.get_in");

        }

        $model = new OrdersDesignersModel();
        $designer = Auth::user()->username;

        $result = $model->update(
            [
                "status" => "designed"
            ],
            [
                [
                    "name" => "orders",
                    "value" => $request->order,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "designer",
                    "value" => $designer,
                    "equ" => "=",
                    "det" => "and",
                ]
            ]
        );

        if($result){

            Alert::sendSuccessAlert("One order has been finished");
            Route::goRoute("OrdersDesigners.my_order", ["designer" => $designer]);

        }
        else{

            Alert::sendErrorAlert("Unknown Error");
            Route::goRoute("OrdersDesigners.my_order", ["designer" => $designer]);

        }

        //return Route::route("OrdersDesigners.show", ["designer" => $request->designer, "type" => "my_orders"]);
        return "";

    }

}
?>
