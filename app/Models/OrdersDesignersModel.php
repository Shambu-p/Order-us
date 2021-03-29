<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class OrdersDesignersModel extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    public $TABLE_NAME = "OrdersDesigners";

    public $MAINS = [
        "orders" => "",
        "designer" => "",
        "status" => ""
    ];

    public $HIDDEN = [];

}
?>
