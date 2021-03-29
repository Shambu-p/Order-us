<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class Previews extends Entity{

    function construct(Schema $table, $table_name = "Previews"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [

            $table->autoincrement("id")->length(15),
            $table->int("orders")->length(15)->nullable(false)->Reference("Orders")->on("id"),
            $table->int("image")->length(30)->nullable(false),
            $table->string("designer")->length(14)->nullable(false)->Reference("Users")->on("username"),
            $table->string("status")->length(10)->nullable(false),
            $table->int("date")->nullable(false)->length(30)->sign(false)

        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
