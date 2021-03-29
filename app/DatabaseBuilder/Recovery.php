<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class Recovery extends Entity{

    function construct(Schema $table, $table_name = "Recovery"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->string("username")->nullable(false)->Reference("Users")->on("username")->length(14)->unique(true)
			//@att_end
        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            $table->hidden("confirmation")->length(30)
			//@hide_end
        ];

    }

}

?>
