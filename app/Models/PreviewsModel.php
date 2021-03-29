<?php
namespace Users\Models;


use Absoft\Line\Modeling\Model;

class PreviewsModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    public $TABLE_NAME = "Previews";

    public $MAINS = [
        "id" => "",
        "orders" => "",
        "designer" => "",
        "image" => "",
        "status" => "",
        "date" => ""
    ];

    public $HIDDEN = [];


    public function byOrder($order){

        return $this->search(
            [
                [
                    "name" => "orders",
                    "value" => $order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function selectPreview($preview){
        return $this->update(
            [
                "status" => "selected",
            ],
            [
                [
                    "name" => "id",
                    "value" => $preview,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );
    }

}
?>
