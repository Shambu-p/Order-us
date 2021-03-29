<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class PreferencesModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "Preferences";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        //@att_start
        "orders" => "",
        "name" => "",
        "value" => ""
        //@att_end
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [
        //@hide_start
        //@hide_end
    ];


    public function byOrder($order){

        $return = [];

        $result = $this->search(
            [
                [
                    "name" => "orders",
                    "value" => $order,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if(sizeof($result)){

            foreach($result as $preference){

                $return[$preference["name"]] = $preference["value"];

            }

        }

        return $return;

    }

    public function simpleByOrder($order){

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

    public function deleteByOrder($order){

        return $this->deleteRecord(
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

}
?>
