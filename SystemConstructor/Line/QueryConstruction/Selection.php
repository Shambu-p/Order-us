<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/18/2020
 * Time: 9:44 PM
 */

namespace Absoft\Line\QueryConstruction;

use Absoft\Line\Modeling\Entity;

class Selection extends QueryConstructor{

    public $values = array();

    /**
     * @param Object $tables
     * @param array $filter
     * @param array $condition
     *      $tables should be object of an Entity
     *      $filter should be array of columns which are supposed to be shown in the result
     *      $condition should be associative array of [attribute name => ['value' => value, 'equ' => '=,>,<', 'det' => 'and,or']]
     * @param Object $join_table
     * @param array $order_by
     */
    function __construct(Entity $tables, $filter = ["*"], $condition = [], Entity $join_table = null, $order_by = []){

        $this->select($filter);

        if($join_table != null){

            $this->from($tables, $join_table);

            $this->join($tables, $join_table);

        }
        else{

            $this->from($tables);

        }

        $this->where($condition);


        if(sizeof($order_by) > 0 && isset($order_by["att"])){

            $this->orderBy($order_by);

        }

    }

    function select($filter){

        //select column1, column2, column3 from table_name, table2, table3 where column = value
        $this->query = "select ";


        if(sizeof($filter) == 0){

            $this->query = $this->query . "* ";

        }else if(sizeof($filter) > 0){

            $this->query = $this->query.$this->singleDerdari($filter);

        }

    }

    function from($table, $join=null){

        //from table_name, table1

        $this->query = $this->query." from ". $table->TABLE_NAME;

        if($join != null){

            $this->query = $this->query.", ". $join->TABLE_NAME;

        }

    }

    function where($condition){

        //where column1 = :condition_column1 and/or column2 = value
        /*

        $array = [
            [
                "name" => "column1",
                "value" => "value",
                "equ" => "= != > < like",
                "det" => "and or"
            ],
            [
                "name" => "column1",
                "value" => "value",
                "equ" => "= != > < like",
                "det" => "and or"
            ],

        ]

         */

        if(sizeof($condition) > 0){

            $this->query = $this->query." where ";
            $this->query = $this->query.$this->conditionDerdari($condition);

            foreach($condition as $value){

                $name = "condition_".$value["name"];
                $this->values[$name] = $value['value'];

            }

        }

    }

    function join(Entity $table, Entity $join){

        if($join != null){

            $this->query .= " join ".$join->TABLE_NAME;

            if($here = $table->getReference($join->TABLE_NAME)){

                $this->query .= " on $table.$here = ".$join->TABLE_NAME.".$join->PRIMARY_KEY ";

            }else if($here = $join->getReference($table->TABLE_NAME)){

                $this->query .= " on $table.$table->PRIMARY_KEY = ".$join->TABLE_NAME.".$here ";

            }

        }

    }

    function orderBy($order_by){

        /*

        $array = [
            "att" => "column",
            "det" => 1
        ]

         */

        $this->query .= " order by ".$order_by["att"];

        if($order_by["det"] == 1){

            $this->query .= " asc";

        }else{

            $this->query .= " desc";

        }

    }

    function getQuery(){
        return $this->query;
    }

    function getValues()
    {
        return $this->values;
    }
}
