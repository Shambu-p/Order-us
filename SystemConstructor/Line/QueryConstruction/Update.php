<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/19/2020
 * Time: 10:30 AM
 */

namespace Absoft\Line\QueryConstruction;

class Update extends QueryConstructor {

    function __construct($table, $set, $condition = array()){

        /*


        $arra = [
            "column" => "value",
            "column2 => "avalu"
        ]

         */

        $this->query = "update $table set ";
        $sets = $this->setDerdari($set, "sets");
        $this->query .= $sets["query"];
        $this->values = $sets["values"];

        if(sizeof($condition) > 0){

            foreach($condition as $value){

                $this->values["condition_".$value["name"]] = $value["value"];

            }

            $this->query = $this->query. " where ";
            $this->query = $this->query. $this->conditionDerdari($condition);

        }

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
