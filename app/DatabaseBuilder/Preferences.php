<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class Preferences extends Entity{

    function construct(Schema $table, $table_name = "Preferences"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->int("orders")->length(15)->nullable(false)->Reference("Orders")->on("id"),
            $table->string("name")->length(15)->nullable(false),
            $table->string("value")->length(15)->nullable(false)
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
