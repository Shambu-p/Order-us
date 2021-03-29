<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class Designs extends Entity{

    function construct(Schema $table, $table_name = "Designs"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            $table->autoincrement("id"),
            $table->int("image")->length(30)->nullable(false)->sign(false)->Reference("Images")->on("id"),
            $table->string("type")->length(20)->nullable(false),
            $table->string("name")->length(30)->nullable(false),
            $table->double("price")->length(6)->nullable(false),
            $table->string("designer")->length(30)->nullable(false)->Reference("Users")->on("username")
        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
