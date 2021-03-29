<?php
namespace Users\Models;


use Absoft\Line\Modeling\Model;

class ApiModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];
    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "Api";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        "api_key" => "",
        "agent_name" => "",
        "company_name" => "",
        "status" => ""
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [];



    public function allUsers(){

        return $this->search([]);

    }

    public function Permissions(){

        return $this->hasMany("Users\Models\ApiPermissionsModel");

    }

    public function change($column, $set, $key){

        return $this->update(
            [
                $column => $set
            ],
            [
                [
                    "name" => "api_key",
                    "value" => $key,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function deactivate($key){

        return $this->update(
            [
                "status" => "deactivated"
            ],
            [
                [
                    "name" => "api_key",
                    "value" => $key,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function activate($key){

        return $this->update(
            [
                "status" => "active"
            ],
            [
                [
                    "name" => "api_key",
                    "value" => $key,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

    public function searchAll($word){

        return $this->search(
            [
                [
                    "name" => "api_key",
                    "value" => "%$word%",
                    "equ" => "like",
                    "det" => "or"
                ],
                [
                    "name" => "agent_name",
                    "value" => "%$word%",
                    "equ" => "like",
                    "det" => "or"
                ],
                [
                    "name" => "company_name",
                    "value" => "%$word%",
                    "equ" => "like",
                    "det" => "or"
                ]
            ]
        );

    }

}
?>
