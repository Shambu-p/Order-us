<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class Posts extends Entity{

    function construct(Schema $table, $table_name = "Posts"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            $table->autoincrement("id")->length(15),
            $table->text("image")->nullable(false),
            $table->text("text")->nullable(false),
            $table->string("pin")->nullable(true)->length(15),
            $table->int("data")->nullable(false)->length(15)->sign(false)

        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
