<?php
namespace Users\Initializers;

use Absoft\Line\Modeling\Initializer;
use Users\Models\UsersModel;

class UsersInitializer extends Initializer{

    /*
    public $MAINS = [
        [
            "id" => "the_id",
            "name" => "the_name",
        ],
        [
            "id" => "the_id",
            "name" => "the_name"
        ]
    ];

    */

    /*************************************************************************
        In this property you are expected to put all the values you want
        to insert into database. the you can initialize the operation from
        line cli.
    *************************************************************************/

    public $VALUES = [
        [
            "username" => "@admin",
            "password" => "password",
            "gender" => "male",
            "f_name" => "Abnet",
            "l_name" => "Kebede",
            "status" => "active",
            "role" => "admin",
            "phone_number" => "0943337884",
            "email" => "abnet.kebede075@gmail.com"
        ]
    ];
    
    

}
?>
