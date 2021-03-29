<?php
namespace Users\Api\DatabaseBuilders;


use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class ApiPermissions extends Entity{

    function construct(Schema $table, $table_name = "ApiPermissions"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            /*
             $table->string("name")->length(30)->nullable(boolean)->reference("table_name")->on("id"),
            */
            $table->int("api_key")->length(15)->nullable(false)->Reference("Api")->on("key"),
            $table->string("tables")->length(20)->nullable(false),
            $table->string("permissions")->length(6)->nullable(false)
            
        ];

        $this->HIDDEN_ATTRIBUTES = [];

    }

}

?>
