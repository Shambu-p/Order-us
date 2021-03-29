<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class Abnet extends Entity{

    function construct(Schema $table, $table_name = "Abnet"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
			$table->string("heni")->length(30)->nullable(true)->sign(false)->unique(false),
			$table->int("aba")->length(12)->nullable(false)->sign(false)->unique(false)
			//@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
			$table->int("final")->length(11)->nullable(true)->unique(false),
			$table->string("heni1")->length(50)->nullable(true)->unique(true)
			//@hide_end
        ];

    }

}

?>
        