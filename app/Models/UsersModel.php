<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class UsersModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "Users";
    //public $DATABASE = "MsSql";
    //public $DATABASE_NAME = "second";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        "username" => "",
        "email" => "",
        "role" => "",
        "f_name" => "",
        "l_name" => "",
        "status" => "",
        "phone_number" => ""
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [
        "password" => ""
    ];

    public function Recovery(){

        return parent::hasMany("Users\Models\RecoveryModel");

    }

    public function changeState($user, $state){

        return $this->update(
            [
                "status" => $state
            ],
            [
                [
                    "name" => "username",
                    "value" => $user,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function getName($username){

        $return = $this->search(
            [
                [
                    "name" => "username",
                    "value" => $username,
                    "equ" => "=",
                    "det" => "and"
                ]
            ],
            [
                "f_name",
                "l_name"
            ]
        );

        if(sizeof($return)){
            return $return[0];
        }

        return [];

    }

    public function byUsername($username){

        $return = $this->search(
            [
                [
                    "name" => "username",
                    "value" => $username,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if(sizeof($return)){
            return $return[0];
        }

        return [];

        //ሰማይም እህ ሲል እንደ ሰው ሲከፋ
        //አይን አይለይም እንጂ በሌት በጨለማ
        //እንዲያው በረዶ ነው ቀን የጣለውማ

    }

    public function activeDesigners(){

        return $this->search(
            [
                [
                    "name" => "status",
                    "value" => "active",
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "role",
                    "value" => "designer",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

}
?>
