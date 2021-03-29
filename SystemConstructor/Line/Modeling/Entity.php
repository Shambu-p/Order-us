<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 10/24/2019
 * Time: 6:25 PM
 */

namespace Absoft\Line\Modeling;

use Absoft\Line\Database\Database;
use Absoft\Line\QueryConstruction\Creation;

abstract class Entity{

    public $ATTRIBUTES;
    public $HIDDEN_ATTRIBUTES;
    public $TABLE_NAME;
    public $PRIMARY_KEY = "id";
    public $DATABASE = "MySql";
    public $DATABASE_NAME = "first";

    public function __construct(){

        $schema = new Schema();
        $this->construct($schema);

    }

    /**
     * @return array|bool|int|string
     */
    public function CreateEntity(){

        $return = array();

        try{

            $con = new Database($this->DATABASE, $this->DATABASE_NAME);
            $result = $con->execute(new Creation($this->TABLE_NAME, array_merge($this->ATTRIBUTES, $this->HIDDEN_ATTRIBUTES)));
            $return = $result;

        }catch(\Exception $e){

            $return['message'] = "-8";
            $return['returned'] = $e->getMessage();

            \ErrorHandler::reportError(
                "Entity Creation Failed!",
                $e->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

        }

        return $return;

    }

    abstract function construct(Schema $table);

    public function getReference($table_name){

        $reference = "";

        foreach($this->ATTRIBUTES as $attribute){

            if($attribute->foreign == $table_name){

                $reference = $attribute->name;
                break;

            }

        }

        return $reference;

    }

    public function getPrimaryAttribute(){

        return $this->PRIMARY_KEY;

    }

}
