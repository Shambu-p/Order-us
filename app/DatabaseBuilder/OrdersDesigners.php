<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class OrdersDesigners extends Entity{

    function construct(Schema $table, $table_name = "OrdersDesigners"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            $table->int("orders")->length(15)->nullable(false)->sign(false)->Reference("Orders")->on("id"),
            $table->string("designer")->length(30)->nullable(false)->Reference("Users")->on("username"),
            $table->string("status")->length(10)->nullable(false)
        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
