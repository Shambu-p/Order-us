<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class ForAman extends Entity{

    function construct(Schema $table, $table_name = "ForAman"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->autoincrement("id"),
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
        