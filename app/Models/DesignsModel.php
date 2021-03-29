<?php
namespace Users\Models;


use Absoft\Line\Modeling\Model;

class DesignsModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    public $TABLE_NAME = "Designs";

    public $MAINS = [
        "id" => "",
        "image" => "",
        "type" => "",
        "designer" => "",
        "name" => "",
        "price" => "",
        "state" => ""
    ];

    public $HIDDEN = [];

    public function byType($type){

        return $this->search(
            [
                [
                    [
                        "name" => "type",
                        "value" => $type,
                        "equ" => "=",
                        "det" => "and"
                    ]
                ]
            ]
        );

    }

    public function byID($design){

        $result = $this->search(
            [
                [
                    [
                        "name" => "id",
                        "value" => $design,
                        "equ" => "=",
                        "det" => "and"
                    ]
                ]
            ]
        );

        if(sizeof($result)){

            return $result[0];

        }

        return [];

    }

    public function getOpen($type){

        return $this->search(
            [
                [
                    "name" => "type",
                    "value" => $type,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "state",
                    "value" => "approved",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function forApproval($type){

        return $this->search(
            [
                [
                    "name" => "type",
                    "value" => $type,
                    "equ" => "=",
                    "det" => "and"
                ]
            ],
            [],
            "",
            [
                "att" => "state",
                "det" => 0
            ]
        );

    }

}
?>
