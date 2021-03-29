<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class Prices extends Entity{

    function construct(Schema $table, $table_name = "Prices"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->string("type")->length(10)->nullable(false),
            $table->string("determiner")->length(15)->nullable(false),
            $table->string("value")->length(15)->nullable(false),
            $table->double("price")->length(6)->nullable(false)
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
