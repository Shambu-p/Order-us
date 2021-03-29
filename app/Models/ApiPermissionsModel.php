<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class ApiPermissionsModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "ApiPermissions";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        "api_key" => "",
        "tables" => "",
        "permissions" => ""
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [];

    public function byKey($key){

        return $this->search(
            [
                [
                    "name" => "key",
                    "value" => $key,
                    "equ" => "=",
                    "det" => "and"
                ]
            ],
            [
                "tables",
                "permissions"
            ]
        );

    }

    public function User()
    {
        return parent::hasOne("Users\Models\ApiModel");
    }

    public function delete($key, $table, $permission){

        return $this->deleteRecord(
            [
                [
                    "name" => "key",
                    "value" => $key,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "tables",
                    "value" => $table,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "permissions",
                    "value" => $permission,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

    }

}
?>
