<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;

class Orders extends Entity{

    function construct(Schema $table, $table_name = "Orders"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            $table->autoincrement("id")->length(15),
            $table->string("full_name")->length(70)->nullable(false),
            $table->string("email")->length(100)->nullable(false),
            $table->string("phone_number")->length(15)->nullable(false),
            $table->string("designer")->length(30)->nullable(false)->Reference("Users")->on("username"),
            $table->string("type")->length(30)->nullable(false),
            $table->string("status")->length(15)->nullable(false),
            $table->int("order_date")->nullable(false)->length(30),
            $table->int("return_date")->nullable(true)->length(30),
            $table->int("suggested_image")->length(30)->nullable(true),
            $table->int("design")->sign(false)->nullable(true)->Reference("Designs")->on("id"),
            $table->text("text")->nullable(true),
            $table->text("address")->nullable(true),
            $table->int("amount")->nullable(false)->sign(false),
            $table->double("payment")->nullable(false)->sign(false)
        ];

        $this->HIDDEN_ATTRIBUTES = [
            $table->hidden("password")->nullable(false),
        ];

    }

}

?>
