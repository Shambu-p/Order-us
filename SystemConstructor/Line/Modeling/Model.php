<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 10/24/2019
 * Time: 10:59 PM
 */

namespace Absoft\Line\Modeling;

use Absoft\App\Loaders\Loader;
use Absoft\Line\Database\Database;
use Absoft\Line\QueryConstruction\Deletion;
use Absoft\Line\QueryConstruction\Insertion;
use Absoft\Line\QueryConstruction\Selection;
use Absoft\Line\QueryConstruction\Update;

abstract class Model{

    public $MAINS;
    public $TABLE_NAME;
    public $HIDDEN;
    public $DATABASE = "MySql";
    public $DATABASE_NAME = "first";

    /**
     * @param $model_name
     * @return array
     */
    public function hasOne($model_name){

        try{

            $model = new $model_name;

            $name = $model->TABLE_NAME;

            $reference = $this->getEntity()->getReference($model->TABLE_NAME);

            if($reference != ""){

                $value = $this->MAINS[$reference];
                //$array[] = ["name" => $reference,"value" => $value, "equ" => "=", "det" => "and"];
                return $model->find($value);

            }else{

                \ErrorHandler::reportError(
                    "Column Not Found!",
                    "There is no Reference to the table named ". $name." in Entity " . $this->TABLE_NAME,
                    __FILE__." on Line ".__LINE__,
                    "immediate"
                );

                return [];

            }

        } catch (\Exception $e){

            \ErrorHandler::reportError(
                "Column Not Found!",
                $e->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

            return [];

        }

    }

    /**
     * @return Entity
     */
    function getEntity(){

        $entity_name = 'Users\DatabaseBuilders\\'.$this->TABLE_NAME;

        return new $entity_name;

    }

    /**
     * @param $model_name
     * @return array
     */
    public function hasMany($model_name){

        try{

            $model = new $model_name;

            $reference = $model->getEntity()->getReference($this->TABLE_NAME);

            if($reference != ""){

                $value = $this->MAINS[$this->getEntity()->PRIMARY_KEY];

                if($value != ""){

                    return $model->search(
                        [
                            [
                                "name" => "$reference",
                                "value" => $value,
                                "equ" => "=",
                                "det" => "and"
                            ]
                        ]
                    );

                }
                else{

                    \ErrorHandler::reportError(
                        "Empty Value!",
                        "The value of the attribute in the model ".$model->TABLE_NAME." is empty",
                        __FILE__." on Line ".__LINE__,
                        "immediate"
                    );

                    return [];

                }

            }
            else{

                \ErrorHandler::reportError(
                    "Column Not Found!",
                    "There is no column named ". $model->TABLE_NAME ." in Entity ". $this->TABLE_NAME,
                    __FILE__." on Line ".__LINE__,
                    "immediate"
                );

                return [];

            }

        }catch (\Exception $ex){

            \ErrorHandler::reportError(
                "Empty Value!",
                $ex->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

            return [];

        }

    }

    /**
     * @param string $key
     * @return array
     */
    public function find($key){

        $table = $this->getEntity();
        $pk = $this->getEntity()->PRIMARY_KEY;

        $array = [
            [
                "name" => "$pk",
                "value" => $key,
                "equ" => "=",
                "det" => "and"
            ]
        ];
        $constructor = new Selection($table, [], $array);
        $connection = new Database($this->DATABASE, $this->DATABASE_NAME);

        $result = $connection->executeFetch($constructor);

        if($result["message"] == "1" || $result["message"] == "-3"){

            if(sizeof($result["returned"]) > 0){

                return $result["returned"][0];

            }

            return $result["returned"];

        }

        return [];

    }

    /**
     * @param array $array
     *  this is condition
     * @param array $array2
     *  this is attribute filter
     * @param string $join
     * @param array $order_by
     * @return array
     */
    function search(Array $array, Array $array2 = array("*"), $join = "", $order_by = []){

        try{

            $condition = [];
            $filter = [];
            $r_join = null;
            $order = [];

            if($join != ""){

                $reflection = new \ReflectionClass($join);
                $r_join = $reflection->newInstance();

            }

            if(sizeof($array) > 0 || sizeof($array2) > 0){

                foreach(array_merge($this->MAINS, $this->HIDDEN) as $key => $value){

                    for($count = 0; $count < sizeof($array); $count ++){

                        if(isset($array[$count]) && isset($array[$count]["name"]) && $array[$count]["name"] == $key ){

                            $condition[] = $array[$count];

                        }

                    }

                    if(in_array($key, $array2)){

                        $filter[] = $key;

                    }

                }

            }


            if(sizeof($order_by) > 0){

                if(isset($order_by["att"]) && isset($this->MAINS[$order_by["att"]])){

                    if(isset($order_by["det"]) && $order_by["det"] == "1" || $order_by["det"] == "0"){

                        $order["att"] = $order_by["att"];
                        $order["det"] = $order_by["det"];

                    }

                }

            }

            $con = new Database($this->DATABASE, $this->DATABASE_NAME);

            if($r_join == null){

                $result = $con->executeFetch(new Selection($this->getEntity(), $filter, $condition, null, $order));

            }else{

                $result = $con->executeFetch(new Selection($this->getEntity(), $filter, $condition, $r_join, $order));

            }

            if($result["message"] == "1" || $result["message"] == "-3"){
                return $result["returned"];
            }

            return [];

        }catch (\Exception $e){

            \ErrorHandler::reportError(
                "Exception Occurred!",
                $e->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

            return [];

        }

    }

    function deleteRecord(Array $condition = array()){

        $return = null;

        $my_condition = array();

        if(sizeof($condition) > 0){

            foreach($this->MAINS as $key => $value){

                for($count = 0; $count < sizeof($condition); $count ++){

                    if(isset($condition[$count]["name"]) && $condition[$count]["name"] == $key){

                        $my_condition[] = $condition[$count];

                    }

                }

            }

        }

        $con = new Database($this->DATABASE, $this->DATABASE_NAME);

        $query = new Deletion();
        $query->deleteRecord($this->TABLE_NAME, $my_condition);

        $return = $con->execute($query);

        if($return["message"] == "1"){

            return true;

        }

        return false;

    }

    /**
     * @param $attribute
     * @return int|mixed
     */
    function getMaxOf($attribute){

        $return = -1;
        $temp = [];

        if(isset($this->MAINS[$attribute])){

            $result = $this->search([], [$attribute]);

            foreach ($result as $val){

                $temp[] = $val[$attribute];

            }

            $return = max($temp);

        }

        return $return;

    }

    /**
     * @param $attribute
     * @return int|mixed
     */
    function getMinOf($attribute){

        $return = -1;
        $temp = [];

        if(isset($this->MAINS[$attribute])){

            $result = $this->search([], [$attribute]);

            foreach ($result as $val){

                $temp[] = $val[$attribute];

            }

            $return = min($temp);

        }

        return $return;

    }

    /**
     * @param $values
     * @return boolean
     */
    function addRecord($values){

        $in_values = [];
        $size = sizeof($values);

        if($size > 0 && $size <= (sizeof($this->MAINS) + sizeof($this->HIDDEN))){

            foreach($this->MAINS as $key => $value){

                if(isset($values[$key]) && $values[$key] != ""){

                    $in_values[$key] = $values[$key];

                }

            }

            foreach($this->HIDDEN as $key => $value){

                if(isset($values[$key]) && $values[$key] != ""){

                    $in_values[$key] = password_hash($values[$key], PASSWORD_DEFAULT);

                }

            }

            $con = new Database($this->DATABASE, $this->DATABASE_NAME);
            $result = $con->execute(new Insertion($this->TABLE_NAME, $in_values));

            if($result["message"] == "1"){
                return true;
            }

            return false;

        }else{

            \ErrorHandler::reportError(
                "Data out of Range!",
                "There is no value to be inserted. the array is empty.",
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

            return false;

        }

    }

    /**
     * @param $values
     * @return array
     */
    function addMultiRecords($values){

        $return = [];

        foreach($values as $record){

            if($this->addRecord($record)){

                $return[] = "Added Successfully";

            }
            else{

                if(isset($_SESSION["_system"]["error_handling"]["error"]["description"])){

                    $return[] = $_SESSION["_system"]["error_handling"]["error"]["description"];

                }

                $return[] = "error";

            }

        }

        return $return;

    }

    /**
     * @param $set
     * @param $condition
     * @return bool
     */
    function update($set, $condition){

        $condi = [];
        $st = [];
        $size = sizeof($set);
        $size1 = sizeof($condition);

        if($size > 0){

            foreach($this->MAINS as $key => $value){

                if($size1 > 0){

                    for($count = 0; $count < $size1; $count ++){

                        if(isset($condition[$count]["name"]) && $condition[$count]["name"] == $key){

                            $condi[] = $condition[$count];

                        }

                    }

                }

                if(isset($set[$key])){

                    $st[$key] = $set[$key];

                }

            }

            foreach($this->HIDDEN as $key => $value){

                if(isset($set[$key])){

                    $st[$key] = password_hash($set[$key], PASSWORD_DEFAULT);

                }

            }

            $con = new Database($this->DATABASE, $this->DATABASE_NAME);
            $result = $con->executeUpdate(new Update($this->TABLE_NAME, $st, $condi));

            if($result["message"] == "1"){
                return true;
            }

            return false;

        }else{

            \ErrorHandler::reportError(
                "Empty Array!",
                "There is nothing to update. you should try to fill the array and then try again.",
                __FILE__." on Line ".__line__,
                "immediate"
            );

            return false;

        }

    }

}
