<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class Api extends Entity{

    function construct(Schema $table, $table_name = "Api"){

        $this->TABLE_NAME = $table_name;
        $this->PRIMARY_KEY = "api_key";

        $this->ATTRIBUTES = [
            //@att_start
            $table->int("api_key")->setPrimaryKey()->length(15)->nullable(false)->sign(false),
            $table->string("agent_name")->length(50)->nullable(false),
            $table->string("company_name")->length(50)->nullable(true),
            $table->string("status")->length(10)->nullable(false)
			//@att_end
        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            
            //@hide_end
        ];

    }

}

?>
