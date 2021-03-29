<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class RecoveryModel extends Model{
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "Recovery";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        "username" => "",
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [
        "confirmation" => ""
    ];



    public function byUser($user){

        $result = $this->search(
            [
                [
                    "name" => "username",
                    "value" => $user,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if(sizeof($result)){

            return $result[0];

        }

        return $result;

    }

}
?>
