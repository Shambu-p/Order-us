<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class Aman extends Entity{

    function construct(Schema $table, $table_name = "Aman"){

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
        