<?php
namespace Users\Models;


use Absoft\Line\Modeling\Model;

class OrdersModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    public $TABLE_NAME = "Orders";

    public $MAINS = [
        "id" => "",
        "full_name" => "",
        "type" => "",
        "order_date" => "",
        "return_date" => "",
        "status" => "",
        "phone_number" => "",
        "text" => "",
        "suggested_image" => "",
        "address" => "",
        "amount" => "",
        "design" => "",
        "email" => "",
        "payment" => "",
        "designer" => ""
    ];

    public $HIDDEN = [
        "password" => ""
    ];

    public function byStatus($status){

        return $this->search(
            [
                [
                    "name" => "status",
                    "value" => $status,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function deleteOrder($order){

        return $this->deleteRecord(
            [
                [
                    "name" => "id",
                    "value" => $order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function byId($order){

        return $this->search(
            [
                [
                    "name" => "id",
                    "value" => $order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function setToPrinting($order){
        return $this->update(
            [
                "status" => "printing",
            ],
            [
                [
                    "name" => "id",
                    "value" => $order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );
    }

}
?>
