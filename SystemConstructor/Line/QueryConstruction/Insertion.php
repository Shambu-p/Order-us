<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/18/2020
 * Time: 10:19 PM
 */

namespace Absoft\Line\QueryConstruction;

class Insertion extends QueryConstructor {

    function __construct($table, $values = array()){
        $value_size = sizeof($values);

        if($value_size > 0 && $table != "" && $table != null){
            $this->query = "insert into $table ";
            $filter = array();
            $last = array();
            foreach($values as $key => $value){
                $filter[] = $key;
                $name = "condition_$key";
                $last[] = ":".$name;
                $this->values[$name] = $value;
            }

            $this->query = $this->query."(".$this->singleDerdari($filter).")";
            $this->query = $this->query." values(".$this->singleDerdari($last).")";
        }
    }

    function getQuery(){
        return $this->query;
    }

    function getValues(){
        return $this->values;
    }

}
