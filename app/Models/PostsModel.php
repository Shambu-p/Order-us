<?php
namespace Users\Models;


use Absoft\Line\Modeling\Model;

class PostsModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    public $TABLE_NAME = "Posts";

    public $MAINS = [
        "id" => "",
        "text" => "",
        "image" => "",
        "pin" => "",
        "date" => ""
    ];

    public $HIDDEN = [];

}
?>
