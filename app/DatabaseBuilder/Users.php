<?php
namespace Users\DatabaseBuilders;


use Absoft\Line\Modeling\Entity;
use Absoft\Line\Modeling\Schema;

class Users extends Entity {

    function construct(Schema $table, $table_name = "Users"){

        $this->TABLE_NAME = $table_name;
        $this->PRIMARY_KEY = "username";

        $this->ATTRIBUTES = [
            //@att_start
            $table->string("username")->nullable(false)->length(14)->setPrimaryKey(),
            $table->string("f_name")->nullable(false)->length(50),
            $table->string("l_name")->nullable(false)->length(50),
            $table->string("email")->nullable(false)->length(100)->unique(true),
            $table->string("phone_number")->nullable(true)->length(15),
            $table->string("role")->length(30),
            $table->string("status")->length(30)
            //@att_end
        ];

        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            $table->hidden("password")->nullable(false)
            //@hide_end
        ];

    }

}

?>
