<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/19/2020
 * Time: 11:12 AM
 */

namespace Absoft\Line\QueryConstruction;

class Deletion extends QueryConstructor {

    public $query = "";
    public $values = array();

    function deleteRecord($table, $condition){

        $this->query = "delete from $table";

        if(sizeof($condition) > 0){

            $this->query .= " where ";

            foreach($condition as $value){

                $this->values["condition_".$value["name"]] = $value["value"];

            }

            $this->query = $this->query.$this->conditionDerdari($condition);

        }

    }

    function dropTable($table_name){

        $this->query = "drop table $table_name";
        $this->values = array();

    }

    function dropColumn(){

    }

    function getQuery()
    {
        return $this->query;
    }

    function getValues()
    {
        return $this->values;
    }
}
