<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class PricesModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "Prices";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        //@att_start
        "type" => "",
        "determiner" => "",
        "value" => "",
        "price" => ""
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

    public function byType($type){

        $return = [];

        $result = $this->search(
            [
                [
                    "name" => "type",
                    "value" => $type,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if(sizeof($result)){

            foreach($result as $price){

                $return[$price["determiner"]][$price["value"]] = $price["price"];

            }

        }

        return $return;

    }

    public function allPrices(){

        $return = [];

        $result = $this->search([]);

        if(sizeof($result)){

            foreach($result as $price){

                $return[$price["type"]][$price["determiner"]][$price["value"]] = $price["price"];

            }

        }

        return $return;

    }

}
?>
